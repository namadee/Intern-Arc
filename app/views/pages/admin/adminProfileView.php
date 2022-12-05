<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
</head>
<body>
    <?php require APPROOT . '/views/includes/navbar.php'; ?>


    <!-- To get Navigation Menu - MUST ADD TO DASHBOARD OF EACH USER-->
    <?php $navSidebar = $_SESSION['user_role']; ?>
    <script type="text/javascript">
        sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
    </script>


    <section id="add_Profile_page" class="main-content">
        <div class="add_profile">

            </form>
            <div class="top">
                <h3>View Profile</h3>
                <div class="flex-container">
                    <div>
                        <div class="admin-user-profile-icon">
                            <img src="images/profile-icon.svg">
                        </div>
                        <form>
                            <label for="sub">Name</label>
                            <input type="text" id="sub" name="name" placeholder="Enter user name here...">
                            <label for="email">Email</label>
                            <input type="text" id="sub" name="name" placeholder="Enter your email here...">
                        </form>

                        <div class="admin-btn">
                            <button>Save</button> <button>Change Password</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php require APPROOT . '/views/includes/footer.php'; ?>