<?php

namespace gui;

include_once('View.php');

class ViewCommentSubmitted extends View {

    public function __construct($layout) {
        parent::__construct($layout);
        header("refresh:5;url=/annonces/index.php/annonces");
        $this->title = 'Exemple Blog Basic PHP : Connexion';
        $this->content = '
            <h1>  Votre commentaire à bien été posté ! Redirection automatique dans 5sec </h1>
        ';
    }
}

?>