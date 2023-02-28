<?php

namespace control;

class Presenter {

    protected $annoncesCheck;

    public function __construct($annoncesCheck) {
        $this->annoncesCheck = $annoncesCheck;
    }

    public function getAllAnnoncesHTML() {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $content = '<h1>List of Posts</h1>  <ul>';
            foreach ($this->annoncesCheck->getAnnoncesTxt() as $post) {
                $content .= ' <li>';
                $content .= '<a href="/annonces/index.php/post?ID=' . $post['ID'] . '">' . $post['TITLE'] . '</a>';
                $content .= ' </li>';
            }
            $content .= '</ul>';
        }
        return $content;
    }

    public function getCurrentPostHTML() {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $post = $this->annoncesCheck->getAnnoncesTxt()[0];
            $content = '<h1>' . $post['TITLE'] . '</h1>';
            $content .= '<div class="date">' . $post['DATE'] . '</div>';
            $content .= '<div class="body">' . $post['BODY'] . '</div>';
        }
        return $content;
    }
}

?>