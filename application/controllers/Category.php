<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
  public $viewData = [];
  public $viewFolder = "";
  public function __construct()
  {
    parent::__construct();
    $this->load->library("pagination");
    $this->viewFolder = "category_v/index";
    $this->viewData["settings"] = get_settings();
    $this->load->model("product_category_model");
    $this->viewData["categories"] = $this->product_category_model->get_all([
      "isActive" => 1,
      "ust_id" => 0
    ]);
  }
  public function index($seo)
  {

    $this->load->model("product_category_model");
    $this->load->model("product_model");
    $this->viewData["category"] = $this->product_category_model->get([
      'seo_url' => $seo
    ]);
    $sub_category = $this->product_category_model->get_all([
      'ust_id' => $this->viewData["category"]->id
    ]);
    $up_category = $this->product_category_model->get([
      'id' => $this->viewData["category"]->ust_id
    ]);
    $config['base_url'] = base_url('kategori/' . $seo);
    $config['total_rows'] = $this->product_model->get_count(  [
      "category_id" => $this->viewData["category"]->id,
      "isActive" => 1
    ],

    $sub_category);
    $config['per_page'] = 1;
    $config['uri_segment'] = 3;
    $this->pagination->initialize($config);
    
    
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
   

    $this->viewData["up_category"] = $up_category;
    $this->viewData["sub_category"] = $sub_category;
    $this->viewData["products"] = $this->product_model->get_all(
      [
        "category_id" => $this->viewData["category"]->id,
        "isActive" => 1
      ],

      $sub_category,
      "products.rank ASC",
      $config['per_page'],
      $page
    );
   

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
