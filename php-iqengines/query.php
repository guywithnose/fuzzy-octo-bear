<?php     
    date_default_timezone_set('UTC');
		$time_stamp = date('YmdHis');
    // Url to the IQEngines Query api
    $url = "http://api.iqengines.com/v1.2/query/";
		
		//make filename usable
		
	  $target = "uploads/image" . $time_stamp. ".jpg"; 
  	print_r($_FILES);
 //In my example, the file is received from an iPhone application.
  if( move_uploaded_file($_FILES["temp"]["tmp_name"],
      "uploads/" . $_FILES["temp"]["name"]) ) {
      //CONTINUE
      echo json_encode("The file has been successfully uploaded to " . $target);
			
  } else{
      echo json_encode("There was an error uploading the file, try again!");
  }
	sleep(5);
	exit;
    // API variables
    $api_key = 'dd8ed7f3899742e7877f5fb1b3e91893';
    $api_secret = 'dd57c5a4ff984dbbbdfaa56eb6cd3a7e';
    $filename = $target;
    $img = '@'.realpath($filename);
    $json = '1';

    // Compose the api raw signature string
    $raw_string = 'api_key'.$api_key.'img'.$filename.'json'.$json.'time_stamp'.$time_stamp;
    
    // Encode the api signature
    $api_sig = hash_hmac("sha1", $raw_string, $api_secret, false);
    
    // Preparing the data we will be sending
    $fields = array(
        'api_key' => $api_key,
        'img' => $img,
        'api_sig' => $api_sig,
        'time_stamp' => $time_stamp,
        'json' => $json
    );
    
    // URL-ify the data for the POST 
    $fields_string = "";
    foreach($fields as $key=>$value) { 
        $fields_string .= $key.'='.$value.'&'; 
    }
    rtrim($fields_string,'&');
    
    // Here I make the cURL request to the API
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // RETURN THE CONTENTS OF THE CALL
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_HEADER, false);  // DO NOT RETURN HTTP HEADERS 
    $response = curl_exec($ch);

    // View the response from the API server
    print_r( $response);
?>
