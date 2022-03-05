<?php require_once('../../../private/initialize.php'); ?>

<?php

session_start();
// If the user is not logged in redirect to the login page...
require_user_login();

$id = isset($_GET['id']) ? $_GET['id'] : '1';

$contact = find_contact_by_id($id);

?>

<?php $page_title = 'Show contact'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/contacts/index.php'); ?>">&laquo; Back to List</a>

    <div class="contact show">

        <div class="attributes">
            <dl>
                <dt>First Name</dt>
                <dd><?php echo h($contact['firstName']); ?></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><?php echo h($contact['lastName']); ?></dd>
            </dl>
            <dl>
                <dt>Phone</dt>
                <dd><?php echo h($contact['phone']); ?></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><?php echo h($contact['email']); ?></dd>
            </dl>
            <dl>
                <dt>Address</dt>
                <dd><?php echo h($contact['address']); ?></dd>
            </dl>
            <dl>
                <dt>City</dt>
                <dd><?php echo h($contact['city']); ?></dd>
            </dl>
            <dl>
                <dt>Province</dt>
                <dd><?php echo h($contact['province']); ?></dd>
            </dl>
            <dl>
                <dt>Postal Code</dt>
                <dd><?php echo h($contact['postalCode']); ?></dd>
            </dl>
            <dl>
                <dt>Date of Birth</dt>
                <dd><?php echo h($contact['dateOfBirth']); ?></dd>
            </dl>
            <dl>
                <dt>userName</dt>
                <dd><?php echo h($contact['userName']); ?></dd>
            </dl>
        </div>

    </div>

</div>