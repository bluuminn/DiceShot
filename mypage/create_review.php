<?php


// header 연결
include("../main/nav_header.php");

if (isset($_SESSION['member_uuid'])) {

} else {

    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href='../member/sign_in.php';</script>";

}

$order_no = $_POST['order_no'];
$product_id = $_POST['product_id'];
$ordered_product_id = $_POST['ordered_product_id'];

$get_product = "select * from product where id={$product_id}";
$product_result = mysqli_query($connect, $get_product);
if ($product_result) {
    $product = mysqli_fetch_assoc($product_result);
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

            <h3>리뷰 작성</h3>

            <form method="post" action="./add_review_process.php">


                <table style="margin: 50px 0px">
                    <tbody>
                    <tr>
                        <td>
                            <img src="<?= $product['img_path'] ?>"
                                 alt="<?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>"
                                 style="width: 100px; height: auto"/>
                        </td>
                        <td style="font-size: 18px;">
                            <?= $product['title'] . ' (' . $product['eng_title'] . ')' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label" style="margin-top: 50px">별점</label>
                            <select class="form-control" id="rating" name="rating" style="max-width: 300px;">
                                <option value="5" selected="selected">★★★★★</option>
                                <option value="4">★★★★☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="1">★☆☆☆☆</option>
                            </select>
                        </td>
                    </tr>

                    </tbody>

                </table>


                <input type="hidden" name="order_no" value="<?= $order_no ?>">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <input type="hidden" name="ordered_product_id" value="<?= $ordered_product_id ?>">

                <label class="control-label">제목</label>
                <div class="form-group">
                    <input class="form-control" id="title" type="text" name="title" placeholder="제목"/>
                </div>

                <label class="control-label" style="margin-top: 50px">내용</label>
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
