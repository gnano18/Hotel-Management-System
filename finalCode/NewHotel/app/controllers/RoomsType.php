<?php

class RoomsType extends Controller
{
    public function __construct()
    {
        $this->roomModel = $this->model('RoomType');
    }

    public function index()
    {
        $this->view('roomsType/index');
    }

    public function roomType()
    {
        $var = $this->roomModel->showroomTypes();
        $data = [
            "roomType" => $var
        ];
        $this->view('roomsType/roomType', $data);
    }

    public function addRoomType()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'typeName' => trim($_POST['typeName']),
                'price' => trim($_POST['price']),
                'typeName_error' => '',
                'price_error' => ''
            ];
            // Validation
            if(empty($data['typeName'])){
                $data['typeName_error'] = 'Please enter type name';
            }

            //price 
            if(empty($data['price'])){
                $data['price_error'] = 'Please enter price';
            }elseif(!is_numeric($data['price'])){
                $data['price_error'] = 'Price must be a number';
            }

            if(empty($data['typeName_error']) && empty($data['price_error'])){
            if ($this->roomModel->addNewRoomType($data)) {
                flash('register_success', 'RoomType Type is registered.');
                redirect('roomsType/roomType');
            } else {
                die("Smth Went wrong");
            }}else{
                $this->view('roomsType/addRoomType', $data); 
            }

        } else {
            $data = [
                'typeName' => '',
                'price' => ''
            ];
            $this->view('roomsType/addRoomType', $data);
        }
    }

    public function editRoomType($typeID)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'typeID' => $typeID,
                'typeName' => trim($_POST['typeName']),
                'price' => trim($_POST['price']),
                'typeName_error' => '',
                'price_error' => ''
            ];
            // print_r($data);

            // Validation
            if(empty($data['typeName'])){
                $data['typeName_error'] = 'Please enter type name';
            }

            //price 
            if(empty($data['price'])){
                $data['price_error'] = 'Please enter price';
            }elseif(!is_numeric($data['price'])){
                $data['price_error'] = 'Price must be a number';
            }

            if(empty($data['typeName_error']) && empty($data['price_error'])){
            //make sure there is not an error (do not forget if)
            if ($this->roomModel->editType($data)) {
                flash('post_message', 'RoomType Updated');
                redirect('roomsType/roomType');
            } else {
                die('Something went wrong');
            }
        }else{
            $this->view('roomsType/editRoomType', $data);
        }

        } else {
            $roomType = $this->roomModel->getRoomTypeByID($typeID);
            $data = [
                'typeID' => $typeID,
                'typeName' => $roomType->typeName,
                'price' => $roomType->price
            ];
            $this->view('roomsType/editRoomType', $data);
        }
    }

    public function deleteRoomType($typeID)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->roomModel->deleteType($typeID)) {

                //nuk kthen data
                flash('delete_success', 'RoomType Type is deleted.');
                redirect('roomsType/roomType');
            }
        } else {
            $roomType = $this->roomModel->getRoomTypeByID($typeID);
            $data = [
                'typeName' => $roomType->typeName,
                'typeID' => $roomType->typeID
            ];

            //nqs deshton vazhdo te form i njejt
            $this->view('roomsType/deleteRoomType', $data);
        }
    }
}