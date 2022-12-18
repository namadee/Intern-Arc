<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="advertisements-view-container">

<div class="published-ad-list-headingfloat">
	<br/><br/><br/><br/><br/>
	<div class="published-ad-list-flex-wrap">
		<div><h4>Round: 1st round</h4></div>
		<div><h4>Ending date: 2022/09/22</h4></div>
	</div>
</div>


<div class="published-ad-list-top">
	
<div class="published-ad-list-flex-container">

	<div class="published-ad-list-flex-wrap2">
		<div class="published-ad-list-heading">
			<h3>Advertisments</h3>
		</div>
		<div class="published-ad-list-dropdown-section">
			<div class="published-ad-list-dropdown">
				<i class="fa fa-filter"></i>
				<button onclick="myFunction()" class="published-ad-list-dropbtn">All</button>

				<div class="published-ad-list-dropdown-content" id="myDropdown" >
				  <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
				  <a href="#">Company</a>
				  <a href="#">Job</a>
				</div>

			  </div>
		</div>
		<div class="published-ad-list-container">
			<form id="search-form">
				<button class="published-ad-list-search-btn" type="submit"><i class="fa fa-search"></i></button>
				<input type="text" placeholder="Search.." name="search">
			</form>
		</div>
	</div>

	<table class="published-ad-list-ad-table" >
		<tr>
		  <th>Company Name</th>
		  <th>Job position</th>
		  <th></th>
		</tr>

		<tr>
		  <td>Virtusa</td>
		  <td>Software Engineer</td>
		  <td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td>WSO2</td>
			<td>Quality Assurance</td>
			<td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td>Codegen International</td>
			<td>Business Analyst</td>
			<td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td>Sysco Labs</td>
			<td>UI/UX Engineer</td>
			<td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td>Tech Venturas</td>
			<td>Mobile Application Developer </td>
			<td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td>Commercial Technologies Plus</td>
			<td>DevOps Engineer </td>
			<td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td>99x Technology</td>
			<td>Full Stack Engineer</td>
			<td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>

		<tr>
			<td>Virtusa</td>
			<td>Software Engineer </td>
			<td><a href="<?php echo URLROOT.'advertisements/show-advertisements-details';?>"><button>view</button></a></td>
		</tr>
	  </table>
	       
</div>
</div>

<script>
	/* When the user clicks on the button,
	toggle between hiding and showing the dropdown content */
	function myFunction() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}
	
	function filterFunction() {
	  var input, filter, ul, li, a, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  div = document.getElementById("myDropdown");
	  a = div.getElementsByTagName("a");
	  for (i = 0; i < a.length; i++) {
		txtValue = a[i].textContent || a[i].innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		  a[i].style.display = "";
		} else {
		  a[i].style.display = "none";
		}
	  }
	}
	</script>


</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>