<?php
/**
  * Plugin Name: Google Analytics for WordPress
  * Plugin URI: https://everythingwoocommerce.com/how-to-add-google-analytics-tracking-code-in-wordpress-website/?ref=analytics
  * Author: Aman Verma
  * Author URI: https://twitter.com/amanverma217
  * Description: Google Analytics for WordPress plugin allows you to track your website by entering your google analytics tracking code.
  * Tags: google analytics plugin, analytics for website, universal analytics of website, google analytics, website google analytics plugin wordpress, google analytics for wordpress, GA code, google analytics script, google analytics for woocommerce, googleanalytics
  * Version: 1.4.6
  * License: GPLv2 or later
  * License URI: http://www.gnu.org/licenses/gpl-2.0.html 
 **/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('admin_menu', 'gaw_create_menu');
function gaw_create_menu()
{
   add_menu_page('Google Analytics Settings', 'Google Analytics', 'administrator', 'google-analytics-settings-page', 'fn_gaw_settings_page', 'dashicons-chart-bar');
   add_action( 'admin_init', 'fn_gaw_register_mysettings' );
}


/*****register settings options****/
function fn_gaw_register_mysettings()
{
   register_setting( 'gaw-settings-group', 'gaw_analytics_id' );
   register_setting( 'gaw-settings-group', 'gaw_disable_track' );
}

/*****settings options****/
function fn_gaw_settings_page()
{
   require plugin_dir_path(__FILE__) . 'options.php';
}
$gaw_disable = get_option('gaw_disable_track', 'No');

/*******function to check ga code*******/
function isAnalytics($str){
    return preg_match('/^ua-\d{4,9}-\d{1,4}$/i', strval($str));
}

function fn_gaw_analytics() {
  $web_property_id = get_option('gaw_analytics_id');
?>
   <script type="text/javascript">
   var _gaq = _gaq || [];
   _gaq.push(['_setAccount', '<?php echo $web_property_id ?>']);
   _gaq.push(['_trackPageview']);
   (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
   })();
   </script>
<?php
}


if ( $gaw_disable == 'No' ) {
   add_action('wp_head', 'fn_gaw_analytics');
}

function fn_gaw_action_links( $links ) {
	$links = array_merge( array(
		'<a href="' . esc_url( admin_url( 'admin.php?page=google-analytics-settings-page' ) ) . '">' . __( 'Settings' ) . '</a>'
	), $links );
	return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'fn_gaw_action_links' );