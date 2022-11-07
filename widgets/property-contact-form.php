<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
if ( !empty($post->post_type) && $post->post_type == 'property' ) {
	$author_id = $post->post_author;
	$avatar = $a_phone = '';
	if ( WP_RealEstate_User::is_agency($author_id) ) {
		$agency_id = WP_RealEstate_User::get_agency_by_user_id($author_id);
		$agency_post = get_post($agency_id);
		$author_email = homeo_agency_display_email($agency_post, 'no-title', false);
		
		$avatar = '';
		ob_start();
		homeo_agency_display_image($agency_post);
		$avatar = ob_get_clean();

		$a_title = get_the_title($agency_id);
		$a_title_html = '<a href="'.get_permalink($agency_id).'">'.get_the_title($agency_id).'</a>';
		$a_phone = homeo_agency_display_phone($agency_post, 'no-title', false);
	} elseif ( WP_RealEstate_User::is_agent($author_id) ) {
		$agent_id = WP_RealEstate_User::get_agent_by_user_id($author_id);
		$agent_post = get_post($agent_id);
		$author_email = homeo_agent_display_email($agent_post, 'no-title', false);

		$avatar = '';
		ob_start();
		homeo_agent_display_image($agent_post);
		$avatar = ob_get_clean();

		$a_title = get_the_title($agent_id);
		$a_title_html = '<a href="'.get_permalink($agent_id).'">'.get_the_title($agent_id).'</a>';
		$a_phone = homeo_agent_display_phone($agent_post, 'no-title', false);
	} else {
		$user_id = $post->post_author;
		$author_email = get_the_author_meta('user_email');
		
		$a_phone = get_user_meta($user_id, '_phone', true);
		$a_phone = homeo_user_display_phone($a_phone, 'no-title', false);

		$first_name = get_user_meta( $user_id, 'first_name', true );
		$last_name = get_user_meta( $user_id, 'last_name', true );
		if ( !empty($first_name) || !empty($last_name) ) {
			$a_title = $a_title_html = $first_name.' '.$last_name;
		} else {
			$a_title = $a_title_html = get_the_author_meta('display_name');
		}
	}

	if ( ! empty( $author_email ) ) :
		extract( $args );
		extract( $instance );
		$title = !empty($instance['title']) ? sprintf($instance['title'], $a_title) : '';
		$title = apply_filters('widget_title', $title);

		if ( $title ) {
		    echo trim($before_title)  . trim( $title ) . $after_title;
		}

		$email = $phone = '';
		if ( is_user_logged_in() ) {
			$current_user_id = get_current_user_id();
			$userdata = get_userdata( $current_user_id );
			$email = $userdata->user_email;
		}
	?>	

		<div class="contact-form-agent">
			<div class="agent-content-wrapper flex-middle">
				<div class="agent-thumbnail">
					<?php if ( !empty($avatar) ) {
						echo trim($avatar);
					} else {
				        echo homeo_get_avatar($post->post_author, 180);
					} ?>
				</div>
				<div class="agent-content">
					<h3><?php echo trim($a_title_html); ?></h3>
					<div class="agent-address">Address</div>
					<div class="phone"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 30 30">
  <defs>
    <clipPath id="clip-path">
      <rect id="Rectangle_9" data-name="Rectangle 9" width="30" height="30" transform="translate(-0.003)" fill="#0057ad"/>
    </clipPath>
    <clipPath id="clip-path-2">
      <path id="Rectangle_3884" data-name="Rectangle 3884" d="M0,0H29.994V30H0Z" fill="#0057ad"/>
    </clipPath>
  </defs>

      <path id="Path_9709" data-name="Path 9709" d="M24.592,30A3.281,3.281,0,0,1,24,29.947a17.956,17.956,0,0,1-7.684-2.573A39.22,39.22,0,0,1,4.677,16.812,22.74,22.74,0,0,1,.4,8.294a19.727,19.727,0,0,1-.4-2.84A3.062,3.062,0,0,1,1.022,2.976l.86-.863c.457-.46.916-.921,1.382-1.374A2.129,2.129,0,0,1,4.914,0,2.223,2.223,0,0,1,6.436,1l4.239,5.745a2.31,2.31,0,0,1-.434,3.585,2.452,2.452,0,0,0-.881,1.1,2.253,2.253,0,0,0,.328,1.611,17.151,17.151,0,0,0,3.537,4.328,37.347,37.347,0,0,0,3.109,2.55,4.712,4.712,0,0,0,1.378.664A1.292,1.292,0,0,0,19.2,20.2c.305-.349.563-.638.838-.9a2.121,2.121,0,0,1,2.915-.194q3.1,2.252,6.171,4.553a1.774,1.774,0,0,1,.251,2.88q-1.286,1.365-2.646,2.657a3.3,3.3,0,0,1-2.132.8M4.755,1.815c-.019.027-.1.086-.234.211-.458.451-.91.9-1.362,1.352l-.906.9A1.284,1.284,0,0,0,1.8,5.331a18.278,18.278,0,0,0,.35,2.546A21.006,21.006,0,0,0,6.1,15.713,37.539,37.539,0,0,0,17.246,25.827a16.149,16.149,0,0,0,6.962,2.325.87.87,0,0,1,.095.015,1.451,1.451,0,0,0,1.219-.312q1.322-1.259,2.572-2.591a1.172,1.172,0,0,1,.1-.095c-.043-.021-.075,0-.113-.032q-3.1-2.321-6.23-4.6a.362.362,0,0,0-.523.014q-.381.371-.725.776a3.066,3.066,0,0,1-3.458.967,6.4,6.4,0,0,1-1.867-.912,38.883,38.883,0,0,1-3.256-2.672,18.765,18.765,0,0,1-3.87-4.731A4.006,4.006,0,0,1,7.61,11a.959.959,0,0,1,.039-.137A4.281,4.281,0,0,1,9.261,8.821.634.634,0,0,0,9.4,8.715.506.506,0,0,0,9.375,8a.937.937,0,0,1-.113-.123l-4.281-5.8a1.352,1.352,0,0,0-.225-.257" transform="translate(0 0)" fill="#0057ad"/>

</svg>
<?php echo trim($a_phone); ?></div>

					<!--<div class="email">-->
					<?php
				// 	echo trim($author_email);
					?>
					<!--</div>-->
				</div>
			</div>
			<div class="email-agent-main">
			    <h3 class="email-agent-head">Email agent</h3>
			    <div class="email-agent-info">
			        <div class="email-agent">
			            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="13.5" viewBox="0 0 18 13.5"><path id="icon-email" d="M0,66.25A2.25,2.25,0,0,1,2.25,64h13.5A2.251,2.251,0,0,1,18,66.25v9a2.252,2.252,0,0,1-2.25,2.25H2.25A2.251,2.251,0,0,1,0,75.25Zm1.125,0v1.4L8,72.694a1.688,1.688,0,0,0,2,0l6.877-5.041v-1.4a1.124,1.124,0,0,0-1.125-1.125H2.218A1.145,1.145,0,0,0,1.093,66.25Zm0,2.8v6.2A1.124,1.124,0,0,0,2.25,76.375h13.5a1.124,1.124,0,0,0,1.125-1.125v-6.2L10.663,73.6a2.806,2.806,0,0,1-3.326,0Z" transform="translate(0 -64)" fill="#484848"/></svg>
			            <p><?php echo trim($author_email);?></p>
			        </div>
			         <div class="email-agent-link">
			           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17.747" viewBox="0 0 20 17.747"><path id="icon-site-link" d="M13.889,13.068a.556.556,0,0,0-.556.556V16.37a1.117,1.117,0,0,1-1.111,1.142h-10A1.111,1.111,0,0,1,1.111,16.4V6.4A1.111,1.111,0,0,1,2.222,5.291H6.111a.556.556,0,0,0,0-1.111H2.222A2.223,2.223,0,0,0,0,6.4V16.37a2.222,2.222,0,0,0,2.222,2.222l10,.031A2.222,2.222,0,0,0,14.444,16.4V13.624A.557.557,0,0,0,13.889,13.068ZM19.8,5.419,14.247,1.006a.555.555,0,1,0-.712.853L17.91,5.291H12.778A6.08,6.08,0,0,0,6.667,11.4v1.111a.556.556,0,1,0,1.111,0V11.4a5.006,5.006,0,0,1,5-5H17.91L13.531,9.864a.556.556,0,0,0-.071.782.564.564,0,0,0,.428.2.553.553,0,0,0,.356-.129L19.8,6.273a.572.572,0,0,0,.2-.458A.461.461,0,0,0,19.8,5.419Z" transform="translate(0 -0.877)" fill="#0057ad"/></svg>
			            <p>Visit agent website</p>
			        </div>
			    </div>
			</div>
		    <form method="post" action="?" class="contact-form-wrapper">
		    	<div class="row">
			        <div class="col-sm-12">
				        <div class="form-group">
				            <input type="text" class="form-control" name="name" placeholder="<?php esc_attr_e( 'Full Name', 'homeo' ); ?>" required="required">
				        </div><!-- /.form-group -->
				    </div>
				    <div class="col-sm-12">
				        <div class="form-group">
				            <input type="email" class="form-control" name="email" placeholder="<?php esc_attr_e( 'E-mail', 'homeo' ); ?>" required="required" value="<?php echo esc_attr($email); ?>">
				        </div><!-- /.form-group -->
				    </div>
				    <div class="col-sm-12">
				        <div class="form-group">
				            <input type="text" class="form-control style2" name="phone" placeholder="<?php esc_attr_e( 'Telephone', 'homeo' ); ?>" required="required" value="<?php echo esc_attr($phone); ?>">
				        </div>
				        <div class="form-group">
				            <input type="number" class="form-control style2" name="phone" placeholder="<?php esc_attr_e( 'Post Code', 'homeo' ); ?>" required="required" value="<?php echo esc_attr($phone); ?>">
				        </div><!-- /.form-group -->
				    </div>
				     <div class="col-sm-12">
				        <div class="form-group">
				            <label>What are you looking to do? <span class="prop_contact_fade">(optional)</span></label>
				            <select name="user_reason" id="cars">
				              <option value="" disabled selected>Please Select</option>
                              <option value="current_home">Buy but keep my current home</option>
                              <option value="first_home">Buy and live in my first home</option>
                              <option value="investment_prop">Buy an investment property</option>
                              <option value="buy_sell">Buy and sell property</option>
                              <option value="monitor_market">Monitor the market</option>
                              <option value="represent_client">Representing a client</option>
                            </select>
				            
				        </div><!-- /.form-group -->
				    </div>
				    <div class="col-sm-12">
				        <div class="form-group">
				            <label>Type of Enquiry</label>
				            <select name="user_reason" id="cars">
				              <option value="" disabled selected>Please Select</option>
                              <option value="detail_request">Request details</option>
                              <option value="arrange_view">Arrange viewing</option>
                              <option value="prop_search">Contact me about my property search</option>
                            </select>
				        </div><!-- /.form-group -->
				    </div>
		        </div>
		        <div class="form-group form-group-textarea">
		            <label>Message <span class="prop_contact_fade">(optional)</span></label>
		            <textarea class="form-control" id="txtInput" onkeypress="textareaLengthCheck(this)" name="message" placeholder="<?php esc_attr_e( 'Please include any useful details, i.e. current status, availability for viewings ect.', 'homeo' ); ?>" required="required"></textarea>
		        </div><!-- /.form-group -->
                <div class="rem-chars">
                    Characters Remaining : <span id="lblRemainingCount">500</span>
                </div>
		        <?php if ( WP_RealEstate_Recaptcha::is_recaptcha_enabled() ) { ?>
		            <div id="recaptcha-contact-form" class="ga-recaptcha" data-sitekey="<?php echo esc_attr(wp_realestate_get_option( 'recaptcha_site_key' )); ?>"></div>
		      	<?php } ?>

		      	<input type="hidden" name="post_id" value="<?php echo esc_attr($post->ID); ?>">
		        <button class="button btn btn-theme btn-block" name="contact-form"><?php echo esc_html__( 'Send Enquiry', 'homeo' ); ?></button>
		    </form>
		    <div class="aside-prop-single-form-condition">
		        By submitting this form, you accept our <a href="/privacy-policy-2/">privacy policy</a>. Your personal data will be sent to Savills - Nottingham so that they can respond to your request.
		    </div>
		    <?php //do_action('homeo_after_contact_form', $post); ?>

		    <?php do_action('wp-realestate-single-property-contact-form', $post); ?>
		</div>
	<?php endif;
}

?>
<script>
function textareaLengthCheck(el) {
  var textArea = el.value.length;
  var charactersLeft = 500 - textArea;
  var count = document.getElementById('lblRemainingCount');
  count.innerHTML = charactersLeft;
//   count.innerHTML = "Characters Remaining: " + charactersLeft;
}
</script>