<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section class="complaint-main-container">
<div class="top">
	<h3>Submit Complaints</h3>

<div class="flex-container">
	<div>

  	<form class="complaint-box" action="<?php echo URLROOT. $data['formAction']; ?>" method="POST" >
    	<label for="subject">Subject</label>
    	<input type="text" name="subject" id="subject" value="<?php echo $data['inputValue'] ?>" required placeholder="Your subject goes here...">
    	<label for="complaint">Description</label>
    	<textarea id="description" name="description" placeholder="Write your complaint here..." style="height:200px"></textarea>
  	

		<button type="submit" class="common-blue-btn">
			<?php echo $data['buttonName'] ?>
		</button>
	</form>

 	</div>

  	<!-- <div>Complaint List
		<div class="complaint-box-row">
	   		Subject 1
	   		<button class="login-btn">View</button>
		</div>
		<div class="complaint-box-row">
	   		Subject 2
	   		<button class="login-btn" >View</button>	
		</div>
	</div> -->
	<div class="jobroles-rolesList">
        <h3>Complaints List</h3>
        <table class="jobroles">
            <?php foreach ($data['subject'] as $complaint) : ?>
                <tr>
                    <td><?php echo $complaint->subject ?></td>
                    <td><a href="<?php echo URLROOT; ?>Complaints/showComplaint/<?php echo $complaint->complaint_id; ?>"><span class="material-symbols-outlined">
                                drive_file_rename_outline
                            </span></a>
                    </td>
                    <td>
                        <a href="<?php echo URLROOT; ?>Complaints/deleteComplaint/<?php echo $complaint->complaint_id; ?>"><span id="delete" class="material-symbols-outlined">
                                delete
                            </span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>
</div>

</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>