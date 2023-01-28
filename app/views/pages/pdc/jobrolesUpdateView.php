<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="pdc_jobroles_page" class="main-content">
    <div class="jobroles-quickAdd display-flex-col">
        <h3>
            Add a new Job Role
        </h3>
        <form class="display-flex-col" action="" method="POST">
            <label for="jobrole">Name</label>
            <input type="text" class="common-input" name="jobrole" id="jobrole" required>
            <button type="submit" class="common-blue-btn">
                Add Job Role
            </button>
        </form>
    </div>
    <div class="jobroles-rolesList">
        <h3>Job Roles List</h3>
        <table class="jobroles">
            <?php foreach ($data['jobroles'] as $jobrole) : ?>
                <tr>
                    <td><?php echo $jobrole->name ?></td>
                    <td><a class="common-edit-btn" href="<?php echo URLROOT; ?>jobroles/showJobrole/<?php echo $jobrole->jobrole_id; ?>"><span class="material-symbols-outlined">
                                edit_square
                            </span></a>
                    </td>
                    <td>
                        <a class="common-edit-btn" href="<?php echo URLROOT; ?>jobroles/deleteJobrole/<?php echo $jobrole->jobrole_id; ?>"><span id="delete" class="material-symbols-outlined">
                                delete
                            </span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="common-modal-box" id="jobroles-modal-box">
        <form method="POST" action="<?php echo URLROOT . "jobroles/update-jobrole/" . $data['jobrole_id'] ?>" class="display-flex-col">
            <a href="<?php echo URLROOT . "jobroles" ?> ">
            <span class="material-symbols-outlined" id="jobrole-modal-span" class="common-modal-close">
                close
                </span></a>
            <label for="jobrole-update">Jobrole Name</label>

            <input type="text" name="jobrole-update" id="jobrole-update" class="common-input" value="<?php echo $data['inputValue'] ?>">
            <button type="submit" class="common-blue-btn">Update</button>
        </form>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>