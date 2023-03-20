<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="advertisement-list" class="main-content">
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
      <h3>Advertisement List</h3>
<a href="<?php echo URLROOT; ?>Advertisements/add-advertisement" class="common-blue-btn"><span id="addIcon" class="material-symbols-outlined">
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
            <td><?php echo $advertisement->status ?></td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>advertisements/view-advertisement/<?php echo $advertisement->advertisement_id; ?>" >View</a>
            </td>
           
            <td>
              <a class="common-edit-btn" href="<?php echo URLROOT; ?>advertisements/showAdvertisementById/<?php echo $advertisement->advertisement_id; ?>"><span class="material-symbols-outlined">
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