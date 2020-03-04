<?php

// header 연결
include("../main/nav_header.php");

$cate_no = $_GET['cate_no'];
$detail_code = $_GET['detail_code'];
$detail_category_name = null;
$query = null;

if ($cate_no == '101') {
    $category_name = '난이도';


    if ($detail_code == 1) {
        $detail_category_name = '초급';

        $query = "select * from product where difficulty='초급'";

    } elseif ($detail_code == 2) {
        $detail_category_name = '중급';

        $query = "select * from product where difficulty='중급'";

    } elseif ($detail_code == 3) {
        $detail_category_name = '고급';

        $query = "select * from product where difficulty='고급'";

    } else {
        $query = "select * from product";

    }


} elseif ($cate_no == '102') {
    $category_name = '인원';

    if ($detail_code == 1) {
        $detail_category_name = '2인 전용';

        $query = "select * from product where max_people=2";

    } elseif ($detail_code == 2) {
        $detail_category_name = '2인 이상';

        $query = "select * from product where max_people>=2";
    } else {
        $query = "select * from product";

    }


} elseif ($cate_no == '103') {
    $category_name = '브랜드';

    if ($detail_code == 1) {
        $detail_category_name = '코리아보드게임즈';
        $query = "select * from product where brand='코리아보드게임즈'";

    } elseif ($detail_code == 2) {
        $detail_category_name = '행복한바오밥';
        $query = "select * from product where brand='행복한바오밥'";

    } elseif ($detail_code == 3) {
        $detail_category_name = '코드코드';
        $query = "select * from product where brand='코드코드'";

    } elseif ($detail_code == 4) {
        $detail_category_name = '보드엠팩토리';
        $query = "select * from product where brand='보드엠팩토리'";

    } else {
        $query = "select * from product";

    }


//} elseif ($cate_no == '104') {
//    $category_name = '악세서리';
//
//    if ($detail_code == 1) {
//        $detail_category_name = '카드 슬리브';
//        $query = "select * from product where brand='보드엠팩토리'";
//
//    } elseif ($detail_code == 2) {
//        $detail_category_name = '플레이 매트';
//        $query = "select * from product where brand='보드엠팩토리'";
//
//    } elseif ($detail_code == 3) {
//        $detail_category_name = '주사위';
//        $query = "select * from product where brand='보드엠팩토리'";
//
//    }


} elseif ($cate_no == '200') {
    $category_name = '신규 게임';
    $query = "select * from product where upload_date >= date(subdate(now(), interval 7 day)) and date(upload_date) <= date(now())";

} elseif ($cate_no == '300') {
    $category_name = '인기 게임';
    $query = " select * from product where sales >= 5";

} else {
    $category_name = '전체 상품';
    $query = "select * from product";

}


$result = mysqli_query($connect, $query);
$total = mysqli_num_rows($result);


?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<body>
<script type="text/javascript">

    var category0 = new Array("세부 카테고리", "");
    var category1 = new Array("초급", "중급", "고급");
    var category2 = new Array("2인 전용", "2인 이상");
    var category3 = new Array("코리아보드게임즈", "행복한바오밥", "코드코드", "보드엠팩토리");
    var category4 = new Array("카드 슬리브", "플레이 매트", "주사위");

    function categoryChange(item) {
        var temp, i = 0, j = 0;
        var ccount, cselect;

        temp = document.signform.detail_category;

        for (i = (temp.options.length - 1); i > 0; i--) {
            temp.options[i] = null;
        }

        eval('ccount = category' + item + '.length');

        for (j = 0; j < ccount; j++) {
            eval('cselect = category' + item + '[' + j + '];');
            temp.options[j] = new Option(cselect, cselect);
        }

        temp.options[0].selected = true;
        return true;
    }

</script>


