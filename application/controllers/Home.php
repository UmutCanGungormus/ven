<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public $viewData = [];
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder="home_v/index";
        $this->viewData["settings"]=get_settings();
        $this->load->model("product_category_model");
        $this->viewData["categories"] = $this->product_category_model->get_all([
            "isActive" => 1,
            "ust_id"=>0
        ]) ;

    }
	public function index()
	{
        $this->load->model("slide_model");
        $this->viewData["sliders"]=$this->slide_model->get_all([
            "isActive" => 1
        ]);
        $this->load->model("product_model");
        $this->viewData["products"]=$this->product_model->get_all([
            "isActive" => 1
        ]);
        $this->viewData["productsHome"]=$this->product_model->get_all([
            "isActive" => 1,
            "isHome" =>1
        ]);
        $this->render();
    }

    public function render(){
         $this->load->view("includes/head",$this->viewData);
         $this->load->view("includes/header");
         $this->load->view($this->viewFolder);      
         $this->load->view("includes/footer");   
    }
}
