<?php require_once('../../../private/initialize.php'); ?>

<?php

    session_start();

    require_admin_login();

    // mysql database connection details
    $host = DB_SERVER;
    $username = DB_USER;
    $password = DB_PASS;
    $dbname = DB_NAME;

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));
    
    // fetch mysql table rows
    $sql = "select * from tblcontacts";
    $result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    $fp = fopen('cms_application.csv', 'w');

    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($fp, $row);
    }
    
    fclose($fp);

    //close the db connection
    mysqli_close($connection);
?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <h1>Export Complete!</h1>
    <p>Your database has been exported to the file: cms_application.csv</p>
    <p>Please download the file and import it into your database.</p>
    <p>You can also <a href="../../../public/staff/admin/index.php">return to the admin page</a>.</p>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>