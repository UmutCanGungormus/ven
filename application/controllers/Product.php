<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public $viewData = [];
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder="product_v/index";
        $this->viewData["settings"]=get_settings();
        $this->load->model("product_category_model");
        $this->viewData["categories"] = $this->product_category_model->get_all([
          "isActive" => 1,
          "ust_id"=>0
      ]) ;

    }
	public function index($seo)
	{
      $this->load->model("product_model");
      $this->load->model("product_image_model");
      $this->load->model("product_option_model");
     
     
      $this->viewData["item"]= $this->product_model->get([
        'url' =>$seo
      ]);
      $this->viewData["option"]=$this->product_option_model->get_all([
        "product_id" => $this->viewData["item"]->id
      ]);
      $this->viewData["similar"]= $this->product_model->get_all([
        'category_id' =>$this->viewData["item"]->category_id,
        "id !="=>$this->viewData["item"]->id
      ]);
      $this->viewData["photos"]= $this->product_image_model->get_all([
        'product_id' =>$this->viewData["item"]->id
      ]);
      
      $this->viewData["products"]=$this->product_model->get_all([
        "category_id"=>$this->viewData["item"]->category_id,
        "isActive" =>1
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
