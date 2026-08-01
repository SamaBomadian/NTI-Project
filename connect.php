<?php

class Connect
{
    private string $host_Name = "localhost";
    private string $user_name = "root";
    private string $password  = "";
    private string $data      = "car_rental_db"; 
    private int $port         = 3307;            
    public $conn;

    public function __construct()
    {
        
        $this->conn = mysqli_connect($this->host_Name, $this->user_name, $this->password, $this->data, $this->port);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function insert(array $post, string $table)
    {
        unset($post['id']);

        $coloms = [];
        $valus = [];

        foreach ($post as $key => $value) {
            $coloms[] = "`$key`";
            $valus[] = "'" . mysqli_real_escape_string($this->conn, $value) . "'";
        }

        $coloms_to_string = implode(",", $coloms);
        $valus_to_string  = implode(",", $valus);

        $sql = "INSERT INTO `$table` ($coloms_to_string) VALUES ($valus_to_string)";

        return $this->conn->query($sql);
    }

    public function select(string $table): array
    {
        $rows = $this->conn->query("SELECT * FROM `$table`");

        if ($rows && $rows->num_rows > 0) {
            return $rows->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function selectonce(string $table, $id)
    {
        $id = (int)$id;
        $row = $this->conn->query("SELECT * FROM `$table` WHERE id = $id");
        if ($row && $row->num_rows > 0) {
            return $row->fetch_assoc();
        }
        return [];
    }

    
    public function searchCars(string $search): array
    {
        $search = mysqli_real_escape_string($this->conn, $search);
        $sql = "SELECT * FROM cars WHERE (brand LIKE '%$search%' OR model LIKE '%$search%') AND status = 'available'";
        $rows = $this->conn->query($sql);

        if ($rows && $rows->num_rows > 0) {
            return $rows->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function login(string $email, string $password)
    {
        $email    = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);

       
        $row = $this->conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        
        if ($row && $row->num_rows > 0) {
            return $row->fetch_assoc();
        }
        
        return [];
    }

    public function update(array $post, string $table, $id)
    {
        $id = (int)$id;
        unset($post['id']); 

        $fieldValue = [];
        foreach ($post as $key => $value) {
            $escapedValue = mysqli_real_escape_string($this->conn, $value);
            $fieldValue[] = "`$key` = '$escapedValue'";
        }

        $fieldValueString = implode(",", $fieldValue);
        return $this->conn->query("UPDATE `$table` SET $fieldValueString WHERE id = $id");
    }

    public function delete(string $table, int $id)
    {
        $id = (int)$id;
        return $this->conn->query("DELETE FROM `$table` WHERE id = $id");
    }
}

