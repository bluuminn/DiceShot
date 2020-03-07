<?php


// header 연결
include("../main/nav_header.php");


?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<script type="text/javascript" language="JavaScript">


    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie() {
        var check_24h = getCookie("check_24h");

        if (check_24h == "") {
            window.open('./pop_up.php', 'newPopup', 'width=400,height=400,scrollbars=no,location=no,menubar=no,toolbar=no,status=no');
        }
    }


</script>

<body onload="checkCookie()">

<section class="home-section home-parallax home-fade" id="home">
    <div class="hero-slider">
        <ul class="slides">
            <li class="bg-dark-30 bg-dark"
                style="background-image:url('../images/diceshot/main_slide/rummikub2.jpg');">
                <div class="titan-caption">
                    <div class="caption-content">
                        <!--                        <div class="font-alt mb-30 titan-title-size-4">루 미 큐 브<br>Rummikub</div>-->
                        <div class="font-alt titan-title-size-4">루 미 큐 브</div>
                        <div class="font-alt mb-30 titan-title-size-2">Rummikub</div>

                        <!--                        <div class="font-alt mb-40 titan-title-size-4">루 미 큐 브</div>-->
                        <!--                        <a class="section-scroll btn btn-border-w btn-round" href="#about">보러가기</a>-->
                        <a class="btn btn-border-bk btn-round" href="about">보러가기</a>
                    </div>
                </div>
            </li>
            <li class="bg-dark-30 bg-dark"
                style="background-image:url('../images/diceshot/main_slide/drecksau.jpg');">
                <div class="titan-caption">
                    <div class="caption-content">
                        <!--                        <div class="font-alt mb-30 titan-title-size-2">Titan is creative multipurpose html template-->
                        <!--                            for<br/>web developers who change the world-->
                        <!--                        </div>-->

                        <!--                        <div class="font-alt mb-30 titan-title-size-4">드 렉 사 우<br>Drecksau</div>-->
                        <div class="font-alt titan-title-size-4">드 렉 사 우</div>
                        <div class="font-alt mb-30 titan-title-size-2">Drecksau</div>
                        <!--                        <div class="font-alt mb-30 titan-title-size-1">Drecksau</div>-->
                        <!--                        <div class="font-alt mb-40 titan-title-size-4">드렉사우</div>-->
                        <a class="btn btn-border-bk btn-round" href="about">보러가기</a>
                    </div>
                </div>
            </li>
            <li class="bg-dark-30 bg-dark"
                style="background-image:url('../images/diceshot/main_slide/weykick.jpg');">
                <div class="titan-caption">
                    <div class="caption-content">

                        <!--                        <div class="font-alt mb-30 titan-title-size-1">We build brands that build business</div>-->
                        <!--                        <div class="font-alt mb-40 titan-title-size-3">We are Amazing</div>-->
                        <!--                        <a class="section-scroll btn btn-border-w btn-round" href="#about">Learn More</a>-->

                        <!--                        <div class="font-alt mb-30 titan-title-size-4">웨이킥<br>Weykick</div>-->
                        <div class="font-alt titan-title-size-4">웨 이 킥</div>
                        <div class="font-alt mb-30 titan-title-size-2">Weykick</div>
                        <!--                        <div class="font-alt mb-30 titan-title-size-1">Weykick</div>-->
                        <!--                        <div class="font-alt mb-40 titan-title-size-4">웨이킥</div>-->
                        <a class="btn btn-border-bk btn-round" href="about">보러가기</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>


