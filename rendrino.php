<?php
/**
 * Rendrino
 * @author Jeffrey Wang
 * @license MIT License - See LICENSE.txt for more details.
*/

// Settings
$rendrino_assets = 'rendrino_assets/'; // location of assets folder or prefix. If folder, MUST include trailing slash.

// Import Parsedown
require_once ( 'vendor/parsedown/Parsedown.php' );
require_once ( 'vendor/parsedown/ParsedownExtra.php' );

// Load rendrino_modules.json (if it exists)
if ( file_exists( 'rendrino_modules.json' ) ) {
  $module_config = json_decode( file_get_contents( 'rendrino_modules.json' ), true );
}

// Go to a page
$page = $_REQUEST['p'];
if ( file_exists( $rendrino_assets . $page . '.md' ) ) {
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
		<?php
    for ( $cssloadcount = 0; $cssloadcount < sizeof( $page_config['modules'] ); $cssloadcount++ ) {
      echo "<!--" . $module_config[$page_config['modules'][$cssloadcount]]['css'] . "-->";
      ?><link rel="stylesheet" href="<?php echo $module_config[$page_config['modules'][$cssloadcount]]['css'];?>" <?php echo ( $module_config[$page_config['modules'][$cssloadcount]]['css_integrity'] != null ) ? 'integrity="' . $module_config[$page_config['modules'][$cssloadcount]]['css_integrity'] . '" crossorigin="anonymous"' : ""; ?> /><?php
    }
		echo $page_config['head'];
		?>
	</head>
	<body>
		<?php
		$Parsedown = new ParsedownExtra();
		$Parsedown->setMarkupEscaped(false);
		echo $Parsedown->text( $page_content );
		?>
    <?php
    for ( $jsloadcount = 0; $jsloadcount < sizeof( $page_config['modules'] ); $jsloadcount++ ) {
      echo "<!--" . $module_config[$page_config['modules'][$jsloadcount]]['js'] . "-->";
      ?><script type="application/javascript" src="<?php echo $module_config[$page_config['modules'][$jsloadcount]]['js'];?>" <?php echo ( $module_config[$page_config['modules'][$jsloadcount]]['js_integrity'] != null ) ? 'integrity="' . $module_config[$page_config['modules'][$jsloadcount]]['js_integrity'] . '" crossorigin="anonymous"' : ""; ?>></script><?php
    }
		echo $page_config['body'];
		?>
	</body>
</html>
