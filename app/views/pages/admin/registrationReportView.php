<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="registrationreport-content">

<br>
        <div class="rrtop">
	
            <div class="rrflex-container">
            
                <div class="rrflex-wrap2">
                    <div>
                        <h3>Registration Reports</h3>
                    </div>
                    <input class="registration-report-filter-button" type="submit" value="Filter">
                </div>
            
                <table class="re-table" >
                    <tr>
                      <th class="re-table-header">Company Name</th>
                      <th class="re-table-header">Contact Person</th>
                      <th class="re-table-header">Email</th>
                      <th class="re-table-header">Contact Number</th>
                      <th class="re-table-header"></th>
                    </tr>
            
                    <tr>
                      <td class="re-table-data">Virtusa</td>
                      <td class="re-table-data">Ruchira Bogahawatta</td>
                      <td class="re-table-data">ruchirab@virtusa</td>
                      <td class="re-table-data">0712412545</td>
                      <td class="re-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">WSO2</td>
                        <td class="re-table-data">Geeth Weerasinghe</td>
                        <td class="re-table-data">geeth@wso2</td>
                        <td class="re-table-data">0712412545</td>
                        <td class="re-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Codegen International</td>
                        <td class="re-table-data">Namadee Shakya</td>
                        <td class="re-table-data">namadee@codegen</td>
                        <td class="re-table-data">0712412545</td>
                        <td class="re-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Sysco Labs</td>
                        <td class="re-table-data">Ravindu Viranga</td>
                        <td class="re-table-data">ravinduviranga@syscolabs</td>
                        <td class="re-table-data">0712412545</td>
                        <td class="re-table-data"><button>view</button></td>
                    </tr>
            
                    <!-- <tr>
                        <td class="re-table-data">Tech Venturas</td>
                        <td class="re-table-data">Namadee Shakya </td>
                        <td class="re-table-data">namadee@techventuras</td>
                        <td class="re-table-data">0712412545</td>
                        <td class="re-table-data"><button>view</button></td>
                    </tr> -->
            
                    <!-- <tr>
                        <td class="re-table-data">Commercial Technologies Plus</td>
                        <td class="re-table-data">Ruchira Bogahawatta </td>
                        <td class="re-table-data">ruchirab@ctp</td>
                        <td class="re-table-data">0712412545</td>
                        <td class="re-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">99x Technology</td>
                        <td class="re-table-data">Ravindu Viranga</td>
                        <td class="re-table-data">ravindu@99x</td>
                        <td class="re-table-data">0712412545</td>
                        <td class="re-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Virtusa</td>
                        <td class="re-table-data">Geeth Weerasinghe </td>
                        <td class="re-table-data">geeth@virtusa</td>
                        <td class="re-table-data">0712412545</td>
                        <td class="re-table-data"><button>view</button></td>
                    </tr>
                     -->
                  </table>

                  <input class="registration-report-download-button" type="submit" value="Download PDF">
                       
            </div>
            </div>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>