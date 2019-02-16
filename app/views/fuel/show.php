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
					echo "<td><a href='index.php?type=fuel&action=edit&id=" . $data['data']->getId() . "'>Edit</a></td>";
					echo "<td><a href='index.php?type=fuel&action=delete&id=" . $data['data']->getId() . "'>Delete</a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<a href="index.php">Homepage</a>
</body>
</html>