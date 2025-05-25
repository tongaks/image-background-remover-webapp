<?php 
$file_name = $_POST['file-name'];
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
		<h2>Filename: <?php echo $file_name; ?> </h2>
		<?php

		if (isset($_FILES['file-name'])) {
		    $uploads_dir = '/var/www/html/uploads/';
		    $file_path = $uploads_dir . basename($_FILES['file-name']['name']);
		    $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));		    
		    $uploadOk = 1;

		    if (isset($_POST['submit'])) {
		        $check = getimagesize($_FILES['file-name']['tmp_name']);
		        if ($check !== false) {
		            $uploadOk = 1;
		        } else {
		            echo "File is not an image.<br>";
		            $uploadOk = 0;
		        }
		    }

		    if ($uploadOk) {
		        if (move_uploaded_file($_FILES['file-name']['tmp_name'], $file_path)) {
		            echo "File uploaded.";
		        } else {
		            echo "Failed to upload file.";
		        }
		    }
		} else {
		    echo "No file uploaded.";
		}

		?>

	</div>
</div>	

</body>
</html>