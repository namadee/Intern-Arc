<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="pdc_jobroles_page" class="main-content">
    <?php flashMessage('jobroleView') ?>

    <div class="jobroles-quickAdd display-flex-col">
        <h3>
            Add a new Job Role
        </h3>
        <form class="display-flex-col" action="<?php echo URLROOT . "jobroles/add-jobrole" ?>" method="POST">
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
                    <?php
                    if ($roundDataArray['roundNumber'] != NULL) {
                        // Need Round Constraints
                        $hrefStatus1 = $roundDataArray['hrefStatus'];
                        $hrefStatus2 = $roundDataArray['hrefStatus'];
                        $elementClass = $roundDataArray['disabledClass'];
                    } else {
                        // No need of round constraints
                        $hrefStatus1 = URLROOT . 'jobroles/show-jobrole/' . $jobrole->jobrole_id;
                        $hrefStatus2 = URLROOT . 'jobroles/delete-jobrole/' . $jobrole->jobrole_id;
                        $elementClass = "";
                    }
                    ?>
                    <td><a class="common-edit-btn <?php echo $elementClass; ?>" href="<?php echo $hrefStatus1; ?>"><span class="material-symbols-outlined">
                                edit_square
                            </span></a>
                    </td>
                    <td>
                        <a class="common-edit-btn <?php echo $elementClass; ?>" href="<?php echo $hrefStatus2; ?>"><span id="delete" class="material-symbols-outlined">
                                delete
                            </span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>