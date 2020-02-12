<?php

require "../includes/includes.php";
if (!$auth->is_auth()) {
    redirect('../login.php', 1);
}

if (isset($_GET['delmsgs']) && !empty($_GET['delmsgs'])) {

    $db->update("feedback", [
        "is_viewed" => 1
    ], "true");

}

$messages = $db->getRows("SELECT * FROM feedback WHERE is_viewed = 0");

$users = $db->getRow("SELECT COUNT(ID) AS count FROM users")->count;
$products = $db->getRow("SELECT COUNT(products.id)+COUNT(services.id) AS count FROM products,services")->count;
$admins = $db->getRows("SELECT * FROM users WHERE account_type = 1");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Eva Admin - Dashboard</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
</head>
<body>
<div id="wrapper">
    <?php include "views/header.php"; ?>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Admin Dashboard</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr/>

            <div class="row">
                <!--number of feadback-->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-envelope-o"></i>
                </span>
                        <div class="text-box">
                            <p class="main-text"><?= count($messages); ?></p>
                            <p class="text-muted">Messages</p>
                        </div>
                    </div>
                </div>
                <!--number of user-->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-users"></i>
                </span>
                        <div class="text-box">
                            <p class="main-text"><?= $users ?></p>
                            <p class="text-muted">Users</p>
                        </div>
                    </div>
                </div>
                <!-- number of post-->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-archive"></i>
                </span>
                        <div class="text-box">
                            <p class="main-text"><?= $products ?></p>
                            <p class="text-muted">Products</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-9 col-sm-12 col-xs-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Supervisors
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($admins) : ?>
                                        <?php $i = 1;
                                        foreach ($admins as $admin) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $admin->first_name ?></td>
                                                <td><?= $admin->last_name ?></td>
                                                <td><?= $admin->user_name ?></td>

                                            </tr>
                                            <?php $i++; endforeach; ?>
                                    <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">

                <div class="chat-panel panel panel-default chat-boder chat-panel-head">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i>
                        Feadback
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-refresh fa-fw"></i>Refresh
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-check-circle fa-fw"></i>Available
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-times fa-fw"></i>Busy
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-clock-o fa-fw"></i>Away
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <ul class="chat-box">
                            <?php if ($messages) : ?>
                                <?php foreach ($messages as $message) : ?>
                                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="assets/img/1.png" alt="User" class="img-circle" height="50"
                                             width="50"/>
                                    </span>
                                        <div class="chat-body">
                                            <strong><?= $message->name . '<small class="text-muted"> (' . $message->email . ') </small>'; ?></strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i><?= $message->time ?>
                                            </small>
                                            <br> <br>
                                            <small class="pull-left text-muted"> <?= $message->subject ?>    </small>
                                            <p>
                                                <?= $message->message_body ?>
                                            </p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- todo : Add adequate no messages error   -->
                                <br><br><br><br><br><br><br>
                                <center><h3> No Messages </h3></center>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="panel-footer">
                        <div class="input-group">
                            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="get">
                                 <span class="input-group-btn">
                                    <button class="btn btn-danger btn-sm pull-right" type="submit" value="del"
                                            name="delmsgs" id="btn-chat">
                                        Clear All !
                                    </button>
                                </span>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            <!-- <div class="col-md-3 col-sm-6 col-xs-6">
     <div class="panel panel-back noti-box">
         <span class="icon-box bg-color-brown set-icon">
             <i class="fa fa-rocket"></i>
         </span>
         <div class="text-box" >
             <p class="main-text">3 Orders</p>
             <p class="text-muted">Pending</p>
         </div>
      </div>
      </div>

     </div>
          <!-- /. ROW  -->
            <hr/>
            <!--    <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue">
                    <i class="fa fa-warning"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">52 Important Issues to Fix </p>
                    <p class="text-muted">Please fix these issues to work smooth</p>
                    <p class="text-muted">Time Left: 30 mins</p>
                    <hr />
                    <p class="text-muted">
                          <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i>
                               Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
                               </span>
                    </p>
                </div>
             </div>
		     </div>


                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel back-dash">
                               <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; SPEED</strong>
                             <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing sit ametsit amet elit ftr. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                        <div class="panel ">
          <div class="main-temp-back">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-6"> <i class="fa fa-cloud fa-3x"></i> Newyork City </div>
                <div class="col-xs-6">
                  <div class="text-temp"> 10° </div>
                </div>
              </div>
            </div>
          </div>

        </div>
                     <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-desktop"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Display</p>
                    <p class="text-muted">Looking Good</p>
                </div>
             </div>

    </div>

        </div>-->
            <!-- /. ROW  -->
            <!--  <div class="row">


                             <div class="col-md-9 col-sm-12 col-xs-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          Bar Chart Example
                      </div>
                      <div class="panel-body">
                          <div id="morris-bar-chart"></div>
                      </div>
                  </div>
              </div>-->
            <!-- <div class="col-md-3 col-sm-12 col-xs-12">
             <div class="panel panel-primary text-center no-boder bg-color-green">
                 <div class="panel-body">
                     <i class="fa fa-bar-chart-o fa-5x"></i>
                     <h3>120 GB </h3>
                 </div>
                 <div class="panel-footer back-footer-green">
                    Disk Space Available

                 </div>
             </div>
             <div class="panel panel-primary text-center no-boder bg-color-red">
                 <div class="panel-body">
                     <i class="fa fa-edit fa-5x"></i>
                     <h3>20,000 </h3>
                 </div>
                 <div class="panel-footer back-footer-red">
                     Articles Pending

                 </div>
             </div>
                 </div>-->

        </div>
        <!-- /. ROW  -->
        <div class="row">
            <!-- <div class="col-md-3 col-sm-12 col-xs-12">
