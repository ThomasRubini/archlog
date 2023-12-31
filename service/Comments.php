<?php

namespace service;

class Comments
{

    /**
     * array that contains the comments retrieved, in the form of arrays
     */
    protected $commentsTxt;

    public function getCommentsTxt() {
        return $this->commentsTxt;
    }


    /**
     * submit a comment
     *
     * @param string $annonce_id the ID of the post linked to the comment
     * @param string $userLogin the login of the user who posted this comment
     * @param string $text the content of this comment
     * @param string $data DataAccess reference
     *
     * @return void
     */
    public function submitComment($annonce_id, $userLogin, $text, $data){
        $data->insertComment($annonce_id, $userLogin, $text);
    }


    /**
     * submit an answer to a comment
     *
     * @param string $comment_id the ID of the comment
     * @param string $answerText the content of the answer
     * @param string $data DataAccess reference
     *
     * @return void
     */
    public function submitAnswer($comment_id, $answerText, $data){
        $data->insertAnswer($comment_id, $answerText);
    }


    /**
     * fill the field $commentsTxt from DataAccess data
     *
     * @param string $userLogin the login of the user
     * @param string $data DataAccess reference
     *
     * @return void
     */
    public function getCommentsUserReceived($userLogin, $data){
        $this->commentsTxt = array();
        foreach($data->getCommentsUserReceived($userLogin) as $comment){
            $this->commentsTxt[] = ['ID' => $comment->getId(), 'ANNONCE_ID' => $comment->getAnnonceID(), 'TEXT' => $comment->getText(), 'ANSWER_TEXT' => $comment->getAnswerText(), 'USER_LOGIN' => $comment->getUserLogin()];
        }
    }
}