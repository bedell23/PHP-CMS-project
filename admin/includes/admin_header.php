<?php ob_start(); ?>
<?php session_start(); ?>

<?php include "../includes/db.php"; ?>
<?php include "./admin_functions.php"; ?>

<?php 
    // for logging out
    if (!isset($_SESSION['user_role'])) {
        header("Location: ../index.php");
    }

    // when user_role is subscriber, you are not allowed to acess admin panel
    // if (!is_admin($_SESSION['user_role'])) {
    //     header("Location: /admin.php");
    // }

    // when user_role is subscriber, you are not allowed to acess admin panel
    if (($_SESSION['user_role'] == 'subscriber')) {
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Societal Ills Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="57x57" href="../images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../images/apple-icon-60x60.png">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
    <script src="js/jquery.js"></script>

</head>

<body id="page-top">