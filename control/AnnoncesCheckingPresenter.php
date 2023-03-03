<?php

namespace control;

class AnnoncesCheckingPresenter {

    protected $annoncesCheck;

    public function __construct($annoncesCheck) {
        $this->annoncesCheck = $annoncesCheck;
    }

    public function getAllAnnoncesHTML() {
        $content = '<h1>List of Posts</h1>  <ul>';
        foreach ($this->annoncesCheck->getAnnoncesTxt() as $post) {
            $content .= ' <li>';
            $content .= '<a href="/annonces/index.php/post?ID=' . $post['ID'] . '">' . $post['TITLE'] . '</a>';
            $content .= ' </li>';
        }
        $content .= '</ul>';
        return $content;
    }

    public function getCurrentPostHTML() {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $post = $this->annoncesCheck->getAnnoncesTxt()[0];
            $content = '<h1>' . $post['TITLE'] . '</h1>';
            $content .= '<div class="user">' . $post['USER_NAME'] . '</div>';
            $content .= '<div class="date">' . $post['DATE'] . '</div>';
            $content .= '<div class="body">' . $post['BODY'] . '</div>';
            $content .= '<a href="/annonces/index.php/comment?ID_ANNONCE='.$post["ID"].'">Commenter sur cette annonce</a>';
        }
        return $content;
    }
}

?>