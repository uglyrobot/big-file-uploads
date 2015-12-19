<?php
/**
 * TuxedoBigFileUploads Handle Upload
 *
 * Ajax callback for plupload to handle chunked uploads.
 *
 * @package TuxedoBigFileUploads
 * @since 1.0.0
 * 
 * Based on code by Davit Barbakadze
 * https://gist.github.com/jayarjo/5846636
 */

/** Check that we have an upload and there are no errors. */
if ( empty( $_FILES ) || $_FILES['async-upload']['error'] ) {
	/** Failed to move uploaded file. */
	die();
}

if ( ! function_exists( 'mime_content_type' ) ) {
	/**
	 * Return a file's mime type.
	 * 
	 * @since 1.0.0
	 * 
	 * @param string $filename File name.
	 * @return var string $mimetype Mime type.
	 */
	function mime_content_type( $filename ) {

		$finfo = finfo_open( FILEINFO_MIME );
		$mimetype = finfo_file( $finfo, $filename );
		finfo_close( $finfo );
		return $mimetype;

	}
}

/** Check and get file chunks. */
$chunk = isset( $_REQUEST['chunk']) ? intval( $_REQUEST['chunk'] ) : 0;
$chunks = isset( $_REQUEST['chunks']) ? intval( $_REQUEST['chunks'] ) : 0;

/** Get file name and path + name. */
$fileName = isset( $_REQUEST['name'] ) ? $_REQUEST['name'] : $_FILES['async-upload']['name'];
$filePath = dirname( $_FILES['async-upload']['tmp_name'] ) . '/' . md5( $fileName );

/** Open temp file. */
$out = @fopen( "{$filePath}.part", $chunk == 0 ? 'wb' : 'ab' );
if ( $out ) {

	/** Read binary input stream and append it to temp file. */
	$in = @fopen( $_FILES['async-upload']['tmp_name'], 'rb' );

	if ( $in ) {
		while ( $buff = fread( $in, 4096 ) ) {
			fwrite( $out, $buff );
		}
	} else {
		/** Failed to open input stream. */
		/** Attempt to clean up unfinished output. */
		@fclose( $out );
		@unlink( "{$filePath}.part" );
		die();
	}

	@fclose( $in );
	@fclose( $out );

	@unlink( $_FILES['async-upload']['tmp_name'] );

} else {
	/** Failed to open output stream. */
	die();
}

/** Check if file has finished uploading all parts. */
if ( ! $chunks || $chunk == $chunks - 1 ) {

	/** Recreate upload in $_FILES global and pass off to WordPress. */
	rename( "{$filePath}.part", $_FILES['async-upload']['tmp_name'] );
	$_FILES['async-upload']['name'] = $fileName;
	$_FILES['async-upload']['size'] = filesize( $_FILES['async-upload']['tmp_name'] );
	$_FILES['async-upload']['type'] = mime_content_type( $_FILES['async-upload']['tmp_name'] );
	/** Set $_SERVER'[PHP_SELF'] global to wp-admin upload AJAX to stop a PHP notice from /wp-includes/vars.php line 31. */
	$_SERVER['PHP_SELF'] = '/wp-admin/async-upload.php';
	require_once( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-admin/async-upload.php' );

}