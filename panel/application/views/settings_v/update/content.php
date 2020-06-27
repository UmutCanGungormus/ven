<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= $item->company_name ?></b> kaydını düzenliyorsunuz
            </h4>
        </div>
        <div class="col-md-12">
            <form action="<?= base_url("settings/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
                <div class="widget">
                    <div class="mb-3 nav-tabs-horizontal">
                    <nav>
                        
                   
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
  
                            <a class="nav-item nav-link active" id="profile-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="profile" aria-selected="false">Site Bilgileri</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-6" role="tab" aria-controls="profile" aria-selected="false">Adres Bilgisi</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="profile" aria-selected="false">Hakkımızda</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-3" role="tab" aria-controls="profile" aria-selected="false">Misyon</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-4" role="tab" aria-controls="profile" aria-selected="false">Vizyon</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-5" role="tab" aria-controls="profile" aria-selected="false">Sosyal Medya</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-7" role="tab" aria-controls="profile" aria-selected="false">Logo</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-8" role="tab" aria-controls="profile" aria-selected="false">Meta Tag</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-9" role="tab" aria-controls="profile" aria-selected="false">Site Analysis</a>
                            <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#tab-10" role="tab" aria-controls="profile" aria-selected="false">Live Support</a>


                            </div>

                            </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site_info"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/address"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/about_us"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/mission"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/vision"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/social_media"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/logo"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site_meta"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site_analysis"); ?>
                            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/live_support"); ?>
                        </div>
                    </div>
                </div>
                <div class="widget">
                    <div class="widget-body">
                        <button type="submit" class="btn btn-primary btn-md">Güncelle</button>
                        <a href="<?= base_url("settings"); ?>" class="btn btn-md btn-danger">İptal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>