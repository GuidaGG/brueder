<?php
/**
 * The template for displaying the homepage.
 *
 *
 * Template name: Thumbnail 
 *
 * @package Die_Brueder_Shop
 */

	
	$post = get_post($_GET['id']);
	
	if($post->post_type == 'post' || $post->post_type == 'product'):
		
		if($post->post_status=="publish"):
			if($post->post_type == 'post'):
				//content to be turned into image
				$content = 'article';
			else:
				$content = "#shop-thumbnail";
			endif;
		?>
		<div id="spinner-container"	></div>

		<div id="spinner-content"><h1>GENERATING IMAGE</h1>
			<div class="spinner"></div>
		</div>
	
		<div id="generation-content">
	
  		<form  method="post" enctype="multipart/form-data" id="thumbnail-form" name="form" style="display: none">
  				<?php wp_nonce_field( 'die_brueder_thumbnail', 'my_nonce_field' ); ?>
			<input type="hidden" name="img" id="img_val" value="wwww" />

		<input type="hidden" name="post_id" id="post_id" value="<?php echo $post->ID; ?>"/>
		<input type='hidden' name='action' value='die_brueder_thumbnail'>
		<input type="hidden" id="file" name="file" value="">;
		<button name="save_thumbnail" type="submit" class="button button-primary button-large" id="save_thumbnail">Save Thumbnail</button>
		
		</form>
	

		<div class="results" style="display: none"><?php echo wp_remote_retrieve_body( wp_remote_get( get_permalink($post->ID) ) ); ?></div>
	
		<div id="contentthumbnail" style="background-color:#fff;"></div>
			
		</div>
	
		<script>
			
		
		var fileOfBlob ;
		jQuery( document ).ready(function() {
			jQuery("#spinner-container").show();	
          	jQuery("#spinner-content").show();	
			jQuery("#contentthumbnail").html(jQuery("<?php echo $content; ?>").html());
			jQuery(".related").css("margin-top", "0px");
			jQuery(".related").html('');
			jQuery('.back-shop-2').hide();
			jQuery('.back-shop-1').hide();
			
			jQuery("#contentthumbnail").html2canvas({
				onrendered: function (canvas) {
			
					canvas.toBlob(function(blob) {
		
		 				    var newImg = document.createElement('img'),
	      						url = URL.createObjectURL(blob);
	      			
	      					fileOfBlob =  new File([blob], 'thumbnail'+jQuery("#post_id").val()+'.png');
	      			
	 						
	 						newImg.src = url;
	 						jQuery('#file').val(url);
	  						//document.body.appendChild(newImg);
	  						jQuery('#save_thumbnail').click();
						
						});

					
					
	
				}
			});

			
		});
		 
		jQuery("#thumbnail-form").submit(function (e) {
		e.preventDefault();
	
		var blob =  jQuery('#file').val();
		var post_id = jQuery("#post_id").val();
		var myForm = document.getElementById("thumbnail-form");
		var data = new FormData(myForm);
        data.append('file', fileOfBlob );
 		console.log(data);
			jQuery.ajax({
        	type: "POST",
        	url: "<?php echo admin_url("admin-ajax.php"); ?>",
    
        	timeout:300000,
       	 	 data: data,
             contentType: false,
             processData: false,

         success: function (result) {
      		jQuery("#spinner-container").hide();	
          	jQuery("#spinner-content").hide();	
          

          /*	if(result!=0){
          			alert("Image saved!");
          	}
          	else{
          			alert("There was an error creating the image. To fix this remove some of the big pictures from the post before 		creating the thumbnail. After the thumbnail is created you can add the pictures back and when prompt to create a new thumbnail just press the back button.")
          	}*/
          	window.location.href = "<?php echo admin_url().'post.php?post='.$post->ID.'&action=edit'; ?>";
        	},
        
        	error: function (result) {
     		alert(result);
     		console.log(result);
        	}
   		 });
	
		});

		</script>
<?php
		endif;
  endif;


