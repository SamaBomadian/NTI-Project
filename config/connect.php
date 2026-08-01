<?php

class connect{
        private     $host_name="localhost";
        private $User_name='root';
        private $Password='123456';
        private $data='rentcar';
        private $Port=3307;

        private $conn;

        public function __construct(){
            $this->conn=mysqli_connect($this->host_name,$this->User_name,$this->Password,$this->data,$this->Port);
        }

        public function insert(array $post,string $table){
        $cols=[];
        $valus=[];

        foreach($post as $key=>$value ){
            $cols[]= $key;
            $valus[]="'".$value."'";
        }
        $cols_to_string=implode(",",$cols);
        $values_to_string=implode(",",$valus);

        
       if( $this->conn->query("Insert Into $table ($cols_to_string) VALUES ($values_to_string)")){
        return true;
       }else{
        return false;
       }

        }

        public function login (string $email,string $password){
            
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

        public function checkEmail(string $email){
            
            $row=$this->conn->query("SELECT * FROM users Where email='$email' ");
            if($row->num_rows>0){
                return true;
            }else{
                return false;
            }
        }


}



?>