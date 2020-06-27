<?php
$permissions = json_decode($item->permissions);

?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">
                <?= "<b>$item->title</b> kaydının yetkilerini değiştiriyorsunuz"; ?>
            </h4>
        </div><!-- END column -->
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-body">
                    <form action="<?= base_url("user_role/update_permissions/$item->id"); ?>" method="post">

                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <th>Modül Adı</th>
                                <th>Görüntüleme</th>
                                <th>Ekleme</th>
                                <th>Düzenleme</th>
                                <th>Silme</th>
                            </thead>
                            <tbody>
                                <?php foreach (getControllerList() as $controllerName) : ?>
                                    <tr>
                                        <?php $name = get_controller_name($controllerName); ?>

                                        <td><?= ($name == "") ? $controllerName : $name; ?></td>
                                        <td class="w50 text-center">
                                            <input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->read)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][read]" type="checkbox" data-switchery data-color="#10c469" />
                                        </td>
                                        <td class="w50 text-center">
                                            <input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->write)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][write]" type="checkbox" data-switchery data-color="#10c469" />
                                        </td>
                                        <td class="w50 text-center">
                                            <input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->update)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][update]" type="checkbox" data-switchery data-color="#10c469" />
                                        </td>
                                        <td class="w50 text-center">
                                            <input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->delete)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][delete]" type="checkbox" data-switchery data-color="#10c469" />
                                        </td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                        <hr>

                        <button type="submit" class="btn btn-primary btn-md btn-outline">Güncelle</button>
                        <a href="<?= base_url("users"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                    </form>
                </div><!-- .widget-body -->
            </div><!-- .widget -->
        </div><!-- END column -->
    </div>
</div>