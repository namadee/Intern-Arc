<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="viewstudentlist-content">

<br>
        <div class="vstop">
	
            <div class="vsflex-container">
            
                <div class="vsflex-wrap2">
                    <div>
                        <h3>Student List - 2019 Batch</h3>
                    </div>
                    <div>
                        <form id="coform">
                            <input type="text" placeholder="Search Company" name="search">
                        </form>
                    </div>
                </div>
            
                <table class="st-table" >
                    <tr>
                      <th class="st-table-header">Student Name</th>
                      <th class="st-table-header">Register Number</th>
                      <th class="st-table-header">Email</th>
                      <th class="st-table-header">Contact Number</th>
                      <th class="st-table-header"></th>
                    </tr>
            
                    <tr>
                      <td class="st-table-data">Ruchira Bogahawatta</td>
                      <td class="st-table-data">2020/IS/109</td>
                      <td class="st-table-data">ruchira.b@gmail.com</td>
                      <td class="st-table-data">0712412545</td>
                      <td class="st-table-data"><button><a href="<?php echo URLROOT.'admin/viewStudent'; ?>">view</a></button></td>
                    </tr>
            
                    <tr>
                        <td class="st-table-data">Geeth Weerasinghe</td>
                        <td class="st-table-data">2020/IS/111</td>
                        <td class="st-table-data">geeth@gmail.com</td>
                        <td class="st-table-data">0712412545</td>
                        <td class="st-table-data"><button><a href="<?php echo URLROOT.'admin/viewStudent'; ?>">view</a></button></td>
                    </tr>
            
                    <tr>
                        <td class="st-table-data">Namadee Shakya</td>
                        <td class="st-table-data">2020/IS/110</td>
                        <td class="st-table-data">namadee@gmail.com</td>
                        <td class="st-table-data">0712412545</td>
                        <td class="st-table-data"><button><a href="<?php echo URLROOT.'admin/viewStudent'; ?>">view</a></button></td>
                    </tr>
            
                    <tr>
                        <td class="st-table-data">Ravindu Viranga</td>
                        <td class="st-table-data">2020/IS/112</td>
                        <td class="st-table-data">ravinduviranga@gmail.com</td>
                        <td class="st-table-data">0712412545</td>
                        <td class="st-table-data"><button><a href="<?php echo URLROOT.'admin/viewStudent'; ?>">view</a></button></td>
                    </tr>
            
                    <tr>
                        <td class="st-table-data">Namadee Shakya</td>
                        <td class="st-table-data">2020/IS/110 </td>
                        <td class="st-table-data">namadee@gmail.com</td>
                        <td class="st-table-data">0712412545</td>
                        <td class="st-table-data"><button><a href="<?php echo URLROOT.'admin/viewStudent'; ?>">view</a></button></td>
                    </tr>
            
                    <tr>
                        <td class="st-table-data">Ruchira Bogahawatta</td>
                        <td class="st-table-data">2020/IS/109 </td>
                        <td class="st-table-data">ruchira.b@gmail.com</td>
                        <td class="st-table-data">0712412545</td>
                        <td class="st-table-data"><button><a href="<?php echo URLROOT.'admin/viewStudent'; ?>">view</a></button></td>
                    </tr>
            
                    <tr>
                        <td class="st-table-data">Ravindu Viranga</td>
                        <td class="st-table-data">2020/IS/112</td>
                        <td class="st-table-data">ravindu@gmail.com</td>
                        <td class="st-table-data">0712412545</td>
                        <td class="st-table-data"><button><a href="<?php echo URLROOT.'admin/viewStudent'; ?>">view</a></button></td>
                    </tr>
            
                    
                  </table>
                       
            </div>
            </div>


</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>