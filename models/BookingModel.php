<?php

class BookingModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function createBooking($data) {
        // Code to create a booking in the database
    }

    public function getBooking($id) {
        // Code to retrieve a booking from the database
    }

    public function updateBooking($id, $data) {
        // Code to update a booking in the database
    }

    public function deleteBooking($id) {
        // Code to delete a booking from the database
    }
}
