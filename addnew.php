<?php
//error_reporting(~E_NOTICE);
require_once 'PDO_Config.php';

if (isset($_POST['btnsave'])) {
    $username = $_POST['user_name'];
    $userjob = $_POST['user_job'];
    $userEmail = $_POST['user_email'];
    $marks = $_POST['marks'];
    

    if (empty($username)) {
        $errorMSG = "Please enter username";
    } else if (empty($userjob)) {
        $errorMSG = "Please enter employees job";
    }elseif (empty($marks)) {
        $errorMSG = "Please select employees image";
    }

     elseif (empty($userEmail)) {
        $errorMSG = "Please select employees image";
    }
    

    if (!isset($errorMSG)) {
        $stmt = $DB_CON->prepare("INSERT INTO tbl_users(userName,userProfession,marks,userEmail) VALUES (:uname,:ujob, :marks,:uemail)");

        $stmt->bindParam(':uname', $username);
        $stmt->bindParam(':ujob', $userjob);
        $stmt->bindParam(':marks', $marks);
        $stmt->bindParam(':uemail', $userEmail);

        if ($stmt->execute()) {
            $successMSG = "New Record Inserted Successfully";
            header('refresh:5; index.php');
        } else {
            $errorMSG = "Error while inserting...";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div>
        <div>
            <h1>Add New Students</h1><a href="index.php"><br><b>View All Students</b></a>
        </div>
        <?php
        error_reporting(~E_NOTICE);
        if (isset($errorMSG)) {
        ?>
            <div>
                <span></span><b><?= $errorMSG; ?></b>
            </div>
        <?php
        } else if (isset($successMSG)) {
        ?>
            <div>
                <b><span></span><?= $successMSG; ?></b>
            </div>
        <?php
            header("location:index.php");
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table>
                <tr>
                    <td>
                        <label for="">Username</label>
                    </td>
                    <td>
                        <input type="text" name="user_name" value="<?= $username; ?>">
                    </td>
                </tr>

                

                <tr>
                    <td>
                        <label for="">Subject</label>
                    </td>
                    <td>
                        <input type="text" name="user_job" value="<?= $userjob; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Marks</label>
                    </td>
                    <td>
                        <input type="text" name="marks" value="<?= $marks; ?>">
                    </td>
                </tr>
              
                 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="user_email" value="<?= $userEmail; ?>">
                    </td>
                </tr>
               

                <tr>
                    <td colspan="2">
                        <button type="submit" name="btnsave" class="btn btn-primary">
                            <span></span>&nbsp;Save
                        </button>
                    </td>
                </tr>
            </table>

        </form>

    </div>

</body>

</html>