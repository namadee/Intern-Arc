<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">

<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="pdc_jobroles_page" class="main-content">
    <?php flashMessage('pdcStaffMsg') ?>

    <div class="jobroles-quickAdd display-flex-col">
        <h3>
            Add a new PDC Member
        </h3>
        <form class="display-flex-col" action="<?php echo URLROOT . "register/" ?>" method="POST">
            <label for="username">Username</label>
            <input type="text" class="common-input" name="username" id="username" required>
            <label for="email">Email</label>
            <input type="email" class="common-input" name="email" id="email" required>
            <button type="submit" class="common-blue-btn">
                Register Member
            </button>
        </form>
    </div>
    <div class="jobroles-rolesList">
        <h3>PDC staff list</h3>

        <table class="jobroles">
            <?php foreach ($data['staff'] as $staff) : ?>
                <tr>
                    <td><?php echo $staff->username ?></td>
                    <td><?php echo $staff->email ?></td>
                    <td><a class="common-edit-btn" href="<?php echo URLROOT.'admin/pdc-staff/view/'.$staff->user_id ?>"><span class="material-symbols-outlined">
                                edit_square
                            </span></a>
                    </td>
                    <td>
                        <a class="common-edit-btn" href="<?php echo URLROOT.'admin/pdc-staff/delete/'.$staff->user_id ?>"><span id="delete" class="material-symbols-outlined">
                                delete
                            </span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>

    <!-- UPDATE PDC MODEL -->
    <div class="common-modal-box <?php echo $data['updateModelBox']; ?>" id="jobroles-modal-box">
        <form method="POST" action="<?php echo URLROOT . "admin/pdc-staff/update/" . $data['userID'] ?>" class="display-flex-col common-modal-box-form">
            <h3>Update Member Details</h3>

            <a href="<?php echo URLROOT . "admin/pdc-staff" ?> " id="modal-box-close">
                <span class="material-symbols-outlined" id="jobrole-modal-span" class="common-modal-close">
                    close
                </span></a>
            <div class="display-flex-col">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="common-input" value="<?php echo $data['username']; ?>">
            </div>
            <div class="display-flex-col">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="common-input" value="<?php echo $data['useremail']; ?>">
            </div>

            <button type="submit" class="common-blue-btn" id="modal-submit-btn">Update</button>
        </form>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>