<?php
class Slides extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "slides_v";
        $this->load->model("slide_model");
        $this->load->helper("text");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function datatable()
    {
        $items = $this->slide_model->getRows(
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
                    <a class="dropdown-item" href="' . base_url("slides/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item" href="' . base_url("slides/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
            </div>';



            //array_push($renkler,$renk->negotiation_stage_color);
            
            $item->img_url="<img src='".get_picture($this->viewFolder,$item->img_url,"857x505")."' width='60px' height='60px' >";
            $checkbox= '<div class="custom-control custom-switch"><input data-id="'.$item->id.'" data-url="'.base_url("slides/check").'" data-status="'.($item->isActive == 1 ? "checked" : null).'" id="customSwitch'.$i.'" type="checkbox" '.($item->isActive == 1 ? "checked" : null).' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch'.$i.'"></label></div>';
            $data[] = array($item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, $item->description, $item->img_url, $checkbox, $proccessing);
        }
        


        $output = array(
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->slide_model->rowCount(),
            "recordsFiltered" => $this->slide_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->slide_model->get_all(
            array(),
            "rank ASC"
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $this->load->library("form_validation");
        if ($_FILES["img_url"]["name"] == "") {
            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Lütfen bir görsel seçiniz",
                "type"  => "error"
            );
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("slides/new_form"));

            die();
        }
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        if ($this->input->post("allowButton") == "on") {
            $this->form_validation->set_rules("button_caption", "Buton Başlık", "required|trim");
            $this->form_validation->set_rules("button_url", "Button URL Bilgisi", "required|trim");
        }
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
            $image_857x505 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 857, 505, $file_name);
            if ($image_857x505) {
                $insert = $this->slide_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "description"   => $this->input->post("description"),
                        "img_url"       => $file_name,
                        "allowButton" => ($this->input->post("allowButton") == "on") ? 1 : 0,
                        "button_url" => $this->input->post("button_url"),
                        "button_caption" => $this->input->post("button_caption"),
                        "language"      => $this->input->post("language"),
                        "rank"          => 0,
                        "isActive"      => 1,
                        "createdAt"     => date("Y-m-d H:i:s")
                    )
                );
                if ($insert) {
                    $alert = array(
                        "title" => "İşlem Başarılı",
                        "text" => "Kayıt başarılı bir şekilde eklendi",
                        "type"  => "success"
                    );
                } else {
                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Kayıt Ekleme sırasında bir problem oluştu",
                        "type"  => "error"
                    );
                }
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Görsel yüklenirken bir problem oluştu",
                    "type"  => "error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("slides/new_form"));
                die();
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("slides"));
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
        $item = $this->slide_model->get(
            array(
                "id"    => $id,
            )
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        if ($this->input->post("allowButton") == "on") {
            $this->form_validation->set_rules("button_caption", "Buton Başlık", "required|trim");
            $this->form_validation->set_rules("button_url", "Button URL Bilgisi", "required|trim");
        }
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            if ($_FILES["img_url"]["name"] !== "") {
                $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
                $image_857x505 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 857, 505, $file_name);
                if ($image_857x505) {
                    $data = array(
                        "title"         => $this->input->post("title"),
                        "description"   => $this->input->post("description"),
                        "img_url"       => $file_name,
                        "allowButton" => ($this->input->post("allowButton") == "on") ? 1 : 0,
                        "language"      => $this->input->post("language"),
                        "button_url" => $this->input->post("button_url"),
                        "button_caption" => $this->input->post("button_caption"),
                    );
                } else {
                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Görsel yüklenirken bir problem oluştu",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("slides/update_form/$id"));
                    die();
                }
            } else {
                $data = array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "allowButton" => ($this->input->post("allowButton") == "on") ? 1 : 0,
                    "language"      => $this->input->post("language"),
                    "button_url" => $this->input->post("button_url"),
                    "button_caption" => $this->input->post("button_caption"),
                );
            }
            $update = $this->slide_model->update(array("id" => $id), $data);
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );
            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("slides"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $this->slide_model->get(
                array(
                    "id"    => $id,
                )
            );
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->slide_model->delete(
            array(
                "id"    => $id
            )
        );
        if ($delete) {
            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt başarılı bir şekilde silindi",
                "type"  => "success"
            );
        } else {

            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt silme sırasında bir problem oluştu",
                "type"  => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("slides"));
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->slide_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
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

    public function check(){
     $id=$this->input->post("id");
     $product=$this->slide_model->get(["id"=>$id])->isActive;
     if($product==1){
         $status=0;
     }else{
         $status=1;
     }
     if($this->slide_model->update(["id"=>$id],["isActive"=>$status])){
        echo json_encode(["success"=>True,"title"=>"İşlem Başarıyla Gerçekleşti","msg"=>"Güncelleme İşlemi Yapıldı"]);
     }else{
       echo json_encode(["success"=>False,"title"=>"İşlem Başarısız Oldu","msg"=>"Güncelleme İşlemi Yapılamadı"]);
     }
     

    }
}
