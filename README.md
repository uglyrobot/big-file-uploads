Tuxedo Big File Uploads
=======================
Contributors: andtrev  
Tags: AJAX, file uploader, files, files uploader, ftp, image uploader, plugin, upload  
Requires at least: 3.4  
Tested up to: 4.4.1  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Enables large file uploads in the built-in WordPress media uploader.

Description
-----------

Enables large file uploads in the standard built-in WordPress media uploader. Uploads can be as large as available disk space allows.

No messing with initialization files or settings. No need to FTP.

Simply activate the plugin and use the media uploader as you normally would.

The browser uploader option is not supported, the multi-file uploader must be used to enable large file uploads.

* Small footprint that doesn't bog down WordPress with unnecessary features.
* Shows available disk space for temporary uploads directory as maximum upload file size in media uploader.
* Options for chunk size and max retries are available under the Uploading Files section on the Settings -> Media page.

In essence the plugin changes the Plupload settings for uploads and points the AJAX url to the plugin. This processes the
upload in chunks (separate smaller pieces) before handing it off to the original AJAX url (WordPress).

Installation
------------

1. Upload the plugin files to the `/wp-content/plugins/tuxedo-big-file-uploads` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings -> Media screen to configure the plugin.

Frequently Asked Questions
--------------------------

### How big can uploads be?

Uploads can be as large as available disk space for temporary files allows.

### Why does the maximum file size decrease after an upload?

Maximum file size is listed as the available free disk space for temporary uploads.
Free disk space will decrease as files are uploaded.
Additionally some systems use a separate partition for temporary files, free space may fluctuate as files
are uploaded and moved out of the temporary folder.

Changelog
---------

### 1.0.1
* Added fallback if the file info extension is missing.

### 1.0
* Initial release.
