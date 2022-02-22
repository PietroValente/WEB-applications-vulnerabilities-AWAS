<?php

if(!isset($_SESSION)) {
    session_start();
}

include_once "connections/connection.php";

$con = connection();
$id = $_SESSION['ID'];
$userPostSQL = "SELECT users.userID, users.firstName, users.lastName, users.email, posts.postID, posts.subject, posts.body, posts.dateAdded ".
            "FROM users JOIN posts ".
            "ON users.userID = posts.userID ".
            "WHERE users.userID = ".$id.
            " ORDER BY posts.dateAdded DESC";
$userPosts = $con->query($userPostSQL) or die($con->error);
$userPostRow = $userPosts->fetch_assoc();

if(!isset($_SESSION['UserLogin'])) {
    echo header("Location: login.php");
}   

if(isset($_SESSION['UserLogin'])) {
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
                <a class="btn btn-success float-left font-weight-bold" href="accounts.php"> Accounts </a>&nbsp;
                <a class="btn btn-danger float-left font-weight-bold" href="logout.php"> Logout </a>
            </div>
            <h1>&nbsp; My Posts </h1>
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
                            <textarea class="form-control" id="addressTA" rows="3" name="postBody" required"
                                style="resize:none;"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary float-right font-weight-bold" value="Post" name="myPost"/>
                    </form>
                </div>
            </div>

            <br>

            <!-- My Posts -->

            <h3> &nbsp;&nbsp;My Posts </h3>
            <?php if($userPosts->num_rows > 0) { ?>
            <?php do { ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary"> <?php echo $userPostRow['subject'] ?></h4>

                    <!-- In Progress -->
                    <form action="delete.php" onSubmit="return confirm('Do you really want to delete this post?')" method="post" accept-charset="utf-8">
                                <button type="submit" class="view btn btn-danger btn-sm float-right" name="deletePost"><b>Delete Post</b></button>
                                <input type="hidden" class="<style>" name="ID" value="<?php echo $userPostRow['postID']?>">
                                <a class="view btn btn-warning btn-sm float-right" name="update" style="margin-right: 10px; color:white"
                                href="editPost.php?ID=<?php echo $userPostRow['postID']?>"><b>Edit Post</b></a>
                    </form>
                    
                            
                    <small class="card-subtitle">
                        <?php echo "Posted by <b>".$userPostRow['firstName'].' '.$userPostRow['lastName'].' </b> | '.' '.$userPostRow['email'].' '.$userPostRow['dateAdded']  ?>
                    </small>                            
                </div>
                <div class="card-body">
                    <?php echo $userPostRow['body'] ?>
                </div>
            </div> <br>
            <?php } while($userPostRow = $userPosts->fetch_assoc()) ?>
            <?php } else { echo "<div class='display-4'> No posts yet!</div>"; } ?>
            </div>
    </body>
</html>