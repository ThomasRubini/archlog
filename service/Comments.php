<?php

namespace service;

class Comments
{
    protected $commentsTxt;

    public function getCommentsTxt() {
        return $this->commentsTxt;
    }

    public function submitComment($annonce_id, $text, $data){
        $data->insertComment($annonce_id, null, $text);
    }

    public function getCommentsUserReceived($userLogin, $data){
        $this->commentsTxt = array();
        foreach($data->getCommentsUserReceived($userLogin) as $comment){
            $this->commentsTxt[] = ['ID' => $comment->getId(), 'ANNONCE_ID' => $comment->getAnnonceID(), 'TEXT' => $comment->getText(), 'USER_LOGIN' => $comment->getUserLogin()];
        }
    }
}