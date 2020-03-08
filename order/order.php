<?php

// header 연결
include("../main/nav_header.php");

if (isset($_SESSION['member_uuid'])) {

} else {

    echo "<script>alert('로그인이 필요한 서비스입니다.'); location.href='../member/sign_in.php';</script>";

}

//$order_no = $_GET['order'];
$order_no = $_POST['order_no'];

$order_list = explode('/', $order_no);


$get_member_query = "select * from member where uuid='{$_SESSION['member_uuid']}'";
$get_member_result = mysqli_query($connect, $get_member_query);
$member_info = mysqli_fetch_assoc($get_member_result);


// 디비에 저장할 주소 정보
$postcode = "";
$address = "";
$extraAddress = "";
$detailAddress = "";
$addr1 = "";
$is_postcode = $member_info['zipcode'];

$member_session_id = $_SESSION['member_uuid'];

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
<script type="text/javascript">

    // <!-- 배송정보 라디오 버든 선택 분기 자바스크립트 -->
    function init() {

        <?
        $phone_array = explode('-', $member_info['phone_number']);
        $first_num = $phone_array[0];
        $middle_num = $phone_array[1];
        $last_num = $phone_array[2];

        $addr_array = explode('+', $member_info['address1']);
        $addr = $addr_array[0];
        $extraAddr = $addr_array[1];
        ?>

        //input에 name으로 접근해서 값 세팅(배송 정보 초기화)
        $('input[name=postcode]').val("<?= $member_info['zipcode']; ?>");
        $('input[name=address]').val("<?= $addr ?>");
        $('input[name=extraAddress]').val("<?= $extraAddr ?>");
        $('input[name=detailAddress]').val("<?= $member_info['address2'] ?>");
        $('input[name=recipient_name]').val("<?= $member_info['member_name'] ?>");
        $('select[name=first_num]').val("<?= $first_num ?>");
        $('input[name=middle_num]').val("<?= $middle_num ?>");
        $('input[name=last_num]').val("<?= $last_num ?>");
        document.getElementById("find_addr").style.visibility = "hidden";

    }


    function changeBg(value) {
        // alert(value);

        if (value === "new") {

            //input에 name으로 접근해서 값 세팅 ())
            $('input[name=postcode]').val("");
            $('input[name=address]').val("");
            $('input[name=detailAddress]').val("");
            $('input[name=extraAddress]').val("");
            $('input[name=recipient_name]').val("");
            $('input[name=first_num]').val("");
            $('input[name=middle_num]').val("");
            $('input[name=last_num]').val("");
            document.getElementById("find_addr").style.visibility = "visible";

        } else {

            <?
//            $phone_array = explode('-', $member_info['phone_number']);
//            $first_num = $phone_array[0];
//            $middle_num = $phone_array[1];
//            $last_num = $phone_array[2];
//
//            $addr_array = explode('+', $member_info['address1']);
//            $addr = $addr_array[0];
//            $extraAddr = $addr_array[0];
            ?>

            //input에 name으로 접근해서 값 세팅(배송 정보 초기화)
            $('input[name=postcode]').val("<?= $member_info['zipcode']; ?>");
            $('input[name=address]').val("<?= $addr ?>");
            $('input[name=extraAddress]').val("<?= $extraAddr ?>");
            $('input[name=detailAddress]').val("<?= $member_info['address2'] ?>");
            $('input[name=recipient_name]').val("<?= $member_info['member_name'] ?>");
            $('select[name=first_num]').val("<?= $first_num ?>");
            $('input[name=middle_num]').val("<?= $middle_num ?>");
            $('input[name=last_num]').val("<?= $last_num ?>");
            document.getElementById("find_addr").style.visibility = "hidden";

        }

    }


    function post_to_url(path, params, method) {

        method = method || "post"; // Set method to post by default, if not specified.
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for (var key in params) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form.appendChild(hiddenField);
        }

        var order_num = '<?= $order_no; ?>';

        var hiddenField2 = document.createElement("input");
        hiddenField2.setAttribute("type", "hidden");
        hiddenField2.setAttribute("name", "cart_id");
        hiddenField2.setAttribute("value", order_num);
        form.appendChild(hiddenField2);

        //입력받은 배송 정보 json으로 만들고 string으로 변환해서 post로 넘김
        //객체생성
        var input_info = {};

        input_info.postcode = $('input[name=postcode]').val();
        input_info.address = $('input[name=address]').val();
        input_info.extraAddress = $('input[name=extraAddress]').val();
        input_info.detailAddress = $('input[name=detailAddress]').val();
        input_info.recipient_name = $('input[name=recipient_name]').val();
        input_info.recipient_contact_first_num = $('select[name=first_num]').val();
        input_info.recipient_contact_middle_num = $('input[name=middle_num]').val();
        input_info.recipient_contact_last_num = $('input[name=last_num]').val();
        input_info.delivery_msg = $('input[name=delivery_msg]').val();

        //String형태로 변환
        var input_json = JSON.stringify(input_info);

        //히든 필드 생성
        var hiddenField3 = document.createElement("input");
        hiddenField3.setAttribute("type", "hidden");
        hiddenField3.setAttribute("name", "input_info");
        hiddenField3.setAttribute("value", input_json);
        form.appendChild(hiddenField3);


        // var addrRegCk = document.getElementsByName("addressRegister_ck");
        // var addrRegResult = addrRegCk.getAttribute("checked");
        // alert("addRegCk.checked: " + addrRegCk.checked);
        var is_checked = $(addressRegister_ck).prop("checked");
        if (is_checked === true) {
            // alert('체크 확인');
            var hiddenField4 = document.createElement("input");
            hiddenField4.setAttribute("type", "hidden");
            hiddenField4.setAttribute("name", "addrRegiCk");
            hiddenField4.setAttribute("value", "y");
            form.appendChild(hiddenField4);
        }

        document.body.appendChild(form);
        form.submit();
    }


