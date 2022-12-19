<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/admin.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="company-content">

<br><br><br>
        <div class="vtop">
	
            <div class="vflex-container">
            
                <div class="vflex-wrap2">
                    <div>
                        <h3>Company List</h3>
                    </div>
                    <div>
                        <form id="coform">
                            <input type="text" placeholder="Search Company" name="search">
                        </form>
                    </div>
                </div>
            
                <table class="co-table" >
                    <tr>
                      <th class="co-table-header">Company Name</th>
                      <th class="co-table-header">Contact Person</th>
                      <th class="co-table-header">Email</th>
                      <th class="co-table-header">Contact Number</th>
                      <th class="co-table-header"></th>
                    </tr>
            
                    <tr>
                      <td class="co-table-data">Virtusa</td>
                      <td class="co-table-data">Ruchira Bogahawatta</td>
                      <td class="co-table-data">ruchirab@virtusa</td>
                      <td class="co-table-data">0712412545</td>
                      <td class="co-table-data"><button> <a href="<?php echo URLROOT.'admin/viewCompany'; ?>">view</a>  </button></td>
                    </tr>
            
                    <tr>
                        <td class="co-table-data">WSO2</td>
                        <td class="co-table-data">Geeth Weerasinghe</td>
                        <td class="co-table-data">geeth@wso2</td>
                        <td class="co-table-data">0712412545</td>
                        <td class="co-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="co-table-data">Codegen International</td>
                        <td class="co-table-data">Namadee Shakya</td>
                        <td class="co-table-data">namadee@codegen</td>
                        <td class="co-table-data">0712412545</td>
                        <td class="co-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="co-table-data">Sysco Labs</td>
                        <td class="co-table-data">Ravindu Viranga</td>
                        <td class="co-table-data">ravinduviranga@syscolabs</td>
                        <td class="co-table-data">0712412545</td>
                        <td class="co-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="co-table-data">Tech Venturas</td>
                        <td class="co-table-data">Namadee Shakya </td>
                        <td class="co-table-data">namadee@techventuras</td>
                        <td class="co-table-data">0712412545</td>
                        <td class="co-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="co-table-data">Commercial Technologies Plus</td>
                        <td class="co-table-data">Ruchira Bogahawatta </td>
                        <td class="co-table-data">ruchirab@ctp</td>
                        <td class="co-table-data">0712412545</td>
                        <td class="co-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="co-table-data">99x Technology</td>
                        <td class="co-table-data">Ravindu Viranga</td>
                        <td class="co-table-data">ravindu@99x</td>
                        <td class="co-table-data">0712412545</td>
                        <td class="co-table-data"><button>view</button></td>
                    </tr>
            
                    <tr>
                        <td class="co-table-data">Virtusa</td>
                        <td class="co-table-data">Geeth Weerasinghe </td>
                        <td class="co-table-data">geeth@virtusa</td>
                        <td class="co-table-data">0712412545</td>
                        <td class="co-table-data"><button>view</button></td>
                    </tr>
                    
                  </table>

                  <input class="company-list-blacklisted-button" type="submit" value="Blacklisted">
                       
            </div>
            </div>

</section>
<?php require APPROOT . '/views/includes/footer.php'; ?>