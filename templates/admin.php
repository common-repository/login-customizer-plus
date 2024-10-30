

<?php wp_enqueue_media(); ?>
<?php 

	if(isset( $_POST["lcp_submit_images"] ) && (isset( $_POST['lcp_form_nonce'] ) || wp_verify_nonce( $_POST['lcp_form_nonce'], 'lcp_verify_nonce' ) ))
	{
		/*upload logo*/
		$uploadedlogofile = $_POST['image_url'];
		$icon = sanitize_text_field( $uploadedlogofile );

		if ( !empty($icon) ) {

			delete_option( 'admin_icon' );		
			add_option( 'admin_icon', $icon);

		}

		$uploadedbgimgfile = $_POST['bgimage_url'];
		$bgimage = sanitize_text_field( $uploadedbgimgfile );

		if( !empty( $bgimage) ) {

			delete_option( 'admin_bgimg' );
			add_option( 'admin_bgimg', $bgimage );
		}

		$lcp_bgclr_raw = $_POST['clrpicker'];
		$lcp_bgclr = sanitize_hex_color( $lcp_bgclr_raw ); /*sanitize background-color*/

		if( !empty($lcp_bgclr) ) {

			delete_option( 'admin_bgclr' );		
			add_option( 'admin_bgclr', $lcp_bgclr);

		}
		
		
		$ft_option = sanitize_text_field( $_POST['lcp_ft_text_option'] );
		 /*sanitizing select option value*/

		if($ft_option=='y') {

			delete_option( 'admin_ft_text');
			add_option( 'admin_ft_text', $ft_option);	

		}elseif($ft_option=='n') { 

			delete_option( 'admin_ft_text');
			add_option( 'admin_ft_text', ''); 

		} else { }


		$option = sanitize_text_field( $_POST['lcp_bg_option'] ); /*sanitizing select option value*/

		if($option=='c') { 

			delete_option( 'admin_bgimg' );    
	    	add_option( 'admin_bgimg', '');	

		}elseif($option=='i') {

			delete_option( 'admin_bgclr' );
			add_option( 'admin_bgclr', '');

		} else { }

	}

		/*fetch all settings*/

		$icon = get_option('admin_icon',true);
		$bgimage = get_option('admin_bgimg',true);
		$lcp_bgcolor = get_option('admin_bgclr',true);
		$lcp_ft_text = get_option('admin_ft_text',true);

?>

<script type="text/javascript">
	$(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});
</script>


<div class="wrap">

		<h1>LOGIN FORM CUSTOMIZATION SETTINGS</h1><hr/>

    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a data-toggle="tab" href="#Image">Manage Design</a></li>
        <li><a data-toggle="tab" href="#Social">Manage Social Icons</a></li>
        <li><a data-toggle="tab" href="#About">About</a></li>
    </ul>
    <div class="tab-content">
        <div id="Image" class="tab-pane active">
            <div class="lcp-form-settings"><!--lcp-form-settings-->
				<h2>Change Image Or Background Color</h2><hr/>
		<div class="lcp-form"><!--lcp-form-->
			<form method="post" name="login-customization-plus-form" enctype="multipart/form-data">
				<table class="form-table">
					<tbody>
						<tr class="form-field form-required">
						    <td colspan="2">
								<tr class="form-field form-required">
									<th scope="row" ><label for="lcp-icon">Logo</label></th>
								    <td>
								    	<img id="preview" style="max-height: 150px;" src="<?php echo $icon; ?>" alt="">
								    	<input id="image_url" style="display: none;" type="text" name="image_url" value="<?php echo $icon ?>" /><br/>
								       	<input type="button" class="button button-secondary" id="lcp_logo" name="lcp_logo" value="Select Image"><br />
								    </td>
						       	</tr>
							</td>
				        </tr>
				        <tr class="form-field form-required">
						    <th scope="row"><label for="selectoption">Background Option</label></th>
						    <td><select id = "lcp_bg_option" name = "lcp_bg_option" >
						    	   	<option value="i" selected>Image</option>
							       	<option value="c">Color</option>
						        </select>
						    </td>
				        </tr>
				        <tr>
				        	<td colspan="2" class="lcp-bg-option" style="padding-left: 0px;">
				        		<table>
									<tr class="form-field form-required" id="lcp_background_img">
										<th scope="row"><label for="lcp-bg-img">Background Image</label></th>
								    	<td>
								    		<img id="bgpreview" style="max-height:150px;" src="<?php echo $bgimage;?>" alt="">
								    		<input id="bgimage_url" style="display: none;" type="text" size="30" name="bgimage_url" value="<?php echo $bgimage ?>"/><br/>					    		
								    		<input type="button" id="lcp_bgimg" name="lcp_bgimg" class="button button-secondary" value="Select Background Image">
								    		<p class="text-muted">Ideal image should be 1920px by 800px (Width by Height)</p> 
								    	</td>
						        	</tr>
									<tr class="form-field form-required lcp-background-clr" id="lcp_background_clr" >
										<th scope="row"><label for="lcp-bg-color">Background Color</label></th>
								        <td><input type="text" name="clrpicker" class="my-color-field"
								        id="my-color-field"  value="<?php echo $lcp_bgcolor; ?>" /></td>
						        	</tr>
					        	</table>
							</td>
						</tr>
					    <tr class="form-field form-required">
						    <th scope="row"><label for="selectoption">Powered by TechuptoDate</label></th>
						    <td><select id = "lcp_ft_text_option" name = "lcp_ft_text_option" >
						    	   	<option value="n"  <?php echo( $lcp_ft_text == "n" ? ' selected="selected"' : ''); ?> >No-I don't want to display</option>
						    	   	<option value="y" <?php echo($lcp_ft_text == "y" ?  ' selected="selected"' : ''); ?> >Yes-I want to display</option>	
						        </select>
						        <p class="text-muted">Can we show a stylish footer credit at the bottom the page</p>
						    </td>
				        </tr>
				    </tbody>
				</table><br />
				<input type="submit" class="button button-primary button-large" name="lcp_submit_images" value="Save Setting">
				<?php wp_nonce_field( 'lcp_verify_nonce', 'lcp_form_nonce' ); ?><!--create nonce-->
			</form>

			<?php if($bgimage=='') { ?> 
			<script type="text/javascript">
				jQuery("#lcp_bg_option").val('c');
				jQuery("#lcp_background_clr").show();
				jQuery("#lcp_background_img").hide();
			</script>

				<?php } ?>
			</div><!--lcp-form-->
		</div>			
        </div>
        <div id="Social" class="tab-pane">

            <?php require_once plugin_dir_path( __FILE__ ).'../templates/icons.php'; ?>

        </div>
        <div id="About" class="tab-pane">
            <?php require_once plugin_dir_path( __FILE__ ).'../templates/about.php'; ?>
        </div>
    </div>
