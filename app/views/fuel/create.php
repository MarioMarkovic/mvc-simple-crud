<!DOCTYPE html>
<html>
<head>
	<title>Create fuel</title>
</head>
<body>
	<form method="POST" action="index.php?type=fuel&action=insert">
		<label for="name">Name</label>
		<input type="text" name="name" id="name">

		<label for="price">Price</label>
		<input type="text" name="price" id="price">

		<button type="submit">Save</button>
	</form>
</body>
</html>