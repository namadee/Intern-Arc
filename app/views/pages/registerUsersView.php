<?php require APPROOT . '/views/includes/header.php'; ?>
<script src="<?php echo URLROOT .'js/register.js'?>"></script>
</head>
<section class="home-user-container" id="register-main-container">
    <div class="home-user-img">
        <img src="<?php echo URLROOT . 'img/register-user-img.svg' ?>" alt="Intern Arc Logo">
    </div>

    <form class="register-user-form display-flex-col " id="regForm" action="<?php echo URLROOT; ?>register/" method="POST" name="reg_form">
        <h2>Register Users</h2>
        <label for="username">Name</label>
        <input type="text" class="common-input" name="username" required>
        <br>
        <label for="email">Email</label>
        <input type="email" class="common-input" name="email" required>
        <br>
        <label for="password">Password</label>
<<<<<<< HEAD
        <input type="password" class="common-input" id="password" name="password" required>
=======
        <input type="password" class="common-input" id="password" name="password" pattern="(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
>>>>>>> 4eb739667e5b1599d4cbd087c8bf2190218b0129
        <br>
        <label for="contact">Contact</label>
        <input type="text" class="common-input" name="contact" required>
        <br>
        <label for="user_role">Choose the type of user:</label>
        <select class="common-input" name="user_role" id="user_role" required>
            <option value='admin'>Admin</option>
            <option value='student'>Student</option>
            <option value='company'>Company</option>
            <option value='pdc'>PDC</option>
        </select>
        <br>
<<<<<<< HEAD
        <button class="common-blue-btn" type="submit" onclick="ValidateEmail(document.reg_form.email)">Register</button>
=======
        <button class="common-blue-btn" type="submit" onclick="Validate(document.reg_form.email, document.reg_form.password)">Register</button>
        <p id="validate-msg"></p>
>>>>>>> 4eb739667e5b1599d4cbd087c8bf2190218b0129
        <div class="signin-error-hide <?php echo $data['error_class']; ?>">
            <span class="material-symbols-rounded">
                report
            </span>
            <?php echo $data['error_msg']; ?>
        </div>
    </form>

</section>

</body>

</html>