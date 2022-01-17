<?php

namespace repository;

class VoteRepository extends Repository
{
    public function vote($uuid, $id, $resolution) {
        $sql = "INSERT IGNORE INTO votes (uuid, joke_id, resolution) VALUES (:uuid, :id, :resolution)";
        return $this->db->exec($sql, ["uuid"=>$uuid, "id"=>$id, "resolution"=>$resolution]) == 1;
    }
}