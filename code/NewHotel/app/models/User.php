<?php
    class User {
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function login($email, $password){
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();


            $hashed_password = $row->Password;
            if(password_verify($password, $hashed_password)){
                return $row;
            }else{
                return false;
            }
        }
        //Find user by email
        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM user WHERE email = :email");
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            if($this->db->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }

        public function getUserById($id){
            $this->db->query("SELECT * FROM user WHERE employeeID = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();
            return $row;
        }

        public function getUsers(){
            $id  = $_SESSION['user_id'];
            $this->db->query("SELECT * FROM user WHERE employeeId != :id");
            $this->db->bind(':id', $id);
            $results =  $this->db->resultSet();
            return $results;
        }

        public function addNewUser($data){
            $this->db->query('INSERT INTO user(Name, Surname, PhoneNo, StreetNo, ApartamentNo, Role, Descrition, Email, Password) VALUES(:Name, :Surname, :PhoneNo, :StreetNo, :ApartamentNo, :Role, :Descrition, :Email, :Password)');
            $this->db->bind(':Name', $data['name']);
            $this->db->bind(':Surname', $data['surname']);
            $this->db->bind(':PhoneNo', $data['phoneNo']);
            $this->db->bind(':StreetNo', $data['streetNo']);
            $this->db->bind(':ApartamentNo', $data['apartamentNo']);
            $this->db->bind(':Role', $data['role']);
            $this->db->bind(':Descrition', $data['description']);
            $this->db->bind(':Email', $data['email']);
            $this->db->bind(':Password', $data['password']);

            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        public function editUserM($data){
            $this->db->query('UPDATE user SET Name = :Name, Surname = :Surname, PhoneNo = :PhoneNo, StreetNo = :StreetNo, ApartamentNo = :ApartamentNo, Role = :Role, Descrition = :Descrition, Email = :Email WHERE employeeID = :id');
            $this->db->bind(':id', $data['employeeID']);
            $this->db->bind(':Name', $data['name']);
            $this->db->bind(':Surname', $data['surname']);
            $this->db->bind(':PhoneNo', $data['phoneNo']);
            $this->db->bind(':StreetNo', $data['streetNo']);
            $this->db->bind(':ApartamentNo', $data['apartamentNo']);
            $this->db->bind(':Role', $data['role']);
            $this->db->bind(':Descrition', $data['description']);
            $this->db->bind(':Email', $data['email']);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        function deleteUserM($id){
            $this->db->query('DELETE FROM user WHERE employeeID = :id');
            $this->db->bind(':id', $id);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


    }