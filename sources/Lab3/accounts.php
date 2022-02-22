<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();

$id = $_SESSION['ID'];
$sql = "SELECT * FROM users ORDER BY userID";
$users = $con->query($sql) or die($con->error);
$row = $users->fetch_assoc();

if (!isset($_SESSION['UserLogin'])) {
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

        <div class="btn-group float-right" role="group" arial-label="">
            <!-- ADMIN Add Account Button -->
            <?php if ($_SESSION['Access'] == "admin") { ?>
                <a class="btn btn-link float-right font-weight-bold text-decoration-none" href="add.php"> Add New Account </a> <br> <br>
            <?php } ?>

            <!-- USER Edit Account Link -->
            <a id="loginBtn" class="btn btn-link float-right font-weight-bold" href="update.php?ID=<?php echo $id ?>"> Edit my Account </a>

        </div>
        <!-- Search Bar -->
        <form action="result.php" method="get">
            <div class="input-group mb-3">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search for user's name or email" autocomplete="off">
                <div class="input-group-append float-right">
                    <button class="btn btn-outline-success font-weight-bold" type="submit">Search</button>
                </div>
            </div>
        </form>

        <!-- Users Table -->
        <table class="table table-striped">

            <thead class="bg-primary" style="color:white;">
                <tr>
                    <th scope="col">View Profile</th>
                    <th scope="col">id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>

                    <!-- ADMIN COLUMNS FIELDS -->
                    <?php if ($_SESSION['Access'] == "admin") { ?>
                      
                        <th scope="col">Access</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    <?php } ?>
            </thead>

            <tbody>
                <?php do { ?>
                    <?php if ($row['userID'] != $_SESSION['ID']) { ?>
                        <tr>
                            <td>
                                <a class="view btn btn-info btn-sm font-weight-bold" name="view" href="details.php?ID=<?php echo $row['userID'] ?>">View Profile</a>
                            </td>
                            <td> <b> <?php echo $row['userID']; ?> </b> </td>

                            <td> <?php echo $row['firstName']; ?> </td>
                            <td> <?php echo $row['lastName']; ?> </td>
                            <td> <?php echo $row['email']; ?> </td>

                            <!-- ADMIN Rows -->
                            <?php if ($_SESSION['Access'] == "admin") { ?>
                               
                                <td> <?php echo $row['access']; ?> </td>

                                <td>
                                    <a class="view btn btn-warning btn-sm font-weight-bold" name="update" href="update.php?ID=<?php echo $row['userID'] ?>">Update</a>
                                </td>
                                <td>
                                    <form action="delete.php" onSubmit="return confirm('Do you really want to delete this user?')" method="post">
                                        <button type="submit" class="view btn btn-danger btn-sm font-weight-bold" name="deleteUser">Delete</button>
                                        <input type="hidden" class="<style>hidden" name="ID" value="<?php echo $row['userID'] ?>">
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } while ($row = $users->fetch_assoc()) ?>
            </tbody>


        </table>
        <div>

</body>
<html>