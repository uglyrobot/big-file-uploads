<div class="card">
	<div class="card-header h5">
		<div class="d-flex align-items-center">
			<h5 class="m-0 mr-auto p-0"><?php esc_html_e( 'Settings', 'tuxedo-big-file-uploads' ); ?></h5>
		</div>
	</div>
	<div class="card-body p-md-5">
		<div class="row mb-2">
			<div class="col">
				<h5><?php esc_html_e( 'File Type Manager', 'tuxedo-big-file-uploads' ); ?></h5>
				<p class="lead"><?php esc_html_e( 'Allow or prevent specific file formats from being uploaded by users.', 'tuxedo-big-file-uploads' ); ?></p>
			</div>
			<div class="col text-right mt-4">
				<span class="badge badge-pill badge-core"><?php esc_html_e( 'WordPress Core', 'tuxedo-big-file-uploads' ); ?></span>
				<span class="badge badge-pill badge-addon"><?php esc_html_e( 'Add-on', 'tuxedo-big-file-uploads' ); ?></span>
			</div>
		</div>
		<div class="row mb-1">
			<div class="card-columns">
				<?php foreach ( $this->get_filetypes_list() as $type => $extensions ) { ?>
					<div class="card">
						<div class="card-header collapsed" data-toggle="collapse" data-target="#collapse-<?php echo sanitize_html_class( $type ); ?>" aria-expanded="false" aria-controls="collapse-<?php echo sanitize_html_class( $type ); ?>" id="heading-<?php echo sanitize_html_class( $type ); ?>">
							<strong class="card-title"><?php echo esc_html( ucfirst( $type ) ); //TODO i18n ?></strong>
						</div>

						<div id="collapse-<?php echo sanitize_html_class( $type ); ?>" class="collapse" aria-labelledby="heading-<?php echo sanitize_html_class( $type ); ?>">
							<div class="card-body">
								<?php foreach ( $extensions as $extension => $file ) { ?>
									<div class="custom-control custom-switch">
										<input type="checkbox" name="allowed_filetypes" class="custom-control-input <?php echo $file['custom'] ? 'custom-filetype' : ''; ?>" id="customSwitch_<?php echo sanitize_html_class( $extension ); ?>" value="<?php echo esc_attr( $extension ); ?>" checked>
										<label class="custom-control-label <?php echo $file['custom'] ? 'custom-filetype' : ''; ?>" for="customSwitch_<?php echo sanitize_html_class( $extension ); ?>"><?php echo esc_html( $file['label'] ); ?></label>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-6 col-sm-12">
				<p class="lead"><?php esc_html_e( 'Note: All WordPress supported file types are listed. Not all webhosts are configured to allow these filetypes to be uploaded. Check with your host if you are having an issue uploading a file.', 'tuxedo-big-file-uploads' ); ?></p>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="row justify-content-end">
					<div class="col-xl-5 col-lg-6 col-md-7 text-center">
						<button class="btn text-nowrap btn-info btn-lg btn-block"><?php esc_html_e( 'Save', 'tuxedo-big-file-uploads' ); ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
