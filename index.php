<?php
session_start();
include 'classes/class.Page.php';
Page::loadConfig();
Page::loadDB();

$function = (!isset($_REQUEST['function'])) ? "index" : $_REQUEST['function'];
if (strlen($function) == 0) {
    $function = 'index';
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'view/head.php'; ?>
    <body>
        <?php
        $user_type = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : "";
        $user_email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";
        $user_id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";

        switch ($user_type) {
            case "1":
                include 'view/menuDirectivo.php';
                break;
            case "2":
                include 'view/menuDocente.php';
                break;
            case "3":
                include 'view/menuBibliotecario.php';
                break;
            case "4":
                include 'view/menuEstudiante.php';
                break;
            case "5":
                include 'view/menuFamiliar.php';
                break;
            case "6":
                include 'view/menuAdmin.php';
                break;
            default:
                include 'view/menuLogout.php';
                break;
        }
        
        if(file_exists('view/'.$function.'.php')){
            switch ($function) {
                case "index":
                case "managers":
                case "teachers":
                case "news":
                    include 'view/' . $function . '.php';
                    break;
                case "login":
                    if ($user_id == "") {
                        include 'view/login.php';
                    }
                    break;
                default:
                    if ($user_id != "") {
                        include 'view/'.$function.'.php';
                    } else {
                        include 'view/errorAccess.php';
                    }
                    break;
            }
        }else{
            include 'view/error404.php';
        }
        ?>

        <?php include 'view/footer.php'; ?>

        <!--== Javascript Files ==-->
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="/sources/js/jquery-2.1.0.min.js"></script>

        <?php if ($function == 'index') {
            ?>
            <script>

                jQuery(document).ready(function($) {
                    var options = {
                        $AutoPlay: true,
                        $PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slideshow is auto playing, default value is false

                        $ArrowKeyNavigation: true, //Allows arrow key to navigate or not
                        $SlideWidth: 820, //[Optional] Width of every slide in pixels, the default is width of 'slides' container
                        $SlideHeight: 400, //[Optional] Height of every slide in pixels, the default is width of 'slides' container
                        $SlideSpacing: 0, //Space between each slide in pixels
                        $DisplayPieces: 2, //Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                        $ParkingPosition: 100, //The offset position to park slide (this options applys only when slideshow disabled).

                        $ArrowNavigatorOptions: {//[Optional] Options to specify and enable arrow navigator or not
                            $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
                            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
                            $AutoCenter: 2, //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                            $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                        }
                    };

                    var jssor_slider1 = new $JssorSlider$("slider1_container", options);

                    //responsive code begin
                    //you can remove responsive code if you don't want the slider scales while window resizes
                    function ScaleSlider() {
                        var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                        if (parentWidth)
                            jssor_slider1.$ScaleWidth(Math.min(parentWidth, 1024));
                        else
                            window.setTimeout(ScaleSlider, 30);
                    }

                    ScaleSlider();

                    if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                        $(window).bind('resize', ScaleSlider);
                    }


                    //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
                    //    $(window).bind("orientationchange", ScaleSlider);
                    //}
                    //responsive code end
                });

            </script>

        <?php }
        ?>



        <script type="text/javascript" src="/sources/js/jssor.js"></script>
        <script type="text/javascript" src="/sources/js/jssor.slider.js"></script>

        <script src="/sources/js/bootstrap.min.js"></script>
        <script src="/sources/js/jquery.validate.js"></script>
        <script src="/sources/js/jquery.scrollTo.js"></script>
        <script src="/sources/js/jquery.nav.js"></script>
        <script src="/sources/js/owl.carousel.min.js"></script>
        <script src="/sources/js/jquery.flexslider.js"></script>
        <script src="/sources/js/jquery.accordion.js"></script>
        <script src="/sources/js/jquery.placeholder.js"></script>
        <script src="/sources/js/jquery.fitvids.js"></script>
        <script src="/sources/js/gmap3.js"></script>
        <script src="/sources/js/fancySelect.js"></script>
        <script src="/sources/js/main.js"></script>
        <script src="/sources/js/script.js"></script>
    </body>
</html>