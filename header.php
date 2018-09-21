<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?><!DOCTYPE html>
<html>
<head>
    <title>User Management - PHP</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"></a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="userlist.php">User List</a></li>   
                <?php if (isset($_SESSION['email'])): ?>
                    <li class="dropdown">
                        <a href="myaccount.php" style=" padding-right:0; display: inline; ">My Account</a>
                        <button style="margin-top: 9px;" class="dropdown-toggle"  data-toggle="dropdown" ><span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                            <li><a href="updateprofile.php">Update Profile</a></li>
                            <li><a href="changepassword.php">Change Password</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
                </ul>
            <?php  else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span>Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </nav> 
