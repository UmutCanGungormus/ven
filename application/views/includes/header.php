    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        <?= $settings->email ?>
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        <?= $settings->phone_1 ?>
                    </div>
                </div>
                <div class="ht-right">
                    <?php
                    if (!empty($this->session->userdata("user"))) { ?>
                        <a href="<?= base_url("cikis") ?>" class="login-panel"><i class="fas fa-sign-out-alt"></i>Güvenli Çıkış</a>
                        <a href="<?= base_url("profil") ?>" class="login-panel pr-3"><i class="fas fa-user"></i> <?= $this->session->userdata("user")->full_name ?></a>
                    <?php } else { ?>
                        <a href="<?= base_url("giris") ?>" class="login-panel"><i class="fa fa-user"></i>Giriş</a>
                        <a href="<?= base_url("kayit-ol") ?>" class="login-panel mr-4"><i class="fa fa-user"></i>Yeni Üyelik</a>
                    <?php } ?>
                    <div class="top-social">
                        <a href="<?= $settings->facebook ?>"><i class="ti-facebook"></i></a>
                        <a href="<?= $settings->twitter ?>"><i class="ti-twitter-alt"></i></a>
                        <a href="<?= $settings->linkedin ?>"><i class="ti-linkedin"></i></a>
                        <a href="<?= $settings->instagram ?>"><i class="ti-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="<?= base_url("/") ?>">
                                <img src="<?= base_url("panel/uploads/settings_v/165x57/" . $settings->logo) ?>" width="100">
                            </a>
                        </div>
                    </div>



                    <div class="col-lg-7 col-md-7">
                        <form id="search-form" action="<?= base_url("ara")?>" method="post">
                            <div class="advanced-search">
                                <select name="category" class="category-btn">
                                    <option value="">KATEGORİ</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?= $category->seo_url ?>"><?= $category->title ?></option>
                                    <?php } ?>
                                </select>
                                <div class="input-group">
                                    
                                    <input type="text" name="search" placeholder="Parfüm Adı">
                                    <button class="searching" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">

                            <li class="cart-icon">
                                <a href="#">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span><?= $this->cart->total_items(); ?></span>
                                </a>

                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                        
                                                <?php
                                                $toplam = 0;
                                                foreach ($this->cart->contents() as $v) {
                                                    $toplam +=$v["price"]*$v["options"]["ml"]*$v["qty"];
                                                ?>
                                                    <tr>
                                                        <td class="si-pic"><img src="<?= base_url("panel/uploads/product_v/1080x426/" . get_product_cover_photo($v["id"])) ?>" alt="" width="65"></td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p><?= $v["price"]*$v["options"]["ml"]  ?> ₺ x <?= $v["qty"] ?></p>
                                                                <p> <?= $v["options"]["ml"] ?> ML</p>
                                                                <h6><?= $v["name"] ?></h6>

                                                            </div>
                                                        </td>
                                                        <td class="si-close">
                                                            <i data-id="<?= $v["rowid"]?>" class="fas fa-times"></i>
                                                        </td>
                                                    </tr>
                                                <?php
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total sub">
                                        <span>Ara Toplam:</span>
                                        <h5><?= $toplam; ?> ₺</h5>

                                    </div>
                                    <div class="select-total sub">
                                                <?php
                                                $kdv=$toplam *18/100;
                                                ?>
                                        <span>KDV</span>
                                        <h5><?= $kdv?> ₺</h5>
                                    </div>

                                    <div class="select-total">
                                        <span>Toplam:</span>
                                        <h5><?= $toplam+$kdv?> ₺</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="<?= base_url("sepet")?>" class="btn primary-btn checkout-btn">SEPETE GİT</a>
                                        <a  class="btn btn-dark text-white checkout-btn mt-1 basket-destroy"  >SEPETİ BOŞALT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price"><?= $toplam+$kdv?> ₺</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="fas fa-bars"></i>
                        <span>Kategoriler</span>
                        <ul class="depart-hover">
                            <?php
                            foreach ($categories as $category) :
                            ?>
                                <li class="<?= ($this->uri->segment(2) == $category->seo_url) ? "active" : "" ?>"><a href="<?= base_url("kategori/" . $category->seo_url) ?>"><?= $category->title ?></a></li>
                            <?php
                            endforeach
                            ?>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="<?= base_url("/") ?>">ANASAYFA</a></li>
                        <?php
                        foreach ($categories as $category) :
                        ?>
                            <li><a href="<?= base_url("kategori/" . $category->seo_url) ?>"><?= $category->title ?></a></li>
                        <?php
                        endforeach
                        ?>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->