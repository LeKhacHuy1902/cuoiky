<?php

class AdminModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function createAdmin($data) {
        // Code to create an admin in the database
    }

    public function getAdmin($id) {
        // Code to retrieve an admin from the database
    }

    public function updateAdmin($id, $data) {
        // Code to update an admin in the database
    }

    public function deleteAdmin($id) {
        // Code to delete an admin from the database
    }
}
