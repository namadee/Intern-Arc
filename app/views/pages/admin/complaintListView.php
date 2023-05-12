<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<script src="<?php echo URLROOT; ?>js/admin.js" defer></script>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
<?php flashMessage('complaintMsg') ?>

    <div class="company-content-container display-flex-col">
        <div class="company-content-top display-flex-row">
            <h2>Complaint List</h2>
            <!-- Common Search Bar Style-->
            <form action="javascript:void(0)" class="common-search-bar display-flex-col">
                <div class="display-flex-row">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                    <input class="common-input" type="text" name="search-item" id="pdc_search_company" placeholder="Search Reference Num">
                </div>

                <div class="common-search-result display-flex-col" id="pdc_company_result">

                </div>
            </form>

        </div>
        <div class="manage-company-table" id="complaint_list_div">
            <table>
                <thead>
                    <th>Reference Number</th>
                    <th>Subject</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th id="action-th"></th>

                </thead>
                <tbody>
                    <?php foreach ($data['complaintList'] as $complaint) : ?>
                        <tr>
                            <td><?php echo $complaint->reference_number ?></td>
                            <td><?php echo $complaint->subject ?></td>
                            <td><?php echo $complaint->username ?></td>
                            <td>
                                <div class="common-status display-flex-row <?php echo $complaint->status == '0' ? 'red-status-font' : ''; ?> ">

                                    <span class="common-status-span <?php echo $complaint->status == '0' ? 'red-status' : ''; ?>">
                                    </span>
                                    <?php echo $complaint->status == '0' ? 'Pending' : 'Reviewed'; ?>
                                </div>
                            </td>
                            <td><a href="<?php echo URLROOT . 'admin/complaint/' . $complaint->complaint_id . '/' . $complaint->user_id; ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>





<?php require APPROOT . '/views/includes/footer.php'; ?>