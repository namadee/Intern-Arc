<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/student.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/shared.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section id="advertisement-list" class="main-content">

    <div class="common_list">
        <div class="common-list-topbar">
            <form action="" class="common-search-bar display-flex-row">
                <span class="material-symbols-rounded">
                    search
                </span>
                <input class="common-input" type="text" name="search-item" placeholder="Search Advertisement">
            </form>
        </div>
        <div class="common_list_content">
            <h3 style="text-align: center; margin-bottom:1rem;"><?php echo $data['companyName'] ?> - Advertisement List in the current batch year <?php echo $_SESSION['batchYear'] ?></h3>
            <table class="common-table">
                <tr>
                    <th>Position</th>
                    <th>No of Interns</th>
                    <th>View Advertisement</th>

                </tr>

                <tbody>

                    <?php foreach ($data['advertisements'] as $ads) : ?>
                        <tr>
                            <td class="view-companies-table-data"><?php echo $ads->position ?></td>
                            <td class="view-companies-table-data"><?php echo $ads->intern_count ?></td>
                            <td class="view-companies-table-data"><a href="<?php echo URLROOT . 'advertisements/view-advertisement/' . $data['companyID']; ?>"><button class="common-view-btn">view</button></a></td>

                        </tr>



                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
    </div>

</section>

<script src='<?php echo URLROOT; ?>js/searchCompanies.js'></script>

<?php require APPROOT . '/views/includes/footer.php'; ?>