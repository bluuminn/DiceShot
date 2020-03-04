<?php


include("../main/db_connection.php");


$title = $_POST['title'];
$eng_title = $_POST['eng_title'];
$sub_description = $_POST['sub_description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$min_people = $_POST['min_people'];
$max_people = $_POST['max_people'];
$play_time = $_POST['play_time'];
$brand = $_POST['brand'];
$difficulty = $_POST['difficulty'];
$description = $_POST['description'];

$img_path = null;

$modify_value = $_POST['submit'];
$modify_id = $_POST['modify_id'];

$modify_ck = null;

if ($modify_value == '수정 완료') {
//    echo 'modify_value : ';
//    echo "<script>alert('$modify_value')</script>";
//    exit();
    $modify_ck = true;
} else {
//    echo 'modify_value : ';
//    echo "<script>alert('$modify_value')</script>";
//    exit();
    $modify_ck = false;
}

function uuidgen4()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}


function fileUpload()
{

    $target_dir = "../upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $path = null;


//if (isset($_FILES['submit']) && $_FILES['submit']['name'] != "") {


    if (isset($_POST['submit']) && $_FILES['fileToUpload']['name'] != "") {

        $file = $_FILES['fileToUpload'];
        $upload_directory = '../upload/';
        $ext_str = "jpg,jpeg,gif,png";
        $allowed_extensions = explode(',', $ext_str);

        $max_file_size = 5242880;
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1);

        $path = md5(microtime()) . '.' . $ext;

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//        $check = getimagesize($_FILES["fileToUpload"][$path]);

            if ($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
//            echo "File is not an image.";
                $uploadOk = 0;
            }
        }


        // Check if file already exists
        // 이미 존재하는 파일 (파일명이 같아서 인듯)
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

    }


// Check file size
    if ($_FILES["fileToUpload"]["size"] > 5242880) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }


// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_directory . $path)) {
//        echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
//        echo "<script>history.back()</script>";
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
            echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
        }

        return $img_path = "../upload/" . $path;

    }

}


// 필수 항목값 null 체크
// 필수 입력 항목 - title, price, stock, min_people, max_people, play_time, brand, difficulty, img_path

if ($modify_ck) {

    if ($title == null || $price == null || $stock == null || $min_people == null || $max_people == null || $play_time == null || $brand == null || $difficulty == null) {

        echo "<script>alert('필수 입력 항목을 모두 입력해주세요.'); history.back()</script>";
        exit();

    }

    $query = null;

    if ($_FILES['fileToUpload']['name'] != "") {

        $img_path = fileUpload();

        $query = "update product set title='{$title}', eng_title='{$eng_title}', price='{$price}', sub_description='{$sub_description}', description='{$description}', img_path='{$img_path}', brand='{$brand}', min_people='{$min_people}', max_people='{$max_people}', play_time='{$play_time}', difficulty='{$difficulty}', stock='{$stock}', modify_date=now() where id='{$modify_id}'";

    } else {

        $query = "update product set title='{$title}', eng_title='{$eng_title}', price='{$price}', sub_description='{$sub_description}', description='{$description}', brand='{$brand}', min_people='{$min_people}', max_people='{$max_people}', play_time='{$play_time}', difficulty='{$difficulty}', stock='{$stock}', modify_date=now() where id='{$modify_id}'";

    }


    $result = mysqli_query($connect, $query);

    if ($result) {
        // db 입력 성공
        echo "<script> alert('상품 수정 완료!');
                        location.href='./product_management.php';
                    </script>";
    } else {
        // db 입력 실패
        echo "fail";
        echo mysqli_error($connect);
    }


} else {

    if ($title == null || $price == null || $stock == null || $min_people == null || $max_people == null || $play_time == null || $brand == null || $difficulty == null || $_FILES['fileToUpload']['name'] == "") {
        echo "<script>alert('필수 입력 항목을 모두 입력해주세요.'); history.back()</script>";
        exit();
    }

    $img_path = fileUpload();

    $uuid = uuidgen4();

    $query = "insert into product(uuid, title, eng_title, price, sub_description, description, img_path, brand, min_people, max_people, play_time, difficulty, stock, sales, upload_date)
 values('{$uuid}','{$title}', '{$eng_title}', '{$price}', '{$sub_description}', '{$description}', '{$img_path}', '{$brand}', '{$min_people}', '{$max_people}', '{$play_time}', '{$difficulty}', '{$stock}', 0, now())";

    $result = mysqli_query($connect, $query);

    if ($result) {
        // db 입력 성공
        echo "<script> alert('상품 등록 완료!'); location.replace('../management/product_management.php');</script>";
    } else {
        // db 입력 실패
        echo "fail";
        echo mysqli_error($connect);
    }

}

