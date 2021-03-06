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
                            <h4 class="page-title"><?php echo $_SESSION['project']['name'] ?> </h4>
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
                            <h4>Add a Paper</h4>

                            <form role="form" method="post" action="scripts/createPaper.php" enctype="multipart/form-data">
                                <input type="hidden" name="projectId" value="<?php echo $_SESSION['project']['id'] ?>"
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
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"  placeholder="Paper Name">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description"  placeholder="Description">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email">Paper Url</label>
                                    <input type="file" class="form-control" id="paper" name="paper"  placeholder="Paper">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">

                        <h5>All papers in this project</h5>
                        <br/>
                    </div>
                </div>

                <div class="row">
                    <?php
                    include './services/PaperService.php';
                    $papers = (new PaperService())->getAllPapersInAProject($_SESSION['project']['id']);


                    foreach ($papers as $paper){

                            ?>


                            <div class="col-md-4 col-xs-12">
                                <div class="card-box">
                                    <h4 class="header-title"><?php echo $paper['name'] ?></h4>

                                    <div id="website-stats" style="min-height: 150px;" class="">
                                        <?php echo $paper['description'] ?>
                                    </div>

                                    <a href="scripts/viewRevisions.php?id=<?php echo $paper['id']; ?>">View Paper</a>
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