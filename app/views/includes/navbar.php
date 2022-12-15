</head>

<body>
    <nav class="display-flex-col" id="nav" class="">
        <div class="sidebar-items display-flex-col">
            <div class="navbar-main-logo">
                <img src="<?php echo URLROOT . 'img/logo.png' ?>" alt="Main Logo" class="" id="main-logo" />
            </div>
            <!-- Rendered Using JS -->
            <ul class="nav-links display-flex-col" id="navbarItems">
            </ul>
        </div>
        <div class="sidebar-bottom">
            <ul>
                <li>
                    <a href="<?php echo URLROOT . 'users/logout' ?>">
                        <span class="material-symbols-rounded"> logout</span>
                        <p>Sign Out</p>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- To get Navigation Menu - MUST ADD TO DASHBOARD OF EACH USER-->
    <?php $navSidebar = $_SESSION['user_role']; ?>
    <script type="text/javascript">
        sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
    </script>

    <main id="main" class="">
        <section id="topnav" class="top-nav">
            <div class="topNav-left" id="top-nav-left">
                <div class="toggle-nav-logo" id="toggle-nav-logo">
                    <img src="<?php echo URLROOT . 'img/logo-icon.png' ?>">
                </div>
                <div class="topNav-icon">
                    <span class="material-symbols-rounded" onclick="toggleNav()">sort</span>
                </div>
                <p>Dashboard</p>
            </div>
            <div class="topNav-right">
            <div class="topNav-icon">
                    <span class="material-symbols-outlined">notifications</span>
                </div>
                <p><?php echo $_SESSION['username'] ?></p>
                <img src="<?php echo URLROOT . 'img/profile-img/profile-icon.svg' ?>">
            </div>
        </section>