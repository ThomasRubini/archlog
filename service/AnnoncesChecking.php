<?php

namespace service;

class AnnoncesChecking {

    protected $annoncesTxt;

    public function getAnnoncesTxt() {
        return $this->annoncesTxt;
    }

    public function authenticate($login, $password, $data) {
        $user = $data->getUser($login);
        return $user != null and $user->getPassword() == $password;
    }

    public function getAllAnnonces($data) {
        $annonces = $data->getAllAnnonces();
        $this->annoncesTxt = array();
        foreach ($annonces as $post){
            $user = $data->getUser($post->getUserLogin());
            $this->annoncesTxt[] = ['ID' => $post->getId(), 'TITLE' => $post->getTitle(), 'BODY' => $post->getBody(), 'DATE' => $post->getDate(), 'USER_NAME' => $user->getLogin()];
        }
    }

    public function getPost($id, $data) {
        $post = $data->getPost($id);
        $user = $data->getUser($post->getUserLogin());
        $this->annoncesTxt[] = array('ID' => $post->getId(), 'TITLE' => $post->getTitle(), 'BODY' => $post->getBody(), 'DATE' => $post->getDate(), 'USER_NAME' => $user->getLogin());
    }

}

?>