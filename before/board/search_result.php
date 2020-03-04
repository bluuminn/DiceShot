<?php
include("../main/nav_header.php");

$keyword = $_GET['keyword'];
?>


<!DOCTYPE html>
<html lang="en">
<body>
<h3>
<?php
echo $keyword . '검색결과';
?>
</h3>
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