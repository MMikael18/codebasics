<?php
// https://perishablepress.com/integrating-google-no-captcha-recaptcha-wordpress-forms/

class reCaptcha_Options_Page {

	private $text_domain = "reCaptcha_textdomain";
    
    function __construct() {

		$this->text_domain = $this->text_domain;

        // Back end
        add_action( "admin_menu", array( $this, "admin_menu" ) );
        add_action( "admin_init", array( $this, "recaptcha_options_init" ));
        
        // Frond end
        add_action( "wp_enqueue_scripts", array( $this, "frontend_recaptcha_script" ));
        add_action( "comment_form", array( $this, "display_comment_recaptcha" ));
        add_filter( "preprocess_comment", array( $this, "verify_comment_captcha" ));
    }
    
    // Registers a new settings page under Settings.
    function admin_menu() {
        add_options_page(
			__("reCaptcha", $this->text_domain),
			__("reCaptcha", $this->text_domain),
			"manage_options",
			"options_page_slug",
			array(
				$this,
				"settings_page"
			)
        );
    }
    
    // Settings page display callback.
    function settings_page() {
        // check user capabilities
        if ( ! current_user_can( "manage_options" ) ) {
            return;
        }
        ?>
		<div class="wrap">
			<h1><?php _e("reCaptcha setting", $this->text_domain); ?></h1>
			<form method="post" action="options.php">
			<?php
				settings_fields("header_section");
				do_settings_sections("recaptcha-options");
				submit_button();
			?>
			</form>
		</div>
		<?php
    }
    
    // Register page field content
    function recaptcha_options_init() {
        add_settings_section("header_section", "Keys", array( $this, "display_recaptcha_content" ), "recaptcha-options");
        
        add_settings_field("captcha_site_key", __("Site Key"), array( $this, "display_captcha_site_key_element" ), "recaptcha-options", "header_section");
        add_settings_field("captcha_secret_key", __("Secret Key"), array( $this, "display_captcha_secret_key_element" ), "recaptcha-options", "header_section");
        
        register_setting("header_section", "captcha_site_key");
        register_setting("header_section", "captcha_secret_key");
    }
    
    
    // Options header and fiels
    function display_recaptcha_content() {
        _e("<p>You need to <a href='https://www.google.com/recaptcha/admin' rel='external'>register you domain</a> and get keys to make this plugin work.</p>");
        _e("Enter the key details below");
    }
    
    function display_captcha_site_key_element() {
        ?> <input type="text" name="captcha_site_key" style="width:95%" id="captcha_site_key" value="<?php echo get_option("captcha_site_key"); ?>" /> <?php
    }
    
    function display_captcha_secret_key_element() {
		?> <input type="text" name="captcha_secret_key" style="width:95%"  id="captcha_secret_key" value="<?php echo get_option("captcha_secret_key"); ?>" /> <?php
    }

    // ------- Front end -------
    function frontend_recaptcha_script() {
        wp_register_script("recaptcha", "https://www.google.com/recaptcha/api.js");
        wp_enqueue_script("recaptcha");
    }
    
    function display_comment_recaptcha() {
        ?>
		<style>#commentform .form-submit {display: none;}</style>
        <div class="g-recaptcha" data-sitekey="<?php echo get_option("captcha_site_key"); ?>"></div>
        <input class="g-submit" name="submit" type="submit" value="<?php _e("Submit Comment", $this->text_domain) ?>">
        <?php
    }

    function verify_comment_captcha($commentdata) {
        if (isset($_POST["g-recaptcha-response"])) {
            $recaptcha_secret = get_option("captcha_secret_key");
            $response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=". $recaptcha_secret ."&response=". $_POST["g-recaptcha-response"]);
            $response = json_decode($response["body"], true);
            if (true == $response["success"]) {
                return $commentdata;
            } else {
                _e("Please fill reCaptcha.");
                return null;
            }
        } else {
            _e("Please enable JavaScript in browser.");
            return null;
        }
    }
    
}
new reCaptcha_Options_Page;