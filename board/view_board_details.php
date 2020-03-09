<?php


// header 연결
include("../main/nav_header.php");

$post_no = $_GET['post_no'];
$query = "select * from cs_board where id='{$post_no}'";
$result = mysqli_query($connect, $query);
if ($result) {
    $post = mysqli_fetch_assoc($result);
}

$get_member_query = "select * from member where uuid='{$post['writer_uuid']}'";
$get_member_result = mysqli_query($connect, $get_member_query);
if ($get_member_result) {
    $writer = mysqli_fetch_assoc($get_member_result);
}

$date = date_create($post['create_date']);

$views = $post['views'];
$views += 1;

$update_query = "UPDATE cs_board SET views={$views} WHERE id={$post_no}";
$update_result = mysqli_query($connect, $update_query);
if (!$result) {
    echo '조회수 업데이트 쿼리 에러 : ' . mysqli_error($connect) . "<br>";
}


?>


<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<script type="text/javascript">
    function del_confirm(id) {
        var conf = confirm("게시글을 삭제하면 되돌릴 수 없어요. 정말 삭제하시겠어요?");
        if (conf) {
            document.location.href = 'post_delete_process.php?&id=' + id + '&cs_no=' + <?= $post['category'] ?>;
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
                <h2 class="module-title">

                    <? if ($post['category'] <= 1) { ?>
                        공지사항
                    <? } elseif ($post['category'] <= 2) { ?>
                        1:1 문의
                    <? } elseif ($post['category'] <= 3) { ?>
                        입고 요청
                    <? } ?>

                </h2>
                <div class="module-subtitle">
                    다이스샷의 새로운 소식들과 유용한 정보들을 한곳에서 확인하세요.
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <!-- MODIFY & DELETE -->
            <div class="row">
                <div style="float: right; margin-bottom: 10px">


                    <? if ($post['category'] <= 1) {
                        if ($_SESSION['member_email'] == 'adming') { ?>

                            <a href="javascript:del_confirm(<?= $post_no ?>)" style="color: red">
                                <input class="btn btn-danger btn-round" type="button" value="삭제"
                                       style="margin-top: 10px">
                            </a>

                            <a href="./create_post.php">
                                <input class="btn btn-g btn-round" type="button" value="수정"
                                       style="margin-top: 10px">
                            </a>

                        <? } ?>

                    <? } elseif ($post['category'] >= 2 && $post['category'] <= 3) {

                        if ($post['writer_uuid'] == $_SESSION['member_uuid']) { ?>
                            <a href="javascript:del_confirm(<?= $post_no ?>)" style="color: red">
                                <input class="btn btn-danger btn-round" type="button" value="삭제"
                                       style="margin-top: 10px">
                            </a>

                            <a href="./create_post.php?cs_no=2&modify_id=<?= $post['id'] ?>">
                                <input class="btn btn-g btn-round" type="button" value="수정"
                                       style="margin-top: 10px">
                            </a>
                            <?
                        }

                    } ?>

                </div>
            </div>
            <div class="row" style="border-top:1px solid #dddddd;">
                <div class="col-sm-2 text-center"
                     style="height:40px; padding: 10px 0px; background-color: #f9f9f9; font-weight: bold">
                    제목
                </div>

                <div class="col-sm-5" style="height:40px; padding: 10px 10px;">
                    <?= $post['title']; ?>
                </div>
            </div>

            <div class="row" style="border-top:1px solid #dddddd;">
                <div class="col-sm-2 text-center"
                     style="height:40px; padding: 10px 0px; background-color: #f9f9f9; font-weight: bold">
                    작성자
                </div>
                <div class="col-sm-10" style="height:40px; padding: 10px 10px;">
                    <?= $writer['nickname'] ?>
                </div>
            </div>

            <div class="row" style="border-top:1px solid #dddddd;">
                <div class="col-sm-2 text-center"
                     style="height:40px; padding: 10px 10px; background-color: #f9f9f9; font-weight: bold">
                    작성일
                </div>

                <div class="col-sm-4" style="height:40px; padding: 10px 10px;">
                    <? echo date_format($date, "Y/m/d"); ?>
                </div>

                <div class="col-sm-2 text-center"
                     style="height:40px; padding: 10px 0px; background-color: #f9f9f9; font-weight: bold">
                    조회수
                </div>
                <div class="col-sm-4" style="height:40px; padding: 10px 10px;">
                    <?= $views; ?>
                </div>
            </div>

            <div class="row"
                 style="border-top:1px solid #dddddd; padding: 30px; border-bottom: 1px solid #dddddd; min-height: 300px">
                <div class="col">
                    <?
                    echo $post['content'];
                    ?>
                </div>
            </div>

            <? if ($post['category'] <= 1) { ?>
            <a href="./cs_main.php?cs_no=1">
                <? } elseif ($post['category'] <= 2) { ?>
                <a href="./cs_main.php?cs_no=2">
                    <? } elseif ($post['category'] <= 3) { ?>
                    <a href="./cs_main.php?cs_no=3">
                        <? } ?>
                        <input class="btn btn-border-d btn-round" type="button" value="목록"
                               style="float: right; margin-top: 30px; margin-bottom: 100px">
                    </a>

        </div>
    </section>
</div>

<?php
// footer 연결
include("../main/footer.php");
?>
</body>
</html>