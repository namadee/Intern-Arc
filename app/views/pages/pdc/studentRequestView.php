<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section class="main-content display-flex-col">
    <div class="display-flex-col student-request-container">
        <div class="display-flex-row student-request-top">
            <h2>Requests</h2>
            <div class="display-flex-row">
                <p>Select Round: </p>
                <div class="common-filter">
                    <form action="" class="display-flex-row">
                        <span class="material-symbols-rounded">
                            filter_alt
                        </span>
                        <select name="filter-list" id="filterlist">
                            <option value="name">Round 1</option>
                            <option value="name">Round 2</option>
                        </select>
                    </form>
                </div>
            </div>

        </div>
        <div class="display-flex-row student-request-body">
            <div class="student-requests-box display-flex-col">
                <div class="display-flex-row container-top">
                    <h3>CS Students</h3>
                    <!-- Common Search Bar Style-->
                    <form action="" class="common-search-bar display-flex-row">
                        <span class="material-symbols-rounded">
                            search
                        </span>
                        <input class="common-input" type="text" name="search-item" placeholder="Search Student">
                    </form>
                </div>
                <div class="common-filter">
                    <form action="" class="display-flex-row">
                        <span class="material-symbols-rounded">
                            filter_alt
                        </span>
                        <select name="filter-list" id="filterlist">
                            <option value="all" selected>All</option>
                            <option value="name">Recruited</option>
                            <option value="name">Rejected</option>
                        </select>
                    </form>
                </div>
                <table class="student-list">
                    <tr>
                        <td>2020/IS/109</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Recruited
                            </div>
                        </td>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2020/IS/109</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Recruited
                            </div>
                        </td>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2020/IS/109</td>
                        <td>
                            <div class="common-status red-status-font display-flex-row">
                                <span class="common-status-span red-status">
                                </span>
                                Rejected
                            </div>
                        </td>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="student-requests-box display-flex-col">
                <div class="display-flex-row container-top">
                    <h3>IS Students</h3>
                    <!-- Common Search Bar Style-->
                    <form action="" class="common-search-bar display-flex-row">
                        <span class="material-symbols-rounded">
                            search
                        </span>
                        <input class="common-input" type="text" name="search-item" placeholder="Search Student">
                    </form>
                </div>
                <div class="common-filter">
                    <form action="" class="display-flex-row">
                        <span class="material-symbols-rounded">
                            filter_alt
                        </span>
                        <select name="filter-list" id="filterlist">
                            <option value="all" selected>All</option>
                            <option value="name">Recruited</option>
                            <option value="name">Rejected</option>
                        </select>
                    </form>
                </div>
                <table class="student-list">
                    <tr>
                        <td>2020/IS/109</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Recruited
                            </div>
                        </td>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2020/IS/109</td>
                        <td>
                            <div class="common-status display-flex-row">
                                <span class="common-status-span">
                                </span>
                                Recruited
                            </div>
                        </td>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2020/IS/109</td>
                        <td>
                            <div class="common-status red-status-font display-flex-row">
                                <span class="common-status-span red-status">
                                </span>
                                Rejected
                            </div>
                        </td>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</section>


<?php require APPROOT . '/views/includes/footer.php'; ?>