//// ================================================================================================ 파일 업로드 부분
//
//$target_dir = "../upload/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//// Check if image file is a actual image or fake image
//
//$path = null;
//
//
////if (isset($_FILES['submit']) && $_FILES['submit']['name'] != "") {
//
//
//if (isset($_POST['submit']) && $_FILES['fileToUpload']['name'] != "") {
//
//    $file = $_FILES['fileToUpload'];
//    $upload_directory = '../upload/';
//    $ext_str = "jpg,jpeg,gif,png";
//    $allowed_extensions = explode(',', $ext_str);
//
//    $max_file_size = 5242880;
//    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);
//
//    $path = md5(microtime()) . '.' . $ext;
//
////    if ($path != null) {
////        echo $path;
////        echo 'path is not null';
////    } else {
////        echo 'path length is 0';
////    }
//
//    if (isset($_POST["submit"])) {
//        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
////        $check = getimagesize($_FILES["fileToUpload"][$path]);
//
//        if ($check !== false) {
////            echo "File is an image - " . $check["mime"] . ".";
//            $uploadOk = 1;
//        } else {
////            echo "File is not an image.";
//            $uploadOk = 0;
//        }
//    }
//
//
//    // Check if file already exists
//    // 이미 존재하는 파일 (파일명이 같아서 인듯)
//    if (file_exists($target_file)) {
//        echo "Sorry, file already exists.";
//        $uploadOk = 0;
//    }
//
//
//    /*    // 확장자 체크
//        if (!in_array($ext, $allowed_extensions)) {
//            echo "업로드할 수 없는 확장자 입니다. JPG, JPEG, PNG, GIF 확장자만 가능합니다.";
//        }
//        // 파일 크기 체크
//        if ($file['size'] >= $max_file_size) {
//            echo "5MB 까지만 업로드 가능합니다.";
//        }*/
//
//
////    if (move_uploaded_file($file['tmp_name'], $upload_directory . $path)) {
////        $query = "INSERT INTO upload_file (file_id, name_orig, name_save, reg_time) VALUES(?,?,?,now())";
////        $file_id = md5(uniqid(rand(), true));
////        $name_orig = $file['name'];
////        $name_save = $path;
////        $stmt = mysqli_prepare($connect, $query);
////        $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
////        $exec = mysqli_stmt_execute($stmt);
////        mysqli_stmt_close($stmt);
////        echo "<h3>파일 업로드 성공</h3>";
////
////        echo '<a href="file_list.php">업로드 파일 목록</a>';
////    }
//
////} else {
////    echo "<h3>파일이 업로드 되지 않았습니다.</h3>";
////    echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
//}
//
//
//// Check file size
//if ($_FILES["fileToUpload"]["size"] > 5242880) {
//    echo "Sorry, your file is too large.";
//    $uploadOk = 0;
//}
//
//// Allow certain file formats
//if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//    && $imageFileType != "gif") {
//    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//    $uploadOk = 0;
//}
//
//
//// Check if $uploadOk is set to 0 by an error
//if ($uploadOk == 0) {
//    echo "Sorry, your file was not uploaded.";
//
//// if everything is ok, try to upload file
//} else {
//    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_directory . $path)) {
////    if (move_uploaded_file($_FILES["fileToUpload"]["name"], $upload_directory . $path)) {
////        echo "<p>The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.</p>";
////        echo "<br><img src=../upload/" . basename($_FILES["fileToUpload"]["name"]) . ">";
////        echo "<br><img src=../upload/" . $path . ">";
////        echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
////        echo "<script>history.back()</script>";
//    } else {
//        echo "<p>Sorry, there was an error uploading your file.</p>";
//        echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
//    }
//
//    $img_path = "../upload/" . $path;
//
//}


// 필수 입력 항목 - title, price, stock, min_people, max_people, play_time, brand, difficulty, img_path
// 선택 입력값 - eng_title, sub_description, description, sales, modify_date

// db 필수 입력 항목 id, uuid, title, price, img_path, brand, min_people, max_people, play_time, difficulty, stock, upload_date


?>

