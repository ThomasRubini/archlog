<?php

namespace control;

use service\Comments;

class CommentsPresenter {

    protected $comments;

    public function __construct($comments) {
        $this->comments = $comments;
    }

    /**
     * Get the HTML tags to display the comments
     *
     * @return string
     */
    public function getAllCommentsHTML(){
        $content = '<h1> Comments received :</h1>  <ul>';
        foreach ($this->comments->getCommentsTxt() as $comment) {
            $content .= ' <li>';
            $content .= '<a href="/annonces/index.php/post?ID='.$comment['ANNONCE_ID'].'">From this post</a>';
            $content .= '<p>From: ' . $comment['USER_LOGIN'] . '</p>';
            $content .= '<p>Text: ' . $comment['TEXT'] . '</p>';
            if($comment["ANSWER_TEXT"]) {
                $content .= '<p> Your answer: '. $comment["ANSWER_TEXT"]." </p>";
            }else{
                $content .= '<form method="POST" action="/annonces/index.php/submitAnswer">';
                $content .= '<p>Answer to this comment: </p>';
                $content .= '<textarea name="ANSWER_TEXT" id="ANSWER_TEXT"></textarea>';
                $content .= '<input type="hidden" name="COMMENT_ID" value="'.$comment["ID"].'">';
                $content .= '<input type="submit" value="Répondre">';
                $content .= '</form>';
            }
            $content .= ' </li>';
            $content .= '<br/> <br/>';
        }
        $content .= '</ul>';
        return $content;
    }



}
