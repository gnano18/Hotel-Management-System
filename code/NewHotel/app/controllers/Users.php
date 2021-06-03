<?php
    class Users extends Controller{
        public function __construct()
        {
            $this->userModel =$this->model('User');
        }

        public function index(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Process the form

                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    //error variables
                    'email_error' => '',
                    'password_error' => '',
                ];

                //validate email
                if (empty($data['email'])) {
                    $data['email_error'] = 'Please enter email';
                }

                if (empty($data['password'])) {
                    $data['password_error'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_error'] = 'Password must be at least 6 characters';
                }

                //check for user/mail
                if ($this->userModel->findUserByEmail($data['email'])) {
                    //user found

                } else {
                    //user not found
                    $data['email_error'] = 'No user found';
                }

                //make sure errors are empty
                if (empty($data['email_error']) && empty($data['password_error'])) {
                    //validated
                    //check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    if ($loggedInUser) {
                        //create session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_error'] = 'Password incorrect';
                        $this->view('users/index', $data);
                    }
                } else {
                    //load view with errors
                    $this->view('users/index', $data);
                }
            } else {
                //init data
                $data = [
                    'email' => '',
                    'password' => '',
                    //error variables
                    'email_error' => '',
                    'password_error' => '',
                ];
                $this->view('users/index', $data);
            }
        }

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->employeeID;
            $_SESSION['user_email'] = $user->Email;
            $_SESSION['user_name'] = $user->Name;
            $_SESSION['user_role'] = $user->Role;
            if($_SESSION['user_role'] == 'ht_manager'){
                redirect('users/ht_manager');
            }

        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
        }

        public function ht_manager(){
            $this->view('users/ht_manager');
        }



        //extra 
        public function showInfo(){
            $currUser = $this->userModel->getUserById($_SESSION['user_id']);
            $data = [
                'id' => $_SESSION['user_id'],
                'name' => $currUser->Name,
                'description' => $currUser->Descrition
            ];
            $this->view('users/showInfo',$data);
        }
        public function manage(){
            $this->view('users/manage');
        }

        public function manageUsers(){
            $users = $this->userModel->getUsers();
            $data = [
                'users' => $users
            ];
            $this->view('users/manageUsers', $data);
        }

        public function addUser(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize post data
                //`Name`, `Surname`, `PhoneNo`, `StreetNo`, `ApartamentNo`, `Role`, `Descrition`, `Email`, `Password`
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'name' => trim($_POST['Name']),
                    'surname' => trim($_POST['Surname']),
                    'phoneNo' => trim($_POST['PhoneNo']),
                    'streetNo' => trim($_POST['StreetNo']),
                    'apartamentNo' => trim($_POST['ApartamentNo']),
                    'role' => trim($_POST['Role']),
                    'description' => trim($_POST['Descrition']),
                    'email' => trim($_POST['Email']),
                    'password' => trim($_POST['Password']),
                    'confirm_password' => trim($_POST['confirm_Password']),
                    'name_error' => '',
                    'phoneNo_error' => '',
                    'streetNo_error' => '',
                    'apartamentNo_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];

                //need some validation here 

                //make sure there are empty error than...
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->addNewUser($data)) {
                    flash('register_success', 'User is registered.');
                    redirect('users/manageUsers');
                } else {
                    die("Smth Went wrong");
                }
            }else{
                //initialize data
                //`employeeID`, `Name`, `Surname`, `PhoneNo`, `StreetNo`, `ApartamentNo`, `Role`, `Descrition`, `Email`, `Password`
                $data = [
                    'name' => '',
                    'surname' => '',
                    'phoneNo' => '',
                    'streetNo' => '',
                    'apartamentNo' => '',
                    'role' => '',
                    'description' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_error' => '',
                    'phoneNo_error' => '',
                    'streetNo_error' => '',
                    'apartamentNo_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];
                $this->view('users/addUser', $data);
            }
        }


        public function editUser($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize Post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'employeeID' => $id,
                    'name' => trim($_POST['Name']),
                    'surname' => trim($_POST['Surname']),
                    'phoneNo' => trim($_POST['PhoneNo']),
                    'streetNo' => trim($_POST['StreetNo']),
                    'apartamentNo' => trim($_POST['ApartamentNo']),
                    'role' => trim($_POST['Role']),
                    'description' => trim($_POST['Descrition']),
                    'email' => trim($_POST['Email']),
                    //'password' => trim($_POST['Password']),
                    //'confirm_password' => trim($_POST['confirm_Password']),
                    'name_error' => '',
                    'phoneNo_error' => '',
                    'streetNo_error' => '',
                    'apartamentNo_error' => '',
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ];

                //make sure there is not an error (do not forget if)
                if($this->userModel->editUserM($data)){
                    flash('post_message', 'User Updated');
                    redirect('users/manageUsers');
                }else{
                    die('Something went wrong');
                }    
        }else{
            //get excisting user from model
            $user = $this->userModel->getUserById($id);
            $data = [
            'employeeID' => $id,
            'name' => $user->Name,
            'surname' => $user->Surname,
            'phoneNo' => $user->PhoneNo,
            'streetNo' => $user->StreetNo,
            'apartamentNo' => $user->ApartamentNo,
            'role' => $user->Role,
            'description' => $user->Descrition,
            'email' => $user->Email,
            //'password' => $user->Password
            ];
            $this->view('users/editUser', $data);
        }
    }

    public function deleteUser($id){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $user = $this->userModel->getUserByID($id);
           
            if($this->userModel->deleteuserM($id)){
                redirect('users/manageUsers');
            }
        }else{
            $user = $this->userModel->getUserById($id);
            $data = [
                'employeeID' => $user->employeeID
            ];
            $this->view('users/deleteUser', $data);
        }
    }
}