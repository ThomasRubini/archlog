<?php

namespace data;

include_once "domain/User.php";
use domain\User;

class UserSqlAccess
{
    protected $dataAccess = null;

    public function __construct($dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function __destruct()
    {
        $this->dataAccess = null;
    }

    public function getUser($login)
    {
        $user = null;

        $query = 'SELECT * FROM USER WHERE login="' . $login . '"';
        $result = $this->dataAccess->query($query);

        if ( $row = $result->fetch() )
            $user = new User( $row['login'] , $row['password']);

        $result->closeCursor();

        return $user;
    }
}