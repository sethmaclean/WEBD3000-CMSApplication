<?php 
// we need to make sure $page_title is defined, otherwise we will get an error.
// if it is not defined, we will set it to an empty string.
// if it is defined, we will leave it as is.
$page_title = isset($page_title) ? $page_title : '';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
    <title>GBI - <?php echo h($page_title); ?> </title>
</head>

<body>
    <header>
        <h1>GBI Staff Area</h1>
    </header>

    <Naviagation>
        <ul>
            <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
        </ul>
    </Naviagation>