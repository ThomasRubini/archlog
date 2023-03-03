<?php

namespace gui;

include_once('View.php');

class ViewComment extends View {

    public function __construct($layout) {
        parent::__construct($layout);
        $this->title = 'Exemple Blog Basic PHP : Connexion';
        $this->content = '
            <h1> Commenter sur ce post </h1> :
            <form method="post" action="/annonces/index.php/annonces/submitComment">
                <label for="TEXT"> Contenu de votre commentaire : </label>
                <br>
                <textarea type="text" name="TEXT" id="TEXT" required></textarea>
                <input type="submit" value="Envoyer">
            </form>';
    }

}

?>