<?php $user = get_active_user(); ?>
<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><i class="fa fa-times position-absolute"></i><img class="brand-img mx-auto mt-1" width="160" src="https://mutfakyapim.com/images/mutfak/logo.png?v=1"></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <?php if (isAllowedViewModule("dashboard")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url() ?>">
                            <i class="fa fa-tachometer-alt"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("settings")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="settings")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("settings") ?>">
                            <i class="fa fa-cogs"></i>
                            <span class="nav-link-text">Ayarlar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("emailsettings")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="emailsettings")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("emailsettings") ?>">
                            <i class="fa fa-mail-bulk"></i>
                            <span class="nav-link-text">E-Posta Ayarları</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("galleries")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="galleries")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("galleries") ?>">
                            <i class="fa fa-photo-video"></i>
                            <span class="nav-link-text">Galeri İşlemleri</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("video")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="video")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("video") ?>">
                            <i class="fa fa-video"></i>
                            <span class="nav-link-text">Video</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("writers")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="writers")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("writers") ?>">
                            <i class="fa fa-edit"></i>
                            <span class="nav-link-text">Editörler/Yazarlar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("slides")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="slides")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("slides") ?>">
                            <i class="fa fa-images"></i>
                            <span class="nav-link-text">Slider</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("home_banner")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="dashboard")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("home_banner") ?>">
                            <i class="fa fa-images"></i>
                            <span class="nav-link-text">Anasayfa Banner</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("advertisement")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="advertisement")? "active":"" ?> ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#advertisement_nav">
                            <i class="fa fa-newspaper"></i>
                            <span class="nav-link-text">İlan İşlemleri</span>
                        </a>
                        <ul id="advertisement_nav" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("advertisement/?type=job"); ?>">İş İlanları</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("advertisement/?type=estate"); ?>">Emlak İlanları</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("social_media_talk")) { ?>
                    <li class="nav-item  ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#social_media_talk_nav">
                            <i class="fa fa-icons"></i>
                            <span class="nav-link-text">Widget İşlemleri</span>
                        </a>
                        <ul id="social_media_talk_nav" class="nav flex-column collapse <?= ($this->uri->segment(1)=="social_media_talk")||($this->uri->segment(1)=="news_box")?"show":""?> collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column ">
                                    <li class="nav-item <?= ($this->uri->segment(1)=="social_media_talk")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("social_media_talk"); ?>">Sosyal Medya Bunu Konuşuyor</a>
                                    </li>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="news_box")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("news_box"); ?>">Haber Kutusu</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("votings")) { ?>
                    <li class="nav-item  ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#votings_nav">
                            <i class="fa fa-vote-yea"></i>
                            <span class="nav-link-text">Oylama İşlemleri</span>
                        </a>
                        <ul id="votings_nav" class="nav flex-column collapse <?= ($this->uri->segment(1)=="votings")||($this->uri->segment(1)=="voting_options")?"show":""?> collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item <?= ($this->uri->segment(1)=="votings")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("votings"); ?>">Oylama Konusu</a>
                                    </li>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="voting_options")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("voting_options"); ?>">Oylama Şıkları</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("news")) { ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#news_nav">
                            <i class="fa fa-newspaper"></i>
                            <span class="nav-link-text">Haber İşlemleri</span>
                        </a>
                        <ul id="news_nav" class="nav flex-column collapse  <?= ($this->uri->segment(1)=="news")||($this->uri->segment(1)=="news_categories")?"show":""?> collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item  <?= ($this->uri->segment(1)=="news")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("news"); ?>">Haberler</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1)=="news_categories")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("news_categories"); ?>">Haber Kategorileri</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("test")) { ?>
                    <li class="nav-item  ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#test_nav">
                            <i class="fa fa-file-signature"></i>
                            <span class="nav-link-text">Test İşlemleri</span>
                        </a>
                        <ul id="test_nav" class="nav flex-column collapse <?= ($this->uri->segment(1)=="test")||($this->uri->segment(1)=="options")?"show":""?> collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item <?= ($this->uri->segment(1)=="test")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("test"); ?>">Testler</a>
                                    </li>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="options")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("options"); ?>">Test Şıkları</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("book")) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#book_nav">
                            <i class="fa fa-book"></i>
                            <span class="nav-link-text">Kitaplar</span>
                        </a>
                        <ul id="book_nav" class="nav flex-column collapse <?= ($this->uri->segment(1)=="book_category")||($this->uri->segment(1)=="book")?"show":""?>  collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item  <?= ($this->uri->segment(1)=="book_category")? "active":"" ?> ">
                                        <a class="nav-link " href="<?= base_url("book_category"); ?>">Kitap Türleri</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1)=="book")? "active":"" ?> ">
                                        <a class="nav-link" href="<?= base_url("book"); ?>">Kitaplar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("cinema")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="cinema")? "active":"" ?> ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#cinema_nav">
                            <i class="fa fa-film"></i>
                            <span class="nav-link-text">Sinema</span>
                        </a>
                        <ul id="cinema_nav" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("cinema_category"); ?>">Film Türleri</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("cinema"); ?>">Filmler</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("activity")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="activity")? "active":"" ?> ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#activity_nav">
                            <i class="fa fa-snowboarding"></i>
                            <span class="nav-link-text">Etkinlik İşlemleri</span>
                        </a>
                        <ul id="activity_nav" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("activity_category"); ?>">Etkinlik Kategorileri</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("activity"); ?>">Etkinlikler</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("users")) { ?>
                    <li class="nav-item  ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#users_nav">
                            <i class="fa fa-users"></i>
                            <span class="nav-link-text">Kullanıcı İşlemleri</span>
                        </a>
                        <ul id="users_nav" class="nav flex-column collapse <?= ($this->uri->segment(1)=="user_role")||($this->uri->segment(1)=="users")?"show":""?>  collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <?php if (isAllowedViewModule("user_role")) { ?>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="user_role")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("user_role"); ?>">Kullanıcı Yetkileri</a>
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="users")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("users"); ?>">Kullanıcılar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (isAllowedViewModule("product")) { ?>
                    <li class="nav-item  ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#product_nav">
                            <i class="fa fa-dropbox"></i>
                            <span class="nav-link-text">Ürün İşlemleri</span>
                        </a>
                        <ul id="product_nav" class="nav flex-column collapse <?= ($this->uri->segment(1)=="product_categories")||($this->uri->segment(1)=="product")?"show":""?> collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item <?= ($this->uri->segment(1)=="product_categories")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("product_categories"); ?>">Ürün Kategorileri</a>
                                    </li>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="product")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("product"); ?>">Ürünler</a>
                                    </li>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="product_option")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("product_option"); ?>">Varyasyon</a>
                                    </li>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="product_option_category")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("product_option_category"); ?>">Varyasyon Kategori</a>
                                    </li>
                                    <li class="nav-item <?= ($this->uri->segment(1)=="product_option_category")? "active":"" ?>">
                                        <a class="nav-link" href="<?= base_url("product_option_add"); ?>">Ürüne Varyasyon Ekle</a>
                                    </li>

                                   
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
        
                <?php if (isAllowedViewModule("services")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="services")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("services") ?>">
                            <i class="fa fa-list"></i>
                            <span class="nav-link-text">Hizmetlerimiz</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("questions")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="questions")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("questions") ?>">
                            <i class="fa fa-question"></i>
                            <span class="nav-link-text">Soru (SSS)</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("portfolio")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="portfolio")? "active":"" ?> ">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#portfolio_nav">
                            <i class="fa fa-id-card"></i>
                            <span class="nav-link-text">Portfolyo İşlemleri</span>
                        </a>
                        <ul id="portfolio_nav" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("portfolio_categories"); ?>">Portfolyo Kategorileri</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= base_url("portfolio"); ?>">Portfolyo</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("references")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="references")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("references") ?>">
                            <i class="fa fa-globe-europe"></i>
                            <span class="nav-link-text">Referanslar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("brands")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="brands")? "active":"" ?> " >
                        <a class="nav-link" href="<?= base_url("brands") ?>">
                            <i class="fa fa-apple"></i>
                            <span class="nav-link-text">Markalar</span>
                        </a>
                    </li>
                <?php } ?>
            
                <?php if (isAllowedViewModule("testimonials")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="testimonials")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("testimonials"); ?>">
                            <i class="fa fa-sticky-note"></i>
                            <span class="nav-link-text">Ziyaretçi Notları</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if (isAllowedViewModule("popups")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1)=="popups")? "active":"" ?> ">
                        <a class="nav-link" href="<?= base_url("popups"); ?>">
                            <i class="fa fa-lightbulb"></i>
                            <span class="nav-link-text">Popup Hizmeti</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <hr class="nav-separator">
            <div class="nav-header">
                <span>Siteyi Görüntüleyin</span>
                <span>SG</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url()?>">
                        <i class="fa fa-external-link-alt"></i>
                        <span class="nav-link-text">Siteyi Görüntüle</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<!-- /Vertical Nav -->