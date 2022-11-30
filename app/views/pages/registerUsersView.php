<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="home-user-container" id="register-main-container">
    <div class="home-user-img">
        <img src="<?php echo URLROOT . 'img/register-user-img.svg' ?>" alt="Intern Arc Logo">
    </div>

    <form class="register-user-form display-flex-col " action="<?php echo URLROOT; ?>register/" method="POST">
        <h2>Register Users</h2>
        <label for="username">Name</label>
        <input type="text" class="common-input" name="username" required>
        <br>
        <label for="email">Email</label>
        <input type="email" class="common-input" name="email" required>
        <br>
        <label for="password">Password</label>
        <input type="password" class="common-input" name="password" required>
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
        <button class="common-blue-btn" type="submit">Register</button>
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