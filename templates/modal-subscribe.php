<div class="modal fade" id="subscribe-modal" tabindex="-1" role="dialog" aria-labelledby="subscribe-modal-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row justify-content-center mb-4 mt-3">
						<div class="col text-center">
							<h4><?php esc_html_e( 'Get Media Management Tips & Tricks', 'tuxedo-big-file-uploads' ); ?></h4>
							<p class="lead"><?php esc_html_e( "Subscribe to receive the ultimate guide to optimizing your WP media storage and delivery by Infinite Uploads.", 'tuxedo-big-file-uploads' ); ?></p>
						</div>
					</div>
					<div class="row justify-content-center mb-2">
						<div class="col-xl-6 col-lg-7 col-md-8 text-center">
							<form action="https://infiniteuploads.us10.list-manage.com/subscribe/post?u=c50f189b795383e791f477637&amp;id=4f5e536a46" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

								<div style="position: absolute; left: -5000px;" aria-hidden="true">
									<input type="text" name="b_c50f189b795383e791f477637_4f5e536a46" tabindex="-1" value="">
								</div>

								<div class="mc-field-group">
									<div class="form-group">
										<label for="mce-EMAIL" class="sr-only"><?php esc_html_e( 'Email Address', 'tuxedo-big-file-uploads' ); ?></label>
										<div class="input-group bfu-input-subscribe">
											<input type="email" value="<?php echo esc_attr( wp_get_current_user()->user_email ); ?>" name="EMAIL" class="required email form-control" id="mce-EMAIL" placeholder="<?php esc_attr_e( 'Email Address', 'tuxedo-big-file-uploads' ); ?>">
											<span class="input-group-btn">
			                                    <button class="btn btn-info" type="submit"><?php esc_html_e( 'Subscribe', 'tuxedo-big-file-uploads' ); ?></button>
			                                </span>
										</div>
										<div class="row text-center">
											<div class="col text-muted">
												<small><?php esc_html_e( 'Optional - no spam, unsubscribe at any time!', 'tuxedo-big-file-uploads' ); ?></small>
											</div>
										</div>
									</div>
								</div>
							</form>
							<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
							<script type='text/javascript'>(function ($) {
									window.fnames = new Array();
									window.ftypes = new Array();
									fnames[0] = 'EMAIL';
									ftypes[0] = 'email';
								}(jQuery));
								var $mcj = jQuery.noConflict(true);</script>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<div id="mce-responses">
								<div id="mce-error-response" class="response alert alert-warning alert-dismissible fade show" role="alert" style="display:none"></div>
								<div id="mce-success-response" class="response alert alert-success alert-dismissible fade show" role="alert" style="display:none"></div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center mt-2 mb-4">
						<div class="col-md-6 col-md-5 col-xl-4 text-center">
							<button id="bfu-view-results" class="btn text-nowrap btn-primary btn-lg"><?php esc_html_e( 'View Scan Results', 'tuxedo-big-file-uploads' ); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
