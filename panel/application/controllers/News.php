<?php
defined('BASEPATH') or exit('No direct script access allowed');
class News extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "news_v";
        $this->load->model("news_model");
        $this->load->model("news_category_model");
        $this->load->model("writers_model");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->news_model->get_all(
            array(),
            "rank ASC"
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->news_model->getRows(
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
                    <a class="dropdown-item" href="' . base_url("news/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item" href="' . base_url("news/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
            </div>';



            //array_push($renkler,$renk->negotiation_stage_color);

            $item->img_url = "<img src='" . get_picture($this->viewFolder, $item->img_url, "370x297") . "' width='60px' height='60px' >";
            $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("news/check") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
            $data[] = array($item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title,  $item->img_url, $checkbox, $proccessing);
        }



        $output = array(
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->news_model->rowCount(),
            "recordsFiltered" => $this->news_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }


    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->categories = $this->news_category_model->get_all();
        $viewData->writers = $this->writers_model->get_all();
        $viewData->subViewFolder = "add";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $this->load->library("form_validation");
        $news_type = $this->input->post("news_type");
        $reaction = [
            'cok_iyi' => 0,
            'helal_olsun' => 0,
            'kizgin' => 0,
            'uzucu' => 0,
            'yerim' => 0,
            'yok_artik' => 0,
            'hos_degil' => 0

        ];

        if ($_FILES["img_url"]["name"] == "") {
            $alert = array(
                "title" => "İşlem Başarısız!",
                "text" => "Lütfen bir görsel seçiniz..",
                "type" => "error"
            );
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("news/new_form"));
        }

        $this->form_validation->set_rules("video_url", "Video URL", "required|trim");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {

            $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
            $image_370x297 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 370, 297, $file_name);
            $image_1008x600 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 1008, 600, $file_name);
            if ($image_370x297 && $image_1008x600) {
                $data = array(
                    "title"         => $this->input->post("title"),
                    "content"   => $this->input->post("content"),
                    "seo_url"           => seo($this->input->post("title")),
                    "tags"      => $this->input->post("tags"),
                    "img_url"     => $file_name,
                    'reaction' => json_encode($reaction),
                    "video_url"     => $this->input->post("video_url"),
                    "emoji"      => $this->input->post("emoji"),
                    "writer_id"      => $this->input->post("writer_id"),
                    "category_id"      => $this->input->post("category_id"),
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
                redirect(base_url("news/new_form"));
            }

            $insert = $this->news_model->add($data);
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
            redirect(base_url("news"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $item = $this->news_model->get(
            array(
                "id" => $id
            )
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->categories = $this->news_category_model->get_all();
        $viewData->writers = $this->writers_model->get_all();
        $viewData->item = $item;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("video_url", "Video URL", "required|trim");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $news_type = $this->input->post("newst_type", true);
        $validate = $this->form_validation->run();
        if ($validate) {

            if ($_FILES["img_url"]["name"] !== "") {
                $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
                $image_370x297 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 370, 297, $file_name);
                $image_1008x600 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 1008, 600, $file_name);

                if ($image_370x297 && $image_1008x600) {
                    $data = array(
                        "title"         => $this->input->post("title"),
                        "content"   => $this->input->post("content"),
                        "seo_url"           => seo($this->input->post("title")),

                        "img_url"     => $file_name,
                        "video_url"     => $this->input->post("video_url"),
                        "emoji"      => $this->input->post("emoji"),
                        "writer_id"      => $this->input->post("writer_id"),
                        "tags"      => $this->input->post("tags"),
                        "category_id"      => $this->input->post("category_id"),
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
                    redirect(base_url("news/update_form/$id"));
                }
            } else {
                $data = array(
                    "title"         => $this->input->post("title"),
                    "content"   => $this->input->post("content"),
                    "seo_url"           => seo($this->input->post("title")),
                    "video_url"     => $this->input->post("video_url"),
                    "emoji"      => $this->input->post("emoji"),
                    "writer_id"      => $this->input->post("writer_id"),
                    "tags"      => $this->input->post("tags"),
                    "category_id"      => $this->input->post("category_id"),
                    "rank"          => 0,
                    "isActive"      => 1
                );
            }


            $update = $this->news_model->update(array("id" => $id), $data);
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
            redirect(base_url("news"));
        } else {
            $viewData = new stdClass();
            $item = $this->news_model->get(
                array(
                    "id" => $id
                )
            );
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;
            $viewData->item = $item;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->news_model->delete(
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
        redirect(base_url("news"));
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->news_model->update(
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

    public function check()
    {
        $id = $this->input->post("id");
        $product = $this->news_model->get(["id" => $id])->isActive;
        if ($product == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        if ($this->news_model->update(["id" => $id], ["isActive" => $status])) {
            echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
        } else {
            echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
        }
    }
}
