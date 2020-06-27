<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    public $viewData = [];
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->library("pagination");
        $this->viewFolder = "search_v/index";
        $this->viewData["settings"] = get_settings();
        $this->load->model("product_category_model");
        $this->viewData["categories"] = $this->product_category_model->get_all([
            "isActive" => 1,
            "ust_id" => 0
        ]);
    }
    public function index($search = null, $seo_url = null, $page = 0)
    {

        $this->load->model("product_category_model");
        $this->load->model("product_model");

        if (!empty($seo_url) && $seo_url != "0") {
            $this->viewData["category"] = $this->product_category_model->get([
                'seo_url' => $seo_url
            ]);
            $sub_category = $this->product_category_model->get_all([
                'ust_id' => $this->viewData["category"]->id
            ]);
            $up_category = $this->product_category_model->get([
                'id' => $this->viewData["category"]->ust_id
            ]);
            $config['base_url'] = base_url("ara/{$search}/{$seo_url}");
            $config['total_rows'] = $this->product_model->get_count_like(
                [
                    "category_id" => $this->viewData["category"]->id,
                    "isActive" => 1
                ],

                $sub_category,
                $search
            );

            $config['per_page'] = 9;
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);


            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : $page;


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
                $page,
                $search
            );
        } else {
           
                $config['base_url'] = base_url("ara/{$search}/0/");
                $config['total_rows'] = $this->product_model->get_count_like(
                    [

                        "isActive" => 1
                    ],

                    "",
                    $search
                );
                $config['per_page'] = 9;
                $config['uri_segment'] = 4;
                $this->pagination->initialize($config);


                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;



                $this->viewData["products"] = $this->product_model->get_all(
                    [
                        "isActive" => 1
                    ],

                    "",
                    "products.rank ASC",
                    $config['per_page'],
                    $page,
                    $search
                );
           
        }


        $this->viewData["search"] = $search;
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
