<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="view-ads-container">
<br/><br/><br/>
<div class="view-ads-top">
	
<div class="view-ads-flex-container">

	<div class="view-ads-flex-wrap">
		<div class="view-ads-heading">
			<h3>Advertisements by Virtusa</h3>
		</div>
		<div class="view-ads-search">
			<form class="view-ads-search-container">
				<button class="view-ads-search-btn" type="submit"><i class="fa fa-search"></i></button>
				<input type="text" placeholder="Search Job Role" name="search">
			</form>
		</div>
	</div>

	<table class="view-ads-table">
		<tr>
		  <th class="view-ads-table-header">Job Role</th>
		  <th class="view-ads-table-header"></th>
		</tr>

		<tr>
		  <td class="view-ads-table-data">Software Engineer</td>
		  <td class="view-ads-table-data"><button>view</button></td>
		</tr>

		<tr>
			<td class="view-ads-table-data">Business Analyst</td>
			<td class="view-ads-table-data"><button>view</button></td>
		</tr>

		<tr>
			<td class="view-ads-table-data">Quality Assurance</td>
			<td class="view-ads-table-data"><button>view</button></td>
		</tr>

		<tr>
			<td class="view-ads-table-data">UI/UX Engineer</td>
			<td class="view-ads-table-data"><button>view</button></td>
		</tr>

		<tr>
			<td class="view-ads-table-data">Web Developer</td>			
			<td class="view-ads-table-data"><button>view</button></td>
		</tr>

		<tr>
			<td class="view-ads-table-data">DevOps Engineer</td>			
			<td class="view-ads-table-data"><button>view</button></td>
		</tr>

		<tr>
			<td class="view-ads-table-data">Mobile Applications Developer</td>			
			<td class="view-ads-table-data"><button>view</button></td>
		</tr>
	  </table>
	       
</div>
</div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>