<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="error-page-container display-flex-row">

    <img class="four04" src="<?php echo URLROOT . "img/error-icon.svg" ?>">
    <div class="display-flex-col">
        <h1>Ooops Page Not Found !!!</h1>
        <p>Seems like the page you are looking for is not available.</p>
        <a href="<?php echo URLROOT."users"; ?>">Click Here to Redirect</a>
    </div>
</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>