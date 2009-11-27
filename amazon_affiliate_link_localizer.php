<?php
/*
Plugin Name: Amazon Affiliate Link Localizer
Plugin URI: http://petewilliams.info/blog/2009/09/amazon-affiliate-link-localizer-wordpress-plugin
Description: This plugin not only automatically changes any Amazon link on your site to use your affiliate ID, but it also changes the link to point to the user's local Amazon store. Visit <a href="options-general.php?page=amazon_affiliate_link_localiser">the settings page</a> to enter your Amazon Associate IDs.
Version: 1.3
Author: Pete Williams
Author URI: http://petewilliams.info
*/
/*  Copyright 2009  Pete Williams  (email : plugins@petewilliams.info)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_option( 'amzn_com' );
add_option( 'amzn_co_uk' );
add_option( 'amzn_de' );
add_option( 'amzn_fr' );
add_option( 'amzn_ca' );
add_option( 'amzn_jp' );

add_action( 'admin_menu', 'amzn_admin_menu');
add_action( 'wp_head', 'amzn_add_js' );

/**
 * add MENU
 */
function amzn_admin_menu() {
  add_options_page('Amazon Affiliate IDs', 'Amazon Affiliate IDs', 8, 'amazon_affiliate_link_localiser', 'amzn_admin_options');
}

/**
 * OPTIONS page
 */
function amzn_admin_options() {

	echo "
	<style type=\"text/css\">
		.confirm {
			color: #090;
			font-weight: bold;
		}
	</style>
	<h2>Amazon Affiliate Link Localizer</h2>";

	if ( $_POST['_wpnonce'] ) {
			update_option( 'amzn_com', $_POST['amzn_com'] );
			update_option( 'amzn_co_uk', $_POST['amzn_co_uk'] );
			update_option( 'amzn_de', $_POST['amzn_de'] );
			update_option( 'amzn_fr', $_POST['amzn_fr'] );
			update_option( 'amzn_ca', $_POST['amzn_ca'] );
			update_option( 'amzn_jp', $_POST['amzn_jp'] );

			echo "<p class=\"confirm\">Affiliate IDs updated</p>";
	}

	echo "
	<div class=\"wrap\">
		<form name=\"form1\" method=\"post\" action=\"" . str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) . "\">
			" . wp_nonce_field('update-options') . "
			<p>Enter your regional Amazon affiliate IDs below.</p>
			<p>Don't worry if you don't have one for each region - just leave it blank.</p>
			<table class=\"form-table\">
				<tr valign=\"top\">
					<th scope=\"row\">Amazon.com ID</th>
					<td><input type=\"text\" name=\"amzn_com\" value=\"" . get_option('amzn_com') . "\" /></td>
				</tr>
					<th scope=\"row\">Amazon.co.uk ID</th>
					<td><input type=\"text\" name=\"amzn_co_uk\" value=\"" . get_option('amzn_co_uk') . "\" /></td>
				</tr>
					<th scope=\"row\">Amazon.de ID</th>
					<td><input type=\"text\" name=\"amzn_de\" value=\"" . get_option('amzn_de') . "\" /></td>
				</tr>
					<th scope=\"row\">Amazon.fr ID</th>
					<td><input type=\"text\" name=\"amzn_fr\" value=\"" . get_option('amzn_fr') . "\" /></td>
				</tr>
					<th scope=\"row\">Amazon.ca ID</th>
					<td><input type=\"text\" name=\"amzn_ca\" value=\"" . get_option('amzn_ca') . "\" /></td>
				</tr>
					<th scope=\"row\">Amazon.jp ID</th>
					<td><input type=\"text\" name=\"amzn_jp\" value=\"" . get_option('amzn_jp') . "\" /></td>
				</tr>
			</table>

			<p class=\"submit\">
			<input type=\"submit\" name=\"Submit\" value=\"Update Options\" />
			</p>

		</div>
	</form>

	<p>Plugin by <a href=\"http://petewilliams.info\">Pete Williams</a> - <a href=\"http://twitter.com/PeteWilliams\">Follow me on twitter</a>";


}

/**
 * generate required JAVASCRIPT
 */
function amzn_add_js() {

	// does not use wp_enqueue_script because we need to ensure linked scripts go above the embedded one
	echo "
	<script type=\"text/javascript\" src=\"http://www.google.com/jsapi\"></script>
	<script type=\"text/javascript\">
		var arrAffiliates = {
			'com'   : '" . get_option( 'amzn_com' ) . "',
			'co.uk'	: '" . get_option( 'amzn_co_uk' ) . "',
			'de'	: '" . get_option( 'amzn_de' ) . "',
			'fr'	: '" . get_option( 'amzn_fr' ) . "',
			'ca'	: '" . get_option( 'amzn_ca' ) . "',
			'jp'	: '" . get_option( 'amzn_jp' ) . "'
		};
		var strUrlAjax = '".WP_PLUGIN_URL  . "/amazon-affiliate-link-localizer/ajax.php';
	</script>
	<script type=\"text/javascript\" src=\"".WP_PLUGIN_URL  . "/amazon-affiliate-link-localizer/js/amazon_linker.min.js\"></script>";

}