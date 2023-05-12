<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="Interview-list" class="main-content">
    <div class="common_list">

        <div class="common_list_content">
            <a class="common-view-btn" href="<?php echo URLROOT; ?>schedule/">Book Slots</a>

            <table class="common-table">
                <tr>
                    <th>Advertisement Name</th>

                    <th>Book Slots</th>

                </tr>

                <?php foreach ($data['advertisement_reqs'] as $addata) : ?>
                    <tr>
                        <td><?php echo $addata->position ?></td>


                    </tr>

                <?php endforeach; ?>
            </table>
        </div>

    </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>