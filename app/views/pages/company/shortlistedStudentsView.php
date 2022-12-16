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
                <input class="common-input" type="text" name="search-item" placeholder="Search Student">
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
        <h3>Software Engineer - Shortlisted Students</h3>
    </div>
      <table class="common-table">
        <tr>
          <th>Student Name</th>
          <th>Student Degree</th>
          <th>Student Year</th>
          
        </tr>
        

          <tr>
            <td>Ruchira Bogahawaththa</td>
            <td>CS</td>
            <td>3</td>
            <td>
             <select class="student-req-action">
                <option class="none" value=""></option>
                <option class="shortlist-op" value="">Recruit</option>
                <option class="reject-op" value="">Reject</option>
             </select>
            </td>
          
          </tr>
       
      </table>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>