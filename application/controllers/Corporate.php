<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Corporate extends CI_Controller
{
  public $viewData = [];
  public $viewFolder = "";
  public function __construct()
  {
    parent::__construct();
    $this->load->library("pagination");
    $this->viewFolder = "corporate_v/index";
    $this->viewData["settings"] = get_settings();
    $this->load->model("product_category_model");
    $this->viewData["categories"] = $this->product_category_model->get_all([
      "isActive" => 1,
      "ust_id" => 0
    ]);
  }
  public function index($seo)
  {
    $this->load->model("reference_model");
    $this->viewData["item"] = $this->reference_model->get(
      [
        "url" => $seo,
        "isActive" => 1
      ]);
    
 
   

    $this->render();
  }

  public function render()
  {
    $this->load->view("includes/head", $this->viewData);
    $this->load->view("includes/header");
    $this->load->view($this->viewFolder);
    $this->load->view("includes/footer");
  }
}
