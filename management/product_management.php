<?php


// header 연결
include("../main/nav_header.php");

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<style>
    .scale {
        transform: scale(1);
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transition: all 0.2s ease-in-out; /* 부드러운 모션을 위해 추가*/
    }

    .scale:hover {
        transform: scale(3);
        -webkit-transform: scale(3);
        -moz-transform: scale(3);
        -ms-transform: scale(3);
        -o-transform: scale(3);
    }
</style>

<script type="text/javascript">
    function del_confirm(id) {
        var conf = confirm("상품을 삭제하면 되돌릴 수 없어요. 정말 삭제하시겠어요?");
        if (conf) {
            document.location.href = 'delete_process.php?&id=' + id;
        } else {
            return;
        }
    }
</script>

<body>

<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 style="text-align: center; color: #111111">상품 관리</h2>

            </div>
        </div>
    </section>


    <section>
        <div class="col-lg-3" style="margin-left: 50px; margin-top: 60px; max-width: 180px; position: fixed">
            <div class="list-group">
                <a href="product_management.php"
                   class="list-group-item active">상품 관리</a>
                <a href="order_management.php" class="list-group-item">주문 관리</a>
                <a href="member_management.php" class="list-group-item">회원 관리</a>
            </div>
        </div>
        <div class="container">
            <a href="form_register_product.php" style="float: right; margin-bottom: 20px">
                <input class="btn btn-d btn-round" type="button" value="상품 등록">
            </a>
            <table class="table table-border">
                <tbody>
                <tr style="text-align: center; background: #f9f9f9;">
                    <td width="30"><input type="checkbox"></td>
                    <td width="60">대표이미지</td>
                    <td width="60">상품명</td>
                    <td width="60">가격</td>
                    <td width="60">브랜드</td>
                    <td width="60">인원</td>
                    <td width="60">난이도</td>
                    <td width="60">게임시간</td>
                    <td width="60">재고</td>
                    <td width="60">판매량</td>
                    <td width="60">관리</td>
                </tr>

                <?
                $query = "select * from product order by upload_date desc";
                $result = mysqli_query($connect, $query);
                $total = mysqli_num_rows($result);

                if ($total > 0) {

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr style="text-align: center;">

                            <!--                    체크박스-->
                            <td style="vertical-align: middle"><input type="checkbox"></td>

                            <style>


                            </style>

                            <!--                    대표이미지-->
                            <td class="hidden-xs" style="vertical-align: middle">
                                <div class="scale">
                                    <a href="#">
                                        <img src="<?= $row['img_path'] ?>"
                                             alt="<?= $row['title'] . '(' . $row['eng_title'] . ')' ?>"
                                             style="width: 60px; height: auto"/>
                                    </a>
                                </div>
                            </td>

                            <td style="text-align: left; vertical-align: middle">
                                <a href="../product/detail_product.php?prod_id=<?= $row['id'] ?>">
                                    <?= $row['title'] . ' (' . $row['eng_title'] . ')' ?>
                                </a>
                            </td>

                            <td style="vertical-align: middle">
                                <?= '₩' . number_format($row['price']) ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?= $row['brand'] ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?
                                if ($row['min_people'] != $row['max_people']) {
                                    echo $row['min_people'] . '~' . $row['max_people'] . '명';
                                } else {
                                    echo $row['max_people'] . '명';
                                }
                                ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?= $row['difficulty'] ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?= $row['play_time'] ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?= $row['stock'] ?>
                            </td>

                            <td style="vertical-align: middle">
                                <?= $row['sales'] ?>
                            </td>

                            <td style="vertical-align: middle">
                                <div>
                                    <a href="./form_register_product.php?modify_id=<?= $row['id'] ?>">수정</a>
                                </div>
                                <div>
                                    <a href="javascript:del_confirm(<?= $row['id'] ?>)" style="color: red">삭제</a>
                                </div>
                            </td>

                        </tr>
                    <? }
                } else { ?>

                    <td colspan="11" style="font-size: 20px; color: #333; text-align: center; padding: 100px">
                        등록된 상품이 없어요.<br>
                        상품을 등록해주세요!
                    </td>

                <? } ?>

                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
// footer 연결
include("../main/footer.php");
?>
</body>
</html>
