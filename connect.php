<?php

class Connect
{
    private string $host_Name = "localhost";
    private string $user_name = "root";
    private string $password = "";
    private string $data = "car_rental_db";
    private int $port = 3307;

    public $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(
            $this->host_Name,
            $this->user_name,
            $this->password,
            $this->data,
            $this->port
        );

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

     public function login(string $email,string $password){
            
            $row=$this->conn->query("SELECT * FROM users Where email='$email' ");
            if($row->num_rows>0){
                $data= $row->fetch_assoc();
                if(password_verify($password, $data['password'])) {
                    return $data;
                } else {
                    return [];
                }
               
            }
            
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

     public function checkEmail(string $email){
            
            $row=$this->conn->query("SELECT * FROM users Where email='$email' ");
            if($row->num_rows>0){
                return true;
            }else{
                return false;
            }
        }

  
public function getCarById($id) {
    $id = intval($id); 
    $result = $this->conn->query("SELECT * FROM cars WHERE id = $id");
    
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return false;
}

public function isCarBooked($car_id, $start_date, $end_date) {
    $sql = "SELECT id FROM bookings 
            WHERE car_id = $car_id 
            AND status != 'Cancelled' 
            AND (pickup_date <= '$end_date' AND return_date >= '$start_date')";
            
    $result = mysqli_query($this->conn, $sql);
    
    return ($result && mysqli_num_rows($result) > 0);
}
// دالة لحساب عدد أيام الحجز والتكلفة الإجمالية
public function calculateTotalPrice($start_date, $end_date, $price_per_day) {
    $days = ((strtotime($end_date) - strtotime($start_date)) / 86400) + 1;
    return $days * $price_per_day;
}

// 1. فانكشن جلب حجوزات مستخدم معين مع بيانات العربية
public function getUserBookings($user_id) {
    $sql = "SELECT bookings.*, cars.brand, cars.model, cars.image 
            FROM bookings 
            INNER JOIN cars ON bookings.car_id = cars.id 
            WHERE bookings.user_id = $user_id 
            ORDER BY bookings.id DESC";
            
    return mysqli_query($this->conn, $sql);
}

// 2. فانكشن إلغاء حجز خاص بمستخدم
public function cancelBooking($booking_id, $user_id) {
    $booking_id = intval($booking_id);
    $user_id    = intval($user_id);
    
    $sql = "UPDATE bookings 
            SET status = 'Cancelled' 
            WHERE id = $booking_id AND user_id = $user_id";
            
    return mysqli_query($this->conn, $sql);
}
}

