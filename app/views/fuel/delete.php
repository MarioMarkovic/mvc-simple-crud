<!DOCTYPE html>
<html>
<head>
	<title>Fuel delete</title>
</head>
<body>
	<?php 
		if(isset($data['message']) && isset($data['id'])) {
			echo "<h4>" . $data['message'] . " " . $data['id'] . "</h4>";
 		}
	?>
	<a href="index.php">Homepage</a>
</body>
</html>