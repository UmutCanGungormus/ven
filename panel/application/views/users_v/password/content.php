<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <b><?= $item->user_name ?></b> kaydının şifresini düzenliyorsunuz
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <hr class="widget-separator">
                <div class="widget-body">
                    <form action="<?= base_url("users/update_password/$item->id"); ?>" method="post">
                        <div class="form-group">
                            <label>Şifre</label>
                            <input type="password" class="form-control" placeholder="Şifre" name="password">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("password"); ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Şifre Tekrar</label>
                            <input type="password" class="form-control" placeholder="Şifre Tekrar" name="re_password">
                            <?php if (isset($form_error)) : ?>
                                <small class="input-form-error float-right"><?= form_error("re_password"); ?></small>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("users"); ?>" class="btn btn-md btn-danger btn-outlinen">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>