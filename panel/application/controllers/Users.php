<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->user_model->get_all(
            array()
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->user_model->getRows(
            [],
            $_POST
        );
        $data = $row = array();
        $i = (!empty($_POST['start']) ? $_POST['start'] : 0);

        foreach ($items as $item) {
            $i++;

            $proccessing = '
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    İşlemler
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="' . base_url("users/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item" href="' . base_url("users/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    <a class="dropdown-item" href="' . base_url("users/update_password_form/$item->id") . '"><i class="fa fa-key"></i> Şifre Değiştir </a>

                    </div>
            </div>';



            //array_push($renkler,$renk->negotiation_stage_color);

            $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("users/check") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
            $data[] = array($item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->full_name,  $item->email, $checkbox, $proccessing);
        }



        $output = array(
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->user_model->rowCount(),
            "recordsFiltered" => $this->user_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }



public function rankSetter()
    {
        $rows = $this->input->post("rows");

        foreach ($rows as $row) {
            $this->user_model->update(
                array(
                    "id" => $row["id"]
                ),
                array("rank" => $row["position"])
            );
        }
    }

    public function check()
    {
        $id = $this->input->post("id");
        $product = $this->user_model->get(["id" => $id])->isActive;
        if ($product == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        if ($this->user_model->update(["id" => $id], ["isActive" => $status])) {
            echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
        } else {
            echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
        }
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $this->load->model("user_role_model");
        $viewData->user_roles = $this->user_role_model->get_all(['isActive' => 1]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|max_length[8]|matches[password]");
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
            $insert = $this->user_model->add(
                array(
                    "user_name"         => $this->input->post("user_name"),
                    "full_name"   => $this->input->post("full_name"),
                    "email"           => $this->input->post("email"),
                    "password"     => md5($this->input->post("password")),
                    "role_id"       => $this->input->post("role_id"),
                    "isActive"      => 1,

                    "createdAt"     => date("Y-m-d H:i:s")
                )
            );
            if ($insert) {
                $alert = array(
                    "title" => "İşlem Başarılıyla Gerçekleşti.",
                    "text" => "Kayıt başarılı bir şekilde eklendi",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız Oldu!",
                    "text" => "Kayıt ekleme sırasında bir problem oluştu!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));
            die();
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $item = $this->user_model->get(
            array(
                "id" => $id
            )
        );
        $this->load->model("user_role_model");
        $viewData->user_roles = $this->user_role_model->get_all(['isActive' => 1]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $this->load->library("form_validation");
        $oldUser = $this->user_model->get(
            array('id' => $id)
        );
        if ($oldUser->user_name != $this->input->post("user_name")) {
            $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim|is_unique[users.user_name]");
        }
        if ($oldUser->email != $this->input->post("email")) {
            $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email|is_unique[users.email]");
        }
        $this->form_validation->set_rules("full_name", "Ad Soyad", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır!",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz!",
                "is_unique" => "<b>{field}</b> alanı daha önceden kullanılmış!"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $update = $this->user_model->update(
                array("id" => $id),
                array(
                    "user_name"         => $this->input->post("user_name"),
                    "full_name"   => $this->input->post("full_name"),
                    "role_id"   => $this->input->post("role_id"),
                    "email"           => $this->input->post("email"),
                )
            );
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılıyla Gerçekleşti.",
                    "text" => "Kayıt başarılı bir şekilde güncellendi.",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız Oldu!",
                    "text" => "Kayıt güncelleme sırasında bir problem oluştu!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));
        } else {
            $viewData = new stdClass();
            $item = $this->user_model->get(
                array(
                    "id" => $id
                )
            );
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->user_model->delete(
            array(
                "id" => $id
            )
        );
        if ($delete) {
            $alert = array(
                "title" => "İşlem Başarılıyla Gerçekleşti.",
                "text" => "Kayıt silme işlemi başarılı bir şekilde silindi.",
                "type" => "success"
            );
        } else {
            $alert = array(
                "title" => "İşlem Başarısız Gerçekleşti.",
                "text" => "Kayıt silme işlemi sırasında bir problem oluştu!",
                "type" => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("users"));
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->user_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }
    }
    public function update_password_form($id)
    {
        $viewData = new stdClass();
        $item = $this->user_model->get(
            array(
                "id" => $id
            )
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update_password($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]|max_length[8]");
        $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|max_length[8]|matches[password]");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır!",
                "matches" => "Şifreler birbirlerini tutmuyor!"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $update = $this->user_model->update(
                array("id" => $id),
                array(
                    "password"         => md5($this->input->post("password"))
                )
            );
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılıyla Gerçekleşti.",
                    "text" => "Şifreniz başarılı bir şekilde güncellendi.",
                    "type" => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız Oldu!",
                    "text" => "Şifre güncelleme sırasında bir problem oluştu!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("users"));
        } else {
            $viewData = new stdClass();
            $item = $this->user_model->get(
                array(
                    "id" => $id
                )
            );
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "password";
            $viewData->form_error = true;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
}
