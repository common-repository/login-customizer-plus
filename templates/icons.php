<?php

	if(isset( $_POST["lcp_submit_socials"] ) && (isset( $_POST['lcp_form_nonce'] ) || wp_verify_nonce( $_POST['lcp_form_nonce'], 'lcp_verify_nonce' ) ))

	{

		$lcp_fb_url = $_POST['lcp_footer_fb'];
		$lcp_fb = esc_url( $lcp_fb_url ); /*esc facebook url*/

		if( !empty($lcp_fb) ) {

			delete_option( 'admin_fa_fb' );		
			add_option( 'admin_fa_fb', $lcp_fb);

		}

		$lcp_tw_url = $_POST['lcp_footer_tw'];
		$lcp_tw = esc_url( $lcp_tw_url ); /*esc twitter url*/

		if( !empty($lcp_tw) ) {

			delete_option( 'admin_fa_tw' );		
			add_option( 'admin_fa_tw', $lcp_tw);

		}

		$lcp_ig_url = $_POST['lcp_footer_ig'];
		$lcp_ig = esc_url( $lcp_ig_url ); /*esc instagram url*/

		if( !empty($lcp_ig) ) {

			delete_option( 'admin_fa_ig' );		
			add_option( 'admin_fa_ig', $lcp_ig);

		}

		$lcp_fa_icon_color_raw = $_POST['faiconclr'];
		$lcp_fa_icon_color = sanitize_hex_color( $lcp_fa_icon_color_raw ); /*sanitize social media icon color*/

		if( !empty($lcp_fa_icon_color) ) {

			delete_option( 'admin_fa_icon_clr' );		
			add_option( 'admin_fa_icon_clr', $lcp_fa_icon_color);

		}

	}

	// Fetch All Setttings

	$lcp_fa_iconfb = get_option('admin_fa_fb',true);
	$lcp_fa_icontw = get_option('admin_fa_tw',true);
	$lcp_fa_iconig = get_option('admin_fa_ig',true);
	$lcp_fa_iconclr = get_option('admin_fa_icon_clr',true);
	// var_dump($lcp_fa_iconclr);
	// die();

?>
<?php wp_enqueue_media(); ?>
<div class="lcp-form-settings"><!--lcp-form-settings-->
			<h2> Add Social Links to your login Page</h2>
		<div class="lcp-form"><!--lcp-form-->
			<form method="post" name="login-customization-plus-form" enctype="multipart/form-data">
				<table class="form-table">
					<tbody>

						<tr class="form-field form-required">
							<th scope="row"><label for="lcp_footer_fb">Facebook</label></th>
							<td>
						    	<input type="url" pattern="https?://.+" name="lcp_footer_fb" id="lcp_footer_fb" placeholder="Enter Facebook URL" value="<?php echo $lcp_fa_iconfb; ?>" /> 
						    </td>
					    </tr>

					    <tr class="form-field form-required">
							<th scope="row"><label for="lcp_footer_tw">Twiter</label></th>
						    <td>
						    	<input type="url" pattern="https?://.+" name="lcp_footer_tw" id="lcp_footer_tw" placeholder="Enter Twitter URL" value="<?php echo $lcp_fa_icontw; ?>" />
						    </td>
					    </tr>

					    <tr class="form-field form-required">
						    <th scope="row"><label for="lcp_footer_ig">Instagram</label></th>
						    <td>
						    	<input type="url" pattern="https?://.+" name="lcp_footer_ig" id="lcp_footer_ig" placeholder="Enter Instagram URL" value="<?php echo $lcp_fa_iconig; ?>" />
						    </td>
					    </tr>

					    <tr id="lcp_fa_icon_clr" class="form-field form-required">
							<th scope="row"><label for="lcp_fa_icn_clr">Social Media Icon Color</label></th>
							<td><input type="text" name="faiconclr" class="my-color-field" id="my-color-field" value="<?php echo $lcp_fa_iconclr; ?>"/></td>
					    </tr>

					    <tr id="lcp_ft_tag_clr" class="form-field form-required lcp-ft-tag-clr">
							<th scope="row"><label for="lcp_ft_tag">Footer Tag Color</label></th>
							<td><input type="text" name="fttagclr" class="my-color-field" id="my-color-field"  /></td>
					    </tr>

					 </tbody>

				</table>

				 <br>

				<input type="submit" class="button button-primary button-large" name="lcp_submit_socials" value="Save Setting">

				<?php wp_nonce_field( 'lcp_verify_nonce', 'lcp_form_nonce' ); ?>

				</form>
			</div>
		</div>


