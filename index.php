<?php session_start()?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aonas Share</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-theme9.css">
</head>
<body>
<div class="form-body">
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <h3>Aonas Share.</h3>
                <p>Project Research Paper Sharing App.</p>
                <img src="images/graphic5.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">

                    <div class="page-links">
                        <a href="#" class="active">Login</a>
                    </div>
                    <?php
                    if(isset($_SESSION['error'])) {
                        ?>
                        <span style="color: red"><?php echo $_SESSION['error'] ?></span>
                        <?php
                        unset($_SESSION['error']);
                    }
                    ?>
                    <form method="post" action="./scripts/login.php">
                        <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Login</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>