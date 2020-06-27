<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cinema extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "cinema_v";
        $this->load->model("cinema_model");
        $this->load->model("cinema_category_model");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->cinema_model->get_all(
            array(),
            "rank ASC"
        );

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->categories = $this->cinema_category_model->get_all(
            array(
                "isActive" => 1
            )
        );
        $viewData->subViewFolder = "add";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $cat = json_encode($this->input->post("category_id"));


        $this->load->library("form_validation");
        if ($_FILES["img_url"]["name"] == "") {
            $alert = array(
                "title" => "İşlem Başarısız!",
                "text" => "Lütfen bir görsel seçiniz..",
                "type" => "error"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("cinema/new_form"));
        }
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
            $image_255x157 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 255, 157, $file_name);
            $image_1140x705 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 1140, 705, $file_name);

            if ($image_255x157 && $image_1140x705) {
                $insert = $this->cinema_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "category_id"         => $cat,
                        "content"   => $this->input->post("content"),
                        "director"   => $this->input->post("director"),
                        "language"   => $this->input->post("language"),
                        "production"   => $this->input->post("production"),
                        "players"   => $this->input->post("players"),
                        "scriptwriter"           => $this->input->post("scriptwriter"),
                        "url"       => $this->input->post('url'),
                        "img_url"     => $file_name,
                        "rank"          => 0,
                        "isActive"      => 1
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
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız Oldu!",
                    "text" => "Görsel yüklenirken bir problem oluştu!",
                    "type" => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("cinema/new_form"));
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("cinema"));
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
        $item = $this->cinema_model->get(
            array(
                "id" => $id
            )
        );
        $viewData->categories = $this->cinema_category_model->get_all();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $cat = json_encode($this->input->post("category_id"));
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            if ($_FILES["img_url"]["name"] !== "") {
                $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
                $image_255x157 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 255, 157, $file_name);
                $image_1140x705 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 1140, 705, $file_name);

                if ($image_255x157 && $image_1140x705) {
                    $data = array(
                        "title"         => $this->input->post("title"),
                        "category_id"         => $cat,
                        "content"   => $this->input->post("content"),
                        "director"   => $this->input->post("director"),
                        "language"   => $this->input->post("language"),
                        "production"   => $this->input->post("production"),
                        "players"   => $this->input->post("players"),
                        "scriptwriter"           => $this->input->post("scriptwriter"),
                        "url"       => $this->input->post('url'),
                        "img_url"     => $file_name,
                        "rank"          => 0,
                        "isActive"      => 1
                    );
                } else {
                    $alert = array(
                        "title" => "İşlem Başarısız Oldu!",
                        "text" => "Görsel yüklenirken bir problem oluştu!",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("cinema/update_form/$id"));
                }
            } else {
                $data = array(
                    "title"         => $this->input->post("title"),
                    "category_id"         => $cat,
                    "content"   => $this->input->post("content"),
                    "director"   => $this->input->post("director"),
                    "language"   => $this->input->post("language"),
                    "production"   => $this->input->post("production"),
                    "players"   => $this->input->post("players"),
                    "scriptwriter"           => $this->input->post("scriptwriter"),
                    "url"       => $this->input->post('url'),
                    "rank"          => 0,
                    "isActive"      => 1
                );
            }
            $update = $this->cinema_model->update(array("id" => $id), $data);
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
            redirect(base_url("cinema"));
        } else {
            $viewData = new stdClass();
            $item = $this->cinema_model->get(
                array(
                    "id" => $id
                )
            );
            $viewData->categories = $this->cinema_category_model->get_all();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->cinema_model->delete(
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
                "title" => "İşlem Başarılıyla Gerçekleşti.",
                "text" => "Kayıt silme işlemi sırasında bir problem oluştu!",
                "type" => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("cinema"));
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->cinema_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");

        foreach ($rows as $row) {
            $this->news_model->update(
                array(
                    "id" => $row["id"]
                ),
                array("rank" => $row["position"])
            );
        }
    }
}