</script>

<body onload="init()">

<div class="main">
    <section class="module">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h1 align="center" style="font-weight: bold; color: #000">주문서</h1>
                <h4 align="center" style="margin-bottom: 80px">주문하실 상품명 및 수량을 정확하게 확인해주세요.</h4>

            </div>
        </div>
    </section>

    <section>
        <div class="container">

            <h2 style="margin-top: 100px; color: #111111">상품정보</h2>

            <table class="table table-border">
                <tbody>
                <tr style="text-align: center; background: #f9f9f9;">
                    <td width="200"></td>
                    <td width="400">상품정보</td>
                    <td width="200">판매가</td>
                    <td width="200">상품수량</td>
                    <td width="200">합계</td>
                </tr>

                <?

                //                while ($member_cart_list = mysqli_fetch_assoc($result)) {

                for ($i = 0; $i < sizeof($order_list); $i++) {

                    $query = "select * from cart where id='{$order_list[$i]}'";
                    $result = mysqli_query($connect, $query);

                    $member_cart_list = mysqli_fetch_assoc($result);

                    $get_prod_query = "select * from product where id='{$member_cart_list['product_id']}'";
                    $get_prod_result = mysqli_query($connect, $get_prod_query);
                    $prod_info = mysqli_fetch_assoc($get_prod_result);

                    $total_price += $prod_info['price'] * $member_cart_list['amount'];

                    if ($i == 0) {
                        $product_name = $prod_info['title'];
                    }

                    ?>


                    <tr style="text-align: center">

                        <td class="hidden-xs" style="vertical-align: middle">
                            <div class="scale">
                                <a href="#">
                                    <img src="<?= $prod_info['img_path'] ?>"
                                         alt="<?= $prod_info['title'] . ' (' . $prod_info['eng_title'] . ')' ?>"
                                         style="width: 60px; height: auto"/>
                                </a>
                            </div>
                        </td>

                        <td style="text-align: left; vertical-align: middle">
                            <a href="../product/detail_product.php?prod_id=<?= $prod_info['id'] ?>">
                                <?= $prod_info['title'] . ' (' . $prod_info['eng_title'] . ')' ?>
                            </a>
                        </td>


                        <td style="vertical-align: middle">
                            <?= $prod_info['price'] ?>
                        </td>

                        <td style="vertical-align: middle">
                            <?= $member_cart_list['amount'] ?>
                        </td>

                        <td style="vertical-align: middle">
                            <?= number_format($prod_info['price'] * $member_cart_list['amount']) ?>
                        </td>
                        <!--                                        <td class="pr-remove" style="vertical-align: middle">-->
                        <!--                                            <a href="#" title="Remove">-->
                        <!--                                                <i class="fa fa-times"></i>-->
                        <!--                                            </a>-->
                        <!--                                        </td>-->
                    </tr>

                <? }

                if ($total_price < 30000) {
                    $shipping = 2500;
                }
                ?>

                <tr style="text-align: right; background: #f9f9f9;">
                    <td colspan="5"> 상품금액(<?= number_format($total_price); ?>) + 배송비(<? if ($shipping < 2500) {
                            echo 0;
                        } else {
                            echo $shipping;
                        }; ?>) = <?= number_format($total_price + $shipping) ?></td>
                </tr>
                </tbody>
            </table>


            <h2 style="margin-top: 100px; color: #111111">주문 정보</h2>

            <table class="table table-border">
                <tbody>
                <tr>
                    <th>주문자</th>
                    <td><?= $member_info['member_name']; ?></td>
                </tr>

                <tr>
                    <th>휴대폰</th>
                    <td><?= $member_info['phone_number']; ?></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td width="88%"><?= $member_info['email']; ?></td>
                </tr>
                </tbody>
            </table>


            <h2 style="margin-top: 100px; color: #111111">배송 정보</h2>
            <hr>
            <!-- 배송정보 라디오 버튼 -->
            <div class="row" style="margin-top:20px; margin-bottom:30px; margin-left:10px;">
                <div class="col-sm-3">
                    <input type="radio" name="bgColor" value="existing" onclick="changeBg(this.value)" checked> 기존 배송지
                </div>
                <div class="col-sm-3">
                    <input type="radio" name="bgColor" value="new" onclick="changeBg(this.value)"> 새로운 배송지
                </div>
            </div>

            <div style="padding-top: 10px; padding-bottom: 30px; font-size: 16px">
                <div class="row">
                    <div class="col-sm-2">
                        주소
                    </div>
                    <div class="col-sm-10">
                        <input class="col-sm-3 form-control-static" id="postcode" name="postcode" placeholder="우편번호"
                               type="text" readonly="readonly" onclick="execDaumPostcode()">
                        <input class="col-sm-2 btn btn-border-bk btn-round" onclick="execDaumPostcode()"
                               type="button" value="우편번호 찾기" style="margin-left: 5px"><br><br>
                        <input class="col-sm-5 form-control-static" id="address" name="address" placeholder="주소"
                               type="text" style="margin-bottom: 10px; margin-top: 10px" readonly="readonly">
                        <input class="col-sm-5 form-control-static" id="extraAddress" name="extraAddress"
                               placeholder="참고항목"
                               type="text" style="margin-bottom: 10px; margin-left: 5px; margin-top: 10px"
                               readonly="readonly">
                        <input class="col-sm-10 form-control-static" id="detailAddress" name="detailAddress"
                               placeholder="상세주소" type="text" style="margin-bottom: 10px">

                        <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
                        <script>
                            function execDaumPostcode() {
                                new daum.Postcode({
                                    oncomplete: function (data) {
                                        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                                        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                                        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                                        var addr = ''; // 주소 변수
                                        var extraAddr = ''; // 참고항목 변수

                                        //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                                        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                                            addr = data.roadAddress;
                                        } else { // 사용자가 지번 주소를 선택했을 경우(J)
                                            addr = data.jibunAddress;
                                        }

                                        // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                                        if (data.userSelectedType === 'R') {
                                            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                                            // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                                            if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                                                extraAddr += data.bname;
                                            }
                                            // 건물명이 있고, 공동주택일 경우 추가한다.
                                            if (data.buildingName !== '' && data.apartment === 'Y') {
                                                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                                            }
                                            // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                                            if (extraAddr !== '') {
                                                extraAddr = ' (' + extraAddr + ')';
                                            }
                                            // 조합된 참고항목을 해당 필드에 넣는다.
                                            document.getElementById("extraAddress").value = extraAddr;

                                        } else {
                                            document.getElementById("extraAddress").value = '';
                                        }

                                        // 우편번호와 주소 정보를 해당 필드에 넣는다.
                                        document.getElementById('postcode').value = data.zonecode;
                                        document.getElementById("address").value = addr;
                                        // 커서를 상세주소 필드로 이동한다.
                                        document.getElementById("detailAddress").focus();
                                    }
                                }).open();
                            }
                        </script>

                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-2">
                        수령인
                    </div>

                    <div class="col-sm-10">
                        <input class="col-sm-4 form-control-static" id="recipient_name"
                               name="recipient_name" placeholder="수령인 이름" value="">
                    </div>

                </div>

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-2">
                        연락처
                    </div>

                    <div class="form-inline col-sm-10">
                        <div class="form-group">
                            <select class="form-control" id="first_num" name="first_num"
                                    style="min-width: 80px; margin-right: 4px">
                                <option value="010">010</option>
                                <option value="011">011</option>
                                <option value="016">016</option>
                                <option value="017">017</option>
                                <option value="018">018</option>
                                <option value="019">019</option>
                            </select>
                            -
                            <input class="form-control" id="middle_num" type="text" id="middle_num" name="middle_num"
                                   placeholder="" style="max-width: 80px; margin-left: 4px; margin-right: 4px" value=""
                                   maxlength="4" max="9999"/>
                            -
                            <input class="form-control" id="last_num" type="text" id="last_num" name="last_num"
                                   placeholder="" style="max-width: 80px; margin-left: 4px; margin-right: 4px" value=""
                                   maxlength="4" max="9999"/>
                        </div>
                    </div>

                    <!--                <div class="col-sm-10">-->
                    <!--                    <input type="text" class="col-sm-4 form-control-static" id="recipient_contact"-->
                    <!--                           name="recipient_contact" placeholder="수령인 연락처">-->
                    <!--                </div>-->

                </div>

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-2">
                        배송요청사항
                    </div>

                    <div class="col-sm-10">
                        <input type="text" class="col-sm-12 form-control-static" id="delivery_msg"
                               name="delivery_msg" placeholder="배송요청사항(최대 50자)">
                    </div>

                </div>

                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-6">
                        <input type="checkbox" id="addressRegister_ck" name="addressRegister_ck"
                               value=""> 해당 주소를 기본 배송지로 등록합니다.
                    </div>
                </div>
            </div>

            <?
            $tmp_cnt = (sizeof($order_list) - 1);
            if ($tmp_cnt <= 0) {
                $payment_name = $product_name;
            } else {
                $payment_name = $product_name . ' 외 ' . (sizeof($order_list) - 1) . '건';
            }
            ?>

            <button class="btn btn-d col-sm-4 col-sm-offset-4" type="button"
                    style="padding: 20px; font-size: 18px; font-weight: 500; margin-top: 100px; margin-bottom: 100px"
                    onclick="payment('', '')">결제하기
            </button>


            <script src="https://cdn.bootpay.co.kr/js/bootpay-3.0.6.min.js" type="application/javascript"></script>
            <script>
                function payment(pg, method) {

                    //실제 복사하여 사용시에는 모든 주석을 지운 후 사용하세요
                    BootPay.request({
                        price: '<?= $total_price + $shipping;  ?>', //실제 결제되는 가격
                        application_id: "5da9b8135ade160022569a32",
                        name: '<?= $payment_name; ?>', //결제창에서 보여질 이름
                        pg: pg,
                        method: method, //결제수단, 입력하지 않으면 결제수단 선택부터 화면이 시작합니다.
                        show_agree_window: 0, // 부트페이 정보 동의 창 보이기 여부
                        items: [
                            {
                                item_name: '<?= $payment_name; ?>', //상품명
                                qty: 1, //수량
                                unique: '123', //해당 상품을 구분짓는 primary key
                                price: <?= $prod_info['price'] ?>, //상품 단가
                                cat1: '', // 대표 상품의 카테고리 상, 50글자 이내
                                cat2: '', // 대표 상품의 카테고리 중, 50글자 이내
                                cat3: '', // 대표상품의 카테고리 하, 50글자 이내
                            }
                        ],
                        user_info: {
                            username: '<?= $member_info["member_name"]; ?>',
                            email: '<?= $member_info["email"]; ?>',
                            addr: '사용자 주소',
                            phone: '<?= $member_info["phone_number"]; ?>'
                        },
                        order_id: '고유order_id_1234', //고유 주문번호로, 생성하신 값을 보내주셔야 합니다.
                        params: {callback1: '그대로 콜백받을 변수 1', callback2: '그대로 콜백받을 변수 2', customvar1234: '변수명도 마음대로'},
                        account_expire_at: '2018-05-25', // 가상계좌 입금기간 제한 ( yyyy-mm-dd 포멧으로 입력해주세요. 가상계좌만 적용됩니다. )
                        extra: {
                            start_at: '2019-05-10', // 정기 결제 시작일 - 시작일을 지정하지 않으면 그 날 당일로부터 결제가 가능한 Billing key 지급
                            end_at: '2022-05-10', // 정기결제 만료일 -  기간 없음 - 무제한
                            vbank_result: 1, // 가상계좌 사용시 사용, 가상계좌 결과창을 볼지(1), 말지(0), 미설정시 봄(1)
                            quota: '0,2,3' // 결제금액이 5만원 이상시 할부개월 허용범위를 설정할 수 있음, [0(일시불), 2개월, 3개월] 허용, 미설정시 12개월까지 허용
                        }
                    }).error(function (data) {
                        //결제 진행시 에러가 발생하면 수행됩니다.
                        console.log(data);
                    }).cancel(function (data) {
                        //결제가 취소되면 수행됩니다.
                        console.log(data);
                    }).ready(function (data) {
                        // 가상계좌 입금 계좌번호가 발급되면 호출되는 함수입니다.
                        console.log(data);
                    }).confirm(function (data) {
                        //결제가 실행되기 전에 수행되며, 주로 재고를 확인하는 로직이 들어갑니다.
                        //주의 - 카드 수기결제일 경우 이 부분이 실행되지 않습니다.
                        console.log(data);
                        var enable = true; // 재고 수량 관리 로직 혹은 다른 처리
                        if (enable) {
                            BootPay.transactionConfirm(data); // 조건이 맞으면 승인 처리를 한다.
                        } else {
                            BootPay.removePaymentWindow(); // 조건이 맞지 않으면 결제 창을 닫고 결제를 승인하지 않는다.
                        }
                    }).close(function (data) {
                        // 결제창이 닫힐때 수행됩니다. (성공,실패,취소에 상관없이 모두 수행됨)
                        console.log(data);
                    }).done(function (data) {
                        //결제가 정상적으로 완료되면 수행됩니다
                        //비즈니스 로직을 수행하기 전에 결제 유효성 검증을 하시길 추천합니다.

                        console.log(data);
                        var tmp = JSON.stringify(data);
                        // var obj = JSON.parse(data);

                        // alert(obj);
                        // document.location.href = './order_complete.php?obj=' + obj;

                        post_to_url('./order_complete.php', {"order_info": tmp});

                    });
                }

            </script>

            <!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
            <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>

            <script>
                function payment() {

                    var IMP = window.IMP; // 생략가능
                    IMP.init('imp73705810'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

                    IMP.request_pay({
                        pg : 'inicis', // version 1.1.0부터 지원.
                        pay_method : 'card',
                        merchant_uid : 'merchant_' + new Date().getTime(),
                        name : '주문명:결제테스트',
                        amount : 14000,
                        buyer_email : 'iamport@siot.do',
                        buyer_name : '구매자이름',
                        buyer_tel : '010-1234-5678',
                        buyer_addr : '서울특별시 강남구 삼성동',
                        buyer_postcode : '123-456',
                        m_redirect_url : 'https://www.yourdomain.com/payments/complete'
                    }, function(rsp) {
                        if ( rsp.success ) {
                            var msg = '결제가 완료되었습니다.';
                            msg += '고유ID : ' + rsp.imp_uid;
                            msg += '상점 거래ID : ' + rsp.merchant_uid;
                            msg += '결제 금액 : ' + rsp.paid_amount;
                            msg += '카드 승인번호 : ' + rsp.apply_num;
                        } else {
                            var msg = '결제에 실패하였습니다.';
                            msg += '에러내용 : ' + rsp.error_msg;
                        }
                        alert(msg);
                    });

                }

            </script>-->


        </div>
    </section>

</div>


<?php

// footer 연결
include("../main/footer.php");

?>

</body>
</html>
