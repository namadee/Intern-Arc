<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="comapany-profile-container">

<div class="company-profile-top">
	
	<div class="company-profile-container">

		<div class="company-profile-flex-wrap2">
			<h3>Company Profile </h3>
		</div>

		<div class="company-profile-details-container">
			<div class="company-profile-logo"> <img class="company-profile-logo-icon" src="<?php echo URLROOT.'img/virtusa-logo.jpeg';?>" alt="virtusa logo"> </div>
			<div class="company-profile-description">
				<p style="margin-bottom: 0; font-size:2rem;">Welcome to <span style="color:darkorange ;"> Virtusa </span></p>
				<p style="margin-top: 0; color:darkorange ;">Sparking innovation, one sprint at a time</p>
				<p>Virtusa help clients change, disrupt, and unlock new value that surpasses their wildest expectations not just to reach our best, but to redefine yours.</p>

			</div>
		</div>
		
	       
	</div>
</div>

<div class="company-profile-bottom">

	<div class="company-technologies">
	<h3 style="color: white;">Preferred technologies</h3>
		<div class="tech-button-area">
		<button class="technologies-btn">React Js </button>
		<button class="technologies-btn">Next Js</button>
		<button class="technologies-btn">Python</button>
		<br>
		<button class="technologies-btn">Java</button>
		<button class="technologies-btn">C++</button>
		<button class="technologies-btn">PHP</button>
		</div>
	</div>

	<div class="company-contact-area">
		<a href="#"><button class="visit-web-btn">Visit Web Site</button></a>
		<a href="#"><button class="view-ads-btn"><a href="<?php echo URLROOT.'companies/show-advertisements-by-company';?>"> View Advertisements </a> </button></a>
		<br>
		<table class="links-and-address">
		<tr>
		<td><span style="font-size: 3rem; color:white;"><i class="fa-brands fa-linkedin"></i></span></td>
		<td><span style="font-size: 3rem; color:white; margin-left: 1rem;"><i class="fa-solid fa-location-dot"></i></span></td> 
		<td style="color:white;"><p>752, <br> Dr. Danister De Silva Mawatha, <br> Colombo 09</p></td>
		</tr>		
		</table>
	</div>

</div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>