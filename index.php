<?php

require_once 'PDO_Config.php';

if (isset($_GET['delete_id'])) {
    $stmt_delete = $DB_CON->prepare('DELETE FROM tbl_users WHERE id=:uid');
    $stmt_delete->bindParam(':uid', $_GET['delete_id']);
    $stmt_delete->execute();

    header('location:index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student database management system</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"> -->

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
            <h1 > Student Information </h1><a href="addnew.php">INSERT Students information</a>
        </div>
        <br>
        <div>
            <?php
            $stmt = $DB_CON->prepare('SELECT id,userName,userProfession,marks,userEmail FROM tbl_users ORDER BY id DESC');

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
            ?>
                <center>
                    <fieldset>

                        <legend style="margin: 0 auto;" class="btn-primary">Information of All Student</legend>

                        <table class="table" border="5px solid black">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="23%">Subject</th>
                                    <th scope="col" width="23%">Marks</th>
                                    <th scope="col" width="23%">Email</th>
                                    <th scope="col" width="30%" colspan="5" class="text-center">Action</th>
                                </tr>
                            </thead>

                            <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row); // This function uses array keys as variable names and values as variable values.

                            ?>


                                <tbody>
                                    <tr>
                                        <th scope="row"><?= $row['id'] ?></th>
                                        <td><?= $row['userName'] ?></td>
                                        <td><?= $row['userProfession'] ?></td>
                                        <td><?= $row['marks'] ?></td>
                                        <td><?= $row['userEmail'] ?></td>
                                        <td><a href="editform.php?edit_id=<?= $row['id']; ?>" onclick="return confirm('sure to edit')">Edit</a></td>
                                        <td><a href="?delete_id=<?= $row['id']; ?>" onclick="return confirm('sure to Delete')">Delete</a></td>
                                    </tr>
                                </tbody>




                                <!-- <div>
                        <p>< ?php echo $userName . "&nbsp;/&nbsp;" . $userProfession   ?></p>
                        <img src="user_images/< ?= $row ['userPic']; ?>" width="150px" height="150px">

                        <p>
                            <span>
                                <a href="editform.php?edit_id=< ?= $row ['id']; ?>" onclick="return confirm('sure to edit')">Edit</a>
                                <a href="?delete_id=< ?= $row ['id']; ?>" onclick="return confirm('sure to edit')">Delete</a>
                            </span>
                        </p>
                    </div> -->
                            <?php
                            }
                            ?>
                        </table>
                    </fieldset>
                </center>
            <?php
            } else {
            ?>

                <div>
                    No Data Found...
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>