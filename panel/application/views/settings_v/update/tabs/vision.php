<div role="tabpanel" class="tab-pane fade p-4" id="tab-4">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Vizyonumuz</label>
			<textarea name="vision" class="m-0 tinymce" data-options="{height: 250}">
				<?= isset($form_error) ? set_value("vision") : $item->vision; ?>
			</textarea>
		</div>
	</div>
</div>