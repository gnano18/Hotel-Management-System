<?php

class Finances extends Controller{
    public function __construct()
    {
        $this->productModel =$this->model('Product');
    }
    public function index(){
        $this->view('finances/index');
    }
}
