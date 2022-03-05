<?php

require_once('../../../private/initialize.php');

session_start();
    // If the user is not logged in redirect to the login page...
require_user_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/contacts/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  
  $result = delete_contact($id);
  redirect_to((url_for('/staff/contacts/index.php')));

} else {
  $contact = find_contact_by_id($id);
}

?>

<?php $page_title = 'Delete contact'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/contacts/index.php'); ?>">&laquo; Back to List</a>

    <div class="contact delete">
        <h1>Delete contact</h1>
        <p>Are you sure you want to delete this contact?</p>
        <p class="item"><?php echo h($contact['firstName']); ?></p>

        <form action="<?php echo url_for('/staff/contacts/delete.php?id=' . h(u($contact['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete contact" />
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>