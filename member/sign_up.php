<?php

// header 연결
include("../main/nav_header.php");

if (isset($_COOKIE["auto_login_member_uuid"])) {
    header("location:../main/index.php");
}


?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<body>

<div class="main">

    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <h1 class="font-alt mb-0" style="padding-bottom: 20px">회원가입</h1>
<!--                    <h4 class="font-alt">회원가입</h4>-->
                    <hr class="divider-w mb-10" style="padding-bottom: 20px">

                    <form class="form" method="post" action="sign_up_process.php">

                        <label class="control-label">이메일 <span class="text-danger">*</span></label>

                        <div class="form-group">
                            <input class="form-control" id="email" type="text" name="email" placeholder="이메일"/>
                        </div>


                        <label class="control-label">비밀번호 <span class="text-danger">*</span></label>

                        <div class="form-group">
                            <input class="form-control" id="password" type="password" name="password"
                                   placeholder="8자리 이상 입력"/>
                        </div>


                        <label class="control-label">비밀번호 확인 <span class="text-danger">*</span></label>

                        <div class="form-group">
                            <input class="form-control" id="re-password" type="password" name="re-password"
                                   placeholder="비밀번호 확인"/>
                            <small>비밀번호 확인을 위해 다시 한 번 입력해주세요.</small>
                        </div>

                        <label class="control-label">이름 <span class="text-danger">*</span></label>

                        <div class="form-group">
                            <input class="form-control" id="member_name" type="text" name="member_name"
                                   placeholder="이름"/>
                        </div>


                        <label class="control-label">닉네임 <span class="text-danger">*</span></label>

                        <div class="form-group">
                            <input class="form-control" id="nickname" type="text" name="nickname"
                                   placeholder="닉네임"/>
                        </div>

                        <label class="control-label">휴대전화 <span class="text-danger">*</span></label>
                        <div class="form-inline">
                            <div class="form-group">
                                <select class="form-control" id="first_num" name="first_num" style="min-width: 60px; margin-right: 4px">
                                    <option value="010">010</option>
                                    <option value="011">011</option>
                                    <option value="016">016</option>
                                    <option value="017">017</option>
                                    <option value="018">018</option>
                                    <option value="019">019</option>
                                </select>
                                -
                                <input class="form-control" id="middle_num" type="text" id="middle_num" name="middle_num"
                                       placeholder="" style="max-width: 80px; margin-left: 4px; margin-right: 4px" maxlength="4" max="9999"/>
                                -
                                <input class="form-control" id="last_num" type="text" id="last_num" name="last_num"
                                       placeholder="" style="max-width: 80px; margin-left: 4px; margin-right: 4px" maxlength="4" max="9999"/>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 8px">
                            <label class="control-label">생년월일</label>
                            <small>매년 생일에 축하 쿠폰을 드립니다.</small>

                            <div class="form-inline">
                                <div class="form-group">
                                    <select name="yyyy" class="form-control">
                                        <option value="">연도</option>
                                        <option value="1960">1960</option>
                                        <option value="1961">1961</option>
                                        <option value="1962">1962</option>
                                        <option value="1963">1963</option>
                                        <option value="1964">1964</option>
                                        <option value="1965">1965</option>
                                        <option value="1966">1966</option>
                                        <option value="1967">1967</option>
                                        <option value="1968">1968</option>
                                        <option value="1969">1969</option>
                                        <option value="1970">1970</option>
                                        <option value="1971">1971</option>
                                        <option value="1972">1972</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1982">1982</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="mm" class="form-control">
                                        <option value="">월</option>
                                        <option value="01">1</option>
                                        <option value="02">2</option>
                                        <option value="03">3</option>
                                        <option value="04">4</option>
                                        <option value="05">5</option>
                                        <option value="06">6</option>
                                        <option value="07">7</option>
                                        <option value="08">8</option>
                                        <option value="09">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="dd" class="form-control">
                                        <option value="">일</option>
                                        <option value="01">1</option>
                                        <option value="02">2</option>
                                        <option value="03">3</option>
                                        <option value="04">4</option>
                                        <option value="05">5</option>
                                        <option value="06">6</option>
                                        <option value="07">7</option>
                                        <option value="08">8</option>
                                        <option value="09">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>
                            </div>
                            <div style="padding-top: 4px">
                                <small><span style="color: red">※ 만 14세 미만 회원은 회원가입이 불가능 합니다.</span></small>
                            </div>
                        </div>


                        <div class="form-group" style="padding-top: 30px">
                            <button class="btn btn-block btn-round btn-b">회원가입</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>


    <?php

    // footer 연결
    include("../main/footer.php");

    ?>
</div>
</body>
</html>