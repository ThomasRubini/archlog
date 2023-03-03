<?php

namespace domain;

class Comment {

    protected $id, $annonce_id, $text, $answerText, $userLogin;

    public function __construct($id, $annonce_id, $text, $answerText, $userLogin) {
        $this->id = $id;
        $this->annonce_id = $annonce_id;
        $this->text = $text;
        $this->answerText = $answerText;
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

    public function getAnswerText() {
        return $this->answerText;
    }

    public function getUserLogin() {
        return $this->userLogin;
    }

}