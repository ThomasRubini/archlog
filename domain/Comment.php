<?php

namespace domain;

class Comment {

    protected $id, $annonce_id, $text, $userLogin;

    public function __construct($id, $annonce_id, $text, $userLogin) {
        $this->id = $id;
        $this->annonce_id = $annonce_id;
        $this->text = $text;
        $this->userLogin = $userLogin;
    }

    public function getId() {
        return $this->id;
    }

    public function getAnnonceID() {
        return $this->annonce_id;
    }

    public function getText() {
        return $this->text;
    }

    public function getUserLogin() {
        return $this->userLogin;
    }

}