<?php
global $post;
wp_enqueue_script('addthis');
if ( !homeo_get_config('show_property_social_share', true) ) {
	return;
}
?>
<div class="social-property">
	<a href="javascript:void(0);" class="btn-add-social">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17.5" viewBox="0 0 20 20"><path id="icon-share" d="M20,35.571a3.57,3.57,0,0,1-3.571,3.571,3.442,3.442,0,0,1-2.594-1.156L7.094,41.4a3.723,3.723,0,0,1,0,1.205l6.741,3.371a3.572,3.572,0,1,1-.978,2.455,3.407,3.407,0,0,1,.219-1.237l-6.5-3.25a3.571,3.571,0,1,1,0-3.884l6.5-3.25A3.572,3.572,0,1,1,20,35.571ZM3.531,44.143a2.143,2.143,0,1,0,0-4.286,2.143,2.143,0,1,0,0,4.286Zm12.9-10.714a2.143,2.143,0,1,0,2.143,2.143A2.143,2.143,0,0,0,16.429,33.429Zm0,17.143a2.143,2.143,0,1,0-2.143-2.143A2.143,2.143,0,0,0,16.429,50.571Z" transform="translate(0 -32)" fill="#484848"/></svg>
		<span><?php esc_html_e('Share', 'homeo'); ?></span>
	</a>
	<div class="bo-social-icons">
		<?php if ( homeo_get_config('facebook_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="facebook" class="bo-social-facebook addthis_button_facebook" data-url="<?php echo esc_url(get_permalink($post)); ?>" data-title="<?php echo esc_attr(get_the_title($post)); ?>"><i class="fab fa-facebook-f"></i></a>
		<?php endif; ?>
		<?php if ( homeo_get_config('twitter_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="twitter" class="bo-social-twitter addthis_button_twitter"><i class="fab fa-twitter"></i></a>
		<?php endif; ?>
		<?php if ( homeo_get_config('linkedin_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="linkedin" class="bo-social-linkedin addthis_button_linkedin"><i class="fab fa-linkedin-in"></i></a>
		<?php endif; ?>
		
		<?php if ( homeo_get_config('pinterest_share', 1) ): ?>
 			<a href="javascript:void(0);" data-original-title="pinterest" class="bo-social-pinterest addthis_button_pinterest"><i class="fab fa-pinterest-p"></i></a>
		<?php endif; ?>

		<?php if ( homeo_get_config('more_share', 1) ): ?>
			<a href="javascript:void(0);" data-original-title="share_more" class="bo-social-pinterest addthis_button_compact"><i class="fas fa-ellipsis-h"></i></a>
		<?php endif; ?>
	</div>
</div>