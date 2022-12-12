<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="pdc_jobroles_page" class="main-content">
    <div class="jobroles-quickAdd display-flex-col">
        <h3>
            Add a new Job Role
        </h3>
        <form class="display-flex-col" action="<?php echo URLROOT ."jobroles/add-jobrole" ?>" method="POST">
            <label for="jobrole">Name</label>
            <input type="text" class="common-input" name="jobrole" id="jobrole" value="<?php echo $data['inputValue'] ?>" required>
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
                    <td><a class="common-edit-btn" href="<?php echo URLROOT; ?>jobroles/show-jobrole/<?php echo $jobrole->jobrole_id; ?>"><span class="material-symbols-outlined">
                    edit_square
                            </span></a>
                    </td>
                    <td>
                        <a class="common-edit-btn"  href="<?php echo URLROOT; ?>jobroles/delete-jobrole/<?php echo $jobrole->jobrole_id; ?>"><span id="delete" class="material-symbols-outlined">
                                delete
                            </span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>