<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Activity extends MY_Controller
{

    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "activitys_v";
        $this->load->model("activity_model");
        $this->load->model("activity_category_model");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->activity_model->get_all(
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
        $viewData->categories = $this->activity_category_model->get_all(
            array(
                "isActive" => 1
            )
        );
        $viewData->subViewFolder = "add";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $this->load->library("form_validation");
        if ($_FILES["img_url"]["name"] == "") {
            $alert = array(
                "title" => "İşlem Başarısız!",
                "text" => "Lütfen bir görsel seçiniz..",
                "type" => "error"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("activity/new_form"));
        }
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("event_date", "Eğitim Tarihi", "required|trim");
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
                $insert = $this->activity_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "category_id"         => $this->input->post("category_id"),
                        "content"   => $this->input->post("content"),
                        "place"   => $this->input->post("place"),
                        "hour"   => $this->input->post("hour"),
                        "city"   => $this->input->post("city"),
                        "info"   => $this->input->post("info"),
                        "url"           => $this->input->post("url"),
                        "img_url"     => $file_name,
                        "date" => $this->input->post("event_date"),
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
                redirect(base_url("activity/new_form"));
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("activity"));
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
        $item = $this->activity_model->get(
            array(
                "id" => $id
            )
        );
        $viewData->categories = $this->activity_category_model->get_all();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("date", "Eğitim Tarihi", "required|trim");
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
                        "category_id"         => $this->input->post("category_id"),
                        "content"   => $this->input->post("content"),
                        "place"   => $this->input->post("place"),
                        "hour"   => $this->input->post("hour"),
                        "city"   => $this->input->post("city"),
                        "info"   => $this->input->post("info"),
                        "url"           => $this->input->post("url"),
                        "img_url"     => $file_name,
                        "date" => $this->input->post("date"),
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
                    redirect(base_url("activity/update_form/$id"));
                }
            } else {
                $data = array(
                    "title"         => $this->input->post("title"),
                    "category_id"         => $this->input->post("category_id"),
                    "content"   => $this->input->post("content"),
                    "place"   => $this->input->post("place"),
                    "hour"   => $this->input->post("hour"),
                    "city"   => $this->input->post("city"),
                    "info"   => $this->input->post("info"),
                    "url"           => $this->input->post("url"),
                    "date" => $this->input->post("date"),
                    "rank"          => 0,
                    "isActive"      => 1
                );
            }
            $update = $this->activity_model->update(array("id" => $id), $data);
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
            redirect(base_url("activity"));
        } else {
            $viewData = new stdClass();
            $item = $this->activity_model->get(
                array(
                    "id" => $id
                )
            );
            $viewData->categories = $this->activity_category_model->get_all();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->activity_model->delete(
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
        redirect(base_url("activity"));
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->activity_model->update(
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
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->activity_model->update(
                array(
                    "id" => $id,
                    "rank !=" => $rank
                ),
                array(
                    "rank" => $rank
                )
            );
        }
    }
}
