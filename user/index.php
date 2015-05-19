<?php 
    session_start();
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    include "../globalfunction/function.php";
    include "../globalfunction/koneksi.php";
    // cek login administrator
    if ((isset($_SESSION['LoginUser'])) & ($_SESSION['UserLevel']=="2"))
    {
        $page = $_GET['page'];
        if ( (isset($page)) & ($page=='trans') )
        {
            $sidebar = false;
        }
        else
        {
            $sidebar = true;
        }
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <meta name="author" content="instingdigital : www.instingdigital.net" />
            <title>User :: Sistem Reservasi</title>
            <link rel="stylesheet" type="text/css" href="../css/main_style.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../css/navi.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../css/messi.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../css/pagination.css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../css/jBox.css" media="screen" />
            <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
            <script type="text/javascript" src="../js/jquery.validationEngine-en.js"></script>
            <script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
            <script type="text/javascript" src="../js/global.js"></script>
            <script type="text/javascript" src="../js/messi.js"></script>
            <script type="text/javascript" src="../js/jquery-ui.js"></script>
            <script type="text/javascript" src="../js/jquery.datetimepicker.js"></script>
            <script type="text/javascript" src="../js/jquery.pagination.js"></script>
            <script type="text/javascript" src="../js/printthis.js"></script>
            <script type="text/javascript" src="module/user.js"></script>
            <script type="text/javascript" src="module/side_bar.js"></script>
        </head>
        <body>
        <!---------- HEADER --------------------->
         <?php 
            include "pagecontent/header.php";
         ?>
         <!---------- END HEADER ----------------->
        <div class="main_wrap">
            <div class="wrap" <?php if (!$sidebar) {?> style="width: 98%;" <?php } ?>>
                <div id="content">
                <!---------- SIDE BAR ----------------->
                <?php 
                    if ($sidebar)
                    {
                        include "pagecontent/sidebar.php";   
                    }
                ?>
                <!---------- END SIDE BAR ----------------->
                <!---------- MAIN CONTENT ----------------->
                <div id="main" <?php if (!$sidebar) {?> style="width: 100%;" <?php } ?>>
                    <?php 
                        if ($sidebar)
                        {
                            include 'module/home.php';
                            //QuickMenu();
                        }
                    ?>
                    <div class="full_w" style="min-height: 500px;">
                        <div id="main_content">
                        <?php 
                            include "module/content.php";
                        ?>
                        </div>
        			</div>
                </div>
                </div>
                <!-------------------FOOTER---------------------->
            	<?php 
                    include "pagecontent/footer.php";
                ?>
                <!-------------------END FOOTER---------------------->
            </div>
        </div>
        </body>
        </html>
<?php 
    }
    else
    {
        $js = "parent.window.location = '../index.php'";
        exec_js($js);
    }
?>
