<?php require_once('../../../private/initialize.php'); ?>

<?php
session_start();

require_admin_login();

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="pages listing">
        <h1>Administrator Panel</h1>
    </div>
    <div class="export">
        <h2>Export Database</h2>
        <form action="export.php" method="post" enctype="multipart/form-data">
            <p>
                <input class="btn-red" type="submit" name="submit" value="Export" />
            </p>
            <a class="back-link" href="cms_application.csv">Download Database</a>
        </form>
    </div>
    <div class="restore">
        <h2>Restore Database</h2>
        <form action="restore.php" method="post" enctype="multipart/form-data">
            <p>
                <input type="file" name="file" id="file" /><br />
                <input class="btn-green" type="submit" name="submit" value="Restore" />
            </p>
        </form>
    </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>