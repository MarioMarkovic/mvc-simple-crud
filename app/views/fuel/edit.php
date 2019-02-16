<!DOCTYPE html>
<html>
<head>
	<title>Fuel edit</title>
</head>
<body>
	<form method="POST" action="index.php?type=fuel&action=update&id=<?=$data['data']->getId()?>">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="<?=$data['data']->getName()?>">

		<label for="price">Price</label>
		<input type="text" name="price" id="price" value="<?=$data['data']->getPrice()?>">

		<button type="submit">Save</button>
	</form>
</body>
</html>