<div class="panel panel-primary text-center no-boder bg-color-green">
                <div class="panel-body">
                     <i class="fa fa-comments-o fa-5x"></i>
                     <h4>200 New Comments </h4>
                      <h4>See All Comments  </h4>
                 </div>
                 <div class="panel-footer back-footer-green">
                      <i class="fa fa-rocket fa-5x"></i>
                     Lorem ipsum dolor sit amet sit sit, consectetur adipiscing elitsit sit gthn ipsum dolor sit amet ipsum dolor sit amet

                 </div>
             </div>
             </div>-->
            <!--  <div class="col-md-9 col-sm-12 col-xs-12">

              <div class="panel panel-default">
                  <div class="panel-heading">
                     Responsive Table Example
                  </div>
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Username</th>
                                       <th>User No.</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                  </tr>
                                   <tr>
                                      <td>2</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                  </tr>
                                   <tr>
                                      <td>3</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                  </tr>
                                    <tr>
                                      <td>4</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                  </tr>
                                   <tr>
                                      <td>5</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                      <td>...</td>
                                  </tr>


                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>

              </div>
          </div>
           <!-- /. ROW  -->
            <!--  <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12">

                  <div class="chat-panel panel panel-default chat-boder chat-panel-head" >
                      <div class="panel-heading">
                          <i class="fa fa-comments fa-fw"></i>
                          Chat Box
                          <div class="btn-group pull-right">
                              <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-chevron-down"></i>
                              </button>
                              <ul class="dropdown-menu slidedown">
                                  <li>
                                      <a href="#">
                                          <i class="fa fa-refresh fa-fw"></i>Refresh
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">
                                          <i class="fa fa-check-circle fa-fw"></i>Available
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">
                                          <i class="fa fa-times fa-fw"></i>Busy
                                      </a>
                                  </li>
                                  <li>
                                      <a href="#">
                                          <i class="fa fa-clock-o fa-fw"></i>Away
                                      </a>
                                  </li>
                                  <li class="divider"></li>
                                  <li>
                                      <a href="#">
                                          <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>

                      <div class="panel-body">
                          <ul class="chat-box">
                              <li class="left clearfix">
                                  <span class="chat-img pull-left">
                                      <img src="assets/img/1.png" alt="User" class="img-circle" />
                                  </span>
                                  <div class="chat-body">
                                          <strong >Jack Sparrow</strong>
                                          <small class="pull-right text-muted">
                                              <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                          </small>
                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                      </p>
                                  </div>
                              </li>
                              <li class="right clearfix">
                                  <span class="chat-img pull-right">

                                      <img src="assets/img/2.png" alt="User" class="img-circle" />
                                  </span>
                                  <div class="chat-body clearfix">

                                          <small class=" text-muted">
                                              <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                          <strong class="pull-right">Jhonson Deed</strong>

                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                      </p>
                                  </div>
                              </li>
                              <li class="left clearfix">
                                  <span class="chat-img pull-left">
                                       <img src="assets/img/3.png" alt="User" class="img-circle" />
                                  </span>
                                  <div class="chat-body clearfix">

                                          <strong >Jack Sparrow</strong>
                                          <small class="pull-right text-muted">
                                              <i class="fa fa-clock-o fa-fw"></i>14 mins ago</small>

                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                      </p>
                                  </div>
                              </li>
                              <li class="right clearfix">
                                  <span class="chat-img pull-right">
                                       <img src="assets/img/4.png" alt="User" class="img-circle" />
                                  </span>
                                  <div class="chat-body clearfix">

                                          <small class=" text-muted">
                                              <i class="fa fa-clock-o fa-fw"></i>15 mins ago</small>
                                          <strong class="pull-right">Jhonson Deed</strong>

                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                      </p>
                                  </div>
                              </li>
                                  <li class="left clearfix">
                                  <span class="chat-img pull-left">
                                      <img src="assets/img/1.png" alt="User" class="img-circle" />
                                  </span>
                                  <div class="chat-body">
                                          <strong >Jack Sparrow</strong>
                                          <small class="pull-right text-muted">
                                              <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                          </small>
                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                      </p>
                                  </div>
                              </li>
                              <li class="right clearfix">
                                  <span class="chat-img pull-right">
                                     <img src="assets/img/2.png" alt="User" class="img-circle" />
                                  </span>
                                  <div class="chat-body clearfix">

                                          <small class=" text-muted">
                                              <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                          <strong class="pull-right">Jhonson Deed</strong>

                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                      </p>
                                  </div>
                              </li>
                          </ul>
                      </div>

                      <div class="panel-footer">
                          <div class="input-group">
                              <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message to send..." />
                              <span class="input-group-btn">
                                  <button class="btn btn-warning btn-sm" id="btn-chat">
                                      Send
                                  </button>
                              </span>
                          </div>
                      </div>

                  </div>

              </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                       <div class="panel panel-default">
                      <div class="panel-heading">
                         Label Examples
                      </div>
                      <div class="panel-body">
                          <span class="label label-default">Default</span>
<span class="label label-primary">Primary</span>
<span class="label label-success">Success</span>
<span class="label label-info">Info</span>
<span class="label label-warning">Warning</span>
<span class="label label-danger">Danger</span>
                      </div>
                  </div>

                       <div class="panel panel-default">
                      <div class="panel-heading">
                          Donut Chart Example
                      </div>
                      <div class="panel-body">
                          <div id="morris-donut-chart"></div>
                      </div>
                  </div>

                  </div>
              </div>
               <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- MORRIS CHART SCRIPTS -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>


</body>
</html>
