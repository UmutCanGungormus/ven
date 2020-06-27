<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a class="text-decoration-none" href="<?= base_url("/") ?>"><i class="fa fa-home"></i> Ven Cosmetic</a>
                    <?php

                    if (!empty($up_category)) {
                    ?>
                        <a class="text-decoration-none" href="<?= base_url("kategori/" . $up_category->seo_url) ?>"><?= $up_category->title ?></a>

                    <?php } ?>

                    <span><?= $search ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <div class="filter-widget">
                    <h4 class="fw-title ">Alt Kategoriler</h4>
                    <ul class="filter-catagories">
                        <?php if (!empty($sub_category)) { ?>
                            <?php foreach ($sub_category as $category) { ?>
                                <li><i class="fas fa-chevron-right"></i><a class="text-decoration-none" href="<?= base_url("kategori/") . $category->seo_url ?>"> <?= $category->title ?></a></li>
                        <?php }
                        } ?>
                    </ul>
                </div>


            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <select class="sorting">
                                    <option value="">Sıralama</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 text-right">
                            <p><?= count($products) ?> adet ürün bulundu</p>
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">

                        <?php
                        foreach ($products as $product) {
                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <img src="<?= base_url("panel/uploads/product_v/1080x426/" . get_product_cover_photo($product->id)) ?>" alt="">
                                        <div class="sale pp-sale">Yeni</div>
                                        <div class="icon">
                                            <i class="fas fa-hearth"></i>
                                        </div>
                                        <ul>
                                            <li class="quick-view w-100"><a href="<?= base_url("urun/" . $product->url) ?>">İncele</a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"><?= get_product_category_title($product->category_id) ?></div>
                                        <a href="product.php">
                                            <h5><a href="<?= base_url("urun/" . $product->url) ?>"><?= $product->title ?></a></h5>
                                        </a>
                                        <div class="product-price">
                                            <?= $product->price ?> ₺
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>



                    </div>
                    <div class="pagination justify-content-center">
                        <?=$this->pagination->create_links(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>