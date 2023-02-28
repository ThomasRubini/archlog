<?php

namespace service;

class AnnoncesChecking {

    protected $annoncesTxt;

    public function getAnnoncesTxt() {
        return $this->annoncesTxt;
    }

    public function authenticate($login, $password, $data) {
        return $data->getUser($login, $password) != null;
    }

    public function getAllAnnonces($data) {
        $annonces = $data->getAllAnnonces();
        $this->annoncesTxt = array();
        foreach ($annonces as $post)
            $this->annoncesTxt[] = ['ID' => $post->getId(), 'TITLE' => $post->getTitle(), 'BODY' => $post->getBody(), 'DATE' => $post->getDate()];
    }

    public function getPost($id, $data) {
        $post = $data->getPost($id);
        $this->annoncesTxt[] = array('ID' => $post->getId(), 'TITLE' => $post->getTitle(), 'BODY' => $post->getBody(), 'DATE' => $post->getDate());
    }

}

?>