<div class="main">

    <!--        <section class="module bg-dark-60 shop-page-header" data-background="../images/diceshot/products/play_rummikub.jpg">-->
    <section class="module shop-page-header">
        <div class="container">
            <!--                <div class="col-sm-6 col-sm-offset-3">-->
            <!--                    <h2 class="module-title font-alt">-->
            <h2 align="center">
                <? echo $category_name ?>
            </h2>
            <!--                </div>-->
        </div>
    </section>


    <section class="module-small">
        <div class="container" style="font-size: 18px; padding-top: 50px; padding-bottom: 20px">

            <div class="col-sm-2">
                총 <?= $total ?>개의 상품
            </div>

            <div class="col-sm-10">
                <form name="signform">

                    <div class="col-sm-2">
                        <label class="control-label">1차 분류</label>
                        <select class="form-control" name="category"
                                onchange="categoryChange(signform.category.options.selectedIndex)">
                            <option selected="selected">전체</option>
                            <option <?= $cate_no == '101' ? 'selected' : '' ?> value="difficulty">난이도</option>
                            <option <?= $cate_no == '102' ? 'selected' : '' ?> value="num_of_people">인원</option>
                            <option <?= $cate_no == '103' ? 'selected' : '' ?> value="brand">브랜드</option>
                            <option <?= $cate_no == '104' ? 'selected' : '' ?> value="accessory">악세서리</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">세부 카테고리</label>
                        <select class="form-control" name="detail_category">
                            <option selected="selected">전체</option>
                            <? if ($cate_no == '101') { ?>
                                <option <?= $detail_code == '1' ? 'selected' : '' ?>>초급</option>
                                <option <?= $detail_code == '2' ? 'selected' : '' ?>>중급</option>
                                <option <?= $detail_code == '3' ? 'selected' : '' ?>>고급</option>

                            <? } elseif ($cate_no == '102') { ?>
                                <option <?= $detail_code == '1' ? 'selected' : '' ?>>2인 전용</option>
                                <option <?= $detail_code == '2' ? 'selected' : '' ?>>2인 이상</option>

                            <? } elseif ($cate_no == '103') { ?>
                                <option <?= $detail_code == '1' ? 'selected' : '' ?>>코리아보드게임즈</option>
                                <option <?= $detail_code == '2' ? 'selected' : '' ?>>행복한바오밥</option>
                                <option <?= $detail_code == '3' ? 'selected' : '' ?>>코드코드</option>
                                <option <?= $detail_code == '4' ? 'selected' : '' ?>>보드엠팩토리</option>

                            <? } elseif ($cate_no == '104') { ?>
                                <option <?= $detail_code == '1' ? 'selected' : '' ?>>카드 슬리브</option>
                                <option <?= $detail_code == '2' ? 'selected' : '' ?>>플레이 매트</option>
                                <option <?= $detail_code == '3' ? 'selected' : '' ?>>주사위</option>
                            <? } else { ?>

                            <? } ?>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">정렬 기준</label>
                        <select class="form-control">
                            <option selected="selected">인기 상품순</option>
                            <option>최근 등록일순</option>
                            <option>리뷰 많은순</option>
                            <option>높은 가격순</option>
                            <option>낮은 가격순</option>
                        </select>
                    </div>

                    <a href="product_list.php">
                        <input type="button" class="btn btn-d btn-round" value="검색">
                    </a>
                </form>
            </div>

        </div>
    </section>

    <hr class="divider-w">

    <section class="module-small">
        <div class="container">

            <? if ($total > 0) {
                while ($product = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-sm-3">
                        <div class="shop-item">
                            <div class="shop-item-image">
                                <img src="<?= $product['img_path'] ?>"
                                     alt="<?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>"/>

                                <div class="shop-item-detail">
                                    <form method="post" action="../cart/add_cart_process.php">
                                        <input type="hidden" id="member_uuid" name="member_uuid"
                                               value="<?= $_SESSION['member_uuid']; ?>">
                                        <input type="hidden" id="product_id" name="product_id" value="<?= $product['id']; ?>">
                                        <input type="hidden" id="amount" name="amount" value="<?= 1 ?>">
                                        <button class="btn btn-round btn-b" style="margin-top: 10px"> 카트 담기
                                        </button>
                                    </form>
                                    <a class="btn btn-round btn-b"
                                       href="../product/detail_product.php?prod_id=<?= $product['id'] ?>"
                                       style="margin-top: 10px">
                                        상세 보기
                                    </a>
                                </div>
                            </div>
                            <h4 class="shop-item-title font-alt"><a
                                        href="#"><?= $product['title'] . '(' . $product['eng_title'] . ')' ?></a>
                            </h4>
                            <?= '₩' . number_format($product['price']) ?>
                        </div>
                    </div>

                <? }
            } else { ?>

                <div class="col-sm-12"
                     style="font-size: 30px; font-weight: bold; text-align: center; vertical-align: middle; padding: 200px">
                    등록된 상품이 없습니다.
                </div>

            <? }

            include("../product/recent_product.php");
            ?>


        </div>


<!--        페이지네이션-->
<!--        <div class="row">-->
<!--            <div class="col-sm-12">-->
<!--                <div class="pagination font-alt">-->
<!--                    <a href="#">-->
<!--                        <i class="fa fa-angle-left"></i>-->
<!--                    </a>-->
<!--                    <a class="active" href="#">1</a>-->
<!--                    <a href="#">2</a>-->
<!--                    <a href="#">3</a>-->
<!--                    <a href="#">4</a>-->
<!--                    <a href="#">-->
<!--                        <i class="fa fa-angle-right"></i>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

    </section>
</div>

<?php
// footer 연결
include("../main/footer.php");

?>

</body>
</html>