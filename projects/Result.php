<?php 
include('server.php');
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$enrollment = $n['enrollment'];
			$course = $n['course'];
			$semester = $n['semester'];
			$modulename = $n['modulename'];
			$ca = $n['ca'];
			$exammarks = $n['exammarks'];
			$totals= $n['totals'];
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL </title>
	<link rel="stylesheet" type="text/css" href="Result.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid padding">
		<h1 class="lead text-center">Fill the Details</h1>
		<form method="post" action="server.php" >

			<input type="hidden" name="id" value="<?php echo $id; ?>">

			<div class="form-group">
				<label>Name</label>
				<input class="form-control" type="text" name="name" value="<?php echo $name; ?>">
			</div>
			<div class="form-group">
				<label>Enrollment No</label>
				<input class="form-control" type="text" name="enrollment" value="<?php echo $enrollment; ?>">
			</div>
			<div class="form-group">
				<label>Course</label>
				<input class="form-control" type="text" name="course" value="<?php echo $course; ?>">
			</div>
			<div class="form-group">
				<label>Semester</label>
				<input class="form-control" type="text" name="semester" value="<?php echo $semester; ?>">
			</div>
			<div class="form-group">
				<label>Module Name</label>
				<input class="form-control" type="text" name="modulename" value="<?php echo $modulename; ?>">
			</div>
			<div class="form-group">
				<label>CA</label>
				<input class="form-control" type="text" name="ca" value="<?php echo $ca; ?>">
			</div>
			<div class="form-group">
				<label>Exam Marks</label>
				<input class="form-control" type="text" name="exammarks" value="<?php echo $exammarks; ?>">
			</div>
			<div class="form-group">
				<label>Totals</label>
				<input class="form-control" type="text" name="totals" value="<?php echo $totals; ?>">
			</div>
			<div class="form-group">

				<?php if ($update == true): ?>
					<button class="btn btn-success" type="submit" name="update" style="background: #556B2F;" >update</button>
				<?php else: ?>
					<button class="btn btn-primary" type="submit" name="save" >Save</button>
				<?php endif ?>
			</div>
		</form>
	</div>
	<div class="container-fluid padding">
		<?php if (isset($_SESSION['message'])): ?>
					<div class="msg">
						<?php 
							echo $_SESSION['message']; 
							unset($_SESSION['message']);
						?>
					</div>
				<?php endif ?>

			<?php $results = mysqli_query($db, "SELECT * FROM info"); ?>
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Enrollment No</th>
						<th>Course</th>
						<th>Semester</th>
						<th>Module Name</th>
						<th>CA</th>
						<th>Exam Marks</th>
						<th>Totals</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['enrollment']; ?></td>
						<td><?php echo $row['course']; ?></td>
						<td><?php echo $row['semester']; ?></td>
						<td><?php echo $row['modulename']; ?></td>
						<td><?php echo $row['ca']; ?></td>
						<td><?php echo $row['exammarks']; ?></td>
						<td><?php echo $row['totals']; ?></td>
						<td>
							<a href="Result.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
						</td>
						<td>
							<a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
						</td>
					</tr>
				<?php } ?>
			</table>			
	</div>
</body>
</html>
