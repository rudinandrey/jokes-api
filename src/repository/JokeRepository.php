<?php

namespace repository;

class JokeRepository extends Repository
{
    public function add($joke) {
        $sql = "INSERT INTO jokes (joke) VALUES (:joke);";
        return $this->db->exec($sql, ["joke"=>$joke]) == 1;
    }
}