</div>


<!-- <style type="text/css">


</style>


<div class="wrap">

		<h1>LOGIN FORM CUSTOMIZATION SETTINGS</h1><hr/>

	<ul class="nav nav-tabs" id="myTab">

		<li class="active"><a href="#tab-1">Image/Color</a></li>
		<li><a href="#tab-2">Social</a></li>
		<li><a href="#tab-3">About</a></li>
		
	</ul>

<div class="tab-content">

	<div id="tab-1" class="tab-pane active">

		<div class="lcp-form-settings">
				<h2>Change Image Or Background Color</h2><hr/>
		<div class="lcp-form"><
			<form method="post" name="login-customization-plus-form" enctype="multipart/form-data">
				<table class="form-table">
					<tbody>
						<tr class="form-field form-required">
						    <td colspan="2">
								<tr class="form-field form-required">
									<th scope="row" ><label for="lcp-icon">Icon</label></th>
								    <td>
								    	<img id="preview" width="150px" height="50px" src="<?php echo $icon; ?>" alt="">
								    	<input id="image_url" type="text" size="30" name="image_url" value="<?php echo $icon ?>" /><br/>
								       	<input type="button" class="button button-secondary" id="lcp_logo" name="lcp_logo" value="Select Image"><br />
								    </td>
						       	</tr>
							</td>
				        </tr>
				        <tr class="form-field form-required">
						    <th scope="row"><label for="selectoption">Background Option</label></th>
						    <td><select id = "lcp_bg_option" name = "lcp_bg_option" >
						    	   	<option value="i" selected>Image</option>
							       	<option value="c">Color</option>
						        </select>
						    </td>
				        </tr>
				        <tr>
				        	<td colspan="2" class="lcp-bg-option" style="padding-left: 0px;">
				        		<table>
									<tr class="form-field form-required" id="lcp_background_img">
										<th scope="row"><label for="lcp-bg-img">Background Image</label></th>
								    	<td>
								    		<img id="bgpreview" width="150px" height="50px"	 src="<?php echo $bgimage;?>" alt="">
								    		<input id="bgimage_url" type="text" size="30" name="bgimage_url" value="<?php echo $bgimage ?>" /><br/>					    		
								    		<input type="button" id="lcp_bgimg" name="lcp_bgimg" class="button button-secondary" value="Select Background Image">
								    		<p class="text-muted">Ideal image should be 1920px by 800px (Width by Height)</p> 
								    	</td>
						        	</tr>
									<tr class="form-field form-required lcp-background-clr" id="lcp_background_clr" >
										<th scope="row"><label for="lcp-bg-color">Background Color</label></th>
								        <td><input type="text" name="clrpicker" class="my-color-field"
								        id="my-color-field"  value="<?php echo $lcp_bgcolor; ?>" /></td>
						        	</tr>
					        	</table>
							</td>
						</tr>
					    <tr class="form-field form-required">
						    <th scope="row"><label for="selectoption">Powered by TechuptoDate</label></th>
						    <td><select id = "lcp_ft_text_option" name = "lcp_ft_text_option" >
						    	   	<option value="n"  <?php echo( $lcp_ft_text == "n" ? ' selected="selected"' : ''); ?> >No-I don't want to display</option>
						    	   	<option value="y" <?php echo($lcp_ft_text == "y" ?  ' selected="selected"' : ''); ?> >Yes-I want to display</option>	
						        </select>
						        <p class="text-muted">Can we show a stylish footer credit at the bottom the page</p>
						    </td>
				        </tr>
				    </tbody>
				</table><br />
				<input type="submit" class="button button-primary button-large" name="lcp_submit_images" value="Save Setting">
				<?php wp_nonce_field( 'lcp_verify_nonce', 'lcp_form_nonce' ); ?>
			</form>

			<?php if($bgimage=='') { ?> 
			<script type="text/javascript">
				jQuery("#lcp_bg_option").val('c');
				jQuery("#lcp_background_clr").show();
				jQuery("#lcp_background_img").hide();
			</script>

				<?php } ?>
			</div>
		</div>			
	</div>

	<div id="tab-2" class="tab-pane">

		<?php require_once plugin_dir_path( __FILE__ ).'../templates/icons.php'; ?>

	</div>

	<div id="tab-3" class="tab-pane ">
						
		<?php require_once plugin_dir_path( __FILE__ ).'../templates/about.php'; ?>

	</div>
  </div>
</div>


 -->