<!DOCTYPE html>
<html>
<head>
	<title>Add fuel to car</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Price</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($data['fuels'] as $fuel) {
					echo "<tr>";
						echo "<td>" . $fuel->getId() . "</td>";
						echo "<td>" . $fuel->getName() . "</td>";
						echo "<td>" . $fuel->getPrice() . "</td>";
						echo "<td><a href='index.php?type=car&action=connectCarFuel&id=" . $data['carId'] . "&fuelId=" . $fuel->getId() . "'>Add fuel</a></td>";
					echo "</tr>";
				} 
			?>
		</tbody>
	</table>
</body>
</html>