<?php

namespace gui;

include_once('View.php');

class ViewMyComments extends View {

    public function __construct($layout, $commentsPresenter) {
        parent::__construct($layout);
        $this->title = 'Exemple Annonces Basic PHP: Annonces';
        $this->content .= $commentsPresenter->getAllCommentsHTML();
    }
}

?>