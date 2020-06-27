<div role="tabpanel" class="tab-pane fade p-4" id="tab-3">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Misyonumuz</label>
			<textarea name="mission" class="m-0 tinymce" data-options="{height: 250}">
				<?= isset($form_error) ? set_value("mission") : $item->mission; ?>
			</textarea>
		</div>
	</div>
</div>