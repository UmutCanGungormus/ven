<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Advertisement extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "advertisements_v";
        $this->load->model("advertisement_model");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $type = $_GET['type'];

        $items = $this->advertisement_model->get_all(
            ['type' => $type],
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

        $viewData->subViewFolder = "add";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $this->load->library("form_validation");
        $type = $_GET['type'];

        if ($_FILES["img_url"]["name"] == "") {
            $alert = array(
                "title" => "İşlem Başarısız!",
                "text" => "Lütfen bir görsel seçiniz..",
                "type" => "error"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("advertisement/new_form/?type=$type"));
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
                if ($type == "job") {
                    $insert = $this->advertisement_model->add(
                        array(
                            "title"         => $this->input->post("title"),
                            "type"         => $type,
                            "content"   => $this->input->post("content"),
                            "city"   => $this->input->post("city"),
                            "url"   => $this->input->post("url"),
                            "sector"   => $this->input->post("sector"),
                            "company_name"   => $this->input->post("company_name"),
                            "work_type"   => $this->input->post("work_type"),
                            "work_time"           => $this->input->post("work_time"),
                            "education_level"           => $this->input->post("education_level"),
                            "personal_count"           => $this->input->post("personal_count"),
                            "img_url"     => $file_name,
                            "holiday" => $this->input->post("holiday"),
                            "rank"          => 0,
                            "isActive"      => 1
                        )
                    );
                } else if ($type == "estate") {
                    $insert = $this->advertisement_model->add(
                        array(
                            "title"         => $this->input->post("title"),
                            "type"         => $type,
                            "content"   => $this->input->post("content"),
                            "city"   => $this->input->post("city"),
                            "url"   => $this->input->post("url"),
                            "sector"   => $this->input->post("sector"),
                            "payment"   => $this->input->post("payment"),
                            "estate_type"   => $this->input->post("estate_type"),
                            "company_name"   => $this->input->post("company_name"),
                            "advertisement_in"   => $this->input->post("advertisement_in"),
                            "advertisement_owner"   => $this->input->post("advertisement_owner"),
                            "img_url"     => $file_name,
                            "rank"          => 0,
                            "isActive"      => 1
                        )
                    );
                }

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
                redirect(base_url("advertisement/new_form/?type=$type"));
            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("advertisement/?type=$type"));
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
        $type = $_GET['type'];
        $viewData = new stdClass();
        $item = $this->advertisement_model->get(
            array(
                "id" => $id
            )
        );
        $viewData->type = $type;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $type = $_GET['type'];

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
                    if ($type == "job") {
                        $data =
                            array(
                                "title"         => $this->input->post("title"),
                                "type"         => $type,
                                "content"   => $this->input->post("content"),
                                "city"   => $this->input->post("city"),
                                "url"   => $this->input->post("url"),
                                "sector"   => $this->input->post("sector"),
                                "company_name"   => $this->input->post("company_name"),
                                "work_type"   => $this->input->post("work_type"),
                                "work_time"           => $this->input->post("work_time"),
                                "education_level"           => $this->input->post("education_level"),
                                "personal_count"           => $this->input->post("personal_count"),
                                "img_url"     => $file_name,
                                "holiday" => $this->input->post("holiday"),
                                "rank"          => 0,
                                "isActive"      => 1
                            );
                    } else if ($type == "estate") {
                        $data =
                            array(
                                "title"         => $this->input->post("title"),
                                "type"         => $type,
                                "content"   => $this->input->post("content"),
                                "city"   => $this->input->post("city"),
                                "url"   => $this->input->post("url"),
                                "sector"   => $this->input->post("sector"),
                                "payment"   => $this->input->post("payment"),
                                "estate_type"   => $this->input->post("estate_type"),
                                "company_name"   => $this->input->post("company_name"),
                                "advertisement_in"   => $this->input->post("advertisement_in"),
                                "advertisement_owner"   => $this->input->post("advertisement_owner"),
                                "img_url"     => $file_name,
                                "rank"          => 0,
                                "isActive"      => 1
                            );
                    }
                } else {
                    $alert = array(
                        "title" => "İşlem Başarısız Oldu!",
                        "text" => "Görsel yüklenirken bir problem oluştu!",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("advertisement/update_form/$id/?type=$type"));
                }
            } else {
                if ($type == "job") {
                    $data =
                        array(
                            "title"         => $this->input->post("title"),
                            "type"         => $type,
                            "content"   => $this->input->post("content"),
                            "city"   => $this->input->post("city"),
                            "url"   => $this->input->post("url"),
                            "sector"   => $this->input->post("sector"),
                            "company_name"   => $this->input->post("company_name"),
                            "work_type"   => $this->input->post("work_type"),
                            "work_time"           => $this->input->post("work_time"),
                            "education_level"           => $this->input->post("education_level"),
                            "personal_count"           => $this->input->post("personal_count"),
                            "holiday" => $this->input->post("holiday"),
                            "rank"          => 0,
                            "isActive"      => 1
                        );
                } else if ($type == "estate") {
                    $data =
                        array(
                            "title"         => $this->input->post("title"),
                            "type"         => $type,
                            "content"   => $this->input->post("content"),
                            "city"   => $this->input->post("city"),
                            "url"   => $this->input->post("url"),
                            "sector"   => $this->input->post("sector"),
                            "payment"   => $this->input->post("payment"),
                            "estate_type"   => $this->input->post("estate_type"),
                            "company_name"   => $this->input->post("company_name"),
                            "advertisement_in"   => $this->input->post("advertisement_in"),
                            "advertisement_owner"   => $this->input->post("advertisement_owner"),
                            "rank"          => 0,
                            "isActive"      => 1
                        );
                }
            }
            $update = $this->advertisement_model->update(array("id" => $id), $data);
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
            redirect(base_url("advertisement/?type=$type"));
        } else {
            $viewData = new stdClass();
            $item = $this->advertisement_model->get(
                array(
                    "id" => $id
                )
            );
            $viewData->type = $type;
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        $type = $_GET['type'];
        $delete = $this->advertisement_model->delete(
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
        redirect(base_url("advertisement/?type=$type"));
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->advertisement_model->update(
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
            $this->advertisement_model->update(
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
