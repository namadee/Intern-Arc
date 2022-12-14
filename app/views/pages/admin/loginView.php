<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
</head>

<body>

	<body>

		<div class="admin-signin-container">
			<div class="admin-signin-img">
				<img src="<?php echo URLROOT . 'img/logo-icon.png' ?>" alt="Intern Arc Logo">

			</div>
			<div class="admin-signin-content">
				<form action="<?php echo URLROOT."login/admin-login" ?>" method="POST" class="display-flex-col">
					<h2>Welcome to Intern Arc</h2>
					<div class="admin-signin-item">
						<span class="material-symbols-outlined">
							person
						</span>
						<input type="text" class="input" placeholder="Username">
					</div>
					<div class="admin-signin-item">
						<span class="material-symbols-outlined">
							lock
						</span>
						<input type="password" class="input" placeholder="Password">
					</div>
					<a href="#">Forgot Password?</a>
					<button type="submit">Login</button>

				</form>
			</div>
		</div>


		<?php require APPROOT . '/views/includes/footer.php'; ?>