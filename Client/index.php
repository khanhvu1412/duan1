<!-- <link rel="stylesheet" type="text/css" href="css/form.css"> -->

<?php

session_start();
ob_start();
include("../model/pdo.php");
include("../model/taikhoan.php");
include("../model/binhluan.php");
include("../model/danhmuc.php");
include("../model/sanpham.php");
include("../model/donhang.php");
include("global.php");

include("header.php");

// if (!isset($_SESSION['mycart']))
//     $_SESSION['mycart'] = [];

if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = [];
}

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {


        case "sanpham":
            if (isset($_POST['kyw']) && $_POST['kyw'] != "") {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }
            $dssp = loadall_sanpham("", $iddm);
            $sanphamShop = loadall_shop($kyw, $iddm);
            //$listsphome = loadall_sanpham_home();
            $listsanpham = loadall_sanpham($kyw, $iddm);
            $listdanhmuc = loadall_danhmuc();
            include("view/sanpham.php");
            break;

        case "chitietsp":
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $sanpham = loadone_sanpham($_GET['id']);
                $sanphamcl = load_sanpham_cungloai($_GET['id'], $sanpham['iddm']);
                //$binhluan = loadone_binhluan($_GET['id']);
                //echo "<pre>";
                //print_r($binhluan);
            // } else {
            //     include("view/chitietsp.php");


             }
            // $sanphamcl = load_sanpham_cungloai($_GET['id'], $sanpham['iddm']);
            include("view/chitietsp.php");
            break;

        // case "timkiem":
        //     if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
        //         $kyw = $_POST['kyw'];
        //     } else {
        //         $kyw = "";
        //     }
        //     if (isset($_GET['iddm']) && ($_GET['iddm']) > 0) {
        //         $iddm = $_GET['iddm'];
        //     } else {
        //         $iddm = 0;
        //     }
        //     $dssp = loadall_sanpham("", $iddm);
        //     $listsanpham = loadall_sanpham($kyw, $iddm);
        //     $listdanhmuc = loadall_danhmuc();
        //     include "view/timkiem.php";
        //     break;

        case "timkiemdm":
            if (isset($_GET['iddm']) && ($_GET['iddm']) > 0) {
                $iddm = $_GET['iddm'];
                $danhmuc = loadone_danhmuc($_GET['iddm']);
            } else {
                $iddm = 0;
            }
            $listsanpham = loadall_sanpham("", $iddm);
            include "view/timkiemdm.php";
            break;

        // case 'tkcanhan':
        //     include('view/tkcanhan.php');
        //     break;


        case "dangky":

            if (isset($_POST['dangky']) && $_POST['dangky']) {
                $nguoidung = $_POST['nguoidung'];
                $matkhau = $_POST['matkhau'];
                $email = $_POST['email'];
                $diachi = $_POST['diachi'];
                $sdt = $_POST['sdt'];

                insert_taikhoan($nguoidung, $matkhau, $email, $diachi, $sdt);

            }
            include "view/taikhoan/dangky.php";
            break;

        case 'dangnhap':
            if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
                $nguoidung = $_POST['nguoidung'];
                $matkhau = $_POST['matkhau'];
                $checkuser = checkuser($nguoidung, $matkhau);
                if (is_array($checkuser)) {
                    $_SESSION['user'] = $checkuser;
                    header("Location: index.php");
                }
                $thongbao = "Tài khoản không tồn tại. Vui lòng nhập lại";


            }
            include("dangnhap.php");
            break;


        case 'quenmk':
            // if (isset($_POST['guiemail']) && $_POST['guiemail']) {
            //     $email = $_POST['email'];

            //     $checkemail = checkemail($email);
            //     if (is_array($checkemail)) {
            //       $thongbao = "Mật khẩu của bạn là: " . $checkemail['pass'];
            //     } else {
            //       $thongbao = "Email này không tồn tại";
            //     }
            //   }

            include('view/taikhoan/quenmk.pjp');
            break;
        case "lienhe":
            include("view/menu/lienhe.php");
            break;

        case "thanhtoan":
            include("view/thanhtoan.php");
            break;

        case 'about':
            include('view/menu/about.php');
            break;

        case 'blog':
            include('view/menu/blog.php');
            break;

        case 'addgiohang':
            if (isset($_POST['addtocart']) && ($_POST['addtocart'])) {
                $id = $_POST['id'];
                $tensp = $_POST['tensp'];
                $img = $_POST['img'];
                $giasp = $_POST['giasp'];
                $soluong = 1;
                $thanhtien = $soluong * $giasp;
                $sanphamadd = [$id, $tensp, $img, $giasp, $thanhtien];
                array_push($_SESSION['mycart'], $sanphamadd);
            }

            include('view/menu/giohang.php');
            break;

        case "deletecart":
            if (isset($_GET['id'])) {
                array_splice($_SESSION['mycart'], $_GET['id'], 1);
            } else {
                $_SESSION['mycart'] = [];
            }
            header("Location: index.php?act=addgiohang");
            break;






        default:
            if (isset($_POST['listok']) && ($_POST['listok'])) {
                $kyw = $_POST['kyw'];
                $iddm = $_POST['iddm'];
            } else {
                $kyw = "";
                $iddm = 0;
            }
            ;
            $listdanhmuc = loadall_danhmuc();
            $listsanpham = loadall_sanpham($kyw, $iddm);
            include("home.php");
            break;

    }
} else {
    if (isset($_POST['listok']) && ($_POST['listok'])) {
        $kyw = $_POST['kyw'];
        $iddm = $_POST['iddm'];
    } else {
        $kyw = "";
        $iddm = 0;
    }
    ;
    $listdanhmuc = loadall_danhmuc();
    $listsanpham = loadall_sanpham($kyw, $iddm);
    include("home.php");
}

include("footer.php");
ob_end_flush();
?>