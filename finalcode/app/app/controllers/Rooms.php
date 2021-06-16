<?php
class Rooms extends Controller
{
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->roomModel = $this->model('Room');
    }

    public function manageRooms()
    {
        // if($_SESSION['user_role'] != 'ht_manger'){
        //     redirect('users/login');
        // }
        $content = $this->roomModel->showRooms();
        $data = [
            'Room' => $content
        ];
        $this->view('rooms/manageRooms', $data);
    }

    public function addRoom()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'RoomNo' => trim($_POST['RoomNo']),
                'Floor' => trim($_POST['Floor']),
                'Status' => trim($_POST['Status']),
                'typeID' => trim($_POST['typeID']),

                'RoomNo_error' => '',
                'Floor_error' => '',
                // 'Status_error' => '',
                // 'typeID_error' => ''

            ];

            // Validation


            /// validate room no
            
            if (empty($data['RoomNo'])) {
                $data['RoomNo_error'] = 'Please enter number of room';
            } elseif (!is_numeric($data['RoomNo'])) { 
                $data['RoomNo_error'] = 'Please enter only numbers';
            }

            //validate floor
            
            if (empty($data['Floor'])) {
                $data['Floor_error'] = 'Please enter floor number';
            } else
            if (!is_numeric($data['Floor'])) {
                $data['Floor_error'] = 'Please enter only numbers';
            }


            if (empty($data['RoomNo_error']) && empty($data['Floor_error'])) {
                if ($this->roomModel->addRoom($data)) {
                    flash('register_success', 'Room is registered.');
                    redirect('rooms/manageRooms');
                } else {
                    die("Smth Went wrong");
                }
            } else {
                $this->view('/rooms/addRoom', $data);
            }
        } else {
            $content = $this->roomModel->getRoomType();
            $data = [
                'RoomNo' => '',
                'Floor' => '',
                'Status' => '',
                'type' => $content
            ];
            $this->view('rooms/addRoom', $data);
        }
    }

    public function editRoom($RoomID)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'RoomID' => $RoomID,
                'RoomNo' => trim($_POST['RoomNo']),
                'Floor' => trim($_POST['Floor']),
                'Status' => trim($_POST['Status']),
                'typeID' => trim($_POST['typeID']),

                'RoomNo_error' => '',
                'Floor_error' => '',
                // 'Status_error' => '',
                // 'typeID_error' => ''
            ];
            // Validation


            if ($this->roomModel->editRoom($data)) {
                flash('post_message', 'Room is edited.');
                redirect('rooms/manageRooms');
            } else {
                die("Smth Went wrong");
            }
        } else {
            $roomType = $this->roomModel->getRoomType();
            $room = $this->roomModel->getRoomByID($RoomID);
            $data = [
                'RoomID' => $RoomID,
                'RoomNo' => $room->RoomNo,
                'Floor' => $room->Floor,
                'typeID' => $room->typeID,
                'Status' => $room->Status,
                'type' => $roomType
            ];
            $this->view('rooms/editRoom', $data);
        }
    }

    public function deleteRoom($RoomID)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->roomModel->deleteRoom($RoomID)) {
                flash('delete_success', 'Room is deleted.');
                redirect('rooms/manageRooms');
            }
        } else {
            $room = $this->roomModel->getRoomByID($RoomID);
            $data = [
                'RoomID' => $RoomID,
                'RoomNo' => $room->RoomNo
            ];
            $this->view('rooms/deleteRoom', $data);
        }
    }
}
