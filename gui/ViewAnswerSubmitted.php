<?php

namespace gui;

include_once('View.php');

class ViewAnswerSubmitted extends View {

    public function __construct($layout) {
        parent::__construct($layout);
        header("refresh:5;url=/annonces/index.php/myComments");
        $this->title = 'Exemple Blog Basic PHP : Connexion';
        $this->content = '
            <h1>  Votre réponse au commentaire à bien été postée ! Redirection automatique dans 5sec </h1>
        ';
    }
}

?>