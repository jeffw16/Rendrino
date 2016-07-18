<?php
/**
 * Rendrino
 * @author Jeffrey Wang
 * @license Full copyright
*/

// Settings
$rendrino_assets = 'rendrino_assets/'; // location of assets folder or prefix. If folder, MUST include trailing slash.

// Import Parsedown
require_once ( 'Parsedown.php' );
require_once ( 'ParsedownExtra.php' );

// Go to a page
$page = $_REQUEST['p'];
if ( file_exists( $rendrino_assets . $page . '.json' ) ) {
	$page_content = file_get_contents( $rendrino_assets . $page . '.md' );
} else {
	$page_content = file_get_contents( $rendrino_assets . 'rendrino.md' );
}
if ( file_exists( $rendrino_assets . $page . '.json' ) ) {
	$page_config = json_decode( file_get_contents( $rendrino_assets . $page . '.json' ), true );
} else {
	$page_config = json_decode( file_get_contents( $rendrino_assets . 'rendrino.json' ), true );
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="<?php echo $page_config['description']; ?>">
		<meta name="author" content="<?php echo $page_config['author'] ?>">
		<link rel="icon" href="favicon.ico">

		<title><?php echo $page_config['title']; ?></title>
		<?php if ( in_array( 'bootstrap', $page_config['modules'] ) ) { ?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php }
		echo $page_config['head'];
		?>
	</head>
	<body>
		<?php
		$Parsedown = new ParsedownExtra();
		$Parsedown->setMarkupEscaped(false);
		echo $Parsedown->text( $page_content );
		?>
		<?php if ( in_array( 'jquery', $page_config['modules'] ) || in_array( 'bootstrap', $page_config['modules'] ) ) { ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
		<?php }
		if ( in_array( 'bootstrap', $page_config['modules'] ) ) { ?>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<?php }
		echo $page_config['body'];
		?>
	</body>
</html>