<?php


// header 연결
include("../main/nav_header.php");

if (isset($_SESSION['member_uuid'])) {

} else {

    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href='../member/sign_in.php';</script>";

}

$cs_no = $_GET['cs_no'];
if ($cs_no == null) {
    $cs_no = 100;
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

            <? if ($cs_no <= 1) { ?>
                <h3>공지사항 작성</h3>

            <? } elseif ($cs_no <= 2) { ?>
                <h3>1:1 문의 작성</h3>

            <? } elseif ($cs_no <= 3) { ?>
                <h3>입고 요청</h3>

            <? } else {
                echo '<script> location.href="../main/404.php"</script>';
            } ?>

            <form method="post" action="./add_db_post.php">

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
