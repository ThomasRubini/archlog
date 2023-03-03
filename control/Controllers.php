<?php

namespace control;

class Controllers {

    public function annoncesAction($login, $password, $data, $annoncesCheck) {
        if ($annoncesCheck->authenticate($login, $password, $data))
            $annoncesCheck->getAllAnnonces($data);
    }

    public function postAction($id, $data, $annoncesCheck) {
        $annoncesCheck->getPost($id, $data);
    }

    public function commentSubmittedAction($annonce_id, $text, $data, $comments) {
        $comments->submitComment($annonce_id, $text, $data);
    }

}

?>