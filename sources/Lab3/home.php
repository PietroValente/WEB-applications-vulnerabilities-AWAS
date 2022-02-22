<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();
$id = $_SESSION['ID'];
$postSQL =  "SELECT users.userID, users.firstName, users.lastName, users.email, posts.postID, posts.subject, posts.body, posts.dateAdded ".
            "FROM users JOIN posts ".
            "ON users.userID = posts.userID ".
            "ORDER BY posts.dateAdded DESC"; 
$posts = $con->query($postSQL) or die($con->error);
$postRow = $posts->fetch_assoc();

if(!isset($_SESSION['UserLogin'])) {
    echo header("Location: login.php");
}

if(isset($_SESSION['UserLogin'])) {
    if(isset($_GET['Access']))
    echo "<div class='float-right'> Welcome <b> ".$_SESSION['UserLogin']." </b> | Role: <b> ".base64_decode($_GET['Access'])."</b></div> <br>";
    else
     echo "<div class='float-right'> Welcome <b> ".$_SESSION['UserLogin']." </b> | Role: <b> ".$_SESSION['Access']."</b></div> <br>";
} else {
    echo "Welcome guest!";
}

?>


<!-- HTML CODES -->

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
                <?php 
                    if(isset($_GET['Access']))
                        if(strcmp(base64_decode($_GET['Access']),"admin")==0)
                            echo "<a class=\"btn btn-danger float-left font-weight-bold\" href=\"admin.html\"> Admin Page </a>&nbsp;"; 
                ?>
                <a class="btn btn-success float-left font-weight-bold" href="accounts.php"> Accounts </a>&nbsp;
                <a class="btn btn-danger float-left font-weight-bold" href="logout.php"> Logout </a>
            </div>
            <h1>&nbsp; News Feed </h1>
            <hr>
            <br>

            <!-- Compose Post Section -->
            <div class="card">
                <div class="card-body">
                    <h3 style="text-align:center;">&nbsp;&nbsp; Compose Post </h3>
                    <form action="addPost.php" method="post" onSubmit="return alert('Your post was posted!')" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="name">&nbsp;&nbsp;Topic </label>
                            <input type="text" class="form-control" name="postSubject" required>
                        </div>
                        <div class="form-group">
                            <label for="address">&nbsp;&nbsp;Body</label>
                            <textarea class="form-control" id="addressTA" rows="3" name="postBody" required
                                style="resize:none;"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary float-right" value="Post" name="addPost"/>
                    </form>
                </div>
            </div>

            <br>

            <!-- Recent Posts -->

            
            <h3> &nbsp;&nbsp;News Feed </h3>
            <?php if($posts->num_rows > 0) { ?>
            <?php do { ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary"> <?php echo $postRow['subject'] ?></h4>
                    <small class="card-subtitle">
                        <?php echo "Posted by <b>".$postRow['firstName'].' '.$postRow['lastName'].' </b> | '.'  '.$postRow['dateAdded']  ?>
                    </small>
                </div>
                <div class="card-body">
                    <?php echo $postRow['body'] ?>
                </div>
            </div> <br>
            <?php } while($postRow = $posts->fetch_assoc()) ?>
            <?php } else { echo "<div class='display-4'> No posts yet! </div>"; } ?>
    
    </body>
<html>