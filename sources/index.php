<?php

include_once "db_functions.php";

if(!existDatabase()){
    createDatabase();
    $con = db_setup();
    createTables($con);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="fi" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>AWAS final project</title>
</head>

<body>
<center>
<div style="background-color:#40b254;height:20px;width:auto"></div>
<p class="text-decamp">

<img alt="Decamp Logo" height="117" src="DecampLogo.jpg" width="911" /></p>
<h1>AWAS final project</h1>

<p><a href="https://www.youtube.com/watch?v=W1SajAMJ2fU" target="_blank">Explanation video</a>.</p>

<p>If you need, you can <a href="db_restore.php" target="_blank">restore</a> the database.</p>

<h3>Laboratory 1: SQL injections</h3>

<p>
    Your goal for this lab is to delete all posts from other users. To succeed you have to steal the credentials of other accounts, <br>
    as only the person who created the post has the authorization to delete it. So, after creating an account, focused on the <br>
    'Accounts' website section. Through SQL union based you should succeed in your intent.
</p>
<p>
    Your mission is to: <br>
        - Find out the all persons in the database.<br>
        - Find out the usernames and passwords. <br>
        - Log in with their accounts and delete their posts.
</p>
<p>
    Required skills:<br>
        - Understanding of SQL injections.
</p>
<p>
    Proceed to the <a href="Lab1/index.php" target="_blank">laboratory 1</a>.
</p>

<h3>Laboratory 2: XSS vulnerability</h3>

<p>
    In this laboratory your mission is to steal the user's PHP session.
</p>
<p> 
    To reach your goal you will have to exploit the lack of validation in the body input of a post, in the 'News Feed' section, <br>
    managing to insert a javascript script that is executed every time the page is loaded.
</p>
<p>
    Remember that it is important there is content before your script that does not make the post look suspicious, this will slow <br>
    down administrators in fixing the threat.
</p>
<p>
    Your mission is to: <br>
        - Create an account and post an XSS attack to the post board. <br>
        - Create another account and access. <br>
        - Open another browser and try to access home.php skipping authentication, using the stolen PHPSESSION.
</p>
<p>
    Required skills:<br>
        - Understanding of XSS attack. <br>
        - Basic javascript language. <br>
        - Know how to use Burp Proxy.
</p>

<p>
    Proceed to the <a href="Lab2/index.php" target="_blank">laboratory 2</a>.
</p>

<h3>Laboratory 3: Attacking Access Control</h3>

<p>
    In this laboratory you have to find the flag, that is found on a page reserved to admins. <br>
    In order to complete this laboratory your mission is to impersonate the admin. You will need to create a new account to <br>
    gain access to the normal user interface, inspect the pages that are present on the site and the roles of the different users.
</p>
<p>
    Your mission is to: <br>
        - Find out how to gain access to admin privileges. <br>
        - Get the flag on admin’s page.
</p>
<p>
    Required skills:<br>
        - Understanding PHP and HTML. <br>
        - Base64 encoding.
</p>
<p>
    Proceed to the <a href="Lab3/index.php" target="_blank">laboratory 3</a>.
</p>

<br>
<br>
<p><a href="solutions.html" target="_blank">SOLUTIONS</a></p>


</center>
</body>

</html>
