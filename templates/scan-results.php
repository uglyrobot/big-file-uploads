<div class="card">
	<div class="card-header">
		<div class="d-flex align-items-center">
			<h5 class="m-0 mr-auto p-0"><?php esc_html_e( 'Storage Usage Analysis', 'tuxedo-big-file-uploads' ); ?></h5>
		</div>
	</div>
	<div class="card-body cloud p-md-5">
		<div class="row align-items-center justify-content-center mb-5">
			<div class="col-lg col-xs-12">
				<p class="lead mb-0"><?php esc_html_e( "Total Bytes / Files", 'tuxedo-big-file-uploads' ); ?></p>
				<span class="h2 text-nowrap"><?php echo size_format( $total_storage, 2 ); ?><small class="text-muted"> / <?php echo number_format_i18n( $total_files ); ?></small></span>

				<div class="container p-0 ml-md-3">
					<?php foreach ( $this->get_filetypes( false ) as $type ) { ?>
						<div class="row mt-2">
							<div class="col-1"><span class="badge badge-pill" style="background-color: <?php echo $type->color; ?>">&nbsp;</span></div>
							<div class="col-4 lead text-nowrap"><?php echo $type->label; ?></div>
							<div class="col-5 text-nowrap"><strong><?php echo size_format( $type->size, 2 ); ?> / <?php echo number_format_i18n( $type->files ); ?></strong></div>
						</div>
					<?php } ?>
					<div class="row mt-2">
						<div class="col text-muted"><small><?php printf( esc_html__( 'Scanned %s ago', 'tuxedo-big-file-uploads' ), human_time_diff( $scan_results['scan_finished'] ) ); ?> &dash; <a href="#" class="badge badge-primary" data-toggle="modal" data-target="#scan-modal"><span
										data-toggle="tooltip"
										title="<?php esc_attr_e( 'Run a new scan to detect recently uploaded files.', 'tuxedo-big-file-uploads' ); ?>"><?php esc_html_e( 'Refresh', 'tuxedo-big-file-uploads' ); ?></span></a></small>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg col-xs-12 mt-5 mt-lg-0 text-center bfu-pie-wrapper">
				<canvas id="bfu-local-pie"></canvas>
			</div>
		</div>
		<?php if ( ! class_exists( 'Infinite_Uploads' ) ) { ?>
			<div class="row justify-content-center mb-3">
				<div class="col text-center">
					<h4><?php esc_html_e( 'Want unlimited storage space?', 'tuxedo-big-file-uploads' ); ?></h4>
					<p class="lead"><?php esc_html_e( 'Move your media files to the Infinite Uploads cloud to save storage space, bandwidth, improve performance, and free you from hosting limits.', 'tuxedo-big-file-uploads' ); ?></p>
				</div>
			</div>
			<div class="row justify-content-center mb-2">
				<div class="col text-center">
					<button class="btn text-nowrap btn-primary btn-lg" data-toggle="modal" data-target="#upgrade-modal"><?php esc_html_e( 'More Info', 'tuxedo-big-file-uploads' ); ?></button>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
