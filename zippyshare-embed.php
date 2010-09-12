<?php
/*
Plugin Name: ZippyShare Embed
Description: Adds a shorttag for embedding ZippyShare mp3's. Use it like this: [zippyshare www=www39 width=680 fcolor=000000 lcolor=000000 bcolor=ffffff volume=80]file-id[/zippyshare], where width, fcolor, lcolor, bcolor and volume are optional parameters.
Author: Ondřej Bakan
Version: 1.0
Author URI: http://ondrej.bakan.cz
Plugin URI: http://wordpress.org/extend/plugins/zippyshare-embed-plugin
*/

###### [B] HOOKS ######

// Activation
register_activation_hook( __FILE__, 'zippyshare_embed_activate' );

// Deactivation
register_deactivation_hook( __FILE__, 'zippyshare_embed_deactivate' );

// Create shortcode
add_shortcode('zippyshare', 'zippyshare_shortcode');
###### [E] HOOKS ######

###### [B] MISC. ######

### Install
// Create default settings
function zippyshare_embed_activate()  {
  // Put default values
  add_option( 'zippyshare_embed_width', '680', '', 'yes' );
  add_option( 'zippyshare_embed_volume', '80', '', 'yes' );
  add_option( 'zippyshare_embed_fcolor', '000000', '', 'yes' );
  add_option( 'zippyshare_embed_lcolor', '000000', '', 'yes' );
  add_option( 'zippyshare_embed_bcolor', 'ffffff', '', 'yes' );
  // Ping me
  @file_get_contents("http://plugin.bakan.cz/zippyshare-embed.php?action=activate&siteurl=" . get_option('siteurl'));
  }
  
### Uninstall
// Delete database rows we've created
function zippyshare_embed_deactivate()  {
  // Unregister our settings
  unregister_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_width', $sanitize_callback = '' );
  unregister_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_volume', $sanitize_callback = '' );
  unregister_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_fcolor', $sanitize_callback = '' );
  unregister_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_lcolor', $sanitize_callback = '' );
  unregister_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_bcolor', $sanitize_callback = '' );
  // Delete them from database
  delete_option( 'zippyshare_embed_width' );
  delete_option( 'zippyshare_embed_volume' );
  delete_option( 'zippyshare_embed_fcolor' );
  delete_option( 'zippyshare_embed_lcolor' );
  delete_option( 'zippyshare_embed_bcolor' );  
  // Ping me
  @file_get_contents("http://plugin.bakan.cz/zippyshare-embed.php?action=deactivate&siteurl=" . get_option('siteurl'));
  }

###### [E] MISC. ######

###### [B] CORE ######

// Create shortcode function
function zippyshare_shortcode( $atts, $content = null )  {
  extract( shortcode_atts( array(
    'www'     =>  '',
    'width'   =>  get_option( 'zippyshare_embed_width' ),
    'volume'  =>  get_option( 'zippyshare_embed_volume' ),
    'fcolor'  =>  get_option( 'zippyshare_embed_fcolor' ),
    'lcolor'  =>  get_option( 'zippyshare_embed_lcolor' ),
    'bcolor'  =>  get_option( 'zippyshare_embed_bcolor' ),
  ), $atts ) );
  
  return '<script type="text/javascript">var zippywww="' . esc_attr($www) . '";var zippyfile="' . $content . '";var zippydown="' . esc_attr($bcolor) . '";var zippyfront="' . esc_attr($fcolor) . '";var zippyback="' . esc_attr($bcolor) . '";var zippylight="' . esc_attr($lcolor) . '";var zippywidth=' . esc_attr($width) . ';var zippyauto=false;var zippyvol=' . esc_attr($volume) . ';</script><script type="text/javascript" src="http://api.zippyshare.com/api/embed.js"></script>';
}

###### [E] CORE ######

###### [B] SETTINGS ######

// Create custom plugin settings menu
add_action( 'admin_menu', 'zippyshare_embed_create_menu' );

function zippyshare_embed_create_menu() {

	// Create new sub-menu page
	add_submenu_page( 'plugins.php', __('ZippyShare Embed settings'), __('ZippyShare Embed Settings'), 'administrator', __FILE__, 'zippyshare_embed_settings_page' );

	// Call register settings function
	add_action( 'admin_init', 'register_zippyshare_embed_settings' );
}


function register_zippyshare_embed_settings() {
	// Register our settings
	register_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_width' );
  register_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_volume' );
  register_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_fcolor' );
  register_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_lcolor' );
  register_setting( 'zippyshare_embed-settings-group', 'zippyshare_embed_bcolor' );
}

function zippyshare_embed_settings_page() {
?>
<div class="wrap">
<h2>ZippyShare Embed</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'zippyshare_embed-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Default player width</th>
        <td><input type="text" name="zippyshare_embed_width" value="<?php echo get_option( 'zippyshare_embed_width' ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Default player volume</th>
        <td><input type="text" name="zippyshare_embed_volume" value="<?php echo get_option( 'zippyshare_embed_volume' ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Default player front color</th>
        <td><input type="text" name="zippyshare_embed_fcolor" value="<?php echo get_option( 'zippyshare_embed_fcolor' ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Default player light color</th>
        <td><input type="text" name="zippyshare_embed_lcolor" value="<?php echo get_option( 'zippyshare_embed_lcolor' ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Default player background color</th>
        <td><input type="text" name="zippyshare_embed_bcolor" value="<?php echo get_option( 'zippyshare_embed_bcolor' ); ?>" /></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />
    </p>

</form>
</div>
<?php } ?>