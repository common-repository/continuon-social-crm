<?php
/*
Plugin Name: Continuon Social CRM 
Plugin URI: https://app.continuon.co/knowledgebase/social-crm
Description: This plugin helps you add a Continuon social CRM banner to your Wordpress site.
Version: 1.0.0
Author: Continuon Dev Team
Author URI: https://www.continuon.co
License: GPL2
*/

//include shortcode feature file
include_once( plugin_dir_path( __FILE__ ) . 'inc/shortcode.php' );

class ContinuonSocialPlugin extends WP_Widget {
	function __construct() {
		parent::__construct(
			'continuon_plugin',
			'&raquo; Continuon Social Banner',
			array(
				'description' => ( 'Enables Continuon collects data and links real human information to social media profiles for you.' )
			) );
	}

	function widget( $args, $instance ) {
		$identifier	= apply_filters( 'widget_identifier', $instance['identifier'] );
		$banner_id 	= $instance['banner_id'];
		?>

        <script>
            const cn = document.createElement('script');
            cn.type = 'text/javascript';
            cn.async = true;
            cn.src = 'https://<?php echo strtolower($identifier); ?>.continuon.co/static/js/continuon_social_plugin.js?v=1.0';
            const s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(cn, s);
        </script>
        <div id="continuon_social" data-identifier="<?php echo $identifier; ?>" data-banner-id="<?php echo $banner_id; ?>"></div>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance['identifier']  = strip_tags( $new_instance['identifier'] );
		$instance['banner_id']   = strip_tags( $new_instance['banner_id'] );

		return $instance;
	}

	function form( $instance ) {
		global $theme;
		$instance = wp_parse_args( (array) $instance, $theme->options['widgets_options']['continuon'] );
		?>

		<div class="widget">
			<p>
				<label for="<?php echo $this->get_field_id( 'identifier' ); ?>">Identifier: </label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'identifier' ); ?>"
					   name="<?php echo $this->get_field_name( 'identifier' ); ?>" type="text" placeholder="e.g: BMW"
					   value="<?php echo esc_attr( $instance['identifier'] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'banner_id' ); ?>">Banner ID:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'banner_id' ); ?>"
					   name="<?php echo $this->get_field_name( 'banner_id' ); ?>" type="text"
					   placeholder="e.g: 345092WH65802"
					   value="<?php echo esc_attr( $instance['banner_id'] ); ?>"/>
			</p>
		</div>
		<?php
	}
}

add_action( 'widgets_init', function () {
	return register_widget( "ContinuonSocialPlugin" );
} );
