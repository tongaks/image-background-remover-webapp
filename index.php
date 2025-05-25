<?php  
// echo phpinfo();
?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css.css">
	<title>ShyLow's tools</title>
</head>
<body>

<div class="hero">
	<div class="intro">
		<h1>Hello, welcome to ShyLow's tools</h1>
		<h2>Image background remover</h2>
	</div>

	<div class="file-input" id="file-input-cnt">
		<form action="file-submit/file-submit.php" method="POST" enctype="multipart/form-data">
			<input type="file" id="file-drop" accept="image/*" name="file-name" placeholder="Drop the file here">
			<input type="submit" value="Submit" id="submit-btn" name="submit">			
		</form>
	</div>
</div>	

<script type="text/javascript" src="index.js"></script>
</body>
</html>