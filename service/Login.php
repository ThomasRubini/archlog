<?php

namespace service;

/**
 * Manages the authentication use-case
 */
class Login {

    /**
     * Checks if a given login/password combination is valid
     *
     * @param string $annonce_id login of the user that tries to connect
     * @param string $userLogin password of the user that tries to connect
     * @param string $data DataAccess reference
     *
     * @return bool
     */
    public function authenticate($login, $password, $data) {
        $user = $data->getUser($login);
        return $user != null and $user->getPassword() == $password;
    }
}