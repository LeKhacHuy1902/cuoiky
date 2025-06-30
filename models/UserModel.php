<?php

class UserModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function createUser($data) {
        // Code to create a user in the database
    }

    public function getUser($id) {
        // Code to retrieve a user from the database
    }

    public function updateUser($id, $data) {
        // Code to update a user in the database
    }

    public function deleteUser($id) {
        // Code to delete a user from the database
    }
}
