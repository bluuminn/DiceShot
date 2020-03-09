<?php


// header 연결
include("../main/nav_header.php");

$cs_no = $_GET['cs_no'];

if ($cs_no <= 3 && $cs_no >= 1) {
    $query = "select * from cs_board where category='{$cs_no}' order by id desc";
} else {
    echo '<script> location.href="../main/404.php"</script>';
}


$result = mysqli_query($connect, $query);
if ($result) {
    $total = mysqli_num_rows($result);
}

$page = ($_GET['page']) ? $_GET['page'] : 1;

$LIST_SIZE = 5;
$BLOCK_SIZE = 5;

$total_page = ceil($total / $LIST_SIZE);
$total_block = ceil($total_page / $BLOCK_SIZE);
$now_block = ceil($page / $BLOCK_SIZE);

$start_page = ($now_block * $BLOCK_SIZE) - ($BLOCK_SIZE - 1);
if ($start_page <= 1) {
    $start_page = 1;
}

$end_page = $now_block * $BLOCK_SIZE;
if ($total_page <= $end_page) {
    $end_page = $total_page;
}

//echo "현재 페이지 : " . $page . "<br>";
//echo "현재 블록 : " . $now_block . "<br>";
//
//echo "현재 블록의 시작 페이지 : " . $start_page . "<br>";
//echo "현재 블록의 마지막 페이지 : " . $end_page . "<br>";
//
//echo "총 페이지 : " . $total_page . "<br>";
//echo "총 블록 : " . $total_block . "<br>";


//$add_query = "insert into cs_board(title, content, views, create_date, category, writer_uuid)";
//
//for ($i = 1; $i <= 100; $i++) {
//    $add_query = "insert into cs_board(title, content, views, create_date, category, writer_uuid)";
//
//    $title = '제목 ' . $i;
//    $content = '내용 ' . $i;
//    $add_query .= " values('{$title}', '{$content}', 0, now(), 1, '{$_SESSION['member_uuid']}')";
//    $add_result = mysqli_query($connect, $add_query);
//    if (!$add_result) {
//        echo $i . '번째 추가 명령 에러 : ';
//        echo mysqli_error($connect) . "<br>";
//    }
//
//}


?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<body>


