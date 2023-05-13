<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="error-page-container display-flex-row">

    <img class="four04" src="<?php echo URLROOT . "img/no-access.svg" ?>">
    <div class="display-flex-col">
        <h1>No ACCESS !!!</h1>
        <p>Seems like you do not have access to this page.</p>
        <a href="<?php echo URLROOT . "errors/error-redirect"; ?>">Click Here to Redirect</a>
    </div>
</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>