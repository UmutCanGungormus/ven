<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a class="text-decoration-none" href="<?= base_url("/") ?>"><i class="fa fa-home"></i> Ven Cosmetic</a>
                    <span><?= $page_name ?></span>
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
                    <h4 class="fw-title ">Hesabım</h4>
                    <ul class="nav flex-column filter-catagories" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <li><i class="fas fa-chevron-right"></i><a class="text-decoration-none active" id="v-pills-account-tab" data-toggle="pill" href="#account-tab" role="tab" aria-controls="v-pills-account" aria-selected="true">Hesabım</a></li>
                        <!--<li><i class="fas fa-chevron-right"></i><a class="text-decoration-none" id="v-pills-order-tracking-tab" data-toggle="pill" href="#order-tracking-tab" role="tab" aria-controls="v-pills-order-tracking" aria-selected="false">Sipariş Takibi</a></li>-->
                        <li><i class="fas fa-chevron-right"></i><a class="text-decoration-none" id="v-pills-delivery-addresses-tab" data-toggle="pill" href="#delivery-addresses-tab" role="tab" aria-controls="v-pills-delivery-addresses" aria-selected="false">Teslimat Adresleri</a></li>
                        <li><i class="fas fa-chevron-right"></i><a class="text-decoration-none" id="v-pills-order-history-tab" data-toggle="pill" href="#order-history-tab" role="tab" aria-controls="v-pills-order-history" aria-selected="false">Sipariş Geçmişi</a></li>
                        <li><i class="fas fa-chevron-right"></i><a class="text-decoration-none" href="<?= base_url("cikis") ?>">Çıkış Yap</a>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <section class="checkout-section p-0">
                    <div class="container">
                        <h4 class="mb-3">Hesap Detayları</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active p-3 border" id="account-tab" role="tabpanel" aria-labelledby="account-tab">
                                        <form action="<?= base_url("profil/guncelle") ?>" class="checkout-form" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <label for="fir">Adınız ve Soyadınız<span>*</span></label>
                                                    <input type="text" id="fir" name="full_name" value="<?= $active_user->full_name ?>">
                                                </div>
                                                <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <label for="cun-name">Emailiniz</label>
                                                    <input type="email" id="cun-name" name="email" value="<?= $active_user->email ?>">
                                                </div>
                                                <input type="hidden" value="<?= $active_user->id ?>" name="id">
                                                <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <label for="cun-phone">Telefon Numaranız</label>
                                                    <input type="tel" id="cun-phone" maxlength="19" placeholder="+90 (232) 232 32 32" minlength="11" name="phone" value="<?= $active_user->phone ?>">
                                                </div>
                                                <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6 position-relative">
                                                    <label for="cun">Şifreniz (Güncellemek için doldurun)<span>*</span></label>
                                                    <input type="password" class="userPass position-relative" id="cun" name="password" minlength="6" maxlength="8" placeholder="******">
                                                    <a style="padding:10px"> <i class="fas fa-eye showPass mt-1 position-absolute" style="right:20px;top:50px;"></i></a>
                                                    <a style="padding:10px"> <i class="fas fa-eye-slash hidePass mt-1 position-absolute" style="display:none;right:20px;top:50px;"></i></a>
                                                </div>
                                                <div class="col-6 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                    <label for="cun-pw">Tekrar Şifreniz (Güncellemek için doldurun)<span>*</span></label>
                                                    <input type="password" id="cun-pw" name="re_password" minlength="6" maxlength="8" placeholder="******">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-success">Hesap Bilgilerimi Güncelle</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--
                                    <div class="tab-pane fade" id="order-tracking-tab" role="tabpanel" aria-labelledby="order-tracking-tab">
                                            
                                    </div>
                                    -->
                                    <div class="tab-pane fade p-3 border" id="delivery-addresses-tab" role="tabpanel" aria-labelledby="delivery-addresses-tab">
                                        <h3 style="border-bottom: 1px dashed #eeeeee" class="p-3 mb-3">Teslimat Adresleri <a href="<?= base_url("user/address_new_form") ?>" class="float-right text-dark"><i class="fa fa-edit"></i>Adres Ekle</a></h3>
                                        <address class="p-3">
                                            <p class="mb-3">
                                                <strong class="font-weight-bolder text-dark">
                                                    Umut Can Güngörmüş
                                                </strong>
                                            </p>
                                            <p class="mb-3"></p>
                                            <p class="mb-3">Telefon: 0531 695 26 23</p>
                                            <button class="btn btn-dark text-white rounded-pill p-3 editAddress"><i class="fa fa-edit"></i> ADRESİ DÜZENLE</button>
                                            <button class="btn btn-dark text-white rounded-pill p-3 deleteAddress"><i class="fa fa-trash"></i> ADRESİ SİL</button>
                                        </address>
                                    </div>
                                    <div class="iziModal">
                                        <form onsubmit="return false;" method="post" enctype="multipart/form-data">
                                            <div class="form-group row mb-3">
                                                <div class="col-3 align-items-center">
                                                    <label for="address_title">Adres Başlığı :</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" name="title" id="address_title" placeholder="Adres Başlığı" class="form-control rounded-0">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-3 align-items-center">
                                                    <label for="addresss_city">İl :</label>
                                                </div>
                                                <div class="col-9">
                                                    <select name="city" id="address_city" onchange="changeCity($(this),'.nsdistrict','.nsneighborhood','.nsquarter')" class="city nscity form-control rounded-0">
                                                        <option value="">Lütfen İl Seçiniz.</option>
                                                        <?php if(!empty($cities)):?>
                                                            <?php foreach($cities as $city_key => $city_value):?>
                                                                <option value="<?=$city_value->city_id?>"><?=$city_value->city?></option>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-3 align-items-center">
                                                    <label for="address_district">İlçe :</label>
                                                </div>
                                                <div class="col-9">
                                                    <select name="district" id="address_district" onchange="changeDistrict($(this),'.nsneighborhood','.nsquarter')" class="district nsdistrict form-control rounded-0">
                                                        <option value="">Lütfen Önce İl Seçiniz.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-3 align-items-center">
                                                    <label for="address_neighborhood">Semt :</label>
                                                </div>
                                                <div class="col-9">
                                                    <select name="neighborhood" id="address_neighborhood" onchange="changeNeighborhood($(this),'.nsquarter')" class="neighborhood nsneighborhood form-control rounded-0">
                                                        <option value="">Lütfen Önce İlçe Seçiniz.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-3 align-items-center">
                                                    <label for="address_quarter">Mahalle :</label>
                                                </div>
                                                <div class="col-9">
                                                    <select name="quarter" id="address_quarter" class="quarter nsquarter form-control rounded-0">
                                                        <option value="">Lütfen Önce Semt Seçiniz.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-3 align-items-center">
                                                    <label for="address_address">Sokak Bilgisi :</label>
                                                </div>
                                                <div class="col-9">
                                                    <textarea name="address" id="address_address" placeholder="Sokak Bilgisi" class="form-control rounded-0"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <button role="button" class="btn btn-dark float-right rounded-0">Adres Bilgisini Kaydet</button>
                                            </div>
                                        </form>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            createModal(".iziModal", "ADRES EKLE", "ADRES EKLE");
                                            $(document).on("click", ".editAddress", function() {
                                                openModal('.iziModal');
                                            });
                                            $(document).on("click", ".deleteAddress", function() {
                                                openModal('.iziModal');
                                            });
                                        });
                                    </script>
                                    <div class="tab-pane fade p-3 border" id="order-history-tab" role="tabpanel" aria-labelledby="order-history-tab">
                                        <table id="examplem" class="table table-striped table-bordered " style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sipariş Detayı</th>
                                                    <th>Ürün Sayısı</th>
                                                    <th>Kupon Kodu</th>
                                                    <th>İndirim Oranı</th>
                                                    <th>EMEL</th>
                                                    <th>Sipariş Toplamı</th>
                                                    <th>Sipariş Durumu</th>
                                                    <th>Ödeme Durumu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                    <td>$320,800</td>
                                                    <td>$320,800</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>