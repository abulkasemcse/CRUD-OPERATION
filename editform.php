<?php
error_reporting(~E_NOTICE);

require_once 'PDO_Config.php';

if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
	$id = $_GET['edit_id'];
	$stmt_edit = $DB_CON->prepare('SELECT userName,userProfession,marks,userEmail FROM tbl_users WHERE id=:uid');
	$stmt_edit->execute(array(':uid' => $id));

	$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
	extract($edit_row);
} else {
	header('Location:index.php');
}

if (isset($_POST['btn_save_update'])) {
	$username = $_POST['user_name'];
	$userjob = $_POST['user_job'];
	$userEmail = $_POST['user_email'];
	$marks = $_POST['marks'];

	if (empty($username)) {
		$errorMSG = "Please enter username";
	} else if (empty($userjob)) {
		$errorMSG = "Please enter employees job";
	}

	 elseif(empty($userEmail)){
	 	$errorMSG = "Please enter employees Email";
	 }

	
	if (!isset($errorMSG)) {
		$stmt = $DB_CON->prepare('UPDATE tbl_users SET userName=:uname,userProfession=:ujob,marks=:marks,   userEmail=:uemail WHERE id=:uid');

		$stmt->bindParam(':uname', $username);
		$stmt->bindParam(':ujob', $userjob);
		$stmt->bindParam(':marks', $marks);
		$stmt->bindParam(':uemail', $userEmail);
		$stmt->bindParam(':uid', $id);

		if ($stmt->execute()) {

?>

			<script>
				alert('Successfully Updated...');
				window.location.href = 'index.php';
			</script>

<?php
		} else {
			$errorMSG = "Sorry Data Could Not Be Updated!";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Edit Students Information</title>
</head>

<body>
	<div>
		<div>
			<h1>Update Profile...</h1><a href="index.php">All Students</a>
		</div>

		<form method="POST" enctype="multipart/form-data">

			<?php

			if (isset($errorMSG)) {
			?>
				<div>
					<span></span>&nbsp;<?php echo $errorMSG; ?>
				</div>
			<?php
			}
			?>

			<table>

				<tr>
					<td>
						<label>Name</label>
					</td>
					<td>
						<input type="text" name="user_name" value="<?php echo $userName; ?>">
					</td>
				</tr>

				
				<tr>
					<td>
						<label>Subject</label>
					</td>
					<td>
						<input type="text" name="user_job" value="<?php echo $userProfession; ?>">
					</td>
				</tr>

				<tr>
					<td>
						<label>Marks</label>
					</td>
					<td>
						<input type="text" name="marks" value="<?php echo $marks; ?>">
					</td>
				</tr>
				
				 <tr>
					<td>
						<label>Email</label>
					</td>
					<td>
						<input type="email" name="user_email" value="<?php echo $userEmail; ?>">
					</td>
				</tr>
				

				<tr>
					<td colspan="2">
						<button type="submit" name="btn_save_update" class="btn btn-success"><span></span>Update</button>

						<a href="index.php">Cancel</a>
					</td>
				</tr>
			</table>

		</form>
	</div>

</body>

</html>