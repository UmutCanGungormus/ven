<?php
class Portfolio extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "portfolio_v";
        $this->load->model("portfolio_model");
        $this->load->model("portfolio_image_model");
        $this->load->model("portfolio_category_model");
        if (!get_active_user()) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->portfolio_model->get_all(
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
        $items = $this->portfolio_model->getRows(
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
                    <a class="dropdown-item" href="' . base_url("portfolio/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item" href="' . base_url("portfolio/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
            </div>';



            //array_push($renkler,$renk->negotiation_stage_color);
            $img_url=get_portfolio_cover($item->id);
            $img_url = "<img src='" . get_picture($this->viewFolder, $img_url, "255x157") . "' width='60px' height='60px' >";
            $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("portfolio/check") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
            $data[] = array($item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title,  $img_url, $checkbox, $proccessing);
        }



        $output = array(
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->portfolio_model->rowCount(),
            "recordsFiltered" => $this->portfolio_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }



public function rankSetter()
    {
        $rows = $this->input->post("rows");

        foreach ($rows as $row) {
            $this->portfolio_model->update(
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
        $product = $this->portfolio_model->get(["id" => $id])->isActive;
        if ($product == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        if ($this->portfolio_model->update(["id" => $id], ["isActive" => $status])) {
            echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
        } else {
            echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
        }
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->categories = $this->portfolio_category_model->get_all(
            array(
                "isActive" => 1
            )
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function save()
    {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("category_id", "Kategori", "required|trim");
        $this->form_validation->set_rules("client", "Müşteri", "required|trim");
        $this->form_validation->set_rules("finishedAt", "Bitiş Tarihi", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $insert = $this->portfolio_model->add(
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => seo($this->input->post("title")),
                    "client" => $this->input->post("client"),
                    "finishedAt" => $this->input->post("finishedAt"),
                    "category_id" => $this->input->post("category_id"),
                    "place" => $this->input->post("place"),
                    "portfolio_url" => $this->input->post("portfolio_url"),
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
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("portfolio"));
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
        $viewData->categories = $this->portfolio_category_model->get_all(
            array(
                "isActive" => 1
            )
        );
        $item = $this->portfolio_model->get(
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
        $this->form_validation->set_rules("category_id", "Kategori", "required|trim");
        $this->form_validation->set_rules("client", "Müşteri", "required|trim");
        $this->form_validation->set_rules("finishedAt", "Bitiş Tarihi", "required|trim");
        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );
        $validate = $this->form_validation->run();
        if ($validate) {
            $update = $this->portfolio_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => seo($this->input->post("title")),
                    "client" => $this->input->post("client"),
                    "finishedAt" => $this->input->post("finishedAt"),
                    "category_id" => $this->input->post("category_id"),
                    "place" => $this->input->post("place"),
                    "portfolio_url" => $this->input->post("portfolio_url")
                )
            );
            if ($update) {
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );
            } else {
                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("portfolio"));
        } else {
            $viewData = new stdClass();
            $item = $this->portfolio_model->get(
                array(
                    "id"    => $id,
                )
            );
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;
            $viewData->categories = $this->portfolio_category_model->get_all(
                array(
                    "isActive" => 1
                )
            );
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }
    public function delete($id)
    {
        $delete = $this->portfolio_model->delete(
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
                "title" => "İşlem Başarısız",
                "text" => "Kayıt silme sırasında bir problem oluştu",
                "type"  => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("portfolio"));
    }
    public function imageDelete($id, $parent_id)
    {
        $fileName = $this->portfolio_image_model->get(
            array(
                "id"    => $id
            )
        );
        $delete = $this->portfolio_image_model->delete(
            array(
                "id"    => $id
            )
        );
        if ($delete) {
            unlink("uploads/{$this->viewFolder}/$fileName->img_url");
            redirect(base_url("portfolio/image_form/$parent_id"));
        } else {
            redirect(base_url("portfolio/image_form/$parent_id"));
        }
    }
    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->portfolio_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }
    public function imageIsActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;
            $this->portfolio_image_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }
    public function isCoverSetter($id, $parent_id)
    {
        if ($id && $parent_id) {
            $isCover = ($this->input->post("data") === "true") ? 1 : 0;
            $this->portfolio_image_model->update(
                array(
                    "id"         => $id,
                    "portfolio_id" => $parent_id
                ),
                array(
                    "isCover"  => $isCover
                )
            );
            $this->portfolio_image_model->update(
                array(
                    "id !="      => $id,
                    "portfolio_id" => $parent_id
                ),
                array(
                    "isCover"  => 0
                )
            );
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";
            $viewData->item_images = $this->portfolio_image_model->get_all(
                array(
                    "portfolio_id"    => $parent_id
                ),
                "rank ASC"
            );
            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

            echo $render_html;
        }
    }
    
    public function imageRankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];
        foreach ($items as $rank => $id) {
            $this->portfolio_image_model->update(
                array(
                    "id"        => $id,
                    "rank !="   => $rank
                ),
                array(
                    "rank"      => $rank
                )
            );
        }
    }
    public function image_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->portfolio_model->get(
            array(
                "id"    => $id
            )
        );
        $viewData->item_images = $this->portfolio_image_model->get_all(
            array(
                "portfolio_id"    => $id
            ),
            "rank ASC"
        );
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function image_upload($id)
    {
        $file_name = seo(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $image_255x157 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder", 255, 157, $file_name);
        $image_276x171 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder", 276, 171, $file_name);
        $image_352x171 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder", 352, 171, $file_name);
        $image_1080x426 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder", 1080, 426, $file_name);
        $image_480x340 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder", 480, 340, $file_name);
        if ($image_255x157 && $image_276x171 && $image_352x171 && $image_480x340 && $image_1080x426) {
            $this->portfolio_image_model->add(
                array(
                    "img_url"       => $file_name,
                    "rank"          => 0,
                    "isActive"      => 1,
                    "isCover"       => 0,
                    "createdAt"     => date("Y-m-d H:i:s"),
                    "portfolio_id"    => $id
                )
            );
        } else {
            echo "islem basarisiz";
        }
    }
    public function refresh_image_list($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item_images = $this->portfolio_image_model->get_all(
            array(
                "portfolio_id"    => $id
            )
        );
        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
        echo $render_html;
    }
}
