<!DOCTYPE html>
<html>
<head>
	<title>Show car</title>
</head>
<body>
	<?php
		if(isset($data['message'])) {
			echo "<h4>" . $data['message'] . "</h4>";
		}
	?>
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
			if(!empty($data)) {
				echo "<tr>";
					echo "<td>" . $data['data']->getId() . "</td>";
					echo "<td>" . $data['data']->getName() . "</td>";
					echo "<td>" . $data['data']->getPrice() . "</td>";
					echo "<td><a href='index.php?type=car&action=edit&id=" . $data['data']->getId() . "'>Edit</a></td>";
					echo "<td><a href='index.php?type=car&action=delete&id=" . $data['data']->getId() . "'>Delete</a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<br><br>
	<h3>Fuels for this car:</h3>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>
				<th>PRICE</th>
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