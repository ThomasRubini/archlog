<?php

namespace service;

interface DataAccessInterface {

    public function getUser($login);
    public function getAllAnnonces();
    public function getPost($id);
    
}

?>