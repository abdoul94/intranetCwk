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
                <h5><a href="#"><?php echo $_SESSION['user']['first_name'] ?></a> </h5>
                <p class="text-muted">Admin Head</p>
            </div>

            <!--- Sidemenu -->
            <?php include './viewIncludes/student_sidebar.php'?>
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
                    <div class="col-md-9">

                        <h5>Your Projects</h5>
                        <br/>
                    </div>
                </div>
                <div class="row">

                    <?php
                    include './services/ProjectService.php';
                    include './services/StudentService.php';

                    $studentProjects = (new StudentService())->retrieveAllProjectsForAStudent($_SESSION['user']['id']);

                    foreach ($studentProjects as $project){
                        $mainProject = (new ProjectService())->retrieveProjectById($project['project_id']);

                        ?>



                        <div class="col-md-4 col-xs-12">
                            <div class="card-box">
                                <h4 class="header-title"><?php echo $mainProject['name'] ?></h4>

                                <div id="website-stats" style="min-height: 150px;" class="">
                                    <?php echo $mainProject['description'] ?>
                                </div>

                                <?php
                                if ($project['is_team_lead']) {
                                    ?>
                                    <h6>Team Leader</h6>
                                    <?php

                                } else {
                                    ?>
                                    <h6>Team Member</h6>

                                    <?php
                                }
                                ?>

                                <a href="scripts/student_viewProject.php?id=<?php echo $mainProject['id'] ?>">View Project</a>
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