<div class="main">

    <section class="module-small">
        <div class="container">
            <div class="row pt-80">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 style="font-weight: normal; color: #000; font-size: 50px" align="center">인기 게임</h1>
                </div>
            </div>


            <?
            $query = "select * from product where sales>=5 order by sales desc";
            $result = mysqli_query($connect, $query);
            $total = mysqli_num_rows($result);


            while ($product = mysqli_fetch_assoc($result)) { ?>
                <div class="col-sm-3">
                    <div class="shop-item">
                        <div class="shop-item-image">
                            <img src="<?= $product['img_path'] ?>"
                                 alt="<?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>"/>

                            <div class="shop-item-detail">
                                <form name="cart" method="post" action="../cart/add_cart_process.php">
                                    <button class="btn btn-round btn-b" style="margin-top: 10px">
                                        카트 담기
                                    </button>
<!--                                    <input type="submit" class="btn btn-round btn-b icon-basket" value="카트 담기">-->
                                    <input type="hidden" name="member_uuid"
                                           value="<?= $_SESSION['member_uuid']; ?>">
                                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="amount" value="<?= 1 ?>">
                                </form>
                                <a class="btn btn-round btn-b"
                                   href="../product/detail_product.php?prod_id=<?= $product['id'] ?>"
                                   style="margin-top: 10px">
                                    상세 보기
                                </a>
                            </div>
                        </div>
                        <h4 class="shop-item-title font-alt"><a
                                    href="#"><?= $product['title'] . ' (' . $product['eng_title'] . ')' ?></a>
                        </h4>
                        <?= '₩' . number_format($product['price']) ?>
                    </div>
                </div>

            <? } ?>

            <div class="row mt-30">
                <div class="col-sm-12 align-center">
                    <a class="btn btn-b btn-round" href="../product/product_list.php?cate_no=300">전체 보기</a>
                </div>
            </div>
        </div>

    </section>

    <!--    <section class="module module-video bg-dark-30" data-background="">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6 col-sm-offset-3">-->
    <!--                    <h2 class="module-title font-alt mb-0">Be inspired. Get ahead of trends.</h2>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="video-player"-->
    <!--             data-property="{videoURL:'https://www.youtube.com/watch?v=EMy5krGcoOU', containment:'.module-video', startAt:0, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false, showYTLogo:false, vol:25}"></div>-->
    <!--    </section>-->


    <!--    <section class="module">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6 col-sm-offset-3">-->
    <!--                    <h2 class="module-title font-alt"></h2>-->
    <!--                    <div class="module-subtitle font-serif">The languages only differ in their grammar, their-->
    <!--                        pronunciation and their most common words.-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                <div class="owl-carousel text-center" data-items="5" data-pagination="false"-->
    <!--                     data-navigation="false">-->
    <!--                    <div class="owl-item">-->
    <!--                        <div class="col-sm-12">-->
    <!--                            <div class="ex-product"><a href="#">-->
    <!--                                    <img src="../images/shop/product-1.jpg" alt="Leather belt"/>-->
    <!--                                </a>-->
    <!--                                <h4 class="shop-item-title font-alt"><a href="#">Leather belt</a></h4>£12.00-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <div class="col-sm-12">-->
    <!--                            <div class="ex-product"><a href="#"><img src="../images/shop/product-2.jpg"-->
    <!--                                                                     alt="Derby shoes"/></a>-->
    <!--                                <h4 class="shop-item-title font-alt"><a href="#">Derby shoes</a></h4>£54.00-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <div class="col-sm-12">-->
    <!--                            <div class="ex-product"><a href="#"><img src="../images/shop/product-3.jpg"-->
    <!--                                                                     alt="Leather belt"/></a>-->
    <!--                                <h4 class="shop-item-title font-alt"><a href="#">Leather belt</a></h4>£19.00-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <div class="col-sm-12">-->
    <!--                            <div class="ex-product"><a href="#"><img src="../images/shop/product-4.jpg"-->
    <!--                                                                     alt="Leather belt"/></a>-->
    <!--                                <h4 class="shop-item-title font-alt"><a href="#">Leather belt</a></h4>£14.00-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <div class="col-sm-12">-->
    <!--                            <div class="ex-product"><a href="#"><img src="../images/shop/product-5.jpg"-->
    <!--                                                                     alt="Chelsea boots"/></a>-->
    <!--                                <h4 class="shop-item-title font-alt"><a href="#">Chelsea boots</a></h4>£44.00-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="owl-item">-->
    <!--                        <div class="col-sm-12">-->
    <!--                            <div class="ex-product"><a href="#"><img src="../images/shop/product-6.jpg"-->
    <!--                                                                     alt="Leather belt"/></a>-->
    <!--                                <h4 class="shop-item-title font-alt"><a href="#">Leather belt</a></h4>£19.00-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </section>-->


    <!--    <hr class="divider-w">-->
    <!---->
    <!---->
    <!--    <section class="module" id="news">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-6 col-sm-offset-3">-->
    <!--                    <h2 class="module-title font-alt">다이스 샷 소식</h2>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="row multi-columns-row post-columns wo-border">-->
    <!--                <div class="col-sm-6 col-md-4 col-lg-4">-->
    <!--                    <div class="post mb-40">-->
    <!--                        <div class="post-header font-alt">-->
    <!--                            <h2 class="post-title"><a href="#">Receipt of the new collection</a></h2>-->
    <!--                        </div>-->
    <!--                        <div class="post-entry">-->
    <!--                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet-->
    <!--                                mornings of spring which I enjoy with my whole heart.</p>-->
    <!--                        </div>-->
    <!--                        <div class="post-more"><a class="more-link" href="#">Read more</a></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-sm-6 col-md-4 col-lg-4">-->
    <!--                    <div class="post mb-40">-->
    <!--                        <div class="post-header font-alt">-->
    <!--                            <h2 class="post-title"><a href="#">Sale of summer season</a></h2>-->
    <!--                        </div>-->
    <!--                        <div class="post-entry">-->
    <!--                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet-->
    <!--                                mornings of spring which I enjoy with my whole heart.</p>-->
    <!--                        </div>-->
    <!--                        <div class="post-more"><a class="more-link" href="#">Read more</a></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-sm-6 col-md-4 col-lg-4">-->
    <!--                    <div class="post mb-40">-->
    <!--                        <div class="post-header font-alt">-->
    <!--                            <h2 class="post-title"><a href="#">New lookbook</a></h2>-->
    <!--                        </div>-->
    <!--                        <div class="post-entry">-->
    <!--                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet-->
    <!--                                mornings of spring which I enjoy with my whole heart.</p>-->
    <!--                        </div>-->
    <!--                        <div class="post-more"><a class="more-link" href="#">Read more</a></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-sm-6 col-md-4 col-lg-4">-->
    <!--                    <div class="post mb-40">-->
    <!--                        <div class="post-header font-alt">-->
    <!--                            <h2 class="post-title"><a href="#">Receipt of the new collection</a></h2>-->
    <!--                        </div>-->
    <!--                        <div class="post-entry">-->
    <!--                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet-->
    <!--                                mornings of spring which I enjoy with my whole heart.</p>-->
    <!--                        </div>-->
    <!--                        <div class="post-more"><a class="more-link" href="#">Read more</a></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-sm-6 col-md-4 col-lg-4">-->
    <!--                    <div class="post mb-40">-->
    <!--                        <div class="post-header font-alt">-->
    <!--                            <h2 class="post-title"><a href="#">Sale of summer season</a></h2>-->
    <!--                        </div>-->
    <!--                        <div class="post-entry">-->
    <!--                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet-->
    <!--                                mornings of spring which I enjoy with my whole heart.</p>-->
    <!--                        </div>-->
    <!--                        <div class="post-more"><a class="more-link" href="#">Read more</a></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-sm-6 col-md-4 col-lg-4">-->
    <!--                    <div class="post mb-40">-->
    <!--                        <div class="post-header font-alt">-->
    <!--                            <h2 class="post-title"><a href="#">New lookbook</a></h2>-->
    <!--                        </div>-->
    <!--                        <div class="post-entry">-->
    <!--                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet-->
    <!--                                mornings of spring which I enjoy with my whole heart.</p>-->
    <!--                        </div>-->
    <!--                        <div class="post-more"><a class="more-link" href="#">Read more</a></div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </section>-->

</div>


<?php

// footer 연결
include("../main/footer.php");

?>

</body>
</html>
