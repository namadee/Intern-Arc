<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content">
  <div class="advertisement_list">
    <div class="advertisement-list-topbar">
      <div class="search-bar">
        <span class="material-symbols-rounded">
          search
        </span>
        <input type="text" name="search-advertisement" placeholder="Search advertisement">
      </div>
      <div class="advertisement-filter">
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

    <div class="advertisement_list_content">
      
      <div class="addBtn">
      <h3>Advertisement List</h3>
<a href="<?php echo URLROOT; ?>Advertisements/add-advertisement" class="common-blue-btn"><span id="addIcon" class="material-symbols-outlined">
    library_add
  </span>Add</a>
</div>
      <table class="advertisements">
        <tr>
          <th>Advertisement Name</th>
          <th>No of Interns</th>
          <th>Working Mode</th>
          <th>Status</th>
        </tr>
        <?php foreach ($data['advertisements'] as $advertisement) : ?>

          <tr>
            <td><?php echo $advertisement->position ?></td>
            <td><?php echo $advertisement->intern_count ?></td>
            <td><?php echo $advertisement->working_mode ?></td>
            <td><?php echo $advertisement->status ?></td>
            <td>
              <a class="common-edit-btn" href="<?php echo URLROOT; ?>advertisements/show-advertisement/<?php echo $advertisement->advertisement_id; ?>"><span class="material-symbols-outlined">
              edit_square
                </span>
              </a>
            </td>
            <td>
            <a class="common-edit-btn" id="common-delete-btn" href="<?php echo URLROOT; ?>advertisements/delete-advertisement/<?php echo $advertisement->advertisement_id; ?>"  id="delete"><span class="material-symbols-outlined">
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