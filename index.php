<?php

include 'classes/class.Page.php';
Page::loadConfig();
Page::loadDB();

?>

<?php
$funtion = (!isset($_GET['funtion']))? "index":$_GET['funtion'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'view/head.php';?>
    <body>
        <?php
        
        if (!isset($_SESSION['username'])) {
            include 'view/headerMenuLogin.php';
        
        }else{
            include 'view/headerMenuLogout.php';        
            include 'view/login.php';
        }
        ?>
        
        <?php include 'view/'.$funtion.'.php';?>
        
	<?php include 'view/footer.php';?>
        
        <!--== Javascript Files ==-->
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="sources/js/jquery-2.1.0.min.js"></script>
        <script src="sources/js/bootstrap.min.js"></script>
        <script src="sources/js/jquery.validate.js"></script>
        <script src="sources/js/jquery.scrollTo.js"></script>
        <script src="sources/js/jquery.nav.js"></script>
        <script src="sources/js/owl.carousel.min.js"></script>
        <script src="sources/js/jquery.flexslider.js"></script>
        <script src="sources/js/jquery.accordion.js"></script>
        <script src="sources/js/jquery.placeholder.js"></script>
        <script src="sources/js/jquery.fitvids.js"></script>
        <script src="sources/js/gmap3.js"></script>
        <script src="sources/js/fancySelect.js"></script>
        <script src="sources/js/main.js"></script>
        <script src="sources/js/script.js"></script>
    </body>
</html>