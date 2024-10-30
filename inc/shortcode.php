<?php
/**
 * Added shortcode to include continuon plugin inside the posts, pages, and custom post types.
 */
 
 class ContinuonPluginShortcode {
 	public function __construct() {
		if ( ! is_admin() ) {
			add_shortcode( 'continuon-social-crm', array( $this, 'csp_shortcode' ) );
		}
	}

	/**
	 * csp_shortcode function added continuon social crm for all singular pages.
	 */
	public function csp_shortcode() {
		if ( is_singular() ) {
			$widget_continuon_plugin = get_option( 'widget_continuon_plugin', true );
		?>
        <script>
            const cn = document.createElement('script'); 
            cn.type = 'text/javascript';
            cn.async = true;
            cn.src = 'https://<?php echo strtolower($widget_continuon_plugin[2]['identifier']); ?>.continuon.co/static/js/continuon_social_plugin.js?v=1.0';
            const s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(cn, s);
        </script>
        <div id="continuon_social" data-identifier="<?php echo $widget_continuon_plugin[2]['identifier']; ?>" data-banner-id="<?php echo $widget_continuon_plugin[2]['banner_id']; ?>"></div>
	<?php } }
 }

 $ContPluginShortcodeObj = new ContinuonPluginShortcode();