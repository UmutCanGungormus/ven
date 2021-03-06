<div role="tabpanel" class="tab-pane fade show active p-4"  id="tab-1">
    <div class="row">
        <div class="form-group col-md-8">
            <label>Şirket Adı</label>
            <input class="form-control" placeholder="Şirketin ya da Sitenizin adı" name="company_name" value="<?= isset($form_error) ? set_value("company_name") : $item->company_name; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                class="float-right input-form-error"> <?= form_error("company_name"); ?></small>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Telefon 1</label>
            <input class="form-control" placeholder="Telefon numaranız" name="phone_1" value="<?= isset($form_error) ? set_value("phone_1") : $item->phone_1; ?>">
            <?php if (isset($form_error)) { ?>
                <small
                class="float-right input-form-error"> <?= form_error("phone_1"); ?></small>
            <?php } ?>
        </div>
        <div class="form-group col-md-4">
            <label>Telefon 2</label>
            <input class="form-control" placeholder="Diğer telefon numaranız (opsiyonel)" name="phone_2" value="<?= isset($form_error) ? set_value("phone_2") : $item->phone_2; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Fax 1</label>
            <input class="form-control" placeholder="Fax numaranız" name="fax_1" value="<?= isset($form_error) ? set_value("fax_1") : $item->fax_1; ?>">
        </div>
        <div class="form-group col-md-4">
            <label>Fax 2</label>
            <input class="form-control" placeholder="Diğer fax numaranız (opsiyonel)" name="fax_2" value="<?= isset($form_error) ? set_value("fax_2") : $item->fax_2; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Site Dili</label>
            <select class="form-control" name="language">
                <?php if($item->language == "TR") { ?>
                <option selected="selected" value="TR">TR (Türkçe/Turkish)</option>
                <option value="EN">EN (İngilizce/English)</option>
                <option value="DE">DE (Almanca/German)</option>
                <?php }else if($item->language == "EN") { ?>
                <option value="TR">TR (Türkçe/Turkish)</option>
                <option selected="selected" value="EN">EN (İngilizce/English)</option>
                <option value="DE">DE (Almanca/German)</option>
                <?php }else{ ?>
                <option value="TR">TR (Türkçe/Turkish)</option>
                <option value="EN">EN (İngilizce/English)</option>
                <option selected="selected" value="DE">DE (Almanca/German)</option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>