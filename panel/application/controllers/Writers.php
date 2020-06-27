<?php
class Writers extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "writers_v";
        $this->load->model("writers_model");
        $this->load->helper("text");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->writers_model->get_all(
            array(),
            "rank ASC"
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->writers_model->getRows(
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
                    <a class="dropdown-item" href="' . base_url("writers/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item" href="' . base_url("writers/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
            </div>';



            //array_push($renkler,$renk->negotiation_stage_color);
            
            $item->img_url="<img src='".base_url("uploads/writers_v/90x90/".$item->img_url)."' width='60px' height='60px' >";
            $checkbox= '<div class="custom-control custom-switch"><input data-id="'.$item->id.'" data-url="'.base_url("writers/check").'" data-status="'.($item->isActive == 1 ? "checked" : null).'" id="customSwitch'.$i.'" type="checkbox" '.($item->isActive == 1 ? "checked" : null).' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch'.$i.'"></label></div>';
            $data[] = array($item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->name, $item->type, $item->img_url, $checkbox, $proccessing);
        }
        


        $output = array(
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->writers_model->rowCount(),
            "recordsFiltered" => $this->writers_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
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
            redirect(base_url("writers/new_form"));
            die();
        }
        $this->form_validation->set_rules("name", "Ad", "required|trim");
        $this->form_validation->set_rules("type", "Görev", "required|trim");
        $this->form_validation->set_rules("email", "Mail", "required|trim");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
            $image_90x90 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 90, 90, $file_name);
            if ($image_90x90) {
                $insert = $this->writers_model->add(
                    array(
                        "name"         => $this->input->post("name"),
                        "type"   => $this->input->post("type"),
                        "email"       => $this->input->post("email"),
                        "password"     => md5($this->input->post("password")),
                        "img_url"       => $file_name,
                        "isActive"      => 1
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
                redirect(base_url("writers/new_form"));
                die();
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("writers"));
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
        $item = $this->writers_model->get(
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
        $this->form_validation->set_rules("name", "Ad", "required|trim");
        $this->form_validation->set_rules("type", "Görev", "required|trim");
        $this->form_validation->set_rules("email", "Mail", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            if ($_FILES["img_url"]["name"] !== "") {
                $file_name = seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
                $image_90x90 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder", 90, 90, $file_name);
                if ($image_90x90) {
                    if ($this->input->post("password") != "") {
                        $data = array(
                            "name"         => $this->input->post("name"),
                            "type"   => $this->input->post("type"),
                            "email"       => $this->input->post("email"),
                            "password"     => md5($this->input->post("password")),
                            "img_url"       => $file_name,
                            "isActive"      => 1
                        );
                    } else {
                        $data = array(
                            "name"         => $this->input->post("name"),
                            "type"   => $this->input->post("type"),
                            "email"       => $this->input->post("email"),
                            "img_url"       => $file_name,
                            "isActive"      => 1
                        );
                    }
                } else {
                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Görsel yüklenirken bir problem oluştu",
                        "type" => "error"
                    );
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("writers/update_form/$id"));
                    die();
                }
            } else {
                if ($this->input->post("password") != "") {
                    $data = array(
                        "name"         => $this->input->post("name"),
                        "type"   => $this->input->post("type"),
                        "email"       => $this->input->post("email"),
                        "password"     => md5($this->input->post("password")),

                        "isActive"      => 1
                    );
                } else {
                    $data = array(
                        "name"         => $this->input->post("name"),
                        "type"   => $this->input->post("type"),
                        "email"       => $this->input->post("email"),


                        "isActive"      => 1
                    );
                }
            }
            $update = $this->writers_model->update(array("id" => $id), $data);
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
            redirect(base_url("writers"));
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $this->writers_model->get(
                array(
                    "id"    => $id,
                )
            );
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->writers_model->delete(
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
        redirect(base_url("writers"));
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->writers_model->update(
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
     $product=$this->writers_model->get(["id"=>$id])->isActive;
     if($product==1){
         $status=0;
     }else{
         $status=1;
     }
     if($this->writers_model->update(["id"=>$id],["isActive"=>$status])){
        echo json_encode(["success"=>True,"title"=>"İşlem Başarıyla Gerçekleşti","msg"=>"Güncelleme İşlemi Yapıldı"]);
     }else{
       echo json_encode(["success"=>False,"title"=>"İşlem Başarısız Oldu","msg"=>"Güncelleme İşlemi Yapılamadı"]);
     }
     

    }
}
