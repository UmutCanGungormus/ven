<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php
        $i = 0;
        foreach ($sliders as $slider) :
        ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class=" <?= ($i == 0) ? "active" : "" ?>"></li>
        <?php
            $i++;
        endforeach
        ?>

    </ol>
    <div class="carousel-inner">
        <?php
        $i = 0;
        foreach ($sliders as $slider) :
        ?>
            <div class="carousel-item  <?= ($i == 0) ? "active" : "" ?>">
                <img class="d-block w-100" src="<?= base_url("panel/uploads/slides_v/857x505/" . $slider->img_url) ?>">
            </div>
        <?php
            $i++;
        endforeach
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Önceki</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Sonraki</span>
    </a>
</div>

<div class="banner-section spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-banner">
                    <a href="<?= base_url("kategori/erkek") ?>">
                        <img src="img/man.jpg" alt="">
                        <div class="inner-text">
                            <h4>ERKEK</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <a href="<?= base_url("kategori/kadin") ?>">
                        <img src="img/banner-2.jpg" alt="">
                        <div class="inner-text">
                            <h4>KADIN</h4>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <a href="<?= base_url("kategori/unisex") ?>">
                        <img src="img/unisex.jpg" alt="">
                        <div class="inner-text">
                            <h4>UNISEX</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-large set-bg" data-setbg="<?= base_url("panel/uploads/home_banner_v/857x505/" . get_banner_photo("KADIN")); ?>">
                    <h2>KADIN</h2>
                    <a href="<?=base_url("kategori/kadin")?>">Tümünü Görüntüle</a>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="product-slider owl-carousel">

                    <?php
                    foreach ($products as $product) {
                        if ($product->category_id == 15) {


                    ?>
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="<?= base_url("panel/uploads/product_v/1080x426/".get_product_cover_photo($product->id))?>" alt="">
                                    <div class="sale">İNDİRİMLİ</div>
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="quick-view"><a href="<?= base_url('urun/'.$product->url)?>">İncele</a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name"><?= get_product_category_title($product->category_id)?></div>
                                    <a href="<?= base_url('urun/'.$product->url)?>">
                                        <h5><?= $product->title ?></h5>
                                    </a>
                                    <div class="product-price">
                                    <?= $product->price?> ₺
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-slider owl-carousel">
                    <?php
                    foreach ($products as $product) {
                        if ($product->category_id == 14) {
                    ?>

                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="<?= base_url("panel/uploads/product_v/1080x426/".get_product_cover_photo($product->id))?>" alt="">
                                    <div class="sale">YENİ</div>
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                       
                                        <li class="quick-view"><a href="<?= base_url("urun/".$product->url)?>">İncele</a></li>
                                        
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name"><?= get_product_category_title($product->category_id)?></div>
                                    <a href="<?= base_url("urun/".$product->url)?>">
                                        <h5><?= $product->title ?></h5>
                                    </a>
                                    <div class="product-price ">
                                        <?= $product->price?> ₺
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>


                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg" data-setbg="<?= base_url("panel/uploads/home_banner_v/857x505/" . get_banner_photo("ERKEK")); ?>">
                    <h2>ERKEK</h2>
                    <a href="<?=base_url("kategori/erkek")?>">Tümünü Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="instagram-photo">
    <h3 class="text-center my-4">ÖNE ÇIKAN ÜRÜNLER</h3>
   <?php foreach($productsHome as $product){?>
    <div class="insta-item set-bg" data-setbg="<?= base_url("panel/uploads/product_v/1080x426/".get_product_cover_photo($product->id))?>">
        <div class="inside-text">
            <i class="far fa-eye"></i>
            <h5><a href="<?=base_url("urun/".$product->url)?>">İncele</a></h5>
        </div>
    </div>
   <?php }?>
    
</div>

<section class="latest-blog spad d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Haberler</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="img/latest-1.jpg" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                Mart 18, 2020
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-eye"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>Başlık</h4>
                        </a>
                        <p>İçerik</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="img/latest-2.jpg" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                Mart 18, 2020
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-eye"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>Başlık</h4>
                        </a>
                        <p>İçerik</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="img/latest-3.jpg" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                Mart 18, 2020
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-eye"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>Başlık</h4>
                        </a>
                        <p>İçerik</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>