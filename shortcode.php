<?php

// Slider shortcode
add_shortcode( 'abrillix_slider', 'custom_slide' );
function custom_slide( $atts ) {
	$prefix = 'abr_';

	$att = shortcode_atts( array(
		'id'	=> ''
	), $atts );

	$slider_style = get_post_meta( $att['id'], $prefix . 'slider_style', true);

	
	if ( $slider_style == '1' ) {
		$slider = slider_style_one($att['id']);
	} elseif ( $slider_style == '2' ) {
		$slider = slider_style_two($att['id']);
	} elseif ( $slider_style == '3' ) {
		$slider = slider_style_three($att['id']);
	}	

	return $slider;

}

function slider_style_one($slide_id) {
	$prefix = 'abr_';
	?>
	<div class="slider slider-1">
        <div id="mainslider">
            <?php echo abrillix_slider_homepage($slide_id);?>
        </div>
        <div class="onslidername">
            <div class="container">
                <div class="onslidername-ct">
                    <span><?php echo get_post_meta($slide_id, $prefix . 'title', true );?></span>
                    <span><i></i></span>
                    <span class="smalltext"><?php echo get_post_meta($slide_id, $prefix . 'subtitle', true );?></span>
                </div>
                <div class="slidernav">
                    <div class="slidernav-inner">
                        <div class="prev"></div>
                        <div class="next"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
}

function slider_style_two($slide_id) {
	$prefix = 'abr_';
	?>

	<div class="slider slider-2">
        <div>
            <div id="mainslider">
                <?php echo abrillix_slider_homepage($slide_id);?>
            </div>
            <div class="onslidername">
                
                <div class="on-slider-ct">
                    <div class="div-table">
                        <div class="div-table-cell">
                            <h1><span><?php echo get_post_meta($slide_id, $prefix . 'subtitle', true );?></span><?php echo get_post_meta($slide_id, $prefix . 'title', true );?><span><img src="<?php echo get_template_directory_uri();?>/assets/images/3bulletsw.png" alt=""></span></h1>
                            <div class="excerpt">
                                <?php echo wpautop(  get_post_meta($slide_id, $prefix . 'content_excerpt', true ) ); ?>
                                <a href="<?php echo esc_url(get_post_meta($slide_id, $prefix . 'url', true ));?>" class="btn btn-link"><?php _e('VIEW MORE', 'abrillix');?></a>
                            </div>
                        </div>
                    </div>
                    <div class="div-table onright">
                        <div class="div-table-cell">
							<ul>
                                <li><a href="javascript:void(0)" class="openSearch"><i class="fa fa-search"></i></a></li>
							<?php
							$fb = get_theme_mod('facebook-account', true);
							if ( $fb ) {
								echo '<li><a href="'.esc_url($fb).'"><i class="fa fa-facebook-square"></i></a></li>';
							}
							$tw = get_theme_mod('twitter-account', true);
							if ( $tw ) {
								echo '<li><a href="'.esc_url($tw).'"><i class="fa fa-twitter-square"></i></a></li>';
							}
							$ig = get_theme_mod('instagram-account', true);
							if ( $ig ) {
								echo '<li><a href="//www.instagram.com/'.$ig.'"><i class="fa fa-instagram"></i></a></li>';
							}
							$yt = get_theme_mod('youtube-account', true);
							if ( $yt ) {
								echo '<li><a href="'.esc_url($yt).'"><i class="fa fa-youtube"></i></a></li>';
							}
							?>
                            
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="scroll-down">
                    <div class="scroll-ct">
                        <img src="<?php echo get_template_directory_uri();?>/assets/images/prev.png" alt=""> <?php _e('scroll down','abrillix');?>
                    </div>
                </div>
                <div class="slidernav">
                    <div class="slidernav-inner">
                        <div class="prev"></div>
                        <div class="next"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php
}

function slider_style_three($slide_id) {
	$prefix = 'abr_';
	$ids = get_post_meta($slide_id, 'attached_slider_posts', true);

	$args = array(
		'post_type'		=> 'post',
		'include'		=> $ids,
	);
	$posts = get_posts($args);

	?>
	<div class="slider slider-3">
		<div>
			<div id="mainslider">
				<?php abrillix_slider_homepage($slide_id);?>
			</div>
			<div class="onslidername">
				<div class="on-slider-ct">
					<div class="slidernav">
						<div class="slidernav-inner">
							<div class="prev"></div>
							<div class="next"></div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="div-table">
						<div class="div-table-cell">
							<?php 
							$id = get_post_meta($slide_id, $prefix . 'featured_slider_select', true);
							$post = get_post($id);
							?>
							<ul>
								<li><i class="fa fa-comment"></i><?php echo $post->comment_count;?> <?php _e('Comments', 'abrillix');?></li>
								<li><?php echo abrillix_getpostviews($post->ID);?></li>
							</ul>
							<h1><?php echo $post->post_title;?></h1>
							<div class="excerpt">
								<p>
								<?php
								if ( empty( $post->post_excerpt ) ) {
									echo wp_kses_post( wp_trim_words( $post->post_content, 20 ) );
								} else {
									echo wp_kses_post( $post->post_excerpt ); 
								}
								?>
								</p>
								<a href="<?php the_permalink($post->ID);?>" class="btn btn-link"><?php _e('VIEW MORE', 'abrillix');?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}