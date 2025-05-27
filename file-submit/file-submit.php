<?php 

// phpinfo();

if (!isset($_POST['submit'])) {
	header('Location: http://localhost');
	die();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css.css">
	<title>ShyLow's tools</title>
</head>
<body>

<div class="hero">
	<div class="intro">
		<h1>Your image is now being processed. Please wait.</h1>
		<?php

		$is_uploaded = false;

	    $file_err = $_FILES['file-name']['error'];
		if (isset($_FILES['file-name']) && $file_err == 0) {
		    $file_name = $_FILES['file-name']['name'];
		    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));		    
		    $file_size = $_FILES['file-name']['size'];
		    $file_tmp = $_FILES['file-name']['tmp_name'];

		    $img_types = array('png', 'jpg', 'jpeg');

		    if (in_array($file_type, $img_types)) {
		    	if ($file_size < 10000000) { //  < 10mb

				    $new_name = uniqid('', true).$file_name;
				    $upload_path = '/var/www/html/uploads/' . $new_name;

		    		if (move_uploaded_file($file_tmp, $upload_path)) {
		    			$is_uploaded = true;
		    		} else {
			    			echo "image failed to upload to the server.";
		    		}

		    	} else {
		    		echo "image file size is too big";
		    	}


		    } else {
		    	echo "invalid file type";
		    }


		} else {
		    echo "No image file uploaded.";
		}

		if ($is_uploaded) {

			$command = "./remove-bg " . escapeshellarg($upload_path);
			$output = exec($command . " 2>&1", $return_val);

			// echo $output . "<br>";
			// echo getcwd();

			if (file_exists($output)) {				
				echo "<img width='200px' src='../" . $output . "'>";
			} else {
				echo "Cannot find the image file";
			}

		} else {
			echo "Failed to remove the BG";
		}

		?>

	</div>
</div>	

</body>
</html>