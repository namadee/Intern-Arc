<?php require APPROOT . '/views/includes/header.php'; ?>
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<!-- To get Navigation Menu - MUST ADD TO DASHBOARD OF EACH USER-->
<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
    sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

<section id="pdc_jobroles_page" class="main-content">
    <div class="jobroles-quickAdd display-flex-col">
        <h3>
            Add a new Job Role
        </h3>
        <form class="display-flex-col" action="<?php echo URLROOT . $data['formAction']; ?>" method="POST">
            <label for="jobrole">Name</label>
            <input type="text" class="common-input" name="jobrole" id="jobrole" value="<?php echo $data['inputValue'] ?>">
            <button type="submit" class="common-blue-btn">
                <?php echo $data['buttonName'] ?>
            </button>
        </form>
    </div>
    <div class="jobroles-rolesList">
        <h3>Job Roles List</h3>
        <table class="jobroles">
            <?php foreach ($data['jobroles'] as $jobrole) : ?>
                <tr>
                    <td><?php echo $jobrole->name ?></td>
                    <td><a href="<?php echo URLROOT; ?>jobroles/showJobrole/<?php echo $jobrole->jobrole_id; ?>"><span class="material-symbols-outlined">
                                drive_file_rename_outline
                            </span></a>
                    </td>
                    <td>
                        <a href="<?php echo URLROOT; ?>jobroles/deleteJobrole/<?php echo $jobrole->jobrole_id; ?>"><span id="delete" class="material-symbols-outlined">
                                delete
                            </span></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>