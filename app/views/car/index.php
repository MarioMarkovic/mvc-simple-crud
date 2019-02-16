<!DOCTYPE html>
<html>
<head>
	<title>Home cars</title>
</head>
<body>
	<a href="index.php?type=car&action=create">Create new car</a>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>PRICE</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($data)) {
				foreach($data['data'] as $car) {
					echo "<tr>";
						echo "<td>" . $car->getId() . "</td>";
						echo "<td>" . $car->getName() . "</td>";
						echo "<td>" . $car->getPrice() . "</td>";
						echo "<td><a href='index.php?type=car&action=show&id=" . $car->getId() . "'>View</a></td>";
						echo "<td><a href='index.php?type=car&action=edit&id=" . $car->getId() . "'>Edit</a></td>";
						echo "<td><a href='index.php?type=car&action=delete&id=" . $car->getId() . "'>Delete</a></td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
</body>
</html>