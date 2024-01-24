<?php
$json = file_get_contents('evaluation-20190711.json');
$data = json_decode($json, true);

function age($DOB)
{
	$dob1 = new DateTime($DOB);
	$now = new DateTime();
	$age = $now->diff($dob1)->y;

	return $age;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">

</head>

<body>
	<H2>SIMPLE HTML TABLE</H2>
	<div class="OuterDiv">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Age</th>
					<th>Address</th>
					<th>Working Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data['data'] as $user) : ?>
					<tr>

						<td><?php echo $user['name']; ?></td>
						<td><?php echo age($user['date_of_birth']); ?></td>
						<td><?php echo $user['address'] ?></td>
						<td><?php echo $user['working_status'] ? 'Yes' : 'No' ?></td>
						<td><a href="exportcsv.php?id=<?php echo $user['id']; ?>">Export CSV</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>

</html>