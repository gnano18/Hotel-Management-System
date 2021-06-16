<?php

class Receptionist extends Controller{
    public function __construct()
    {
        $this->productModel =$this->model('Product');
    }
    public function index(){
        $this->view('users/receptionist/index');
    }
}
