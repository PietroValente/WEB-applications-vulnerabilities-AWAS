<?php

function db_setup() {
    include_once "\Lab1\connections\connection.php";
    $con = connection();
    return $con;
}

function createDatabase() {
    include_once "\Lab1\connections\connection.php";
    $con = DBLessConnection();
    $sql = "CREATE DATABASE blog";
    $con->query($sql) or die($con->error);
    $con->close();
}

function existDatabase(){
    include_once "\Lab1\connections\connection.php";
    $con = DBLessConnection();
    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'blog'";
    $user = $con->query($sql) or die($con->error);
    $row = $user -> fetch_assoc();
    $num = $user->num_rows;
    $con->close();
    return $num;
}

function createTables($con) {
    $usersTable = 
        "CREATE TABLE `users` (".
            "`userID` int AUTO_INCREMENT PRIMARY KEY,".
            "`firstName` varchar(50) NOT NULL,".
            "`lastName` varchar(50) NOT NULL,".
            "`email` varchar(50) NOT NULL,".
            "`password` varchar(255) NOT NULL,".
            "`access` varchar(10) NOT NULL) ";
    $con->query($usersTable) or die ($con->error);

    $password = 'Admin123!';
    $insertAdmin = "INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`, `access`) VALUES (1, 'Admin', 'Admin', 'admin@admin.com', '$password', 'admin')";
    $con->query($insertAdmin) or die ($con->error);

    $password = 'Marco123!';
    $insertMarco = "INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`, `access`) VALUES (2, 'Marco', 'Rossi', 'Marco@Rossi.com', '$password', 'user')";
    $con->query($insertMarco) or die ($con->error);

    $password = 'Elon123!';
    $insertElon = "INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`, `access`) VALUES (3, 'Elon', 'Musk', 'Elon@Musk.com', '$password', 'user')";
    $con->query($insertElon) or die ($con->error);

    $postsTable =
        "CREATE TABLE `posts` (".
            "`postID` int AUTO_INCREMENT PRIMARY KEY,".
            "`userID` int NOT NULL,".
            "`subject` varchar(75) NOT NULL,".
            "`body` varchar(1000) NOT NULL,".
            "`dateAdded` datetime NOT NULL)";

    $postsForeignKey = "ALTER TABLE posts ADD FOREIGN KEY (userID) REFERENCES users(userID);";
    $con->query($postsTable) or die ($con->error);
    $con->query($postsForeignKey) or die ($con->error);

    $userID = 1;
    $subject = 'Welcome to my site';
    $body = 'I created this site to discuss any AWAS issues.';
    $dateAdded = '2021-05-15 22:59:16';
    $insertAdminPost = "INSERT INTO `posts` (`userID`,`subject`,`body`,`dateAdded`) VALUES ('$userID','$subject','$body', '$dateAdded')";
    $con->query($insertAdminPost) or die ($con->error);

    $userID = 2;
    $subject = 'Presentation';
    $body = 'Hi everyone, I\'\'m Marco Rossi and I\'\'m happy with the idea of ​​this site.';
    $dateAdded = '2021-05-20 17:12:01';
    $insertMarcoPost = "INSERT INTO `posts` (`userID`,`subject`,`body`,`dateAdded`) VALUES ('$userID','$subject','$body', '$dateAdded')";
    $con->query($insertMarcoPost) or die ($con->error);

    $userID = 3;
    $subject = 'Observing';
    $body = 'Cool idea!!';
    $dateAdded = '2021-05-24 14:32:56';
    $insertElonPost = "INSERT INTO `posts` (`userID`,`subject`,`body`,`dateAdded`) VALUES ('$userID','$subject','$body', '$dateAdded')";
    $con->query($insertElonPost) or die ($con->error);

    $syslogsTable =
    "CREATE TABLE `syslogs` (".
        "`Log_ID` int AUTO_INCREMENT PRIMARY KEY,".
        "`Log_Type` varchar(10) NOT NULL,".
        "`Level` int(11) NOT NULL,".
        "`Timestamp` datetime NOT NULL,".
        "`Message` varchar(255) NOT NULL)";
    $con->query($syslogsTable) or die ($con->error);

    $con->close();
}

function deleteDatabase() {
    include_once "\Lab1\connections\connection.php";
    $con = DBLessConnection();
    $sql = "DROP DATABASE blog";
    $con->query($sql) or die($con->error);
    $con->close();
}

?>
