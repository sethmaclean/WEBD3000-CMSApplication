<?php require_once('../../../private/initialize.php');

session_start();
// If the user is not logged in redirect to the login page...
require_user_login();

$message_sent = false;

$emailList = array();

$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$sql = "SELECT * FROM tblcontacts WHERE userName = '" . $_SESSION['username'] . "'";
$result = mysqli_query($db, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $emailList[] = $row['email'];
}

// if the email is verified, send the email
if(isset($_POST['email']) && $_POST['email'] != '') {
    if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {

        
        $name = $_POST['name'];
        $message = $_POST['message'];
        
        $mailHeaders = 'From:sethgordonmaclean@gmail.com';
        $subject = 'Contact Form Submission';
        $body = 'Name: ' . $name . "\n" . 'Subject: ' . $subject . "\n" . 'Message: ' . $message;
        
        foreach ($emailList as $email) {
            mail($email, $subject, $message, $mailHeaders);
        }
        $message_sent = true;
    }
} 

?>

<?php include (SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <h1>Click away to start Email Forwarding</h1>

    <a class="back-link" href="<?php echo url_for('/staff/contacts/index.php'); ?>">&laquo; Back to List</a>

    <form action="<?php echo url_for('/staff/contacts/email.php'); ?>" method="post">
        <dl>
            <dt>Name:</dt>
            <dd><input type="text" name="name" value="<?php echo h($_POST['name'] ?? ''); ?>" maxlength="25" required />
            </dd>
        </dl>
        <dl>
            <dt>Address:</dt>
            <dd><input type="text" name="email" value="<?php echo h($_POST['email'] ?? ''); ?>" maxlength="25"
                    required /></dd>
        </dl>
        <dl>
            <dt>Subject:</dt>
            <dd><input type="text" name="subject" value="<?php echo h($_POST['subject'] ?? ''); ?>" maxlength="25"
                    required /></dd>
        </dl>
        <dl>
            <dt>Message:</dt>
            <dd><textarea name="message" cols="30" rows="10" maxLength="500"
                    required><?php echo h($_POST['message'] ?? ''); ?></textarea></dd>
        </dl>
        <div id="operations">
            <input class="btn-green" type="submit" value="Send Email" />
        </div>
    </form>
</div>

<?php include (SHARED_PATH . '/staff_footer.php'); ?>