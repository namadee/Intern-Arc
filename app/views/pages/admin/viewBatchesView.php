<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewbatches-content">

<br><br>
        <div class="s-top">
	
<div class="s-flex-container">

	<div class="sflex-wrap2">
		<div>
			<h3>Student Batches</h3>
		</div>
		<div>
			<form id="stform">
				<input type="text" placeholder="Search Batch" name="search">
			</form>
		</div>
	</div>

	<table >

		<tr>
		  <td>2017 Batch</td>
          <td>CS 250</td>
          <td>IS 140</td>
		  <td><button>view</button></td>
		</tr>

		<tr>
			<td>2018 Batch</td>
            <td>CS 250</td>
            <td>IS 140</td>
			<td><button>view</button></td>
		</tr>

		<tr>
			<td>2019 Batch</td>
            <td>CS 250</td>
            <td>IS 140</td>
			<td><button>view</button></td>
		</tr>

		<tr>
			<td>2017 Batch</td>
            <td>CS 250</td>
            <td>IS 140</td>
			<td><button>view</button></td>
		</tr>

		<tr>
			<td>2018 Batch</td>
            <td>CS 250</td>
            <td>IS 140</td>			
			<td><button>view</button></td>
		</tr>

		<tr>
			<td>2019 Batch</td>
            <td>CS 250</td>
            <td>IS 140</td>			
			<td><button>view</button></td>
		</tr>
	  </table>
	       
</div>
</div>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>