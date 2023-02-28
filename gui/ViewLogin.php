<?php

namespace gui;

include_once('View.php');

class ViewLogin extends View {

    public function __construct($layout) {
        parent::__construct($layout);
        $this->title = 'Exemple Blog Basic PHP : Connexion';
        $this->content = '
            <form method="post" action="index.php/annonces">
                <label for="LOGIN"> Votre identifiant </label> :
                <input type="text" name="LOGIN" id="LOGIN" placeholder="defaut" maxlength="12" required />
                <br />
                <label for="PASSWORD"> Votre mot de passe </label> : <input type="password" name="PASSWORD" id="LOGIN" maxlength="12" required />
                <input type="submit" value="Envoyer">
            </form>';
    }

}

?>