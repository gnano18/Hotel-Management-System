<?php
  class Pages extends Controller{
    public function __construct(){
     
    }

    // Load Homepage
    public function index(){
      //Set Data
      $data = [
        'title' => 'Welcome'
      ];

      // Load homepage/index view
      $this->view('pages/index', $data);
    }

    public function about(){

      $this->view('pages/about');
    }

    public function rooms(){
      $this->view('pages/rooms');
    }
    public function room1(){
      $this->view('pages/room1');
    }
    public function room2(){
      $this->view('pages/room2');
    }
    public function room3(){
      $this->view('pages/room3');
    }
    public function room4(){
      $this->view('pages/room4');
    }
    public function room5(){
      $this->view('pages/room5');
    }
    public function gallery(){
      $this->view('pages/gallery');
    }
    public function contact(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $name = trim($_POST['name']);
          $email = trim($_POST['email']);
          $message = trim($_POST['message']);
          $subject = 'mesazh';
          
        $content="From: $name \n Email: $email \n Message: $message";
        $recipient = "gmuca@epoka.edu.al";
        $mailheader = "From: $email \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        redirect('pages/index');
      }
      else{
        $this->view('pages/contact');
      }
      
    }
  }