<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
        <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,300|Raleway:300,400,900,700italic,700,300,600">
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>

        <!--        <div class="loader"></div>-->

        <header id="">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container" style="background: rgb(77, 87, 107);">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><span class="text-danger">Barisal Division News</span></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class=""><a href="index.php">Home</a></li>
                            <li class=""><a href="national.php">National</a></li>
                            <li class=""><a href="ict.php">ICT</a></li>
                            <li class=""><a href="sports.php">Sports</a></li>
                            <li class=""><a href="business.php">Business</a></li>
                            <li class=""><a href="entertainment.php">Entertainment</a></li>
                            <li class=""><a href="developer.php">Developer</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>


        <section id="slider-main" style="margin-top: 6%">
            <div class="container myslider">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->

                    <!-- Left and right controls -->
                </div>
            </div>
        </section>

        <!--/ HEADER-->


        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="blog">
                        <!---->
                        <?php
                        include_once '../web_project/database/databasefile.php';
                        ?>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3>Categories</h3>
                    <div class="list-group">
                        <a href="#" class="list-group-item">National</a>
                        <a href="#" class="list-group-item">ICT</a>
                        <a href="#" class="list-group-item">Sports</a>
                        <a href="#" class="list-group-item">Business</a>
                        <a href="#" class="list-group-item">Entertainment</a>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="service-title pad-bt15"></h2>
        <p class="sub-title pad-bt15"></p>


        <div class="col-sm-9">
            <div class="blog-sec">
                <div class="blog-img">
                </div>
                <div class="blog-info">
                    <pre><h2>
                     <img src="developer/_DSC4945.jpg">
                     Mahmud Hasan Shakkhor
                     PSTU
                     Mobile : 01515255819
                     Email : <a href="">mahmudshakkhor@gmail.com</a>
                 </h2>
                    </pre>
                </div>
            </div>
        </div>

        <!---->
        <footer id="footer">
            <div class="container">
                <div class="row text-center">
                    <p>
                        <?php
                        include_once './database/databasefile.php';
                        $statement = $db->prepare("SELECT * FROM footer_text WHERE id = 1");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo $row['description'];
                        }
                        ?>
                    </p>
                    <!--        <div class="credits">
                                 
                                    All the links in the footer should remain intact. 
                                    You can delete the links only if you purchased the pro version.
                                    Licensing information: https://bootstrapmade.com/license/
                                    Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Baker
                                
                            </div>-->
                </div>
            </div>
        </footer>
        <!---->
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/jquery.bxslider.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>

</body>
</html>