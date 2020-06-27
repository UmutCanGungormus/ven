<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alert extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder="404_v/index";
        $this->viewData["settings"]=get_settings();
        $this->load->model("product_category_model");
        $this->viewData["categories"] = $this->product_category_model->get_all([
            "isActive" => 1,
            "ust_id"=>0
        ]) ;
    }
    public function index()
    {
        $this->render();
    }
    public function render(){
        $this->load->view("includes/head",$this->viewData);
        $this->load->view("includes/header");
        $this->load->view($this->viewFolder);      
        $this->load->view("includes/footer");   
   }
}
