<?php
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "register_v/index";
        $this->viewData["settings"] = get_settings();
        $this->load->model("product_category_model");
        $this->load->model("user_model");
        $this->viewData["categories"] = $this->product_category_model->get_all([
            "isActive" => 1,
            "ust_id" => 0
        ]);
        $this->load->library("form_validation");
    }
    public function index()
    {
        $this->render();
    }
    public function save()
    {

        $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Tekrar Şifre", "required|trim|min_length[6]|max_length[8]");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır!",
                "valid_email" => "Lütfen geçerli bir <b>e-posta</b> adresi giriniz!",
                "min_length" => "Şifre alanı en az 6 karakterden oluşmalıdır.",
                "max_length" => "Şifre alanı en fazla 8 karakterden oluşmalıdır",
            )
        );
        if ($this->form_validation->run()) {
            $data = rClean($_POST);
            if ($data["password"] !== $data["re_password"]) {
                $this->session->set_flashdata("alert", ["success" => false, "title" => "Başarısız!", "msg" => "Şifrelerinizin Aynı Olduğundan Emin Olup Lütfen Tekrar Deneyin."]);
                redirect(base_url("kayit-ol"));
            } else {
                // Unset re_password
                unset($data["re_password"]);
                // Create md5 password
                $data["password"] = md5($data["password"]);
                // Set user_name = email
                $data["user_name"] = $data["email"];

                $data["email"] = $data["email"];
                // Set CreatedAt
                $data["createdAt"] = date("Y-m-d H:i:s");

                // Save Values On DB

                if (!empty($this->user_model->get(["email" => $data["email"]]))) {
                    $this->session->set_flashdata("alert", ["success" => false, "title" => "Başarısız!", "msg" => "Bu Mail Hesabı Sistemde Mevcut"]);
                    redirect(base_url("kayit-ol"));
                } else {


                    if ($this->user_model->add($data)) {
                        $this->session->set_flashdata("alert", ["success" => true, "title" => "Başarılı!", "msg" => "Başarıyla Kayıt Oldunuz."]);
                        // Nereye gitmek istersen canısı
                    } else {
                        $this->session->set_flashdata("alert", ["success" => false, "title" => "Başarısız!", "msg" => "Kayıt Olurken Bir Hata Oluştu. Bilgilerinizi Kontrol Edip Lütfen Tekrar Deneyin."]);
                        redirect(base_url("kayit-ol"));
                    }
                }
            }
        } else {
            $this->session->set_flashdata("alert", ["success" => false, "title" => "Başarısız!", "msg" => "Alanları Doldurduğunuzdan Emin Olup, Lütfen Tekrar Deneyin."]);
            redirect(base_url("kayit-ol"));
        }
    }
    public function render()
    {
        $this->load->view("includes/head", $this->viewData);
        $this->load->view("includes/header");
        $this->load->view($this->viewFolder);
        $this->load->view("includes/footer");
    }
}
