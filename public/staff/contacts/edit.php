<?php

require_once('../../../private/initialize.php');

session_start();
// If the user is not logged in redirect to the login page...
require_user_login();

$id = $_GET['id'];


if(is_post_request()) {

  // Handle form values sent by edit.php
  $contact = [];
  $contact['id'] = $id;
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

  $result = update_contact($contact);
  if($result === true) {
    redirect_to(url_for('staff/contacts/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {
  $contact = find_contact_by_id($id);

}

$contact_set = find_all_contacts();
$contact_count = mysqli_num_rows($contact_set);
mysqli_free_result($contact_set);

?>

<?php $page_title = 'Edit contact'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/contacts/index.php'); ?>">&laquo; Back to List</a>

    <div class="contact edit">
        <h1>Edit contact</h1>

        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/contacts/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="firstName" value="<?php echo h($contact['firstName']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="lastName" value="<?php echo h($contact['lastName']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Phone</dt>
                <dd><input type="text" name="phone" value="<?php echo h($contact['phone']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="<?php echo h($contact['email']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Address</dt>
                <dd><input type="text" name="address" value="<?php echo h($contact['address']); ?>" /></dd>
            </dl>
            <dl>
                <dt>City</dt>
                <dd><input type="text" name="city" value="<?php echo h($contact['city']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Province</dt>
                <dd><input type="text" name="province" value="<?php echo h($contact['province']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Postal Code</dt>
                <dd><input type="text" name="postalCode" value="<?php echo h($contact['postalCode']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Date of Birth</dt>
                <dd><input type="text" name="dateOfBirth" value="<?php echo h($contact['dateOfBirth']); ?>" /></dd>
            </dl>
            <dl>
                <dt>UserName</dt>
                <dd><input type="text" name="userName" value="<?php echo h($contact['userName']); ?>" /></dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Edit contact" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>