<?php

# add image part to a kooaba multipart request
function image_part($boundary, $attr_name, $file_name, $data) {
  $str  = "--" . $boundary . "\r\n";
  $str .= 'Content-Disposition: form-data; name="'. $attr_name .'"; filename="' . $file_name . '"' . "\r\n";
  $str .= 'Content-Transfer-Encoding: binary' ."\r\n";
  $str .= 'Content-Type: image/jpeg' . "\r\n\r\n";
  $str .= $data . "\r\n";
  return $str;
}

# add text part to a kooaba multipart request
function text_part($boundary, $attr_name, $data) {
  $str = "--" . $boundary . "\r\n";
  $str .= 'Content-Disposition: form-data; name="'. $attr_name .'"'."\r\n\r\n";
  $str .= $data . "\r\n";
  return $str;
}

# setup config variables
$query_key = "YmHmIsUKFuLUeP85h7x6eufUyHXa37q21BhZRew6";
$url = "https://query-api.kooaba.com/v4/query";

# Image to query with
    date_default_timezone_set('UTC');
		$time_stamp = $_GET['timestamp'];
    // Url to the IQEngines Query ap
		
		//make filename usable
		
	  $target = "uploads/image" . $time_stamp . ".jpg"; 
  	//print_r($_FILES);
 //In my example, the file is received from an iPhone application.
  if( move_uploaded_file($_FILES["temp"]["tmp_name"],
      $target) ) {
      //CONTINUE
      //echo json_encode("The file has been successfully uploaded to " . $target);
			
  } else{
      echo json_encode("There was an error uploading the file, try again!");
  }

$file_path = $target;
$file_name = $target;
if (file_exists($file_path)) {
  $img = file_get_contents($file_path);
} else {
  die($file_path . ": File does not exist");
}

# Define boundary for multipart message
$boundary = uniqid();

# Construct the body of the request
$body  = image_part($boundary, "image", $file_name, $img);
$body .= "--" . $boundary . "--\r\n";

$context = stream_context_create(array(
              'http' => array(
                   'method' => 'POST',
                   'header' => 'Content-type: multipart/form-data; boundary='.$boundary."\r\n" .
                               'Authorization: Token ' . $query_key,
                   'content' => $body
                   )
              ));

$result = file_get_contents($url, false, $context);

echo $result;

?>

