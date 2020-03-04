<?php

// header 연결
include("../main/nav_header.php");

if (isset($_COOKIE["auto_login_member_uuid"])) {
    header("location:../main/index.php");
}

$prevPage = $_SERVER["HTTP_REFERER"];

if ($prevPage == 'http://10.211.55.16/DiceShot/member/sign_up.php' || $prevPage == 'http://10.211.55.16/DiceShot/member/sign_up_process.php') {
    $prevPage = 'http://10.211.55.16/DiceShot/main/index.php';
}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<body>

<div class="main">
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4 pt-100">
                    <h1 class="font-alt mb-0" style="padding-bottom: 20px">로그인</h1>

                    <form class="form" method="post" action="sign_in_process.php">

                        <div class="form-group pt-30">
                            <input class="form-control" id="member_email" type="text" name="member_email"
                                   placeholder="이메일"/>
                        </div>
                        <div class="form-group pt-10">
                            <input class="form-control" id="password" type="password" name="password"
                                   placeholder="비밀번호"/>
                        </div>
                        <div class="form-group pt-10">
                            <input type="checkbox" name="auto_login">&nbsp;&nbsp;자동로그인
                        </div>
                        <div class="form-group pt-50" style="padding-top: 30px; padding-bottom: 50px">
                            <button class="btn btn-block btn-round btn-b">로그인</button>
                        </div>
                        <input type="hidden" name="prevPage" value="<?= $prevPage; ?>">
                        <!--                        <div class="form-group"><a href="">비밀번호를 잊어버리셨나요?</a></div>-->
                    </form>
                </div>
            </div>
        </div>
</div>

<?php

// footer 연결
include("../main/footer.php");


?>
</body>
</html>