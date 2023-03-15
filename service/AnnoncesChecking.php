<?php

namespace service;

class AnnoncesChecking {

    protected $annoncesTxt;

    public function getAnnoncesTxt() {
        return $this->annoncesTxt;
    }

    public function getAllAnnonces($dataAnnonce) {
        $annonces = $dataAnnonce->getAllAnnonces();
        $this->annoncesTxt = array();
        foreach ($annonces as $post){
            $this->annoncesTxt[] = ['ID' => $post->getId(), 'TITLE' => $post->getTitle(), 'BODY' => $post->getBody(), 'DATE' => $post->getDate(), 'USER_NAME' => $post->getUserLogin()];
        }
    }

    public function getPost($id, $data) {
        $post = $data->getPost($id);
        $this->annoncesTxt[] = array('ID' => $post->getId(), 'TITLE' => $post->getTitle(), 'BODY' => $post->getBody(), 'DATE' => $post->getDate(), 'USER_NAME' => $post->getUserLogin());
    }

}

?>