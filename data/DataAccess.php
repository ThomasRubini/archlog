<?php

namespace data;

include "service/DataAccessInterface.php";
include "domain/User.php";
include "domain/Post.php";

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

    public function insertComment($annonce_id, $user_login, $text) {
        $result = $this->dataAccess->prepare('INSERT INTO COMMENT (annonce_id, user_login, text) VALUES (:ann_id, :user_login, :text)');
        $result->bindValue(":ann_id", $annonce_id);
        $result->bindValue(":user_login", $user_login);
        $result->bindValue(":text", $text);
        $result->execute();
    }
}

?>