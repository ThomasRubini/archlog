<?php

namespace gui;

include_once('View.php');

class ViewAnnonces extends View {

    public function __construct($layout, $login, $presenter) {
        parent::__construct($layout);
        $this->title = 'Exemple Annonces Basic PHP: Annonces';
        $this->content = '<p> Hello ' . $login . ' </p>';
        $this->content .= $presenter->getAllAnnoncesHTML();
        $this->content .= '<a href="/annonces/index.php/myComments"> View comments on your posts </a>';
    }
}

?>