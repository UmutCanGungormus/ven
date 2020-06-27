<?php
Class Basket extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder="basket_v/index";
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
    public function basket_add(){
       
        $data=$this->input->post();
        $this->cart->insert($data);
    }
    public function basket_remove(){
       
        $data=$this->input->post();
        $this->cart->remove($data["id"]);
    }
    public function basket_destroy(){
       
        $this->cart->destroy();
    }
    public function basket_update(){
       
        $data=$this->input->post();
        $this->cart->update($data);
    }
    public function render(){
        $this->load->view("includes/head",$this->viewData);
        $this->load->view("includes/header");
        $this->load->view($this->viewFolder);      
        $this->load->view("includes/footer");   
   }
}