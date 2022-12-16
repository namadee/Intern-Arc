</head>

<body>
<nav class="display-flex-col" id="nav" class="">
    <div class="sidebar-items display-flex-col">
    <div class="navbar-main-logo">
    <img src="<?php echo URLROOT . 'img/logo.png' ?>" alt="Main Logo" class="" id="main-logo" />
    </div>        
        
        <ul class="nav-links display-flex-col " id="navbarItems" >
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
                        <p ><?php echo $navItem[2] ?></p>
                    </a>
                </li>
            <?php endforeach;?>
            
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
        <div class="topNav-left">
            <div class="topNav-icon" >
                <span class="material-symbols-rounded" onclick="toggleNav()">sort</span>
            </div>
            <p>Dashboard</p>
        </div>
        <div class="topNav-right">
            <p><?php echo $_SESSION['username'] ?></p>
            <img src="<?php echo URLROOT . 'img/profile-img/profile-icon.svg' ?>">
        </div>
    </section>