<?php
?>

</head>

<body>
    <?php

    use helpers\Session;

    if (!SESSION::isLoggedIn()) {
        redirect('login');
    }

    //Call Round Check Function in general helper
    $roundDataArray = roundCheckFunction();

    //Call 

    ?>
    <nav class="display-flex-col" id="nav" class="">
        <div class="sidebar-items display-flex-col">
            <div class="navbar-main-logo">
                <img src="<?php echo URLROOT . 'img/logo.png' ?>" alt="Main Logo" class="" id="main-logo" />
            </div>

            <ul class="nav-links display-flex-col " id="navbarItems">
                <?php
                $userRole = $_SESSION['user_role'];
                $userRole = strtolower($userRole); //To lower case

                //Based on the userRole navigation data will be received
                $navigation = getNavigationByUser($userRole) ?>
                <?php foreach ($navigation as $navItem) : ?>
                    <li>
                        <a href="<?php echo $navItem[0] ?>">
                            <span class="material-symbols-rounded">
                                <?php echo $navItem[1] ?>
                            </span>
                            <p><?php echo $navItem[2] ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
        <div class="sidebar-bottom">
            <ul>
                <li>
                    <a href="<?php echo URLROOT . 'login/logout' ?>">
                        <span class="material-symbols-rounded"> logout</span>
                        <p>Sign Out</p>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="main" class="">
        <section id="topnav" class="top-nav">
            <div class="topNav-left" id="top-nav-left">
                <div class="toggle-nav-logo" id="toggle-nav-logo">
                    <img src="<?php echo URLROOT . 'img/logo-icon.png' ?>">
                </div>
                <div class="topNav-icon" onclick="toggleNav()">
                    <span class="material-symbols-rounded">sort</span>
                </div>
                <p></p>
            </div>
            <div class="topNav-right">

                <div id="notfIcon" class="topNav-icon topNav-notif<?php echo count($_SESSION['roundNotification']) ? ' unread' : ''; ?>">
                    <span class="material-symbols-outlined">notifications</span>
                    <?php if (count($_SESSION['roundNotification'])) : ?>
                        <span class="unread-dot"></span>
                    <?php endif; ?>
                    <section>
                        <ul id="notification-list" class="notification-list">
                            <?php $notifications = $_SESSION['roundNotification'] ?>
                            <?php foreach ($notifications as $notification) : ?>
                                <li class="notification-item">
                                    <h3><?php echo $notification->title ?></h3>
                                    <p><?php echo $notification->message ?></p>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </section>

                </div>
                <p><?php echo $_SESSION['username'] ?></p>
                <img src="<?php echo URLROOT . $_SESSION['profile_pic'] ?>">
            </div>


        </section>