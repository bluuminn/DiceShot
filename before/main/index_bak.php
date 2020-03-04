<?php

session_start();

// db 연결
include("./db_connection.php");


//if (!isset($_SESSION['mem_id']) || !isset($_SESSION['pw'])) {
//    //    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
//    exit;
//}


//echo "<p><a href='sign_out.php'>로그아웃</a></p>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dice Shot</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/modern-business.css" rel="stylesheet">

</head>

<body>


<!-- Navigation -->
<div class="navbar">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Dice Shot</a>
            <button class="navbar-toggler navbar-toggler-dark" type="button" data-toggle="collapse"
                    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse row" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php

                    if (isset($_SESSION['mem_id'])) {
                        $nickname = $_SESSION['nickname'];
                        echo "<li class=\"nav-item\"><a class=\"navbar-text\">안녕하세요. {$nickname} 님 </a></li>";
                        echo ">로그아웃</a></li>";
                        echo ">장바구니(0)</a></li>";
                        echo ">마이페이지</a></li>";

                    } else {
                        echo ">로그인</a></li>";
                        echo ">회원가입</a></li>";
                        echo ">장바구니(0)</a></li>";
                    }

                    ?>
                </ul>
            </div>
        </div>


        <div class="container">
            <div class="collapse navbar-collapse row" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.html">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Portfolio
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                            <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>
                            <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>
                            <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>
                            <a class="dropdown-item" href="portfolio-4-col.html">4 Column Portfolio</a>
                            <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Blog
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                            <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
                            <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
                            <a class="dropdown-item" href="blog-post.html">Blog Post</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Other Pages
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                            <a class="dropdown-item" href="full-width.html">Full Width Page</a>
                            <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
                            <a class="dropdown-item" href="faq.html">FAQ</a>
                            <a class="dropdown-item" href="404.html">404</a>
                            <a class="dropdown-item" href="pricing.html">Pricing Table</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active" style="background-image: url('../images/products/play_rummikub.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>루미큐브 (Rummikub)</h3>
                    <p><span style="color: #ffffff;">This is a description for the Rummikub.</span></p>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('../images/products/play_drecksau2.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>드렉사우 (Drecksau)</h3>
                    <p><span style="color: #ffffff;">This is a description for the Drecksau.</span></p>
                </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('../images/products/play_weykick.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>웨이 킥 (Wey Kick)</h3>
                    <p><span style="color: #ffffff;">This is a description for the Wey Kick.</span></p>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>


<section class="py-5">
    <div class="container">
        <h1>Section Heading</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat
            architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>
    </div>
</section>


<div class="container">
    <div class="row text-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/Rummikub.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">Rummikub</h4>
                    <p class="lead">세 번째로 가장 많이 팔리는 세계적인 베스트셀러</p>
                    <p class="card-text">36,000원</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo magni
                        sapiente,
                        tempore debitis beatae culpa natus architecto.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/Rummikub.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse
                        necessitatibus neque.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo magni
                        sapiente,
                        tempore debitis beatae culpa natus architecto.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Find Out More!</a>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-light">
    <div class="container">
        <p class="m-0 text-center text-black">Copyright King-Ming &copy; Dice Shot 2019</p>
    </div>
    <!-- /.container -->
</footer>


<!-- Bootstrap core JavaScript -->
<script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>


