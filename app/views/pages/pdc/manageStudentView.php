<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="student-batches-container display-flex-col">
        <div class="student-batches-top display-flex-row">
            <h2>Student Batches</h2>
            <a  href='<?php echo URLROOT.'register/register-student' ?>' class="common-blue-btn display-flex-row">
                <span class="material-symbols-outlined">
                    library_add
                </span>
                Add</a>


        </div>
        <div class="student-batches-table">
            <table>
                <thead>
                    <tr>
                        <th>Batch Year</th>
                        <th>CS Count</th>
                        <th>IS Count</th>

                        <th class="student-batch-status">
                            <div class="display-flex-row">
                                Status <span class="material-symbols-outlined">
                                    help
                                </span>
                            </div>
                        </th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="">Change Access</a></button>
                        </td>
                    </tr>

                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="">Change Access</a></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Active
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="">Change Access</a></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row red-status-font">
                                <span class="common-status-span red-status">
                                </span>
                                Inactive
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="" >Change Access</a></button>
                        </td>
                    </tr>

                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row red-status-font">
                                <span class="common-status-span red-status">
                                </span>
                                Inactive
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="" >Change Access</a></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row red-status-font">
                                <span class="common-status-span red-status">
                                </span>
                                Inactive
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="" >Change Access</a></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row red-status-font">
                                <span class="common-status-span red-status">
                                </span>
                                Inactive
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="" >Change Access</a></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row red-status-font">
                                <span class="common-status-span red-status">
                                </span>
                                Inactive
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="" >Change Access</a></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2016 Batch</td>
                        <td>250</td>
                        <td>140</td>

                        <td>
                            <div class="common-status display-flex-row red-status-font">
                                <span class="common-status-span red-status">
                                </span>
                                Inactive
                            </div>
                        </td>
                        <td> <a href="" class="student-batches-btn">View</a></button></td>
                        <td>
                            <button> <a href="" >Change Access</a></button>
                        </td>
                    </tr>
                    
                    
                </tbody>
            </table>
        </div>



    </div>
</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>