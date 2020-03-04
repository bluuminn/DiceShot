<?php
include("../main/nav_header.php");
?>


<!DOCTYPE html>
<html lang="en">



<body>


<div class="container col-sm-4">
    <div class="row">
        <div class="col-md-12">
            <!--            <section>-->
            <h1 class="entry-title"><span><br>회원 가입<br></span></h1>
            <hr>
            <form class="form-horizontal" method="post" name="sign_up" id="sign_up"
                  enctype="multipart/form-data" action="sign_up_process.php">


                <!--                        아이디-->
                <div class="form-group" style="padding-top: 8px">
                    <label class="control-label col-sm-3">아이디 <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input type="text" class="form-control" name="mem_id" id="mem_id"
                                   placeholder="아이디" value="">
                        </div>
                    </div>
                </div>


                <!--                        비밀번호-->
                <div class="form-group" style="padding-top: 8px">
                    <label class="control-label col-sm-3">비밀번호 <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="8자리 이상 입력" value="">
                        </div>
                    </div>
                </div>


                <!--                        비밀번호 확인-->
                <div class="form-group" style="padding-top: 8px">

                    <label class="control-label col-sm-5">비밀번호 확인 <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-lock"></i>
                                </span>
                            <input type="password" class="form-control" name="ck_password" id="ck_password"
                                   placeholder="" value="">
                        </div>
                        <div style="padding-top: 4px">
                            <small>비밀번호 확인을 위해 다시 한 번 입력해주세요.</small>
                        </div>
                    </div>
                </div>


                <!--                        이름-->
                <div class="form-group" style="padding-top: 8px">

                    <label class="control-label col-sm-3">이름 <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mem_name" id="mem_name"
                               placeholder="" value="">
                    </div>
                </div>


                <!--                        닉네임-->
                <div class="form-group" style="padding-top: 8px">

                    <label class="control-label col-sm-3">닉네임 <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mem_nickname" id="mem_nickname"
                               placeholder="7자리 이내로 입력" value="">
                    </div>
                </div>


                <!--                        생년월일-->
                <div class="form-group" style="padding-top: 8px">

                    <label class="control-label col-sm-10">생년월일
                        <div style="padding-top: 4px; padding-bottom: 8px">
                            <small>매년 생일에 축하 쿠폰을 드립니다.</small>
                        </div>
                    </label>

                    <div class="col-md-8">
                        <!--                            <div class="col-xs-8">-->
                        <div class="form-inline">
                            <div style="padding-right: 10px">
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
                            </div>
                            <div style="padding-right: 10px">
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
                </div>


                <!--                        성별-->
                <div class="form-group" style="padding-top: 8px">
                    <label class="control-label col-sm-3">성별</label>
                    <div class="form-inline col">
                        <div class="form-group">
                            <select name="gender" class="form-control">
                                <option value="">성별을 선택해주세요.</option>
                                <option value="남자"> 남자</option>
                                <option value="여자"> 여자</option>
                                <!--                    <div class="col-md-8">-->
                                <!--                        <label> <input name="gender" type="radio" value="남자"> 남자 </label>-->
                                <!--                        <label> <input name="gender" type="radio" value="여자"> 여자 </label>-->
                            </select>
                        </div>
                    </div>
                </div>


                <!--                        이메일-->
                <div class="form-group" style="padding-top: 8px">
                    <label class="control-label col">본인 확인 이메일 <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </span>

                            <input type="email" class="form-control" name="email" id="email" placeholder="이메일 입력">
                            <div style="padding-top: 4px">
                                <small>비밀번호를 분실했거나 휴대전화 사용이 불가능 한 경우 계정을 복구하는데에 쓰입니다.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!--                        연락처-->
                <div class="form-group" style="padding-top: 8px">

                    <label class="control-label col-sm-3">휴대전화 <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                            <input type="number" class="form-control" name="mobile_num" id="mobile_num"
                                   placeholder="번호만 입력" value="" maxlength="11" oninput="maxLengthCheck(this)">
                            <!--                                   placeholder="번호만 입력" value="" maxlength="11">-->
                        </div>
                    </div>
                </div>


                <!--                        회원가입 버튼-->
                <div class="form-group" style="padding-top: 48px; padding-bottom: 160px;">
                    <!--                            <div class="col-xs-offset-3 col-xs-10">-->
                    <div class="control-label col">
                        <input name="Submit" type="submit" value="회원가입" class="btn btn-outline-primary">
                    </div>
                </div>
            </form>
            <!--            </section>-->
        </div>
    </div>
</div>


<?php
include("../main/footer.php");
?>


<!-- Bootstrap core JavaScript -->
<script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength) {
            object.value = object.value.slice(0, object.maxLength);
        }
    }
</script>

</body>

</html>