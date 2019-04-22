<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Welcome <?php echo $_SESSION['user']['first_name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>

</head>


<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">

        <div class="slimscroll-menu" id="remove-scroll">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="" class="logo">
                          AonasShare
                </a>
            </div>

            <!-- User box -->
            <div class="user-box">
                <div class="user-img">
                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                </div>
                <h5><a href="#"><? echo $_SESSION['first_name'] ?></a> </h5>
                <p class="text-muted">Admin Head</p>
            </div>

            <!--- Sidemenu -->
          <?php include './viewIncludes/admin_sidebar.php'?>
            <!-- Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="content-page">

        <!-- Top Bar Start -->
        <div class="topbar">

            <nav class="navbar-custom">



                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left disable-btn">
                            <i class="dripicons-menu"></i>
                        </button>
                    </li>
                    <li>
                        <div class="page-title-box">
                            <h4 class="page-title">Projects </h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Welcome to AonasShare</li>
                            </ol>
                        </div>
                    </li>

                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->



        <!-- Start Page content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-9">
                        <div class="card-box">
                            <h4>Create A Project</h4>

                        <form role="form" method="post" action="scripts/createProject.php">
                           <label> <?php

                            if(isset($_SESSION['success'])){
                                echo "<span style='color: green'>".$_SESSION['success']."</span>";
                                unset($_SESSION['success']);
                            }

                            if(isset($_SESSION['error'])){
                                echo "<span style='color: red'>".$_SESSION['error']."</span>";
                                unset($_SESSION['error']);
                            }
                            ?></label>
                            <div class="form-group">
                                <label for="projectName">Project Name</label>
                                <input type="text" class="form-control" id="projectName" name="name"  placeholder="Project Name">
                                <small id="projectHelp" class="form-text text-muted">The name of the new project you want to create</small>
                            </div>
                            <div class="form-group">
                                <label for="projectDescription">Project Description</label>
                                <textarea class="form-control" id="projectDescription" name="description" placeholder="Project Description">
                                </textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">

                            <h5>All Projects</h5>
                       <br/>
                    </div>
                </div>
                <div class="row">

                <?php
                     require_once './services/ProjectService.php';
                    $allProjects = (new ProjectService())->retrieveAllProjects();

                    foreach ($allProjects as $project){

                ?>



                    <div class="col-md-4 col-xs-12">
                        <div class="card-box">
                            <h4 class="header-title"><?php echo $project['name'] ?></h4>

                            <div id="website-stats" style="min-height: 150px;" class="">
                                <?php echo $project['description'] ?>
                            </div>
                            <a href="scripts/viewProject.php?id=<?php echo $project['id'] ?>">View Project</a>
                        </div>
                    </div>



                <!-- end row -->

                <?php }?>

                </div>






            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            2019 © AonasShare
        </footer>

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->



<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>


<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="/pluggins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="/pluggins/jquery-knob/jquery.knob.js"></script>

<!-- Dashboard Init -->
<script src="assets/pages/jquery.dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

</body>
</html>