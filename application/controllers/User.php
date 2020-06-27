<?php
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v/index";
        $this->viewData["settings"] = get_settings();
        $this->load->model("product_category_model");
        $this->load->model("user_model");
        $this->viewData["categories"] = $this->product_category_model->get_all([
            "isActive" => 1,
            "ust_id" => 0
        ]);
        if(empty(get_active_user())){
            redirect(base_url("/"));
        }
    }

    public function index()
    {
        $this->viewData["page_name"] = "Profil";
        $id = get_active_user()->id;
        $this->viewData["active_user"] = $this->user_model->get(["id" => $id]);
        $this->viewData["cities"] = $this->address_model->get_all("cities");
        $this->render();
    }
    public function update()
    {
        $id = $this->input->post("id");
        $this->load->library("form_validation");
        $oldUser = $this->user_model->get(
            array('id' => $id)
        );


        if ($oldUser->email != $this->input->post("email")) {
            $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email|is_unique[users.email]");
        }
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("phone", "Telefon", "required|trim");
        if (!empty($this->input->post("password"))) {
            $this->form_validation->set_rules("password", "Şifre", "required|trim");
            $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|matches[password]");
        }

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır!",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz!",
                "is_unique" => "<b>{field}</b> alanı daha önceden kullanılmış!",
                "matches" => "Şifreler birbirlerini tutmuyor!"
            )
        );
        $validate = $this->form_validation->run();

        if ($validate) {
            if (!empty($this->input->post("password"))) {
                $update = $this->user_model->update(
                    array("id" => $id),
                    array(

                        "full_name"   => $this->input->post("full_name"),
                        "email"           => $this->input->post("email"),
                        "phone"           => $this->input->post("phone"),
                        "password"    => md5($this->input->post("password"))
                    )
                );
            } else {
                $update = $this->user_model->update(
                    array("id" => $id),
                    array(

                        "full_name"   => $this->input->post("full_name"),
                        "email"           => $this->input->post("email"),
                        "phone"           => $this->input->post("phone")
                    )
                );
            }

            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılıyla Gerçekleşti.",
                    "text" => "Kayıt başarılı bir şekilde güncellendi.",
                    "type" => "success"
                );
                $user=$this->user_model->get(["id"=>$id]);
                $this->session->unset_userdata('user');
                $this->session->set_userdata('user', $user);
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız Oldu!",
                    "text" => "Kayıt güncelleme sırasında bir problem oluştu!",
                    "type" => "error"
                );
            }
        }
        $this->session->set_flashdata("alert", $alert);

        redirect(base_url("profil"));
    }

    // IF CHANGE CITY RETURN DISTRICTS
    public function changeCity(){
        $postData = rClean($_POST);
        $data = get_districts($postData["city_id"]);
        echo json_encode($data);
    }

    // IF CHANGE DISTRICT RETURN NEIGHBORHOODS
    public function changeDistrict(){
        $postData = rClean($_POST);
        $data = get_neighborhoods($postData["district_id"]);
        echo json_encode($data);
    }

    // IF CHANGE NEIGHBORHOODS RETURN QUARTERS
    public function changeNeighborhood(){
        $postData = rClean($_POST);
        $data = get_quarters($postData["neighborhood_id"]);
        echo json_encode($data);
    }

    public function order(){
        
    }
    public function render()
    {
        $this->load->view("includes/head", $this->viewData);
        $this->load->view("includes/header");
        $this->load->view($this->viewFolder);
        $this->load->view("includes/footer");
    }
}
