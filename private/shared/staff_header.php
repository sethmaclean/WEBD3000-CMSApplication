<?php 
// check if $page_title is defined
// if not, set it to an empty string
// otherwise, set it to the value of $page_title
$page_title = isset($page_title) ? $page_title : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
    <title>CMS Application - <?php echo h($page_title); ?> </title>
</head>

<body>
    <header>
        <h1>Contact Management Application</h1>
    </header>

    <Naviagation>
        <form method="POST" action="<?php echo url_for('/logout.php'); ?>">
            <input class="btn-red" type="submit" value="Sign Out of Your Account">
        </form>
    </Naviagation>