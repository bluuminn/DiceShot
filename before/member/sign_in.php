<?php

include("../main/nav_header.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dice Shot</title>

    <!-- Bootstrap core CSS -->
<!--    <link href="../bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="../bootstrap/vendor/bootstrap/css/litera_bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../bootstrap/css/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/sign_in_util.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/sign_in_main.css">

</head>

<body>



<div class="container col-sm-4">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <form class="login100-form validate-form flex-sb flex-w" name="sign_in" method="post"
                      action="sign_in_process.php">
					<span class="login100-form-title p-b-32" ; style="padding-top: 100px">
						로그인
					</span>

                    <span class="txt1 p-b-11">아이디</span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate="아이디를 입력해주세요.">
                        <input class="input100" type="text" name="mem_id">
                        <span class="focus-input100"></span>
                    </div>


                    <span class="txt1 p-b-11">비밀번호</span>
                    <div class="wrap-input100 validate-input m-b-46" data-validate="비밀번호를 입력해주세요.">
						<span class="btn-show-pass">
<!--							<i class="fa fa-eye-slash"></i>-->
						</span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                    </div>


                    <!--                <div class="flex-sb-m w-full p-b-48">-->
                    <!--                    <div class="contact100-form-checkbox">-->
                    <!--                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">-->
                    <!--                        <label class="label-checkbox100" for="ckb1">-->
                    <!--                            아이디 저장-->
                    <!--                        </label>-->
                    <!--                    </div>-->

                    <!--                    <div>-->
                    <!--                        <a href="#" class="txt3">-->
                    <!--                            비밀번호를 잊으셨나요?-->
                    <!--                        </a>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                    <div class="container-login100-form-btn" ; style="padding-bottom: 130px;">
                        <button class="login100-form-btn col" type="submit" style="margin-right: 80px">
                            로그인
                        </button>

                        <button class="login100-form-btn col" type=button onclick="location.href='sign_up.php'">
                            회원가입
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include("../main/footer.php");
?>



<!-- Bootstrap core JavaScript -->
<script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>