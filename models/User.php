<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = connectDB(); // Ensure connectDB() returns a PDO instance.
    }

    // Retrieve all active users
    public function getUser()
    {
        $query = "SELECT * FROM tai_khoans WHERE trang_thai = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all as an associative array
    }

    // Retrieve user details by ID
    public function getUserById($user_id)
    {
        $sql = "SELECT ho_ten, so_dien_thoai, dia_chi FROM tai_khoans WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row as an associative array
    }
}
