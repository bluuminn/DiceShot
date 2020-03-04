<?php


// header 연결
include("../main/nav_header.php");

$category = null;
$detail_category = null;

$modify_id = $_GET['modify_id'];


?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <script type="text/javascript" src="../smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
</head>

<body>

<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }


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

    <section class="module bg-dark-60 shop-page-header"
             data-background="/DiceShot/images/diceshot/products/play_rummikub.jpg">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">

                <!--                수정 아이디 값이 있다면 => 상품 수정 -->
                <? if ($modify_id != null) { ?>
                    <h1 align="center" style="margin-bottom: 100px; color: #000; font-size: 50px">상품 수정</h1>

                    <!--                수정 아이디 값이 없다면 => 상품 등록-->
                <? } else { ?>
                    <h1 align="center" style="margin-bottom: 100px; color: #000; font-size: 50px">상품 등록</h1>

                <? } ?>
            </div>
        </div>
    </section>

    <section class="pt-40">
        <div class="container" style="font-size: 16px">

            <div class="col-sm-12"
                 style="margin-top: 20px; margin-bottom: 51px; font-size: 24px; text-align: center; color: red">
                <label>* 기호는 필수 입력 항목입니다.</label>
            </div>


            <form method="post" name="signform" action="./register_process.php" enctype="multipart/form-data">

                <? if ($modify_id != null) {

                    $query = "select * from product where id like '$modify_id'";
                    $result = mysqli_query($connect, $query);

                    $product = mysqli_fetch_assoc($result); ?>


                    <div class="col-sm-6">
                        <label style="color: red">*</label> <label class="control-label">상품명</label>
                        <div class="form-group">
                            <input class="form-control" id="title" type="text" name="title"
                                   value="<?= $product['title'] ?>" placeholder="상품명"/>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="control-label">상품명 (영어)</label>
                        <div class="form-group">
                            <input class="form-control" id="eng_title" type="text" name="eng_title"
                                   value="<?= $product['eng_title'] ?>" placeholder="상품명 (영어)"/>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="control-label">한 줄 설명</label>
                        <div class="form-group">
                            <input class="form-control" id="sub_description" type="text" name="sub_description"
                                   value="<?= $product['sub_description'] ?>" placeholder="한 줄 설명"/>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">가격</label>
                        <div class="form-group">
                            <input class="form-control" id="price" type="text" name="price"
                                   value="<?= $product['price'] ?>" placeholder="가격"/>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">수량</label>
                        <div class="form-group">
                            <input class="form-control" id="stock" name="stock" type="text"
                                   value="<?= $product['stock'] ?>" placeholder="수량"/>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">최소 인원</label>
                        <div class="form-group">
                            <select id="min_people" name="min_people" class="form-control">
                                <option selected="selected" value="">최소 인원 선택</option>
                                <option <?= $product['min_people'] == '1' ? 'selected' : '' ?> value=1>1명</option>
                                <option <?= $product['min_people'] == '2' ? 'selected' : '' ?> value=2>2명</option>
                                <option <?= $product['min_people'] == '3' ? 'selected' : '' ?> value=3>3명</option>
                                <option <?= $product['min_people'] == '4' ? 'selected' : '' ?> value=4>4명</option>
                                <option <?= $product['min_people'] == '5' ? 'selected' : '' ?> value=5>5명</option>
                                <option <?= $product['min_people'] == '6' ? 'selected' : '' ?> value=6>6명</option>
                                <!--                                <option value="">직접입력</option>-->
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">최대 인원</label>
                        <div class="form-group">
                            <select id="max_people" name="max_people" class="form-control">
                                <option selected="selected" value="">최대 인원 선택</option>
                                <option <?= $product['max_people'] == '1' ? 'selected' : '' ?> value=1>1명</option>
                                <option <?= $product['max_people'] == '2' ? 'selected' : '' ?> value=2>2명</option>
                                <option <?= $product['max_people'] == '3' ? 'selected' : '' ?> value=3>3명</option>
                                <option <?= $product['max_people'] == '4' ? 'selected' : '' ?> value=4>4명</option>
                                <option <?= $product['max_people'] == '5' ? 'selected' : '' ?> value=5>5명</option>
                                <option <?= $product['max_people'] == '6' ? 'selected' : '' ?> value=6>6명</option>
                                <option <?= $product['max_people'] == '7' ? 'selected' : '' ?> value=7>7명</option>
                                <option <?= $product['max_people'] == '8' ? 'selected' : '' ?> value=8>8명 이상</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label style="color: red">*</label> <label class="control-label">플레이 시간 (한 게임 기준)</label>
                        <div class="form-group">
                            <select id="play_time" name="play_time" class="form-control">
                                <option selected="selected" value="">플레이 시간 선택</option>
                                <option <?= $product['play_time'] == '10분' ? 'selected' : '' ?> value="10분">10분</option>
                                <option <?= $product['play_time'] == '20분' ? 'selected' : '' ?> value="20분">20분</option>
                                <option <?= $product['play_time'] == '30분' ? 'selected' : '' ?> value="30분">30분</option>
                                <option <?= $product['play_time'] == '40분' ? 'selected' : '' ?> value="40분">40분</option>
                                <option <?= $product['play_time'] == '50분' ? 'selected' : '' ?> value="50분">50분</option>
                                <option <?= $product['play_time'] == '1시간' ? 'selected' : '' ?> value="1시간">1시간</option>
                                <option <?= $product['play_time'] == '1시간 30분' ? 'selected' : '' ?> value="1시간 30분">1시간
                                    30분
                                </option>
                                <option <?= $product['play_time'] == '2시간' ? 'selected' : '' ?> value="2시간">2시간</option>
                                <option <?= $product['play_time'] == '2시간 30분' ? 'selected' : '' ?> value="2시간 30분">2시간
                                    30분
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label style="color: red">*</label> <label class="control-label">브랜드</label>
                        <div class="form-group">
                            <select id="brand" name="brand" class="form-control">
                                <option selected="selected" value="">브랜드 선택</option>
                                <option <?= $product['brand'] == '코리아보드게임즈' ? 'selected' : '' ?> value="코리아보드게임즈">
                                    코리아보드게임즈
                                </option>
                                <option <?= $product['brand'] == '행복한바오밥' ? 'selected' : '' ?> value="행복한바오밥">행복한바오밥
                                </option>
                                <option <?= $product['brand'] == '코드코드' ? 'selected' : '' ?> value="코드코드">코드코드</option>
                                <option <?= $product['brand'] == '보드엠팩토리' ? 'selected' : '' ?> value="보드엠팩토리">보드엠팩토리
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label style="color: red">*</label> <label class="control-label">난이도</label>
                        <div class="form-group">
                            <select id="difficulty" name="difficulty" class="form-control">
                                <option selected="selected" value="">난이도 선택</option>
                                <option <?= $product['difficulty'] == '초급' ? 'selected' : '' ?> value="초급">초급</option>
                                <option <?= $product['difficulty'] == '중급' ? 'selected' : '' ?> value="중급">중급</option>
                                <option <?= $product['difficulty'] == '고급' ? 'selected' : '' ?> value="고급">고급</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <label style="color: red">*</label> <label class="control-label">대표 이미지</label>
                        <div>
                            <input type="file" name="fileToUpload" id="fileToUpload" onchange='readURL(this);'>
                            <img id="thumbnail" src="<?= $product['img_path'] ?>"
                                 style="max-width: 200px; max-height:200px;"/>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <label class="control-label">내용</label>
                        <div class="form-group">

                            <textarea name="description" id="description" style="width: 100%; height: 400px">
                                <?= $product['description'] ?>
                            </textarea>

                            <script type="text/javascript">
                                var oEditors = [];
                                var sLang = "ko_KR";
                                var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"], ["TEST", "TEST"]];

                                nhn.husky.EZCreator.createInIFrame({
                                    oAppRef: oEditors,
                                    elPlaceHolder: "description",
                                    sSkinURI: "../smarteditor/SmartEditor2Skin.html",
                                    fCreator: "createSEditor2"

                                });

                                function pasteHTML(filepath) {
                                    // var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                                    var sHTML = '<span style="color:#FF0000;"><img src="' + filepath + '"></span>';
                                    oEditors.getById["description"].exec("PASTE_HTML", [sHTML]);
                                }


                                function showHTML() {
                                    var sHTML = oEditors.getById["description"].getIR();
                                    alert(sHTML);
                                }

                                function submitContents(elClickedObj) {
                                    // 에디터의 내용이 textarea에 적용됩니다.
                                    oEditors.getById["description"].exec("UPDATE_CONTENTS_FIELD", []);
                                    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                                    try {
                                        elClickedObj.form.submit();
                                    } catch (e) {
                                    }
                                }
                            </script>

                        </div>

                        <input class="hidden" id="modify_id" name="modify_id" value="<?= $modify_id ?>">

                        <input class="btn btn-b btn-round" type="submit" onclick="submitContents(this)" value="수정 완료"
                               name="submit" style="float: right; margin-top: 20px">
                    </div>


                <? } else { ?>

                    <div class="col-sm-6">
                        <label style="color: red">*</label> <label class="control-label">상품명</label>
                        <div class="form-group">
                            <input class="form-control" id="title" type="text" name="title" placeholder="상품명"/>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="control-label">상품명 (영어)</label>
                        <div class="form-group">
                            <!--                            <input class="form-control" id="eng_title" type="text" name="eng_title" value="-->
                            <? //= $product['eng_title'] ?><!--" placeholder="상품명 (영어)"/>-->
                            <input class="form-control" id="eng_title" type="text" name="eng_title"
                                   placeholder="상품명 (영어)"/>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label class="control-label">한 줄 설명</label>
                        <div class="form-group">
                            <input class="form-control" id="sub_description" type="text" name="sub_description"
                                   placeholder="한 줄 설명"/>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">가격</label>
                        <div class="form-group">
                            <input class="form-control" id="price" type="text" name="price" placeholder="가격"/>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">수량</label>
                        <div class="form-group">
                            <input class="form-control" id="stock" name="stock" type="text" placeholder="수량"/>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">최소 인원</label>
                        <div class="form-group">
                            <select id="min_people" name="min_people" class="form-control">
                                <option selected="selected" value="">최소 인원 선택</option>
                                <option value=1>1명</option>
                                <option value=2>2명</option>
                                <option value=3>3명</option>
                                <option value=4>4명</option>
                                <option value=5>5명</option>
                                <option value=6>6명</option>
                                <option value="">직접입력</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label style="color: red">*</label> <label class="control-label">최대 인원</label>
                        <div class="form-group">
                            <select id="max_people" name="max_people" class="form-control">
                                <option selected="selected" value="">최대 인원 선택</option>
                                <option value=1>1명</option>
                                <option value=2>2명</option>
                                <option value=3>3명</option>
                                <option value=4>4명</option>
                                <option value=5>5명</option>
                                <option value=6>6명</option>
                                <option value=7>7명</option>
                                <option value=8>8명 이상</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label style="color: red">*</label> <label class="control-label">플레이 시간 (한 게임 기준)</label>
                        <div class="form-group">
                            <select id="play_time" name="play_time" class="form-control">
                                <option selected="selected" value="">플레이 시간 선택</option>
                                <option value="10분">10분</option>
                                <option value="20분">20분</option>
                                <option value="30분">30분</option>
                                <option value="40분">40분</option>
                                <option value="50분">50분</option>
                                <option value="1시간">1시간</option>
                                <option value="1시간 30분">1시간 30분</option>
                                <option value="2시간">2시간</option>
                                <option value="2시간 30분">2시간 30분</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label style="color: red">*</label> <label class="control-label">브랜드</label>
                        <div class="form-group">
                            <select id="brand" name="brand" class="form-control">
                                <option selected="selected" value="">브랜드 선택</option>
                                <option value="코리아보드게임즈">코리아보드게임즈</option>
                                <option value="행복한바오밥">행복한바오밥</option>
                                <option value="코드코드">코드코드</option>
                                <option value="보드엠팩토리">보드엠팩토리</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label style="color: red">*</label> <label class="control-label">난이도</label>
                        <div class="form-group">
                            <select id="difficulty" name="difficulty" class="form-control">
                                <option selected="selected" value="">난이도 선택</option>
                                <option value="초급">초급</option>
                                <option value="중급">중급</option>
                                <option value="고급">고급</option>
                            </select>
                        </div>
                    </div>


                    <!--                <div class="col-sm-6">-->
                    <!--                    <label class="control-label">카테고리</label>-->
                    <!--                    <select class="form-control" name="category"-->
                    <!--                            onchange="categoryChange(signform.category.options.selectedIndex)">-->
                    <!--                        <option selected="selected">카테고리 선택</option>-->
                    <!--                        <option value="difficulty">난이도</option>-->
                    <!--                        <option value="num_of_people">인원</option>-->
                    <!--                        <option value="brand">브랜드</option>-->
                    <!--                        <option value="accessory">악세서리</option>-->
                    <!--                    </select>-->
                    <!--                </div>-->
                    <!---->
                    <!--                <div class="col-sm-6">-->
                    <!--                    <label class="control-label">세부 카테고리</label>-->
                    <!--                    <select class="form-control" name="detail_category">-->
                    <!--                        <option selected="selected">전체</option>-->
                    <!--                    </select>-->
                    <!--                </div>-->

                    <div class="col-sm-12">
                        <label style="color: red">*</label> <label class="control-label">대표 이미지</label>
                        <div>
                            <input type="file" name="fileToUpload" id="fileToUpload" onchange='readURL(this);'>
                            <img id="thumbnail" src="" style="max-width: 200px; max-height:200px;"/>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <label class="control-label">내용</label>
                        <div class="form-group">

                            <textarea name="description" id="description" style="width: 100%; height: 400px"></textarea>

                            <script type="text/javascript">
                                var oEditors = [];
                                var sLang = "ko_KR";
                                var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"], ["TEST", "TEST"]];

                                nhn.husky.EZCreator.createInIFrame({
                                    oAppRef: oEditors,
                                    elPlaceHolder: "description",
                                    sSkinURI: "../smarteditor/SmartEditor2Skin.html",
                                    fCreator: "createSEditor2"

                                });

                                function pasteHTML(filepath) {
                                    // var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                                    var sHTML = '<span style="color:#FF0000;"><img src="' + filepath + '"></span>';
                                    oEditors.getById["description"].exec("PASTE_HTML", [sHTML]);
                                }


                                function showHTML() {
                                    var sHTML = oEditors.getById["description"].getIR();
                                    alert(sHTML);
                                }

                                function submitContents(elClickedObj) {
                                    // 에디터의 내용이 textarea에 적용됩니다.
                                    oEditors.getById["description"].exec("UPDATE_CONTENTS_FIELD", []);
                                    // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                                    try {
                                        elClickedObj.form.submit();
                                    } catch (e) {
                                    }
                                }
                            </script>

                        </div>


                        <input class="btn btn-b btn-round" type="submit" onclick="submitContents(this)" value="등록 완료"
                               name="submit" style="float: right; margin-top: 20px">
                    </div>

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
