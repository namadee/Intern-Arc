<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content">
  <div class="common_list">
    <div class="common-list-topbar">
    <form action="" class="common-search-bar display-flex-row">
                <span class="material-symbols-rounded">
                    search
                </span>
                <input class="common-input" type="text" name="search-item" placeholder="Search Advertisement">
      </form>
      <div class="common-filter">
        <span class="material-symbols-rounded">
          filter_alt
        </span>
        <select name="filter-list" id="filterlist">
          <option value="all" selected>All</option>
          <option value="name">name</option>
          <option value="name">name</option>
          <option value="name">name</option>
        </select>
      </div>
    </div>

    <div class="common_list_content">
      
      <div class="addBtn">
      <h3>Advertisement List-Shortlisted</h3>
</div>
      <table class="common-table">
        <tr>
          <th>Advertisement Name</th>
          <th>No of Interns</th>
          <th>Total Requests</th>
          <th>Shortlisted</th>
        </tr>
        

          <tr>
            <td>Software Engineer-Virtusa</td>
            <td>10</td>
            <td>25</td>
            <td>25</td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>requests/shortlisted-students" >View</a>
            </td>
          
          </tr>
          <tr>
            <td>Software Engineer-Virtusa</td>
            <td>10</td>
            <td>25</td>
            <td>25</td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>requests/shortlisted-students" >View</a>
            </td>
          
          </tr>
          <tr>
            <td>Software Engineer-Virtusa</td>
            <td>10</td>
            <td>25</td>
            <td>25</td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>requests/shortlisted-students" >View</a>
            </td>
          
          </tr>
       
      </table>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>