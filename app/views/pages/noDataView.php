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
      </div>
      <table class="common-table">
      <div class="no-data-page display-flex-col">
        <h1>Oops! No data yet!!</h1>
          <img src="<?php echo URLROOT . "img/no-data-img.svg"?>">
      </div>
      </table>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>