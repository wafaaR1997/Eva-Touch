<?php
require "../includes/includes.php";
if (!$auth->is_auth()) {
    redirect('../login.php', 1);
}


if (isset($_GET['delusr']) && !empty($_GET['delusr'])) {
    $user_id = intval($_GET['delusr']);
    if ($user_id === intval($_SESSION['id'])) {
        //todo: redirect to page show you can't delete yourself error .

    } else {

        $db->query("DELETE FROM users WHERE id = {$user_id}");

    }


}
if (isset($_GET['delcat']) && !empty($_GET['delcat'])) {
    $table_name = "products_main_categories";
    if ($_GET['delcat'] === "service") {
        $table_name = "services_main_categories";

    }
    if (!$db->query("DELETE FROM {$table_name} WHERE id = {$_GET['id']}")) {

    }

}


$users = $db->getRows("SELECT * FROM users WHERE 1 LIMIT 5");
//
$products_main_cats = $db->getRows("SELECT * FROM products_main_categories");
$services_main_cats = $db->getRows("SELECT * FROM services_main_categories");
//
$products_sub_cats = $db->getRows("SELECT * FROM products_sub_categories");
$services_sub_cats = $db->getRows("SELECT * FROM services_sub_categories");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Eva Admin - Data Tables </title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <!-- MORRIS CHART STYLES-->

    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet"/>
</head>
<body>
<div id="wrapper">
    <?php include "views/header.php"; ?>

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Data Tables</h2>
                    <!--<h5>Welcome Jhon Deo , Love to see you back. </h5>-->

                </div>
            </div>
            <!-- /. ROW  -->
            <hr/>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"> All Users</i>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th> Phone Number</th>
                                        <th>Location</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr class="odd gradeX">
                                            <td><?= $user->user_name ?></td>
                                            <td><?= htmlspecialchars(ucfirst($user->first_name)) . ' ' . htmlspecialchars(ucfirst($user->last_name)) ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->phone_number ?></td>
                                            <td><?= $user->location ?></td>
                                            <td style="color: <?= $perms[$user->account_type][1] ?>;"><?= $perms[$user->account_type][0] ?></td>
                                            <td><a href="?delusr=<?= $user->id ?> " class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-6">
                    <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Products & Services Main Categories
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th> Icon</th>
                                        <th> Type</th>
                                        <th> Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($products_main_cats as $products_main_cat) : ?>
                                        <tr>
                                            <td><?= $products_main_cat->name; ?></td>
                                            <td><img src="<?= "../" . $products_main_cat->icon_path; ?>"></td>
                                            <td>Product</td>
                                            <td><a href="?delcat=product&id=<?= $products_main_cat->id ?>"
                                                   class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php foreach ($services_main_cats as $products_main_cat) : ?>
                                        <tr>
                                            <td><?= $products_main_cat->name; ?></td>
                                            <td><img src="<?= "../" . $products_main_cat->icon_path; ?>"></td>
                                            <td>Service</td>
                                            <td><a href="?delcat=service&id=<?= $products_main_cat->id ?>"
                                                   class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- End  Kitchen Sink -->
                </div>
                <div class="col-md-6">
                    <!--    Context Classes  -->
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Top 5 users
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>

                                        <th>First Name</th>
                                        <th>Email</th>
                                        <th>Username</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr class="success">

                                            <td><?= $user->first_name ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->user_name ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--  end  Context Classes  -->
                </div>
            </div>
            <div class="col-md-6">
                <!--   Basic Table  -->
                <!-- <div class="panel panel-default">
                     <div class="panel-heading">
                         Basic Table
                     </div>
                     <div class="panel-body">
                         <div class="table-responsive">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>First Name</th>
                                         <th>Last Name</th>
                                         <th>Username</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>1</td>
                                         <td>Mark</td>
                                         <td>Otto</td>
                                         <td>@mdo</td>
                                     </tr>
                                     <tr>
                                         <td>2</td>
                                         <td>Jacob</td>
                                         <td>Thornton</td>
                                         <td>@fat</td>
                                     </tr>
                                     <tr>
                                         <td>3</td>
                                         <td>Larry</td>
                                         <td>the Bird</td>
                                         <td>@twitter</td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                   <!-- End  Basic Table  -->
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-6">
                <!--    Striped Rows Table  -->
                <!-- <div class="panel panel-default">
                     <div class="panel-heading">
                         Striped Rows Table
                     </div>
                     <div class="panel-body">
                         <div class="table-responsive">
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>First Name</th>
                                         <th>Last Name</th>
                                         <th>Username</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>1</td>
                                         <td>Mark</td>
                                         <td>Otto</td>
                                         <td>@mdo</td>
                                     </tr>
                                     <tr>
                                         <td>2</td>
                                         <td>Jacob</td>
                                         <td>Thornton</td>
                                         <td>@fat</td>
                                     </tr>
                                     <tr>
                                         <td>3</td>
                                         <td>Larry</td>
                                         <td>the Bird</td>
                                         <td>@twitter</td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                 <!--  End  Striped Rows Table  -->
            </div>
            <div class="col-md-6">
                <!--    Bordered Table  -->
                <!--  <div class="panel panel-default">
                      <div class="panel-heading">
                          Bordered Table
                      </div>
                      <!-- /.panel-heading
                      <div class="panel-body">
                          <div class="table-responsive table-bordered">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Username</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>1</td>
                                          <td>Mark</td>
                                          <td>Otto</td>
                                          <td>@mdo</td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>Jacob</td>
                                          <td>Thornton</td>
                                          <td>@fat</td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td>Larry</td>
                                          <td>the Bird</td>
                                          <td>@twitter</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                   <!--  End  Bordered Table  -->
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-6">
                <!--    Hover Rows  -->
                <!-- <div class="panel panel-default">
                     <div class="panel-heading">
                         Hover Rows
                     </div>
                     <div class="panel-body">
                         <div class="table-responsive">
                             <table class="table table-hover">
                                 <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>First Name</th>
                                         <th>Last Name</th>
                                         <th>Username</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>1</td>
                                         <td>Mark</td>
                                         <td>Otto</td>
                                         <td>@mdo</td>
                                     </tr>
                                     <tr>
                                         <td>2</td>
                                         <td>Jacob</td>
                                         <td>Thornton</td>
                                         <td>@fat</td>
                                     </tr>
                                     <tr>
                                         <td>3</td>
                                         <td>Larry</td>
                                         <td>the Bird</td>
                                         <td>@twitter</td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                 <!-- End  Hover Rows  -->
            </div>
            <!-- <div class="col-md-6">
                  <!--    Context Classes
                 <div class="panel panel-default">

                     <div class="panel-heading">
                         Context Classes
                     </div>

                     <div class="panel-body">
                         <div class="table-responsive">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>First Name</th>
                                         <th>Last Name</th>
                                         <th>Username</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr class="success">
                                         <td>1</td>
                                         <td>Mark</td>
                                         <td>Otto</td>
                                         <td>@mdo</td>
                                     </tr>
                                     <tr class="info">
                                         <td>2</td>
                                         <td>Jacob</td>
                                         <td>Thornton</td>
                                         <td>@fat</td>
                                     </tr>
                                     <tr class="warning">
                                         <td>3</td>
                                         <td>Larry</td>
                                         <td>the Bird</td>
                                         <td>@twitter</td>
                                     </tr>
                                     <tr class="danger">
                                         <td>4</td>
                                         <td>John</td>
                                         <td>Smith</td>
                                         <td>@jsmith</td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                 <!--  end  Context Classes  -->
        </div>
    </div>
    <!-- /. ROW  -->
</div>

</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>


</body>
</html>
