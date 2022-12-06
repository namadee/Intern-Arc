<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>


<section id="update-admin-profile" class="main-content">

    <div class="update-profile-container display-flex-col">
        <h3>View Profile</h3>

        <form class="display-flex-col" method="POST" action="<?php echo URLROOT . "admin/updateProfile" . $data['user_id']; ?>">
        <div class="admin-user-profile-icon">

        </div>
            <ul>
                <li>
                <img src="<?php echo URLROOT; ?>img/profile-img/profile-icon.svg">
                <a href="" class="common-edit-btn" id="admin-profile-edit"><span class="material-symbols-outlined">
                        edit_square
                    </span></a>
                </li>
                <li>
                    <label for="username">Name</label>
                    <input class="common-input" type="text" id="username" name="username" placeholder="Name" value="<?php echo $data['username']; ?>">
                    <a href="" class="common-edit-btn"><span class="material-symbols-outlined">
                            edit_square
                        </span></a>
                </li>
                <li>
                    <label for="email">Email</label>
                    <input class="common-input" type="email" id="email" name="name" placeholder="Email" value="<?php echo $data['useremail']; ?>">
                    <a href="" class="common-edit-btn "><span class="material-symbols-outlined">
                            edit_square
                        </span></a>
                </li>
                <li>
                    <label for="contact">Contact</label>
                    <input class="common-input" type="text" id="contact" name="contact" placeholder="Contact Number" value="<?php echo $data['contact']; ?>">
                    <a href="" class="common-edit-btn "><span class="material-symbols-outlined">
                            edit_square
                        </span></a>
                </li>
            </ul>
            <div class="update-profile-container-btn">
                <button class="common-blue-btn" type="submit">Update</button>
                <button class="common-blue-btn">Change Password</button>
            </div>
        </form>


    </div>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>