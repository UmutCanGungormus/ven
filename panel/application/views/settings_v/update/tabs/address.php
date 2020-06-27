<div role="tabpanel" class="tab-pane fade p-4" id="tab-6">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Adres Bilgisi</label>
			<textarea name="address" class="m-0 tinymce" data-options="{height: 250}">
				<?= isset($form_error) ? set_value("address") : $item->address; ?>
			</textarea>
		</div>
	</div>
	<div class="row">
        <div class="form-group col-md-4">
            <label>Harita Lat</label>
            <input class="form-control" placeholder="Harita Lat" name="lat" value="<?= isset($form_error) ? set_value("lat") : "$item->lat"; ?>">
        </div>
        <div class="form-group col-md-4">
            <label>Harita Long</label>
            <input class="form-control" placeholder="Harita Long" name="long" value="<?= isset($form_error) ? set_value("long") : "$item->long"; ?>">
        </div>
    </div>
</div>