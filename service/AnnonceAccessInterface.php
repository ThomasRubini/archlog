<?php

namespace service;

interface AnnonceAccessInterface {

    public function getAllAnnonces();
    public function getPost($id);
    public function insertComment($annonce_id, $user_login, $text);
    public function getCommentsUserReceived($user_login);
    public function insertAnswer($comment_id, $answerText);

}

?>