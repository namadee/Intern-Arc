<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src="<?php echo URLROOT; ?>js/company.js" defer></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content">
  <div class="common_list">
    <div class="common-list-topbar">
      <!-- Common Search Bar Style-->
      <form action="javascript:void(0)" class="common-search-bar display-flex-col">
        <div class="display-flex-row">
          <span class="material-symbols-rounded">
            search
          </span>
          <input class="common-input" type="text" name="search-item" id="company_search_stdreq" placeholder="Search Student Request" >
        </div>

        <div class="common-search-result display-flex-col" id="company_stdreq_result">

        </div>
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
        <h3>Advertisement List-Student Requests</h3>
      </div>
      <table class="common-table">
        <tr>
          <th>Advertisement Name</th>
          <th>No of Interns</th>
          <th>Total Requests</th>

        </tr>
        <?php $x = 0; ?>
        <?php foreach ($data['advertisements'] as $advertisement) : ?>

          <tr>
            <td><?php echo $data['positions'][$x] ?></td>
            <td><?php echo $data['intern_counts'][$x] ?></td>
            <td><?php echo $data['count'][$x] ?></td>
            <td>
              <a class="common-view-btn" href="<?php
                                                if ($data['count'][$x] != 0) {
                                                  echo URLROOT . 'requests/show-requests-by-ad/' . $advertisement->advertisement_id;
                                                } else {
                                                  echo URLROOT . 'Errors/noData';
                                                }

                                                ?>">View</a>
            </td>

          </tr>
          <?php $x++ ?>
        <?php endforeach; ?>

      </table>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>