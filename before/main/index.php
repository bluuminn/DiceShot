<?php

// db 연결
include("../main/nav_header.php");

$game_title = null;
$normal_price = 0;
$discount_price = 0;

?>

<!DOCTYPE html>
<html lang="en">

<body>
<div class="container">
    <ul class="nav nav-justified position-sticky" style="font-size: 16px; padding-bottom: 10px; padding-top: 10px">
        <li class="nav-item border-right">
            <a class="nav-link" href="#">
                <span style="color: #696969;">전체</span></a>
        </li>
        <li class="nav-item border-right">
            <a class="nav-link" href="#">
                <span style="color: #696969;">
                    <span class="badge badge-primary">new</span>
                    신상품
                </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span style="color: #696969; font-size: medium">인기</span></a>
        </li>
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="#">-->
        <!--                <span style="color: #696969;">할인</span></a>-->
        <!--        </li>-->
        <li class="nav-item">
            <!--            <a class="nav-link" href="#">-->
            <!--                <span style="color: #696969;">검색</span></a>-->

            <!--            <form class="form-inline" action="">-->
            <!--                <input class="form-control" type="text" placeholder="검색어를 입력하세요.">-->
            <!--                <input class="btn btn-primary" value="검색" type="submit">-->
            <!--            </form>-->
            <form class="form-inline" action="../board/search_result.php">
                <input class="form-control" type="text" placeholder="검색어를 입력하세요." name="keyword"
                       style="font-size: 14px"/>
                <button class="btn btn-sm btn-outline-primary" type="submit" style="font-size: 14px; margin-left: 10px">
                    검색
                </button>
            </form>

        </li>
    </ul>
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
        <br><br><br>
        <h1 style="text-align: center">
            <?php
            if (isset($_SESSION['mem_id'])) {
                $nickname = $_SESSION['nickname'];
                echo "{$nickname} 님";
            } else {
                echo "회원님";
            }
            ?>
            이런 게임은 어떠세요?</h1>

        <!--        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>-->
        <!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat-->
        <!--            architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>-->
    </div>
</section>


<div class="container">
    <div class="row text-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <?php
            $game_title = 'rummikub';
            $normal_price = 36000;
            $discount_price = 21000;
            echo "<a style='text-decoration: none; color: #353a3f' href='../product/detail.php?title=" . $game_title . "&normal_price=" . $normal_price . "&discount_price=" . $discount_price . "'>";
            ?>
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/rummikub_classic.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">
                        루미큐브 (Rummikub)
                    </h4>
                    <!--                    <p class="card-text">세 번째로 가장 많이 팔리는 세계적인 베스트셀러</p>-->
                    <p class="lead">
                        <?php
                        echo number_format($normal_price) . '원';
                        ?>
                    </p>
                </div>
                <!--                <div class="card-footer">-->
                <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                <!--                </div>-->
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <?php
            $game_title = 'skullking';
            $normal_price = 30000;
            $discount_price = 27000;
            echo "<a style='text-decoration: none; color: #353a3f' href='../product/detail.php?title=" . $game_title . "&normal_price=" . $normal_price . "&discount_price=" . $discount_price . "'>";
            ?>
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/skullking.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">스컬킹 (Skull King)</h4>
                    <p class="lead"><?php
                        echo number_format($normal_price) . '원';
                        ?></p>
                    <!--                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo magni-->
                    <!--                        sapiente, tempore debitis beatae culpa natus architecto.</p>-->

                </div>
                <!--                <div class="card-footer">-->
                <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                <!--                </div>-->
            </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <?php
            $game_title = 'drecksau';
            $normal_price = 26000;
            $discount_price = 15000;
            echo "<a style='text-decoration: none; color: #353a3f' href='../product/detail.php?title=" . $game_title . "&normal_price=" . $normal_price . "&discount_price=" . $discount_price . "'>";
            ?>
            <form action="../product/detail.php">
                <div class="card h-100">
                    <img class="card-img-top" src="../images/products/drecksau.png" alt="">
                    <div class="card-body">
                        <h4 class="card-title">드렉사우 (Drecksau)</h4>
                        <p class="lead">
                            <?php
                            echo number_format($normal_price) . '원';
                            ?>
                            <!--                            26000원-->
                        </p>
                        <!--                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse-->
                        <!--                        necessitatibus neque.</p>-->
                    </div>
                    <!--                <div class="card-footer">-->
                    <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                    <!--                </div>-->
                </div>
                <!--            </a>-->
            </form>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <?php
            $game_title = 'davinci_code';
            $normal_price = 22000;
            $discount_price = 18000;
            echo "<a style='text-decoration: none; color: #353a3f' href='../product/detail.php?title=" . $game_title . "&normal_price=" . $normal_price . "&discount_price=" . $discount_price . "'>";
            ?>
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/davincicode.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">다빈치코드 (Davinci Code)</h4>
                    <!--                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo magni-->
                    <!--                        sapiente, tempore debitis beatae culpa natus architecto.</p>-->
                    <p class="lead"><?php
                        echo number_format($normal_price) . '원';
                        ?></p>
                </div>
                <!--                <div class="card-footer">-->
                <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                <!--                </div>-->
            </div>
            </a>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->


<section class="py-5">
    <div class="container">
        <br><br><br>
        <h1 style="text-align: center">인기 게임</h1>
        <!--        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>-->
        <!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat-->
        <!--            architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>-->
    </div>
</section>


<div class="container">
    <div class="row text-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/rummikub_classic.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">루미큐브 (Rummikub)</h4>
                    <!--                    <p class="card-text">세 번째로 가장 많이 팔리는 세계적인 베스트셀러</p>-->
                    <p class="lead">36,000원</p>
                </div>
                <!--                <div class="card-footer">-->
                <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                <!--                </div>-->
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/clue.jpg" alt="">
                <div class="card-body">
                    <h4 class="card-title">클루 (Clue)</h4>
                    <p class="lead">41,000원</p>
                    <!--                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo magni-->
                    <!--                        sapiente, tempore debitis beatae culpa natus architecto.</p>-->

                </div>
                <!--                <div class="card-footer">-->
                <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                <!--                </div>-->
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/haligalicups.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">할리갈리 컵스 (Halli Galli Cups)</h4>
                    <p class="lead">30,000원</p>
                    <!--                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse-->
                    <!--                        necessitatibus neque.</p>-->
                </div>
                <!--                <div class="card-footer">-->
                <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                <!--                </div>-->
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="../images/products/pinata.png" alt="">
                <div class="card-body">
                    <h4 class="card-title">피냐타 (PINATA)</h4>
                    <!--                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo magni-->
                    <!--                        sapiente, tempore debitis beatae culpa natus architecto.</p>-->
                    <p class="lead">26,000원</p>
                </div>
                <!--                <div class="card-footer">-->
                <!--                    <a href="#" class="btn btn-primary">Find Out More!</a>-->
                <!--                </div>-->
            </div>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php
include("../main/footer.php");
?>


<!-- Bootstrap core JavaScript -->
<script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>