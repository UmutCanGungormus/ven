 <!-- Breadcrumb Section Begin -->
 <div class="breacrumb-section">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="breadcrumb-text">
                     <a href="#"><i class="fa fa-home"></i> Ven Cosmetic</a>
                     <span>Giriş</span>
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
                 <div class="login-form">
                     <h2>Giriş Yap</h2>
                     <form action="<?= base_url("giris/giris") ?>" method="POST" class="form-control">
                         <div class="group-input">
                             <label for="username">E-Posta Adresi:</label>
                             <input type="email" name="email" class="form-control">
                         </div>
                         <div class="group-input position-relative">
                             <label for="pass">Şifre: *</label>
                             <input type="password" name="password" class="form-control userPass positon-relative">
                             <a style="padding:10px">   <i class="fas fa-eye showPass mt-1 position-absolute" style="right:20px;top:50px;"></i></a>
                               <a style="padding:10px">  <i class="fas fa-eye-slash hidePass mt-1 position-absolute" style="display:none;right:20px;top:50px;"></i></a>
                                 
                         </div>
                         <div class="group-input gi-check">
                             <div class="gi-more">
                                 <label for="save-pass">
                                     Oturumu Kaydet
                                     <input type="checkbox" id="save-pass">
                                     <span class="checkmark"></span>
                                 </label>
                                 <a href="#" class="forget-pass">Şifremi Unuttum</a>
                             </div>
                         </div>
                         <button type="submit" class="site-btn login-btn">Giriş Yap</button>
                     </form>
                     <div class="switch-login">
                         <a href="<?= base_url("kayit-ol") ?>" class="or-login">Yeni Üyelik</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Register Form Section End -->