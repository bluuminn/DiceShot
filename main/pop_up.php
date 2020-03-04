<?php


?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<body>
<p style="text-align: center;">
                <span style="font-size: 14pt;">
                    <b>
                        <span style="font-size: 24pt;">신규 입고</span>
                    </b>
                </span>
</p>
<p style="text-align: center; line-height: 1.5; font-size: 20px"><br/>
    다이스샷 판매량 1위! <br/><br/>
    루미큐브 클래식이 입고되었습니다.<br/><br/>
    감사합니다.<br/>
</p>
<p><br/>
</p>
<input type="checkbox" id="check_24h" name="check_24h"> 24시간동안 보지 않기
<input class="btn btn-d" type="submit" value="닫기" onclick="pop_up_close()">
<script type="text/javascript">


    function pop_up_close() {

        var check_24h = document.getElementById("check_24h");

        // 24시간 보지 않기 체크 상태면
        if (check_24h.checked) {
            //쿠키 생성하기위해 포스트로 값 넘겨줌
            post_to_url('./pop_up_process.php', {"check_24h": "on"})
        }

        close();
    }

    function post_to_url(path, params, method) {
        method = method || "post"; // Set method to post by default, if not specified.
        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form1 = document.createElement("form");
        form1.setAttribute("method", method);
        form1.setAttribute("action", path);
        for (var key in params) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);
            form1.appendChild(hiddenField);
        }
        document.body.appendChild(form1);
        form1.submit();
    }
</script>

</body>
</html>