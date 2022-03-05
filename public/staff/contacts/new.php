<?php require_once('../../../private/initialize.php'); ?>

<?php

session_start();
// If the user is not logged in redirect to the login page...
require_user_login();


if(is_post_request()) {
    
    // Handle form values sent by new.php
    $contact = [];
    $contact['firstName'] = $_POST['firstName'] ?? '';
    $contact['lastName'] = $_POST['lastName'] ?? '';
    $contact['phone'] = $_POST['phone'] ?? '';
    $contact['email'] = $_POST['email'] ?? '';
    $contact['address'] = $_POST['address'] ?? '';
    $contact['city'] = $_POST['city'] ?? '';
    $contact['province'] = $_POST['province'] ?? '';
    $contact['postalCode'] = $_POST['postalCode'] ?? '';
    $contact['dateOfBirth'] = $_POST['dateOfBirth'] ?? '';
    $contact['userName'] = $_POST['userName'] ?? '';

    $result = insert_contact($contact);
    if($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/contacts/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }

} else {

    // Display the blank form
    $contact = [];
    $contact['firstName'] = '';
    $contact['lastName'] = '';
    $contact['phone'] = '';
    $contact['email'] = '';
    $contact['address'] = '';
    $contact['city'] = '';
    $contact['province'] = '';
    $contact['postalCode'] = '';
    $contact['dateOfBirth'] = '';
    $contact['userName'] = '';
}

?>

<?php $page_title = 'Create contact'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/contacts/index.php'); ?>">&laquo; Back to List</a>

    <div class="contact new">
        <h1>Create Contact</h1>

        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/contacts/new.php'); ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="firstName" value="<?php echo h($contact['firstName']); ?>" maxlength="25"
                        required /></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="lastName" value="<?php echo h($contact['lastName']); ?>" maxlength="50"
                        required /></dd>
            </dl>
            <dl>
                <dt>Phone</dt>
                <dd><input type="text" name="phone" value="<?php echo h($contact['phone']); ?>" maxlength="25"
                        required /></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="<?php echo h($contact['email']); ?>" maxlength="100"
                        required /></dd>
            </dl>
            <dl>
                <dt>Address</dt>
                <dd><input type="text" name="address" value="<?php echo h($contact['address']); ?>" maxlength="50"
                        required /></dd>
            </dl>
            <dl>
                <dt>City</dt>
                <dd><input type="text" name="city" value="<?php echo h($contact['city']); ?>" maxlength="25" required />
                </dd>
            </dl>
            <dl>
                <dt>Province</dt>
                <dd><input type="text" name="province" value="<?php echo h($contact['province']); ?>" maxlength="2"
                        required /></dd>
            </dl>
            <dl>
                <dt>Postal Code</dt>
                <dd><input type="text" name="postalCode" value="<?php echo h($contact['postalCode']); ?>" maxlength="7"
                        required /></dd>
            </dl>
            <dl>
                <dt>Date of Birth</dt>
                <dd><input type="text" name="dateOfBirth" value="<?php echo h($contact['dateOfBirth']); ?>"
                        maxlength="50" required /></dd>
            </dl>
            <dl>
                <dt>User Name</dt>
                <dd><input type="text" name="userName" value="<?php echo h($contact['userName']); ?>" maxlength="25"
                        required /></dd>
            </dl>
            <dl>
                <dt>&nbsp;</dt>
                <dd><input class="btn-green" type="submit" value="Create contact" /></dd>
            </dl>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>