<?php

namespace repository;

use DB\SQL;

class Repository
{
    protected SQL $db;

    public function __construct()
    {
        $this->db = new SQL(
            "mysql:host=localhost;dbname=app1",
            "app1",
            "8895075b7cb060c8c80e9a775558f5a3be9f5861072ada8c94e02b45f149fe64"
        );
    }
}