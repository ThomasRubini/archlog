<?php

namespace data;

include "service/DataAccessInterface.php";
include "domain/User.php";
include "domain/Post.php";
include "domain/Comment.php";

use Domain\Comment;

use service\DataAccessInterface;
use domain\{User, Post};

class dataAccess implements DataAccessInterface {

    protected $dataAccess = null;

    public function __construct($dataAccess) {
        $this->dataAccess = $dataAccess;
    }

    public function __destruct() {
        $this->dataAccess = null;
    }

    public function getUser($login) {

        $query = 'SELECT * FROM USER WHERE LOGIN="' . $login . '"';
        $result = $this->dataAccess->query($query);
        if (!$result->rowCount())return null;
        $row = $result->fetch();

        $user = new User($row["login"], $row["password"]);
        $result->closeCursor();
        return $user;
    }

    public function getAllAnnonces() {
        $result = $this->dataAccess->query('SELECT * FROM POST');
        $annonces = array();
        while ($row = $result->fetch())
            $annonces[] = new Post($row['id'], $row['title'], $row['body'], $row['date'], $row['user_login']);
        $result->closeCursor();
        return $annonces;
    }

    public function getPost($id) {
        $id = intval($id);
        $result = $this->dataAccess->query('SELECT * FROM POST WHERE ID=' . $id);
        $row = $result->fetch();
        $post = new Post($row['id'], $row['title'], $row['body'], $row['date'], $row['user_login']);
        $result->closeCursor();
        return $post;
    }

    /**
     * Inserts a comment in the database
     *
     * @param string $annonce_id the ID of the post/annonce linked to the comment
     * @param string $user_login the login of the user who posted this comment
     * @param string $text the content of this comment
     *
     * @return void
     */
    public function insertComment($annonce_id, $user_login, $text) {
        $result = $this->dataAccess->prepare('INSERT INTO COMMENT (annonce_id, user_login, text) VALUES (:ann_id, :user_login, :text)');
        $result->bindValue(":ann_id", $annonce_id);
        $result->bindValue(":user_login", $user_login);
        $result->bindValue(":text", $text);
        $result->execute();
    }


    /**
     * Query comments from the database
     *
     * @param string $userLogin the login of the user
     *
     * @return array(Comment)
     */
    public function getCommentsUserReceived($userLogin) {
        $result = $this->dataAccess->prepare('
            SELECT COMMENT.* FROM COMMENT
            JOIN POST ON COMMENT.annonce_id = POST.id
             WHERE POST.user_login = :user_login
        ');
        $result->bindValue(":user_login", $userLogin);
        $result->execute();

        $comments = array();
        while ($row = $result->fetch()){
            $comments[] = new Comment($row['id'], $row['annonce_id'], $row['text'], $row['user_login']);
        }

        return $comments;
    }
}

?>