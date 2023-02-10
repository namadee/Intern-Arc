<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content" id="company-dashboard">
    <div class="company-top-notif">
        <p>Ending date of reqruitment period: </p>
    </div>
    <div class="company-dashboard-top">
        <div class="company-dashboard-box">
            <div>
            <div class="blue-line"> </div>
            <p>Total Students Applied</p>
            </div>
            <p>180</p>
        </div>
        <div class="company-dashboard-box">
            <div>
            <span class="blue-line"></span>
            <p>Total students Shortlisted</p>
            </div>
            <p>40</p>
        </div>
        <div class="company-dashboard-box">
            <div>
            <span class="blue-line"></span>
            <p>Total Advertisements</p>
            </div>
            <p>40</p>
        </div>
    </div>

    <div class="common_list_content">
      
      <table class="common-table">
        <div class="common-list-topbar">
            <h3>Student Requests</h3>
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
          
        <tr>
          <th>Name</th>
          <th>Degree</th>
          <th>Academic Year</th>
          <th>Advertisement</th>
          <th>Status</th>
         
        </tr>
          <tr>
            <td>Ruchira Bogahawaththa</td>
            <td>CS</td>
            <td>4th year</td>
            <td>Software Engineering</td>
            <td>Pending</td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>studentRequests/viewStudentRequest" >View</a>
            </td>
          
          </tr>
          <tr>
            <td>Ruchira Bogahawaththa</td>
            <td>CS</td>
            <td>4th year</td>
            <td>Software Engineering</td>
            <td>Pending</td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>studentRequests/viewStudentRequest" >View</a>
            </td>
          
          </tr>
          <tr>
            <td>Ruchira Bogahawaththa</td>
            <td>CS</td>
            <td>4th year</td>
            <td>Software Engineering</td>
            <td>Pending</td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>studentRequests/viewStudentRequest" >View</a>
            </td>
          
          </tr>
          <tr>
            <td>Ruchira Bogahawaththa</td>
            <td>CS</td>
            <td>4th year</td>
            <td>Software Engineering</td>
            <td>Pending</td>
            <td>
             <a class="common-view-btn" href="<?php echo URLROOT; ?>studentRequests/viewStudentRequest" >View</a>
            </td>
          
          </tr>
      </table>
      <a href="<?php echo URLROOT; ?>Advertisements/add-advertisement" class="common-blue-btn">View All</a>
    </div>
    

  </div>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>