<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 style="text-align: center; color: #111111">고객센터</h2>
                <div class="module-subtitle">
                    다이스샷 고객센터입니다.
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <!-- Sidebar Column -->
            <div class="col-lg-2" style="max-width: 180px">
                <div class="list-group">
                    <a href="./cs_main.php?cs_no=1"
                       class="list-group-item <?= $cs_no == '1' ? 'active' : '' ?>">공지사항</a>
                    <a href="./cs_main.php?cs_no=2" class="list-group-item <?= $cs_no == '2' ? 'active' : '' ?>">1:1
                        문의</a>
                    <a href="./cs_main.php?cs_no=3" class="list-group-item <?= $cs_no == '3' ? 'active' : '' ?>">입고
                        요청</a>
                </div>
            </div>

            <div class="col-lg-10">
                <!--                <div class="row">-->
                <!--                    <div class="col-sm-1">번호</div>-->
                <!--                    <div class="col-sm-4">제목</div>-->
                <!--                    <div class="col-sm-2">작성자</div>-->
                <!--                    <div class="col-sm-3">작성일</div>-->
                <!--                    <div class="col-sm-2">조회수</div>-->
                <!--                </div>-->

                <table class="table" align=center style="width: 100%;">
                    <!--                    <thead align="center">-->

                    <!--                    </thead>-->

                    <tbody align="center" style="border-bottom: 1px solid #dddddd">
                    <tr style="background:#f9f9f9">
                        <th width="60" style="text-align: center">번호</th>
                        <th width="500" style="text-align: center">제목</th>
                        <th width="100" style="text-align: center">작성자</th>
                        <th width="100" style="text-align: center">작성일</th>
                        <th width="100" style="text-align: center">조회수</th>
                    </tr>

                    <?php


                    $start_point = ($page - 1) * $LIST_SIZE;
                    $get_show_data_query = "select * from cs_board where category='{$cs_no}' order by id desc limit {$start_point}, {$LIST_SIZE}";
                    $get_show_data_result = mysqli_query($connect, $get_show_data_query);


                    $index = $total - ($page - 1) * $LIST_SIZE;

                    if ($total > 0) {
                        while ($post = mysqli_fetch_assoc($get_show_data_result)) { //DB에 저장된 데이터 수 (열 기준)

                            $get_member_query = "select * from member where uuid='{$post['writer_uuid']}'";
                            $get_member_result = mysqli_query($connect, $get_member_query);
                            $writer = mysqli_fetch_assoc($get_member_result);

                            $date = date_create($post['create_date']);

                            ?>

                            <td><?= $index ?></td>
                            <td align="left">
                                <a style="text-decoration: none; color: #353a3f"
                                   href="view_board_details.php?post_no=<?php echo $post['id'] ?>">
                                <?= $post['title'] ?></td>
                            <!--                        <td>--><?php //echo $rows['id'] ?><!--</td>-->
                            <td>
                                <?= $writer['nickname'] ?>

                            </td>
                            <td>
                                <?php echo date_format($date, "Y/m/d"); ?>
                            </td>

                            <td><?php echo $post['views'] ?></td>
                            </tr>

                            <?php $index--;

                            if ($post == false) {
                                exit;
                            }
                        }
                    } else { ?>
                        <td colspan="5" style="font-size: 20px; color: #333; text-align: center; padding: 100px">
                            <?

                            if ($cs_no <= 1) {
                                echo '등록된 공지사항이 없습니다.';

                            } elseif ($cs_no <= 2) {
                                echo '등록된 1:1 문의가 없습니다.';

                            } else {
                                echo '등록된 입고 요청이 없습니다.';
                            }

                            ?>
                        </td>
                    <? } ?>

                    </tbody>
                </table>


                <? if ($cs_no <= 1) {
                    if ($_SESSION['member_email'] == 'adming') { ?>

                        <a href="./create_post.php?cs_no=1">
                            <input class="btn btn-d btn-round" type="button" value="글쓰기"
                                   style="float: right; margin-top: 10px">
                        </a>

                    <? }
                } elseif ($cs_no <= 2 || $cs_no <= 3) {
                    if (isset($_SESSION['member_uuid'])) {

                        ?>
                        <a href="./create_post.php?cs_no=<?= $cs_no ?>">
                            <input class="btn btn-d btn-round" type="button" value="글쓰기"
                                   style="float: right; margin-top: 10px">
                        </a>
                    <? }
                }


                //                for ($p = $start_page; $p <= $end_page; $p++) { ?>
                <!--                    <a href="--><? //= $_SERVER['PHP_SELF'] ?><!--?cs_no=-->
                <? //=$cs_no?><!--&page=--><? //= $p ?><!--">--><? //= $p ?><!--</a>-->
                <!---->
                <!--                --><? // }

                ?>


                <!--    <a class="btn btn-default pull-right">글작성</a>-->

                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="pagination" style="margin-top: 140px">
                                <?
                                if ($now_block > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=1">처음</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $start_page - 1 ?>">이전</a>
                                    </li>
                                <? } else { ?>
<!--                                    <li class="page-item">-->
<!--                                        <a class="page-link">처음</a>-->
<!--                                    </li>-->
<!--                                    <li class="page-item">-->
<!--                                        <a class="page-link">이전</a>-->
<!--                                    </li>-->
                                    <?
                                }
                                for ($p = $start_page; $p <= $end_page; $p++) {
                                    if ($p == $page) {
                                        ?>
                                        <li class="page-item active">
                                            <a class="page-link"
                                               href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $p ?>"><?= $p ?></a>
                                        </li>
                                    <? } else { ?>
                                        <li class="page-item">
                                            <a class="page-link"
                                               href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $p ?>"><?= $p ?></a>
                                        </li>
                                        <?
                                    }
                                }

                                // 총 블럭(1~5/6~10/11~15 ..)수가 현재 블럭 수보다 작을 경우
                                if ($now_block < $total_block) { ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $end_page + 1 ?>">다음</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="<?= $_SERVER['PHP_SELF'] ?>?cs_no=<?= $cs_no ?>&page=<?= $total_page ?>">마지막</a>
                                    </li>

                                <? } else { ?>
<!--                                    <li class="page-item">-->
<!--                                        <a class="page-link">다음</a>-->
<!--                                    </li>-->
<!--                                    <li class="page-item">-->
<!--                                        <a class="page-link">마지막</a>-->
<!--                                    </li>-->
                                <? } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--<div class="col" style="text-align: center; margin-top: 40px;">
    <h4 class="col">공지사항</h4>
    <small class="col">다이스샷의 새로운 소식들과 유용한 정보들을 한곳에서 확인하세요.</small>
    <br><br><br><br>
</div>-->


<?php
// footer 연결
include("../main/footer.php");
?>

</body>
</html>
