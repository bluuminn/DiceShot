<?php


// header 연결
include("../main/nav_header.php");

if (isset($_SESSION['member_uuid'])) {

} else {

    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href='../member/sign_in.php';</script>";

}

$cs_no = $_GET['cs_no'];
$modify_id = $_GET['modify_id'];

if ($cs_no == null) {
    $cs_no = 100;
}

// 수정할 아이디 값이 있으면 쿼리 실행
if ($modify_id != null) {
    $query = "select * from cs_board where id='{$modify_id}'";
    $result = mysqli_query($connect, $query);
}

if ($result) {
    $post = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <script type="text/javascript" src="../smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
</head>

<body>

<div class="main">
    <section class="module">
        <div class="container">

            <? if ($cs_no <= 1) {
                if ($modify_id == null) { ?>
                    <h3>공지사항 작성</h3>
                <? } else { ?>
                    <h3>공지사항 수정</h3>
                <? } ?>

            <? } elseif ($cs_no <= 2) {
                if ($modify_id == null) { ?>
                    <h3>1:1 문의 작성</h3>
                <? } else { ?>
                    <h3>1:1 문의 수정</h3>
                <? } ?>

            <? } elseif ($cs_no <= 3) {
                if ($modify_id == null) { ?>
                    <h3>입고 요청</h3>
                <? } else { ?>
                    <h3>입고 요청 수정</h3>
                <? } ?>

            <? } else {
                echo '<script> location.href="../main/404.php"</script>';
            } ?>

            <form method="post" action="./add_db_post.php">

                <?
                // 수정할 아이디 값 있을 때 == 수정할 경우
                if ($modify_id != null) { ?>

                    <input type="hidden" name="cs_no" value="<?= $cs_no ?>">

                    <label class="control-label">제목</label>
                    <div class="form-group">
                        <input class="form-control" id="title" type="text" name="title" value="<?= $post['title']?>" placeholder="제목"/>
                    </div>

                    <label class="control-label">내용</label>
                    <div class="form-group">

                        <textarea name="content" id="content" style="width: 100%; height: 400px">
                            <?= $post['content']?>
                        </textarea>

                        <script type="text/javascript">
                            var oEditors = [];
                            var sLang = "ko_KR";
                            var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"], ["TEST", "TEST"]];

                            nhn.husky.EZCreator.createInIFrame({
                                oAppRef: oEditors,
                                elPlaceHolder: "content",
                                sSkinURI: "../smarteditor/SmartEditor2Skin.html",
                                fCreator: "createSEditor2"

                            });

                            function pasteHTML(filepath) {
                                // var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                                var sHTML = '<span style="color:#FF0000;"><img src="' + filepath + '"></span>';
                                oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);
                            }


                            function showHTML() {
                                var sHTML = oEditors.getById["content"].getIR();
                                alert(sHTML);
                            }

                            function submitContents(elClickedObj) {
                                // 에디터의 내용이 textarea에 적용됩니다.
                                oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
                                // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                                try {
                                    elClickedObj.form.submit();
                                } catch (e) {
                                }
                            }
                        </script>

                    </div>

                    <input class="hidden" id="modify_id" name="modify_id" value="<?= $modify_id ?>">

                    <input class="btn btn-b btn-round" type="button" onclick="submitContents(this)" value="수정 완료"
                           style="float: right; margin-top: 20px">

                    <?
                    // 수정 할 아이디 값 없을 때 == 새로 작성할 때
                } else { ?>

                    <input type="hidden" name="cs_no" value="<?= $cs_no ?>">

                    <label class="control-label">제목</label>
                    <div class="form-group">
                        <input class="form-control" id="title" type="text" name="title" placeholder="제목"/>
                    </div>

                    <label class="control-label">내용</label>
                    <div class="form-group">

                        <textarea name="content" id="content" style="width: 100%; height: 400px"></textarea>

                        <script type="text/javascript">
                            var oEditors = [];
                            var sLang = "ko_KR";
                            var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"], ["TEST", "TEST"]];

                            nhn.husky.EZCreator.createInIFrame({
                                oAppRef: oEditors,
                                elPlaceHolder: "content",
                                sSkinURI: "../smarteditor/SmartEditor2Skin.html",
                                fCreator: "createSEditor2"

                            });

                            function pasteHTML(filepath) {
                                // var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                                var sHTML = '<span style="color:#FF0000;"><img src="' + filepath + '"></span>';
                                oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);
                            }


                            function showHTML() {
                                var sHTML = oEditors.getById["content"].getIR();
                                alert(sHTML);
                            }

                            function submitContents(elClickedObj) {
                                // 에디터의 내용이 textarea에 적용됩니다.
                                oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
                                // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                                try {
                                    elClickedObj.form.submit();
                                } catch (e) {
                                }
                            }
                        </script>

                    </div>

                    <input class="btn btn-b btn-round" type="button" onclick="submitContents(this)" value="작성 완료"
                           style="float: right; margin-top: 20px">

                <? } ?>


            </form>

        </div>


    </section>
</div>

<?php
// footer 연결
include("../main/footer.php");
?>
</body>
</html>
