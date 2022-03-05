<?php require_once('../../../private/initialize.php'); ?>

<?php

session_start();
// If the user is not logged in as administrator redirect to the login page...
require_admin_login();

//set the connection variables
$hostname = DB_SERVER;
$username = DB_USER;
$password = DB_PASS;
$database = DB_NAME;
$filename = "uploads/backup.csv";
$target_dir = "uploads/";
    // File name
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    // get file extension
    $csvFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if file is csv file
    if(isset($_POST["submit"])) {
        // check if file is a csv file
        if($csvFileType != "csv") {
            echo "<h3>Sorry, only csv files are allowed.</h3>";
            // try again if not csv format

            $uploadOk = 0;
        }else if ($csvFileType == "csv") {
            // rename the file
            $new_file_name = "backup.csv";
            $target_file = $target_dir . $new_file_name;
            // move file to directory
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            // Success message
        }
    }
// connect to mysql database
$connection = mysqli_connect($hostname, $username, $password, $database) or die("Error " . mysqli_error($connection));

// open the csv file
$fp = fopen($filename,"r");

mysqli_query($connection, "DELETE FROM tblcontacts");

//parse the csv file row by row
while(($row = fgetcsv($fp,1000,",")) !== FALSE)
{
    //insert csv data into mysql table
    $sql = "INSERT INTO tblcontacts (id, firstName, lastName, phone, email, address, city, province, postalCode, dateOfBirth, userName) VALUES ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','$row[10]')";
    mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

}

fclose($fp);

//close the db connection
mysqli_close($connection);
?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <h1>Restore Complete!</h1>
    <p>You have successfully restored your database.</p>
    <p>You can also <a href="../../../public/staff/admin/index.php">return to the admin page</a>.</p>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>