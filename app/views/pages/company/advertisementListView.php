<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<!-- To get Navigation Menu - MUST ADD TO DASHBOARD OF EACH USER-->
<?php $navSidebar = $_SESSION['user_role']; ?>
<script type="text/javascript">
  sessionStorage.setItem("navSidebar", "<?php echo $navSidebar; ?>");
</script>

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
      <h3>Advertisement List</h3>
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
            <td><a href="<?php echo URLROOT; ?>advertisements/showAdvertisement/<?php echo $advertisement->advertisement_id; ?>"><span class="material-symbols-outlined">
                  drive_file_rename_outline
                </span></a>
            </td>
            <td>
              <a href="<?php echo URLROOT; ?>advertisements/deleteAdvertisement/<?php echo $advertisement->advertisement_id; ?>"><span id="delete" class="material-symbols-outlined">
                  delete
                </span></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <!-- <table>                    
                    <tr>
                      <th>Advertisement Name</th>
                      <th>No of Interns</th>
                      <th>Status</th>
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                     
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                     
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                      
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                      
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                      
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                     
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                      
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                      
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                      
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                    </tr>
                    <tr>
                      <td>Software Engineer - Virtusa</td>
                      <td>10</td>
                      <td>Accepted</td>
                      
                      <td><button class="viewBtn">View</button></td>
                      <td><button class="deleteBtn"><span class="material-symbols-outlined">
                        delete
                        </span></button></td>
                    </tr>
                  </table>  -->
    </div>
    <div class="addBtn">

      <a href="<?php echo URLROOT; ?>Advertisements/add-advertisement"><span id="addIcon" class="material-symbols-outlined">
          library_add
        </span>Add</a>
    </div>
  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>