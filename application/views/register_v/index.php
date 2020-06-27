  <!-- Breadcrumb Section Begin -->
  <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Ven Cosmetic</a>
                        <span>Yeni Üyelik</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Kayıt Ol</h2>
                        <form action="<?= base_url("kayit-ol/kayit")?>" method="post" class="form-control">
                            <div class="group-input">
                                <label for="full_name">Ad Soyad:</label>
                                <input type="text" name="full_name" class="form-control" id="full_name">
                                <?php if (isset($form_error)) : ?><small class="input-form-error float-right"><?= form_error("full_name"); ?></small> <?php endif; ?>

                            </div>
                            <div class="group-input">
                                <label for="username">E-Posta Adresi:</label>
                                <input type="email" name="email" class="form-control" id="username">
                                <?php if (isset($form_error)) : ?><small class="input-form-error float-right"><?= form_error("email"); ?></small> <?php endif; ?>

                            </div>
                            <div class="group-input position-relative">
                                <label for="pass">Şifre: *</label>
                                <input type="password" name="password" class="userPass position-relative" class="form-control">
                                <a style="padding:10px">   <i class="fas fa-eye showPass mt-1 position-absolute" style="right:20px;top:50px;"></i></a>
                               <a style="padding:10px">  <i class="fas fa-eye-slash hidePass mt-1 position-absolute" style="display:none;right:20px;top:50px;"></i></a>
                                 <?php if (isset($form_error)) : ?><small class="input-form-error float-right"><?= form_error("password"); ?></small> <?php endif; ?>

                            </div>
                            <div class="group-input">
                                <label for="pass">Şifre Tekrar: *</label>
                                <input type="password" name="re_password" class="form-control">
                                <?php if (isset($form_error)) : ?><small class="input-form-error float-right"><?= form_error("re_password"); ?></small> <?php endif; ?>

                            </div>
                          
                            <button type="submit" class="site-btn register-btn">Kayıt Ol</button>
                        </form>
                        <div class="switch-login">
                            <a href="<?=base_url("giris")?>" class="or-login">Giriş Yap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    