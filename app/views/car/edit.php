<!DOCTYPE html>
<html>
<head>
	<title>Car edit</title>
</head>
<body>
	<form method="POST" action="index.php?type=car&action=update&id=<?=$data['data']->getId()?>">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="<?=$data['data']->getName()?>">

		<label for="price">Price</label>
		<input type="text" name="price" id="price" value="<?=$data['data']->getPrice()?>">

		<button type="submit">Save</button>
	</form>

	<br><br>
	<h3>Fuels for this car:</h3>
	<a href="index.php?type=car&action=addFuel&id=<?=$data['data']->getId()?>">Add fuel to car</a><br><br>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>PRICE</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(!empty($data['data']->getFuels())) {
					foreach($data['data']->getFuels() as $fuel) {
						echo "<tr>";
							echo "<td>" . $fuel->getId() . "</td>";
							echo "<td>" . $fuel->getName() . "</td>";
							echo "<td>" . $fuel->getPrice() . "</td>";
							echo "<td><a href='index.php?type=car&action=removeCarFuel&id=" . $data['data']->getId() . "&fuelId=" . $fuel->getId() . "'>Remove from this car</a></td>";
						echo "</tr>";
					}
				}
			?>
		</tbody>
	</table>
	<br>
	<br>
	<a href="index.php">Homepage</a>
</body>
</html>