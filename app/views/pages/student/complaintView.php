<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section id="student_complaints_page" class="main-content">
	<div class="complaints-quickAdd display-flex-col">
		<h3>
            Submit your complaint
    	</h3>
  		<form class="display-flex-col" action="<?php echo URLROOT. $data['formAction']; ?>" method="POST" >
    	<label for="subject">Subject</label>
    	<input type="text" class="common-input" name="subject" id="subject" value="<?php echo $data['subject'] ?>" required>
    	<label for="complaint">Description</label>
    	<textarea id="description" name="description" required><?php echo $data['description'] ?></textarea>
  	

		<button type="submit" class="common-blue-btn">
			<?php echo $data['buttonName'] ?>
		</button>
		</form>

 	</div>
	<div class="complaints-list">
        <h3>Complaints List</h3>
        <table class="complaints">
            <?php foreach ($data['complaints'] as $complaint) : ?>
                <tr>
                    
					<td><?php echo $complaint->subject ?></td>
                    <td><?php echo ($complaint->status  == 0) ?  'Pending' : 'Reviewed'; ?></td>
                    
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

</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>