<?php
add_filter( 'wpcf7_display_message', 'validaiton_messages_fail', 10, 2 );

function validaiton_messages_fail( $message, $status ) { 
  $submission = WPCF7_Submission::get_instance();
  $posted_data = $submission->get_posted_data();
  if(!isset($posted_data['LoggedUserId'])) {
    $message = __( 'Authentication problem', '');
  }
  return $message;
}

?>