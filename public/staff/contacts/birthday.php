<?php

require_once('../../../private/initialize.php');

session_start();
// If the user is not logged in redirect to the login page...
require_user_login()

?>

<?php $page_title = 'Birthday Filter'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php $sql = "SELECT * FROM tblContacts ";
$sql .= "WHERE MONTH(dateOfBirth) = MONTH(CURDATE()) ";
$sql .= "ORDER BY lastName ASC";
$contact_set = find_all_contacts($sql);
?>

<h1>Birthday Filter</h1>

<div class="container">
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="January">
            <input class="btn-blue" type="submit" value="January"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="February">
            <input class="btn-blue" type="submit" value="February"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="March">
            <input class="btn-blue" type="submit" value="March"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="April">
            <input class="btn-blue" type="submit" value="April"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="May">
            <input class="btn-blue" type="submit" value="May"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="June">
            <input class="btn-blue" type="submit" value="June"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="July">
            <input class="btn-blue" type="submit" value="July"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="August">
            <input class="btn-blue" type="submit" value="August"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="September">
            <input class="btn-blue" type="submit" value="September"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="October">
            <input class="btn-blue" type="submit" value="October"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="November">
            <input class="btn-blue" type="submit" value="November"><br>
        </div>
    </form>
    <form method="POST" action="index.php">
        <div class="inputs">
            <input type="hidden" name="month" value="December">
            <input class="btn-blue" type="submit" value="December"><br>
        </div>
    </form>
</div>