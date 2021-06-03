<?php
    class Rooms extends Controller{
        public function __construct()
        {
            $this->roomModel =$this->model('Room');
        }
        public function index(){
            $this->view('rooms/index');
        }
        public function roomType(){
            $var = $this->roomModel->showroomTypes();
            $data = [
                "roomType" => $var
            ];
            $this->view('rooms/roomType', $data);
    }

        public function addRoomType(){
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[
                    'typeName' => trim($_POST['typeName']),
                    'price' => trim($_POST['price'])
                ];
                if ($this->roomModel->addNewRoomType($data)) {
                    flash('register_success', 'Room Type is registered.');
                    redirect('rooms/roomType');
                } else {
                    die("Smth Went wrong");
                }

            } else {
                $data = [
                    'typeName' => '',
                    'price' => ''
                ];
                $this->view('rooms/addRoomType', $data);
            }
        }
        public function deleteRoomType($typeID)
        {
                if ($this->roomModel->deleteRoomType()) {
                    flash('delete_success', 'Room Type is deleted.');
                    redirect('rooms/roomType');
                } else {
                    die("Smth Went wrong");
                }
            }

    }