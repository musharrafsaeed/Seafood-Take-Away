<?php
/**
 * Plugin Name: Contact Form 7 Response Colorbox Popup 
 * Plugin URI: dudaster@gmail.com
 * Description: You want the Contact Form 7 response message when you push submit in a popup color box window? This small plugin does just that. You need Lightbox Plus Color Box and Contact Form 7 Plugins installed.
 * Version: 1.0
 * Author: Liviu Duda
 * Author URI: dudaster@gmail.com
 * License: GPL2
 */

// main function
function cbcf7response(){
	$return = <<<EOT
	<script>
	jQuery(".wpcf7-submit").click(function(event) {
	jQuery( document ).ajaxComplete(function() {
	myclass=jQuery(".wpcf7-response-output").hasClass("wpcf7-validation-errors") ? "alert" : "succes";
	//alert (myclass);
	    jQuery.colorbox({
			className: myclass,
			opacity:"0.05",
			width:"350px",
			height:"200px",
			html:jQuery(".wpcf7-response-output").html()
	    });
		jQuery(".wpcf7-response-output").css( "display", "none" );
	 });
	});
	</script>
	<style>
	.alert, .succes {
	font-size: 20px;
	font-weight: bold;
	line-height: 1.3em;
	}
	.alert #cboxLoadedContent, .succes #cboxLoadedContent{
	display: table-cell;
	vertical-align: middle;
	text-align: center;
	}
	.alert{
	color: red;
	}
	.succes{
	color: green;
	}
	</style>
EOT;
echo $return;
}
/* deactivate plugin if Lightbox Plus and Contact Form 7 are not active*/

function showAdminMessages()
{
  return 'To use <i>Colorbox Contact Form Response</i> you need to have both <a href="plugin-install.php?tab=search&s=simple+colorbox">Simple Colorbox</a> or <a href="plugin-install.php?tab=search&s=lightbox+plus+colorbox">Lightbox Plus Colorbox</a>and <a href="plugin-install.php?tab=search&s=contact+form+7">Contact Form 7</a> plugins installed and active for this plugin to work.<br/> Plugin would be inactive! After you make sure you have installed and activated all the required plugins you can reactivate it.';
}
function myplugin_activate() {

	if ( !(is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) && (is_plugin_active( 'lightbox-plus/lightboxplus.php' ) || is_plugin_active( 'simple-colorbox/index.php' )))) {
		die(showAdminMessages());
	} 
}
register_activation_hook(realpath(__FILE__), 'myplugin_activate' );

// else let the plugin do the job
add_action('wp_footer', 'cbcf7response', 100);
?>