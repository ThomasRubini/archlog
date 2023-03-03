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

    public function getUser($login, $password) {
        $user = null;
        $query = 'SELECT login FROM USER WHERE LOGIN="' . $login . '" and PASSWORD="' . $password . '"';
        $result = $this->dataAccess->query($query);
        if ($result->rowCount()) $user = new User($login, $password);
        $result->closeCursor();
        return $user;
    }

    public function getAllAnnonces() {
        $result = $this->dataAccess->query('SELECT * FROM POST');
        $annonces = array();
        while ($row = $result->fetch())
            $annonces[] = new Post($row['id'], $row['title'], $row['body'], $row['date']);
        $result->closeCursor();
        return $annonces;
    }

    public function getPost($id) {
        $id = intval($id);
        $result = $this->dataAccess->query('SELECT * FROM POST WHERE ID=' . $id);
        $row = $result->fetch();
        $post = new Post($row['id'], $row['title'], $row['body'], $row['date']);
        $result->closeCursor();
        return $post;
    }

}

?>