<?php $user_image = $db->getRow("SELECT profile_image_path AS temp FROM users
 WHERE id = {$_SESSION['id']}")->temp;


?>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Eva Admin</a>
    </div>
    <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 09 Dec. 2018 &nbsp; <a href="<?= "http://" . DNSURL . "/logout.php" ?>"  class="btn btn-danger square-btn-adjust">Logout</a> </div>
</nav>
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="<?= "../".$user_image ?>" class="user-image img-responsive"/>
            </li>


            <li>
                <a class=""  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
            </li>

            <li>
                <a   href="chart.php"><i class="fa fa-bar-chart-o fa-2x"></i> Morris Charts</a>
            </li>
            <li  >
                <a  href="table.php"><i class="fa fa-table fa-2x"></i> Data Tables </a>
            </li>
            <li>
                <a  href="form.php"><i class="fa fa-user fa-2x"></i> Add New Admin  </a>
            </li>
            <li>
                <a  href="form2.php"><i class="fa fa-adjust fa-2x"></i> Categories Manager</a>
            </li>
            <li>
                <a  href="form3.php"><i class="fa fa-star-o fa-2x"></i> Add New Promotion</a>
            </li>
        </ul>

    </div>

</nav>