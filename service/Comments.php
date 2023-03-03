<?php

namespace service;

class Comments
{
    public function submitComment($annonce_id, $text, $data){
        $data->insertComment($annonce_id, null, $text);
    }
}