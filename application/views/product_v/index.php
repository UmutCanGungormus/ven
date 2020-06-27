  <!-- Breadcrumb Section Begin -->
  <div class="breacrumb-section">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="breadcrumb-text">
                      <a href="#"><i class="fa fa-home"></i> Ven Cosmetic</a>
                      <span>Ürün Detay</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Section Begin -->
  <?php $optionObj = new stdClass(); ?>
  <?php $i = 0;?>

  <?php foreach ($option as $key => $value) : ?>
    
      <?php foreach ($value as $key_2 => $value_2) : ?>

          <?php $value_2 = explode(",", trim(str_replace("\"", "", $value_2), "[]")) ?>
          <?php $optionObj->$key_2[$i] = $value_2 ?>
       

      <?php endforeach ; $i+=1; ?>
  <?php endforeach ?>


  <!-- Product Shop Section Begin -->
  <section class="product-shop spad page-details">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="row">
                      <div class="col-lg-6">
                          <div>
                              <img class="product-big-img w-100 img-fluid" src="<?= base_url("panel/uploads/product_v/1080x426/" . get_product_cover_photo($item->id)) ?>" alt="" style="height:500px;max-height:500px">
                             
                          </div>
                          <div class="product-thumbs">
                              <div class="product-thumbs-track ps-slider owl-carousel">
                                  <?php foreach ($photos as $key => $photo) { ?>
                                      <div class="pt <?= ($key == 0) ? "active" : "" ?>" data-imgbigurl="<?= base_url("panel/uploads/product_v/1080x426/" . $photo->img_url) ?>">
                                          <img src="<?= base_url("panel/uploads/product_v/1080x426/" . $photo->img_url) ?>" alt="" style="width: 100%!important;height:100px">
                                      </div>
                                  <?php } ?>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="product-details">
                                      <div class="pd-title">
                                          <!-- <span>oranges</span> -->
                                          <h4 class="unit-title"><?= $item->title ?></h4>
                                          <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                      </div>
                                      <div class="pd-desc">
                                          <h4 class="product-price unit-price" data-price="<?= $item->price ?>"><?= $item->price ?> ₺ </h4>
                                      </div>
                                      <div class="pd-size-choose">
                                          <div class="sc-item">
                                              <input type="radio" data-id="<?= $item->id ?>" value="1">
                                              <img src="<?= base_url("img/1ml.jpg") ?>" alt="" checked="checked" width="40">
                                              <label class="sm-size active">1 ML</label>
                                          </div>
                                          <div class="sc-item">
                                              <input type="radio" value="2">
                                              <img src="<?= base_url("img/2ml.jpg") ?>" alt="" width="40">
                                              <label class="sm-size">2 ML</label>
                                          </div>
                                          <div class="sc-item">
                                              <input type="radio" value="3">
                                              <img src="<?= base_url("img/3ml.jpg") ?>" alt="" width="40">
                                              <label class="sm-size">3 ML</label>
                                          </div>
                                          <div class="sc-item">
                                              <input type="radio" value="5">
                                              <img src="<?= base_url("img/5ml.jpg") ?>" alt="" width="40">
                                              <label class="sm-size">5 ML</label>
                                          </div>
                                      </div>
                                      <div class="quantity">
                                          <div class="pro-qty">
                                              <input type="text" value="1">
                                          </div>
                                          <a href="#" class="primary-btn pd-cart">Sepete Ekle</a>
                                      </div>
                                      <ul class="pd-tags">
                                          <li><span>Kategori</span>: <?= get_product_category_title($item->category_id) ?></li>
                                      </ul>
                                    <p style="font-weight:900; text-align:center"><?=strto("lower|ucwords",$item->title)?> Notaları</p>
                                      <ul class="notes ">
                                         
                                   
                                        <?php
                                        if(!empty($optionObj->img_url)){
                                        foreach(array_filter($optionObj->img_url) as $key=> $v){
                                            $i=0;
                                            foreach($v as $key=>$val){
                                            ?>
                                        
                                        <li class="border p-3 w-auto m-2" >
                                            
                                            
                                           <b><?=strto("lower|ucfirst",$optionObj->stock[$key][$i])?></b>
                                           
                                        <img  style="height:60px;width:60px;" src="<?= base_url("panel/uploads/product_option_v/348x215/".$val)?>" alt="" >
                                        </li>
                                     
                                     <?php  
                                     $i++;
                                    }
                                    } }else{
                                       echo " Ürün Notaları En Kısa Sürede Yükelnecektir.";
                                    }
                                        ?>
                                      
                                      </ul>
                                      <div class="pd-share mt-5">
                                          <div class="pd-social">
                                              <a href="#"><i class="ti-facebook"></i></a>
                                              <a href="#"><i class="ti-twitter-alt"></i></a>
                                              <a href="#"><i class="ti-linkedin"></i></a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Product Shop Section End -->

  <!-- Related Products Section End -->
  <div class="related-products spad">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="section-title">
                      <h2>Benzer Ürünler</h2>
                  </div>
              </div>
          </div>
          <div class="row">
              <?php foreach ($similar as $item) { ?>
                  <div class="col-lg-3 col-sm-6">
                      <div class="product-item">
                          <div class="pi-pic">
                              <img src="<?= base_url("panel/uploads/product_v/1080x426/" . get_product_cover_photo($item->id)) ?>" alt="">
                              <div class="icon">
                                  <i class="far fa-heart"></i>
                              </div>
                              <ul>
                                  <li class="w-icon active"><a href="#"><i class="fas fa-shopping-bag"></i></a></li>
                                  <li class="quick-view"><a href="<?= base_url("urun/" . $item->url) ?>">İncele</a></li>
                                  <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                              </ul>
                          </div>
                          <div class="pi-text">
                              <div class="catagory-name"><?= get_product_category_title($item->category_id) ?></div>
                              <a href="#">
                                  <h5><?= $item->title ?></h5>
                              </a>
                              <div class="product-price">
                                  34 ₺
                              </div>
                          </div>
                      </div>
                  </div>
              <?php } ?>
          </div>
      </div>
  </div>
  <!-- Related Products Section End -->