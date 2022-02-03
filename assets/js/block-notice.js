const { __ } = wp.i18n;

function BFUGettextFilter( translation, text, domain ) {
  if ( text === 'This file exceeds the maximum upload size for this site.' ) {
    return translation + ' ' + __('To upload larger files use the upload tab via the Media Library link.', 'tuxedo-big-file-uploads');
  }
  return translation;
}

wp.hooks.addFilter(
  'i18n.gettext',
  'infinite-uploads/bfu/upload-notice',
  BFUGettextFilter
);
