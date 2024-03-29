<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <?php flashMessage('attachment_status'); ?>

    <div class="company-invitation-container display-flex-col">
        <div class="invitation-top display-flex-row">
            <h2>Send Company Invitation</h2>
        </div>
        <div class="invitation-body">
            <form action="<?php echo URLROOT; ?>pdc/send-invitation" method="POST" enctype="multipart/form-data">
                <ul class="display-flex-col">
                    <li class="display-flex-row">
                        <label for="invitation-mail-attach">Attach File:</label>
                        <input type="file" class="common-input" name="invitation_attachment" id="invitation-mail-attach">
                    </li>
                    <li class="display-flex-row">
                        <label for="invitation-mail-subject">Subject</label>
                        <input type="text" class="common-input" name="invitation_subject" id="invitation-mail-subject">
                    </li>
                    <li class="display-flex-row">
                        <label for="invitation-mail-body" name>Invitation Message</label>
                        <textarea id="invitation-mail-body" class="common-input" name="invitation_body" rows="10" cols="50" value="">
                        </textarea>
                    </li>
                    <li class="display-flex-row">
                        <button type="submit" class="common-blue-btn display-flex-row"><span class="material-symbols-outlined">
                                send
                            </span> Send </button>
                    </li>
                </ul>

            </form>
        </div>

    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>