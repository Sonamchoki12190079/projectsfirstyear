<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', 'stdpro2020?', 'db_connect');


	// initialize variables
	$name = "";
	$enrollment = "";
	$course = "";
	$semester = "";
	$modulename = "";
	$ca = "";
	$exammarks = "";
	$totals = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$enrollment = $_POST['enrollment'];
		$course = $_POST['course'];
		$semester = $_POST['semester'];
		$modulename = $_POST['modulename'];
		$ca = $_POST['ca'];
		$exammarks = $_POST['exammarks'];
		$totals = $_POST['totals'];

		mysqli_query($db, "INSERT INTO info (name, enrollment, course, semester, modulename, ca, exammarks, totals) VALUES ('$name', '$enrollment', '$course', '$semester', '$modulename', '$ca', '$exammarks', '$totals')"); 
		$_SESSION['message'] = "Address saved"; 
		header('location: Result.php');
	}


	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$enrollment = $_POST['enrollment'];
		$course = $_POST['course'];
		$semester = $_POST['semester'];
		$modulename = $_POST['modulename'];
		$ca = $_POST['ca'];
		$exammarks = $_POST['exammarks'];
		$totals = $_POST['totals'];

		mysqli_query($db, "UPDATE info SET name='$name', enrollment='$enrollment', course='$course', semester='$semester', modulename='$modulename', ca='$ca', exammarks='$exammarks', totals='$totals' WHERE id=$id");
		$_SESSION['message'] = "Address updated!"; 
		header('location: Result.php');
	}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM info WHERE id=$id");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: Result.php');
}


	$results = mysqli_query($db, "SELECT * FROM info");


?>

