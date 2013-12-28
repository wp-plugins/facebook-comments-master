<?php
//Hook Widget
add_action( 'widgets_init', 'facebook_comments_master_widget' );
//Register Widget
function facebook_comments_master_widget() {
register_widget( 'facebook_comments_master_widget' );
}
add_action( 'wp_enqueue_scripts', 'facebook_comments_master_wcss' );
//load css for shortcode
function facebook_comments_master_wcss() {
	wp_enqueue_style( 'prefix-style', plugins_url('facebook-comments-master-style.css', __FILE__) );
}
class facebook_comments_master_widget extends WP_Widget {
	function facebook_comments_master_widget() {
	$widget_ops = array( 'classname' => 'Facebook Comments Master', 'description' => __('Facebook Comments Master is the professional integration of facebook comments into heavy duty wordpress websites. ', 'facebook_comments_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'facebook_comments_master_widget' );
	$this->WP_Widget( 'facebook_comments_master_widget', __('Facebook Comments Master', 'facebook_comments_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Variables from the widget settings.
		$name = "Facebook Comments Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$facebookcommentsspacer ="'";
		@$fburibase = site_url( $path, $scheme );
		@$fburicurrent = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$show_facebookcomments = isset( $instance['show_facebookcomments'] ) ? $instance['show_facebookcomments'] :false;
		$facebookcomments_posts = $instance['facebookcomments_posts'];
		$facebookcomments_color = $instance['facebookcomments_color'];
		echo $before_widget;
		
	// Display the widget title
		if ( $title ){
		echo $before_title . $name . $after_title;
		}
		else{
		}
	//Display Faceboook Comments
		if ( $show_facebookcomments )
		echo '<div id="fb-root"></div>' .
			'<script>(function(d, s, id) {' .
			'var js, fjs = d.getElementsByTagName(s)[0];' .
			'if (d.getElementById(id)) return;' .
			'js = d.createElement(s); js.id = id;' .
			'js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";' .
			'fjs.parentNode.insertBefore(js, fjs);' .
			'}(document, '.$facebookcommentsspacer.'script'.$facebookcommentsspacer.', '.$facebookcommentsspacer.'facebook-jssdk'.$facebookcommentsspacer.'));</script>' .
			'<div class="fb-comments" data-href="'.$fburicurrent.'" data-num-posts="'.$facebookcomments_posts.'" data-colorscheme="'.$facebookcomments_color.'"></div>';
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_facebookcomments'] = $new_instance['show_facebookcomments'];
		$instance['facebookcomments_posts'] = $new_instance['facebookcomments_posts'];
		$instance['facebookcomments_color'] = $new_instance['facebookcomments_color'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Facebook Comments Master', 'facebook_comments_master'), 'title' => true, 'show_facebookcomments' => false, 'facebookcomments_appid' => false, 'facebookcomments_userid' => false, 'facebookcomments_posts' => false, 'facebookcomments_color' => false, 'show_facebookcomments_mobile' => true );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'facebook_comments_master'); ?></b></label></br>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_facebookcomments'], true ); ?> id="<?php echo $this->get_field_id( 'show_facebookcomments' ); ?>" name="<?php echo $this->get_field_name( 'show_facebookcomments' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_facebookcomments' ); ?>"><b><?php _e('Display Facebook Comments', 'facebook_comments_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_posts' ); ?>"><?php _e('Number of Posts:', 'facebook_comments_master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookcomments_posts' ); ?>" name="<?php echo $this->get_field_name( 'facebookcomments_posts' ); ?>" value="<?php echo $instance['facebookcomments_posts']; ?>" style="width:auto;" />
	</p>
	<p>Number of facebook posts to display, ie <b>10</b></p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_color' ); ?>"><?php _e('Color Scheme:', 'facebook_comments_master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookcomments_color' ); ?>" name="<?php echo $this->get_field_name( 'facebookcomments_color' ); ?>" value="<?php echo $instance['facebookcomments_color']; ?>" style="width:auto;" />
	</p>
	<p>Facebook Color Scheme: <b>light</b> or <b>dark</b></p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Optimized Mobile Responsive Version</b>
	</p>
	<div class="description">Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<b>Moderation Tools (optional)</b>
	</p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_appid' ); ?>"><?php _e('Facebook Application ID:', 'facebook_comments_master'); ?></label>
	<div class="description">Only available in advanced version.</div><br>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_userid' ); ?>"><?php _e('Facebook User ID:', 'facebook_comments_master'); ?></label>
	<div class="description">Only available in advanced version.</div><br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
		&nbsp;
		<b>Shortcode Framework</b>
		</p>
		<div class="description">The shortcode framework allows you to insert Facebook Comments Master inside Pages & Posts without the need of extra plugins or gimmicks. Fast page load times and top SEO. Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Facebook Comments Master Website</b>
	</p>
	<p><a class="button-secondary" href="http://wordpress.techgasp.com/facebook-comments-master/" target="_blank" title="Facebook Comments Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/facebook-comments-master-documentation/" target="_blank" title="Facebook Comments Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/facebook-comments-master/" target="_blank" title="Facebook Comments Master">Adv. Version</a></p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Advanced Version Updater:</b>
	</p>
	<div class="description">The advanced version updater allows to automatically update your advanced plugin. Only available in advanced version.</div>
	<br>
	<?php
	}
 }
?>