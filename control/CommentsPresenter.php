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
            $content .= ' </li>';
        }
        $content .= '</ul>';
        return $content;
    }



}
