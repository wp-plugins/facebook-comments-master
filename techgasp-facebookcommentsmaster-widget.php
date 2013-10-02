<?php
//Load Shortcode Framework

//Hook Widget
add_action( 'widgets_init', 'techgasp_facebookcommentsmaster_widget' );
//Register Widget
function techgasp_facebookcommentsmaster_widget() {
register_widget( 'techgasp_facebookcommentsmaster_widget' );
}

class techgasp_facebookcommentsmaster_widget extends WP_Widget {
	function techgasp_facebookcommentsmaster_widget() {
	$widget_ops = array( 'classname' => 'Facebook Comments Master', 'description' => __('Facebook Comments Master is the professional integration of facebook comments into heavy duty wordpress websites. ', 'Facebook Comments Master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'techgasp_facebookcommentsmaster_widget' );
	$this->WP_Widget( 'techgasp_facebookcommentsmaster_widget', __('Facebook Comments Master', 'facebook comments master'), $widget_ops, $control_ops );
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
		$facebookcomments_appid = $instance['facebookcomments_appid'];
		$facebookcomments_userid = $instance['facebookcomments_userid'];
		$facebookcomments_posts = $instance['facebookcomments_posts'];
		$facebookcomments_width = $instance['facebookcomments_width'];
		$facebookcomments_color = $instance['facebookcomments_color'];
		echo $before_widget;
		
	// Display the widget title
		if ( $title )
		echo $before_title . $name . $after_title;
	//Display Faceboook Comments
		if ( $show_facebookcomments )
		echo '<meta property="fb:admins" content="{'.$facebookcomments_userid.'}"/>' .
			'<meta property="fb:app_id" content="{'.$facebookcomments_appid.'}"/>' .
			'<div id="fb-root"></div>' .
			'<script>(function(d, s, id) {' .
			'var js, fjs = d.getElementsByTagName(s)[0];' .
			'if (d.getElementById(id)) return;' .
			'js = d.createElement(s); js.id = id;' .
			'js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";' .
			'fjs.parentNode.insertBefore(js, fjs);' .
			'}(document, '.$facebookcommentsspacer.'script'.$facebookcommentsspacer.', '.$facebookcommentsspacer.'facebook-jssdk'.$facebookcommentsspacer.'));</script>' .
			'<div class="fb-comments" data-href="'.$fburicurrent.'" data-width="'.$facebookcomments_width.'" data-num-posts="'.$facebookcomments_posts.'" data-colorscheme="'.$facebookcomments_color.'" data-mobile="auto-detect"></div>';
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_facebookcomments'] = $new_instance['show_facebookcomments'];
		$instance['facebookcomments_appid'] = $new_instance['facebookcomments_appid'];
		$instance['facebookcomments_userid'] = $new_instance['facebookcomments_userid'];
		$instance['facebookcomments_posts'] = $new_instance['facebookcomments_posts'];
		$instance['facebookcomments_width'] = $new_instance['facebookcomments_width'];
		$instance['facebookcomments_color'] = $new_instance['facebookcomments_color'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Facebook Comments Master', 'facebook comments master'), 'title' => true, 'show_facebookcomments' => false, 'facebookcomments_appid' => false, 'facebookcomments_userid' => false, 'facebookcomments_posts' => false, 'facebookcomments_width' => false, 'facebookcomments_color' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<hr>
	<p><b>Hide Widget Title. Upgrade to Advanced Version.</b></p>
	<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['show_facebookcomments'], true ); ?> id="<?php echo $this->get_field_id( 'show_facebookcomments' ); ?>" name="<?php echo $this->get_field_name( 'show_facebookcomments' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_facebookcomments' ); ?>"><b><?php _e('Display Facebook Comments', 'facebook comments master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_posts' ); ?>"><?php _e('Number of Posts:', 'facebook comments master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookcomments_posts' ); ?>" name="<?php echo $this->get_field_name( 'facebookcomments_posts' ); ?>" value="<?php echo $instance['facebookcomments_posts']; ?>" style="width:auto;" />
	</p>
	<p>Number of facebook posts to display, ie <b>10</b></p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_width' ); ?>"><?php _e('Plugin Width:', 'facebook comments master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookcomments_width' ); ?>" name="<?php echo $this->get_field_name( 'facebookcomments_width' ); ?>" value="<?php echo $instance['facebookcomments_width']; ?>" style="width:auto;" />
	</p>
	<p>Plugin Width to fit your widget size, ie <b>470</b></p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_color' ); ?>"><?php _e('Color Scheme:', 'facebook comments master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookcomments_color' ); ?>" name="<?php echo $this->get_field_name( 'facebookcomments_color' ); ?>" value="<?php echo $instance['facebookcomments_color']; ?>" style="width:auto;" />
	</p>
	<p>Facebook Color Scheme: <b>light</b> or <b>dark</b></p>
	<hr>
	<p><b>Moderation Tools (optional)</b></p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_appid' ); ?>"><?php _e('Facebook Application ID:', 'facebook comments master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookcomments_appid' ); ?>" name="<?php echo $this->get_field_name( 'facebookcomments_appid' ); ?>" value="<?php echo $instance['facebookcomments_appid']; ?>" style="width:auto;" />
	</p>
	<p>Insert your Facebook Application ID number</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'facebookcomments_userid' ); ?>"><?php _e('Facebook User ID:', 'facebook comments master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'facebookcomments_userid' ); ?>" name="<?php echo $this->get_field_name( 'facebookcomments_userid' ); ?>" value="<?php echo $instance['facebookcomments_userid']; ?>" style="width:auto;" />
	</p>
	<p>Insert Facebook Moderator User ID. To check your Facebook User ID navigate to:</p>
	<p>http://graph.facebook.com/username</p>
	<p>(replace username with your facebook username)</p>
	<p><b>To moderate comments use the link</b></p>
	<p>https://developers.facebook.com/tools/comments</p>
	<hr>
	<p><b>Activate Mobile Optimize Version. Upgrade to Advanced Version.</b></p>
	<hr>
	<p><b>Shortcode Framework. Upgrade to Advanced Version.</b></p>
	<hr>
	<p><b>Facebook Comments Master Lite Version</b></p>
	<p>Upgrade and get all features and support! Display or hide Widget Title - Display or hide Facebook Comments - Number of comments to display - Plugin Width - Facebook Application Ready - Facebook Comments Moderation Ready - Facebook Mobile Optimized version Ready - Facebook Color Scheme (light or dark) - Shortcode Framework. Publish widget inside pages and posts.</p>
	<p><a class="button-primary" href="http://wordpress.techgasp.com/facebook-comments-master/" target="_blank" title="Facebook Comments Master Advanced Version">Facebook Comments Master Advanced Version</a></p>
	<?php
	}
 }
?>