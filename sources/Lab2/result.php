<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";
include "validation/validation.php";

$con = connection();

$con = connection();
$search = $_GET['search'];
//$search = SQLvalid($con,$search);
$sql = "SELECT * FROM users WHERE firstName LIKE '$search%' OR lastName LIKE '$search%' OR email LIKE '$search%' ORDER BY userID";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

if(!isset($_SESSION['UserLogin'])) {
    echo header("Location: login.php");
}

if (isset($_SESSION['UserLogin'])) {
    echo "<div class='float-right'> Welcome <b> " . $_SESSION['UserLogin'] . " </b> | Role: <b> " . $_SESSION['Access'] . "</b></div> <br>";
} else {
    echo "Welcome guest!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>AWAS-BLOG</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

    <div class="container">

            <br>
            <br>
            <h1 class="text-center"><b>A W A S - B L O G</b> </h1>
            <br>
            <br>
            <br>

        <!-- Button Group User -->
        <div class="btn-group float-right font-weight-bold" role="group" aria-label="Basic example">
            <a class="btn btn-info float-left  font-weight-bold" href="home.php"> News Feed </a>&nbsp;
            <a class="btn btn-primary float-left font-weight-bold" href="myPosts.php"> My Posts </a>&nbsp;
            <a class="btn btn-success float-left font-weight-bold" href="accounts.php"> Accounts </a>&nbsp;
            <a class="btn btn-danger float-left font-weight-bold" href="logout.php"> Logout </a>
        </div>
        <h1>&nbsp; Accounts </h1>
        <hr>
        <br>
        
        <!-- Edit Account Link -->
        <a id="loginBtn" class="btn btn-link float-right" href="update.php?ID=<?php echo $id?>"> Edit My Account </a>

        <?php if($_SESSION['Access'] == "admin") { ?>
        <a id="loginBtn" class="btn btn-link float-right" href="add.php"> Add New Account </a> <br> <br>
        <?php } ?>
        
        <!-- Search Bar -->
        <form action="result.php" method="get" accept-charset="utf-8">
            <div class="input-group mb-3">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search for user's name or email" autocomplete="off">
            <div class="input-group-append float-right">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
            </div>
        </form>

        <!-- Users Table -->
        <table class="table table-striped">

        <?php if($users->num_rows > 0) { ?>
            <thead>
                    <tr class="bg-primary" style="color:white;">
                        <th scope="col">View Profile</th>
                        <th scope="col">id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>

                        <!-- ADMIN COLUMNS FIELDS -->
                        <?php if($_SESSION['Access'] == "admin") { ?>
                       
                        <th scope="col">Access</th>
                  
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                        <?php } ?>
                </thead>
    
            <tbody>
          
                    <?php do {?>
                        <?php if($row['userID'] != $_SESSION['ID']) { ?>
                    <tr>
                        <td>
                            <a class="view btn btn-info btn-sm font-weight-bold" name="view"
                                href="details.php?ID=<?php echo $row['userID']?>">View Profile</a>
                        </td>
                        <td> <b> <?php echo $row['userID'];?> </b> </td>
                        <td> <?php echo $row['firstName'];?> </td>
                        <td> <?php echo $row['lastName'];?> </td>
                        <td> <?php echo $row['email'];?> </td>

                        <!-- ADMIN Rows -->
                        <?php if($_SESSION['Access'] == "admin") { ?>
                   
                        <td> <?php echo $row['access'];?> </td>
                        
                        <td>
                            <a class="view btn btn-warning btn-sm font-weight-bold" name="update"
                                href="update.php?ID=<?php echo $row['userID']?>">Update</a>
                        </td>
                        <td>
                            <form action="delete.php" onSubmit="return confirm('Do you really want to delete this user?')"
                                method="post" accept-charset="utf-8">
                                <button type="submit" class="view btn btn-danger btn-sm font-weight-bold" name="delete">Delete</button>
                                <input type="hidden" class="<style>hidden" name="ID" value="<?php echo $row['userID']?>">
                            </form>
                        </td>
                        <?php } ?>
                    </tr>
                        <?php } ?>
                    <?php } while ($row = $users->fetch_assoc()) ?>
                    <?php } else { echo "<div class='display-4'> No result! </div>"; } ?>
                </tbody>
        </table>
        <a id="loginBtn" class="btn btn-link float-left" href="accounts.php"> View All User's List </a>
        </div>
</body>
<html>