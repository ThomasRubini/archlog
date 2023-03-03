<?php

namespace control;

class Controllers {

    public function annoncesAction($data, $annoncesCheck) {
        $annoncesCheck->getAllAnnonces($data);
    }

    public function postAction($id, $data, $annoncesCheck) {
        $annoncesCheck->getPost($id, $data);
    }

    /**
     * Controller method for /annonces/index.php/submitComment
     * will write the comment in the database
     *
     * @param string $annonce_id the ID of the post/annonce linked to the commen
     * @param string $userLogin the login of the user who posted this comment
     * @param string $text the content of this comment
     * @param string $data DataAccess reference
     *
     * @return void
     */
    public function commentSubmittedAction($annonce_id, $userLogin, $text, $data, $comments) {
        $comments->submitComment($annonce_id, $userLogin, $text, $data);
    }


    /**
     * Controller method for /annonces/index.php/myComments
     * will query comments a user got from the database
     *
     * @param string $userLogin the login of the user
     * @param string $data DataAccess reference
     * @param string $comments reference to the use-case, to store retrieved elements
     *
     * @return void
     */
    public function myCommentsAction($userLogin, $data, $comments) {
        $comments->getCommentsUserReceived($userLogin, $data);
    }

}

?>