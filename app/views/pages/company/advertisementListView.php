<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<script src="<?php echo URLROOT; ?>js/company.js" defer></script>

<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="advertisement-list" class="main-content">
  <div class="common_list">
    <div class="common-list-topbar">
      <!-- Common Search Bar Style-->
      <form action="javascript:void(0)" class="common-search-bar display-flex-col">
        <div class="display-flex-row">
          <span class="material-symbols-rounded">
            search
          </span>
          <input class="common-input" type="text" name="search-item" id="company_search_ad" placeholder="Search Advertisement" data-company-id="<?php echo $data['companyID'] ?>">
        </div>

        <div class="common-search-result display-flex-col" id="company_ad_result">

        </div>
      </form>
    </div>

    <div class="common_list_content">

      <?php

      if ($roundDataArray['roundNumber'] != NULL) {
        // Need Round Constraints
        $hrefStatus = $roundDataArray['hrefStatus'];
        $elementClass = $roundDataArray['disabledClass'];
      } else {
        // No need of round constraints
        $hrefStatus = URLROOT . 'advertisements/add-advertisement';
        $elementClass = "";
      }
      ?>

      <div class="addBtn">
        <h3>Advertisement List</h3>
        <a href="<?php echo $hrefStatus ?>" class="common-blue-btn <?php echo $elementClass ?>"><span id="addIcon" class="material-symbols-outlined">
            library_add
          </span>Add</a>
      </div>
      <table class="common-table">
        <tr>
          <th>Advertisement Name</th>
          <th>No of Interns</th>
          <th>Status</th>
          <th>View</th>
          <th></th>
          <th></th>

        </tr>
        <?php foreach ($data['advertisements'] as $advertisement) : ?>

          <tr>
            <td><?php echo $advertisement->position ?></td>
            <td><?php echo $advertisement->intern_count ?></td>
            <td>
              <div class="common-status display-flex-row advertisement-status <?php echo $advertisement->status == 'pending' ? 'yellow-status-font' : ($advertisement->status == 'rejected' ? 'red-status-font' : ''); ?> ">

                <span class="common-status-span <?php echo $advertisement->status == 'pending' ? 'yellow-status' : ($advertisement->status == 'rejected' ? 'red-status' : ''); ?>">
                </span>
                <?php echo ucfirst($advertisement->status); ?>
              </div>
            </td>
            <td>
              <a class="common-view-btn" href="<?php echo URLROOT; ?>advertisements/view-advertisement/<?php echo $advertisement->advertisement_id; ?>">View</a>
            </td>
            <?php

            if ($roundDataArray['roundNumber'] != NULL || $advertisement->status == 'approved' ) {
              // Need Round Constraints
              $hrefStatus1 = "javascript:void(0)";
              $hrefStatus2 = "javascript:void(0)";
              $elementClass = "disabled-button-style";
            } else {
              // No need of round constraints
              $hrefStatus1 = URLROOT . 'advertisements/show-advertisement-by-id/' . $advertisement->advertisement_id;
              $hrefStatus2 = URLROOT . 'advertisements/delete-advertisement/' . $advertisement->advertisement_id;
              $elementClass = "";
            }
            ?>

            <td>
              <a class="<?php echo $elementClass; ?> common-edit-btn" href="<?php echo $hrefStatus1; ?>"><span class="material-symbols-outlined">
                  edit_square
                </span>
              </a>
            </td>
            <td>
              <a class="common-edit-btn <?php echo $elementClass; ?>" id="common-delete-btn" href="<?php echo $hrefStatus2; ?>" id="delete" onclick="confirmDelete(event)"><span class=" material-symbols-outlined">
                  delete
                </span></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>