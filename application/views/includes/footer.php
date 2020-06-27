    <section style="overflow-x: hidden;" class="mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="container">

                    <div class="benefit-items">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="single-benefit">
                                    <div class="sb-icon">
                                        <img src="<?= base_url("img/icon-1.png") ?>" alt="">
                                    </div>
                                    <div class="sb-text">
                                        <h6>ÜCRETSİZ KARGO</h6>
                                        <p>100 ₺ Üzeri Siparişlerde</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-benefit">
                                    <div class="sb-icon">
                                        <img src="<?= base_url("img/icon-2.png") ?>" alt="">
                                    </div>
                                    <div class="sb-text">
                                        <h6>GARANTİLİ</h6>
                                        <p>İthal Gerçek Ürünler</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-benefit">
                                    <div class="sb-icon">
                                        <img src="<?= base_url("img/icon-3.png") ?>" alt="">
                                    </div>
                                    <div class="sb-text">
                                        <h6>GÜVENLİ ÖDEME</h6>
                                        <p>100% Güvenli Ödeme</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="index.php">
                                <img src="<?= base_url("panel/uploads/settings_v/ven-logo-beyaz.png") ?>" width="100">
                            </a>
                        </div>
                        <ul>
                            <li>Adres: <?= $settings->address ?></li>
                            <li>Telefon: <?= $settings->phone_1 ?></li>
                            <li>E-Posta:<?= $settings->email ?> </li>
                        </ul>
                        <div class="footer-social">
                            <a href="<?= $settings->facebook?>"><i class="fa fa-facebook"></i></a>
                            <a href="<?= $settings->instagram?>"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-widget">
                        <h5>Sayfalar</h5>
                        <ul>
                            <li><a href="<?= base_url("sayfa/hakkimizda")?>">Hakkımızda</a></li>
                            <li><a href="<?= base_url("sayfa/mesafeli-satis-sozlesmesi")?>">Mesafeli Satış Sözleşmesi</a></li>
                            <li><a href="<?= base_url("sayfa/cerez-kullanimi")?>">Çerez Kullanımı</a></li>
                            <li><a href="<?= base_url("iletisim")?>">İletişim</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-widget">
                        <h5>Üyelik</h5>
                        <ul>
                            <li><a href="<?=  base_url("register")?>">Üyelik</a></li>
                            <li><a href="<?= base_url("profil")?>">Hesabım</a></li>
                            <li><a href="<?= base_url("sepet")?>">Sepet</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            Copyright &copy;<?php echo date('Y'); ?>Her hakkı saklıdır | powered by <a href="https://mutfakyapim.com" target="_blank">Mutfak Yapım</a>
                        </div>
                        <div class="payment-pic">
                            <img src="img/payment-method.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    
    <script src="<?= base_url("assets/js/jquery.dd.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/main.js") ?>"></script>
    <?php $alert = $this->session->userdata("alert"); ?>
    <?php if ($alert) : ?>
        <?php if ($alert["success"]) : ?>
            <script>
                iziToast.success({
                    title: '<?= $alert["title"]; ?>',
                    message: '<?= $alert["msg"]; ?>',
                    position: "topCenter"
                });
            </script>
        <?php else : ?>
            <script>
                iziToast.error({
                    title: '<?= $alert["title"]; ?>',
                    message: '<?= $alert["msg"]; ?>',
                    position: "topCenter"
                });
            </script>
        <?php endif ?>
    <?php endif ?>
    </body>

    </html>