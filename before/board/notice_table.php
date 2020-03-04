<?php
$page_num = 0;
?>

<div class="container">
    <table class="table table-hover">
        <thead>
        <tr align="center">
            <td>번호</td>
            <td>제목</td>
            <td>작성자</td>
            <td>작성일</td>
            <td>조회수</td>
        </tr>
        </thead>
        <tbody align="center">
        <tr>
            <td><?php echo ++$page_num ?></td>
            <td align="left"><a style="text-decoration: none; color: #353a3f" href="#">hard coding ... ㅋㅋㅋ</a></td>
            <td>밍밍</td>
            <td>2019-10-07</td>
            <td>500</td>
        </tr>
        <tr>
            <td><?php echo ++$page_num ?></td>
            <td align="left"><a style="text-decoration: none; color: #353a3f" href="#">루미큐브 하고싶당ㅇㅇㅇㅇ</a></td>
            <td>밍밍</td>
            <td>2019-10-05</td>
            <td>500</td>
        </tr>
        <tr>
            <td><?php echo ++$page_num ?></td>
            <td align="left"><a style="text-decoration: none; color: #353a3f" href="#">어려웡ㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇ</a></td>
            <td>밍밍</td>
            <td>2019-10-04</td>
            <td>500</td>
        </tr>
        <tr>
            <td><?php echo ++$page_num ?></td>
            <td align="left"><a style="text-decoration: none; color: #353a3f" href="#">팀노바팀노바팀노바팀노바팀노바</a></td>
            <td>밍밍</td>
            <td>2019-10-03</td>
            <td>500</td>
        </tr>
        <tr>
            <td><?php echo ++$page_num ?></td>
            <td align="left" href="#"><a style="text-decoration: none; color: #353a3f" href="#">hard coding ... ㅋㅋㅋ</a></td>
            <td>밍밍</td>
            <td>2019-10-01</td>
            <td>500</td>
        </tr>
        </tbody>
    </table>

    <input class="btn btn-primary" type="button" value="글쓰기" style="float: right; margin-top: 10px">
    <!--    <a class="btn btn-default pull-right">글작성</a>-->

    <div class="container">
        <div class="row py-5">
            <div class="col">
                <ul class="pagination justify-content-center" style="margin-top: 100px">
                    <li class="page-item"><a class="page-link" href="#"> < </a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    <li class="page-item"><a class="page-link" href="#">9</a></li>
                    <li class="page-item"><a class="page-link" href="#">10</a></li>
                    <li class="page-item"><a class="page-link" href="#"> > </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
