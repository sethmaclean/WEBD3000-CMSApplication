<?php require_once('../../../private/initialize.php'); ?>

<?php

session_start();

require_user_login();

    if(isset($_POST['month'])) {
        $contact_set = find_contacts_by_birthday($_POST['month']);
    } else {
        $contact_set = find_all_contacts();
    }

?>

<?php $page_title = 'contacts'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="contacts listing">
        <h1>Customer Database</h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/contacts/new.php'); ?>">Create New contact</a>
            <a class="action" href="<?php echo url_for('/staff/contacts/birthday.php'); ?>">Birthday Filter</a>
            <a class="action" href="<?php echo url_for('/staff/contacts/email.php'); ?>">Email Contacts</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>First</th>
                <th>Last</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal</th>
                <th>Date</th>
                <th>User</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php while($contact = mysqli_fetch_assoc($contact_set)) { ?>
            <tr>
                <td><?php echo h($contact['id']); ?></td>
                <td><?php echo h($contact['firstName']); ?></td>
                <td><?php echo h($contact['lastName']); ?></td>
                <td><?php echo h($contact['phone']); ?></td>
                <td><?php echo h($contact['email']); ?></td>
                <td><?php echo h($contact['address']); ?></td>
                <td><?php echo h($contact['city']); ?></td>
                <td><?php echo h($contact['province']); ?></td>
                <td><?php echo h($contact['postalCode']); ?></td>
                <td><?php echo h($contact['dateOfBirth']); ?></td>
                <td><?php echo h($contact['userName']); ?></td>

                <td><a class="action"
                        href="<?php echo url_for('/staff/contacts/show.php?id=' . h(u($contact['id']))); ?>">View</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/staff/contacts/edit.php?id=' . h(u($contact['id']))); ?>">Edit</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/staff/contacts/delete.php?id=' . h(u($contact['id']))); ?>">Delete</a>
                </td>

            </tr>
            <?php } ?>
        </table>

        <?php mysqli_free_result($contact_set); ?>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>