<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewpdcuser-content">

<section id="add_PDC_page" class="main-content">
            <div class="add_pdc">
           
        </form> 
        <div class="p-top">
		<h3>PDC Staff User</h3>
		<div class="vpflex-container">
			<div>
				Name
				<br />
				<div class="view"><?php echo $data['staff']->username;?></div>
				Email
				<div class="view"><?php echo $data['staff']->email;?> </div>
				<br />
                <!-- <div class="btn">
                  <button>Delete</button>
                </div> -->
				
			</div>
		</div>
	</div>

            </div>
        </section>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>