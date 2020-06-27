<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                    <a class="text-decoration-none" href="<?= base_url("/") ?>"><i class="fa fa-home"></i> Ven Cosmetic</a>
                        <span>Sepet</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">

                        <table>
                            <thead>
                                <tr>
                                    <th>Fotoğraf</th>
                                    <th class="p-name">Ürün Adı</th>
                                    <th>Fiyat</th>
                                    <th>Mililitre</th>
                                    <th>Adet</th>
                                    <th>Toplam</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                                $toplam = 0;
                                                foreach ($this->cart->contents() as $v) {
                                                    $toplam +=$v["price"]*$v["options"]["ml"]*$v["qty"];
                                                ?>
                                <tr>
                                    <td class="cart-pic first-row"><img src="<?= base_url("panel/uploads/product_v/1080x426/" . get_product_cover_photo($v["id"])) ?>" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5><?= $v["name"]?></h5>
                                    </td>
                                    <td class="p-price first-row"><?= $v["price"]?> ₺</td>
                                    <td class="p-price first-row"><?= $v["options"]["ml"]?> ML</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity ">
                                            <div class="pro-qty update-qty">
                                                <input type="text" data-id="<?= $v["rowid"]?>" value="<?=$v["qty"]?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row"><?= $v["price"]* $v["options"]["ml"]*$v["qty"] ?> ₺</td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
                                </tr>
                                                <?php }?>
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <?php
                                     $kdv=$toplam *18/100;
                                    ?>
                                    <li class="subtotal">Ara Toplam <span><?= $toplam?> ₺</span></li>
                                    <li class="subtotal">KDV <span><?= $kdv?> ₺</span></li>
                                    <li class="cart-total">Toplam <span><?= $toplam+$kdv?> ₺</span></li>
                                </ul>
                                <a  class="proceed-btn text-white text-decoration-none">ÖDEMEYE GİT</a>
                                <a  style="width:100%" class="btn btn-danger text-white checkout-btn mt-1 basket-destroy "  >SEPETİ BOŞALT</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>