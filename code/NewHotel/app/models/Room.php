<?php
    class Room {
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }
        public function showRoomTypes(){
            $this->db->query("Select * from roomType");

            $content = $this->db->resultset();
            return $content;
        }
        public function addNewRoomType($data){
            $this->db->query('Insert into RoomType(typeName,price) values (:typeName, :price)');
            $this->db->bind(':typeName',$data['typeName']);
            $this->db->bind(':price',$data['price']);

            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function editRoomType($data){
            $this->db->query('update RoomType set typeName = :typeName,price = :price where typeID = :typeID');
            $this->db->bind(':typeName',$data['typeName']);
            $this->db->bind(':price',$data['price']);
            $this->db->bind(':typeID',$data['typeID']);
        }

        public function deleteRoomType(){
            $this->db->query('Delete from RoomType where typeID = :typeID');
            $this->db->bind(':typeID',$data['typeID']);
        }

    }
