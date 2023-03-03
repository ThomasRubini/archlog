<?php

namespace service;

// Je considère l'authentification comme un cas d'usage
class Login {
    public function authenticate($login, $password, $data) {
        $user = $data->getUser($login);
        return $user != null and $user->getPassword() == $password;
    }
}