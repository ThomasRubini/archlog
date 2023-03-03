<?php

namespace domain;

class Post {
    
    protected $id;
    protected $title;
    protected $body;
    protected $date;
    protected $userLogin;

    public function __construct($id, $title, $body, $date, $userLogin) {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->userLogin = $userLogin;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getBody() {
        return $this->body;
    }

    public function getDate() {
        return $this->date;
    }

    public function getUserLogin() {
        return $this->userLogin;
    }
}

?>