<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
</head>
<body>
<section class="signin-main-container display-flex-col">
    <img src="<?php echo URLROOT . 'img/logo.png' ?>" alt="Intern Arc Logo">
    <form action="<?php echo URLROOT; ?>users/pdc-login" method="POST" class="display-flex-col">
        <h2>Sign In to Intern Arc</h2>
        <div class="signin-form-content display-flex-col">
            <span class="material-symbols-rounded">
                person
            </span>
            <input type="email" class="common-input" name="email" placeholder="Enter Your Email" required>
        </div>

        <div class="signin-form-content display-flex-col">
            <span class="material-symbols-rounded">
                key
            </span>
            <input type="password" class="common-input" name="password" placeholder="Enter Your Password" required>
        </div>
        <div class="signin-error-hide <?php echo $data['error_class']; ?>">
            <span class="material-symbols-rounded">
                report
            </span>
            <?php echo $data['error_msg']; ?>
        </div>
        <button class="common-blue-btn" type="submit">Submit</button>
    </form>
</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>