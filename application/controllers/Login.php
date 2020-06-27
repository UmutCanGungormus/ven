<?php
class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder="login_v/index";
        $this->viewData["settings"]=get_settings();
        $this->load->model("product_category_model");
        $this->viewData["categories"] = $this->product_category_model->get_all([
          "isActive" => 1,
          "ust_id"=>0
      ]) ;
    }
    public function index(){
        $this->render();

    }

    public function signin(){
      $email=$this->input->post("email");
      $password=$this->input->post("password");
      $this->load->model("user_model");
     if(!empty($user=$this->user_model->get(["email"=>$email,"password"=>md5($password)]))){
        $this->session->set_userdata("user",$this->user_model->get(["email"=>$email,"password"=>md5($password)]));
        $this->session->set_flashdata("alert",["success" => true,"title" => "Başarılı!","msg" => "Başarıyla Giriş Yaptın ".$this->session->userdata("user")->full_name."."]);
        redirect(base_url("profil"));
     }
     else{
        $this->session->set_flashdata("alert",["success" => false,"title" => "Başarısız!","msg" => "Böyle Bir Kullanıcı Bulunamadı."]);
        redirect(base_url("giris"));
     }
    }
    public function signout(){
        $this->session->unset_userdata("user");
        $this->session->set_flashdata("alert",["success" => true,"title" => "Başarılı!","msg" => "Başarıyla Çıkış Yaptınız."]);
        redirect(base_url("/"));
    }
    public function render(){
        $this->load->view("includes/head",$this->viewData);
        $this->load->view("includes/header");
        $this->load->view($this->viewFolder);      
        $this->load->view("includes/footer");   
   }
}