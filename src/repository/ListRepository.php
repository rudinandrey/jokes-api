<?php

namespace repository;

class ListRepository extends Repository
{
    public function getAllCards($uuid) {
        $sql = "SELECT jokes.id, jokes.joke 
                FROM jokes 
                    LEFT JOIN votes ON votes.joke_id = jokes.id 
                        AND votes.uuid =:uuid 
                WHERE votes.id IS NULL;";
        return $this->db->exec($sql, ["uuid"=>$uuid]);
    }

    public function myVotes($uuid) {
        $sql = "SELECT jokes.id, jokes.joke, votes.resolution 
                FROM votes 
                    LEFT JOIN jokes ON jokes.id = votes.joke_id 
                WHERE uuid = :uuid";
        return $this->db->exec($sql, ["uuid"=>$uuid]);
    }
}