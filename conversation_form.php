<?php
if ( ! is_user_logged_in() ) {
	return;
} ?>

<?php if ( $error ) : ?>
	<div class="alert alert-danger" role="alert"><?php echo esc_attr( $error, 'help-scout-desk' ) ?></div>
<?php endif ?>

<form action="" method="post" enctype="multipart/form-data" id="hsd_message_form" class="form" role="form">
	
	<?php do_action( 'hsd_form_start' ) ?>

	<?php if ( ! $conversation_view ) : ?>
		<?php do_action( 'hsd_form_subject' ) ?>
		<div class="form-group">
			<label for="subject"><?php _e( 'Subject', 'help-scout-desk' ) ?></label>
			<input type="text" class="form-control" id="hsd_subject" name="subject" placeholder="<?php esc_attr_e( 'How can we help?', 'help-scout-desk' ) ?>" required="required">
		</div>
	<?php endif ?>
	
	<?php do_action( 'hsd_form_message' ) ?>

	<div class="form-group">
		<label for="message"><?php _e( 'Message', 'help-scout-desk' ) ?></label>
		<textarea name="message" class="form-control" id="hsd_message" rows="10" placeholder="<?php esc_attr_e( 'Please include any information that you think will help us generate a speedy response.', 'help-scout-desk' ) ?>" required="required" ></textarea>
		<?php if ( $conversation_view ) : ?>
			<p class="help-block"><?php _e( 'This will add a message to our current conversation.', 'help-scout-desk' ) ?></p>
		<?php endif ?>
	</div>

	<?php do_action( 'hsd_form_attachments' ) ?>

	<div class="form-group">
		<label for="message_attachment"><?php _e( 'Add attachments', 'help-scout-desk' ) ?></label><br>
		<p class="small">10MB file restriction. If you need to send more than 10MB in files please share a downloadable link in the <strong>Message</strong> or let us know and we can provide you with a temporary location to upload your files.</p>
		<input type="file" id="message_attachment" name="message_attachment[]" multiple onchange="Filevalidation()">
		<p id="size small"></p> 
	</div>

	<?php /*/  ?>
	<?php do_action( 'hsd_form_close_thread' ) ?>

	<?php if ( $conversation_view ) : ?>
		<div id="close_thread_check" class="checkbox">
			<label for="close_thread"><input type="checkbox" name="close_thread" id="close_thread"> <?php _e( 'Close Support Thread', 'help-scout-desk' ) ?></label>
		</div>
	<?php endif ?>
	<?php /**/  ?>
	
	<?php do_action( 'hsd_form_hidden_values' ) ?>

	<?php if ( $conversation_view ) : ?>
		<input type="hidden" name="hsd_conversation_id" value="<?php echo esc_attr( $_GET['conversation_id'] ) ?>">
	<?php endif ?>
	<input type="hidden" name="mid" value="<?php echo esc_attr( $mid ) ?>">
	<input type="hidden" name="hsd_nonce" value="<?php echo wp_create_nonce( HSD_Controller::NONCE ) ?>">

	<?php do_action( 'hsd_form_submit' ) ?>

	<button type="submit" id="hsd_submit" class="button"><?php _e( 'Submit', 'help-scout-desk' ) ?></button>

	<?php do_action( 'hsd_form_end' ) ?>
</form>


<script> 
Filevalidation = () => { 
        const fi = document.getElementById('message_attachment'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 10240) { 
                    alert( 
                      "File too Big, please select a file less than 10mb"); 
                    document.getElementById('message_attachment').value = "";

                }  else { 
                    document.getElementById('size').innerHTML = '<b>'
                    + file + '</b> KB'; 
                } 
            } 
        } 
    } 
</script>
