<!DOCTYPE html>
<html>
<head>
	<title>Home fuels</title>
</head>
<body>
	<br><br>
	<a href="index.php?type=fuel&action=create">Create new fuel</a>
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
				foreach($data['data'] as $fuel) {
					echo "<tr>";
						echo "<td>" . $fuel->getId() . "</td>";
						echo "<td>" . $fuel->getName() . "</td>";
						echo "<td>" . $fuel->getPrice() . "</td>";
						echo "<td><a href='index.php?type=fuel&action=show&id=" . $fuel->getId() . "'>View</a></td>";
						echo "<td><a href='index.php?type=fuel&action=edit&id=" . $fuel->getId() . "'>Edit</a></td>";
						echo "<td><a href='index.php?type=fuel&action=delete&id=" . $fuel->getId() . "'>Delete</a></td>";
					echo "</tr>";
				}
			}
			?>
		</tbody>
	</table>
</body>
</html>