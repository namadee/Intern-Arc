<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="advertisementreport-content">

<br>
        <div class="rrtop">
	
            <div class="rrflex-container">
            
                <div class="rrflex-wrap2">
                    <div>
                        <h3>Advertisement Reports</h3>
                    </div>
                    <input class="registration-report-filter-button" type="submit" value="Filter">
                </div>
            
                <table class="re-table" >
                    <tr>
                      <th class="re-table-header">Company Name</th>
                      <th class="re-table-header">Job Position</th>
                      <th class="re-table-header">Interns</th>
                    </tr>
            
                    <tr>
                      <td class="re-table-data">Virtusa</td>
                      <td class="re-table-data">Software Engineer</td>
                      <td class="re-table-data">1</td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">WSO2</td>
                        <td class="re-table-data">Software Engineer</td>
                        <td class="re-table-data">1</td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Codegen International</td>
                        <td class="re-table-data">Software Engineer</td>
                        <td class="re-table-data">1</td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Sysco Labs</td>
                        <td class="re-table-data">Software Engineer</td>
                        <td class="re-table-data">1</td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Tech Venturas</td>
                        <td class="re-table-data">Software Engineer </td>
                        <td class="re-table-data">1</td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Commercial Technologies Plus</td>
                        <td class="re-table-data">Software Engineer </td>
                        <td class="re-table-data">1</td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">99x Technology</td>
                        <td class="re-table-data">Software Engineer</td>
                        <td class="re-table-data">1</td>
                    </tr>
            
                    <tr>
                        <td class="re-table-data">Virtusa</td>
                        <td class="re-table-data">Software Engineer </td>
                        <td class="re-table-data">1</td>
                    </tr>
                    
                  </table>
                  <br><br><br>
                            <ul>
                                <li>Total Advertisements &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp:20</li>
                                <li>Total Interns Recruited   &nbsp&nbsp&nbsp : 20</li>
                            </ul>

                  <input class="registration-report-download-button" type="submit" value="Download PDF">
                       
            </div>
            </div>


</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>