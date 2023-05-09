<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<script src="<?php echo URLROOT; ?>js/pdc.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="display-flex-col student-requests-list-container">
        <div class="top-container display-flex-row">
            <h2>Applied Adevertisements - Round <?php echo $data['round']; ?></h2>
            <a href="" class="common-blue-btn"> View Profile</a>
        </div>

        <div class="middle-container display-flex-row">
            <ul class="display-flex-col">
                <li class="display-flex-row top-name">
                    <p id="name">Name</p>
                    <p class="detail-item"><?php echo $data['requestsList'][0]->username; ?></p>
                </li>

                <li class="display-flex-row detail-container">
                    <div class="display-flex-row container-one">
                        <p id="reg-number">Index Number</p>
                        <p class="detail-item"><?php echo $data['requestsList'][0]->index_number; ?></p>
                    </div>
                    <div class="display-flex-row container-one">
                        <p>Batch</p>
                        <p class="detail-item"><?php echo $data['requestsList'][0]->batch_year; ?></p>
                    </div>
                </li>
                <li class="display-flex-row detail-container">
                    <div class="display-flex-row container-one">
                        <p id="reg-number">Registration Number</p>
                        <p class="detail-item"><?php echo $data['requestsList'][0]->registration_number; ?></p>
                    </div>
                    <div class="display-flex-row container-one">
                        <p>Stream</p>
                        <p class="detail-item"><?php echo $data['requestsList'][0]->stream; ?></p>
                    </div>


                </li>
            </ul>
        </div>

        <div class="bottom-container display-flex-col">

            <table class="requests-by-student-table">
                <tr>
                    <th>Advertisement</th>
                    <th>Initial Screening</th>
                    <th>Offer Consideration</th>
                    <th class="action-btn"></th>
                </tr>
                <?php foreach ($data['requestsList'] as $request) : ?>
                    <tr>
                        <td><?php echo $request->company_name . " - " .  $request->position ?></td>
                        <td>
                            <?php if ($request->initial_status == "pending") {
                                $status = "Pending";
                                $spanClass = "yellow-status";
                                $divClass = "yellow-status-font";
                            } else if ($request->initial_status == "rejected") {
                                # code...else
                                $status = "Rejected";
                                $spanClass = "red-status";
                                $divClass = "red-status-font";
                            } else {

                                $status = "Shortlisted";
                                $spanClass = "";
                                $divClass = "";
                            }; ?>
                            <div class="common-status display-flex-row <?php echo $divClass; ?>">
                                <span class="common-status-span <?php echo $spanClass; ?>">
                                </span>
                                <?php echo $status; ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($request->recruit_status == "pending") {
                                $status = "Pending";
                                $spanClass = "yellow-status";
                                $divClass = "yellow-status-font";
                            } else if ($request->recruit_status == "rejected") {
                                # code...else
                                $status = "Rejected";
                                $spanClass = "red-status";
                                $divClass = "red-status-font";
                            } else {

                                $status = "Recruited";
                                $spanClass = "";
                                $divClass = "";
                            }; ?>
                            <div class="common-status display-flex-row <?php echo $divClass; ?>">
                                <span class="common-status-span <?php echo $spanClass; ?>">
                                </span>
                                <?php echo $status; ?>
                            </div>
                        </td>
                        <td>
                            <a href="<?php echo URLROOT."advertisements/viewAdvertisement/".$request->ad_id ?>" class="common-view-btn"> View Ad </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>