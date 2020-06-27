<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends MY_Controller
{   
    
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_v";
        $this->load->model("product_model");
        $this->load->model("product_image_model");
        $this->load->model("product_category_model");
        $this->load->helper("text");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->product_model->get_all(
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
        $items = $this->product_model->getRows(
            [],
            $_POST
        );
        $data = $row = array();
        $i = (!empty($_POST['start']) ? $_POST['start'] : 0);

        foreach ($items as $item) {
            $i++;
            $j=$i+1;
            
            $proccessing = '
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    İşlemler
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="' . base_url("product/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item" href="' . base_url("product/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    <a class="dropdown-item" href="' . base_url("product/image_form/$item->id") . '"><i class="fa fa-image mr-2"></i>Resimler</a>
                    <a class="dropdown-item" href="' . base_url("product_option/productAddOrUpdateForm/$item->id") . '"><i class="fa fa-image mr-2"></i>Varyasyon Ekle</a>

                    </div>
            </div>';



            //array_push($renkler,$renk->negotiation_stage_color);
            
            $item->img_url="<img src='".base_url("uploads/product_v/348x215/".get_product_cover_photo($item->id))."' width='60px' height='60px' >";
            $checkbox= '<div class="custom-control custom-switch"><input data-id="'.$item->id.'" data-url="'.base_url("product/check").'" data-status="'.($item->isActive == 1 ? "checked" : null).'" id="customSwitch'.$i.'" type="checkbox" '.($item->isActive == 1 ? "checked" : null).' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch'.$i.'"></label></div>';
            $checkbox2= '<div class="custom-control custom-switch"><input data-id="'.$item->id.'" data-url="'.base_url("product/isHome").'" data-status="'.($item->isHome == 1 ? "checked" : null).'" id="customSwitch'.$j.'" type="checkbox" '.($item->isHome == 1 ? "checked" : null).' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch'.$j.'"></label></div>';
            
            $data[] = array($item->product_rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->product_title, $item->category_title, $item->img_url, $checkbox,$checkbox2, $proccessing);
        }
        


        $output = array(
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_model->rowCount(),
            "recordsFiltered" => $this->product_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->categories = $this->product_category_model->get_all(
            array(
                "isActive" => 1
            )
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("category_id", "Kategori", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $getRank = $this->product_model->get([], "products.id DESC");
            $insert = $this->product_model->add(
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => seo($this->input->post("title")),
                    "category_id" => $this->input->post("category_id"),
                    "rank"          => $getRank->rank + 1,
                    "price"         => $this->input->post("price"),
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
            redirect(base_url("product"));
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
        $viewData->categories = $this->product_category_model->get_all(
            array(
                "isActive" => 1
            )
        );
        $item = $this->product_model->get(
            array(
                "id" => $id
            )
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function update($id)
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("category_id", "Kategori", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $update = $this->product_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "category_id" => $this->input->post("category_id"),
                    "price"         => $this->input->post("price"),
                    "url"           => seo($this->input->post("title"))
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
                    "title" => "İşlem Başarısız Oldu.",
                    "text" => "Kayıt güncelleme sırasında bir problem oluştu!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("product"));
        } else {
            $item = $this->product_model->get(
                array(
                    "id" => $id
                )
            );
            $viewData = new stdClass();
            $viewData->categories = $this->product_category_model->get_all(
                array(
                    "isActive" => 1
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
        $delete = $this->product_model->delete(
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
        redirect(base_url("product"));
    }
    public function imageDelete($id, $parent_id)
    {
        $delete = $this->product_image_model->delete(
            array(
                "id" => $id
            )
        );
        if ($delete) {
            $rsil = getFileName($id);
            unlink("uploads/{$this->viewFolder}/$rsil");
            redirect(base_url("product/image_form/$parent_id"));
        } else {
            redirect(base_url("product/image_form/$parent_id"));
        }
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }
    }
    public function imageIsActiveSetter($id)
    {
        if ($id) {
            $imageIsActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_image_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $imageIsActive
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
     $product=$this->product_model->get(["id"=>$id])->isActive;
     if($product==1){
         $status=0;
     }else{
         $status=1;
     }
     if($this->product_model->update(["id"=>$id],["isActive"=>$status])){
        echo json_encode(["success"=>True,"title"=>"İşlem Başarıyla Gerçekleşti","msg"=>"Güncelleme İşlemi Yapıldı"]);
     }else{
       echo json_encode(["success"=>False,"title"=>"İşlem Başarısız Oldu","msg"=>"Güncelleme İşlemi Yapılamadı"]);
     }
     

    }
    public function isHome(){
        $id=$this->input->post("id");
        $product=$this->product_model->get(["id"=>$id])->isHome;
        if($product==1){
            $status=0;
        }else{
            $status=1;
        }
        if($this->product_model->update(["id"=>$id],["isHome"=>$status])){
           echo json_encode(["success"=>True,"title"=>"İşlem Başarıyla Gerçekleşti","msg"=>"Güncelleme İşlemi Yapıldı"]);
        }else{
          echo json_encode(["success"=>False,"title"=>"İşlem Başarısız Oldu","msg"=>"Güncelleme İşlemi Yapılamadı"]);
        }
        
   
       }
    
    public function imageRankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->product_image_model->update(
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
    public function image_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->product_model->get(
            array(
                "id" => $id
            )
        );
        $viewData->item_images = $this->product_image_model->get_all(
            array(
                "product_id" => $id
            ),
            "rank ASC"
        );
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function image_upload($id)
    {
        $file_name = seo(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $image_348x215 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder", 348, 215, $file_name);
        $image_1080x426 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder", 1080, 426, $file_name);
        if ($image_348x215 && $image_1080x426) {
            $this->product_image_model->add(
                array(
                    "img_url" => $file_name,
                    "rank" => 0,
                    "isActive" => 1,
                    "isCover" => 0,
                    "createdAt" => date("Y-m-d H:i:s"),
                    "product_id" => $id
                )
            );
        } else {
            echo "basarısız";
        }
    }
    public function refresh_image_list($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item_images = $this->product_image_model->get_all(
            array(
                "product_id" => $id
            )
        );
        $render_html = $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
        echo $render_html;
    }
    public function isCoverSetter($id, $parent_id)
    {
        if ($id && $parent_id) {
            $isCover = ($this->input->post("data") === "true") ? 1 : 0;
            $this->product_image_model->update(
                array(
                    "id" => $id,
                    "product_id" => $parent_id
                ),
                array(
                    "isCover" => $isCover
                )
            );

            $this->product_image_model->update(
                array(
                    "id !=" => $id,
                    "product_id" => $parent_id
                ),
                array(
                    "isCover" => 0
                )
            );
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";
            $viewData->item_images = $this->product_image_model->get_all(
                array(
                    "product_id" => $parent_id
                ),
                "rank ASC"
            );
            $render_html = $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
            echo $render_html;
        }
    }
}
