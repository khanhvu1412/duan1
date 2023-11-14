<?php

include("../model/taikhoan.php");

include("view/header.php");

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {

        case 'tkcanhan':
            include('view/tkcanhan.php');
            break;

        
        case 'dangnhap':
            if(isset($_POST['dangnhap'])&& ($_POST['dangnhap'])){
                dangnhap($_POST['email'], $_POST['matkhau']);
                include('view/home.php');
            }
        break;

        case 'dangxuat':
            dangxuat();
            include('../Webbanhang/view/taikhoan/dangnhap.php');
            break;

        case "sanpham":
            include("view/sanpham.php");
            break;

        case "chitietsp":
            include("view/chitietsp.php");
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

        case 'giohang':
            include('view/menu/giohang.php');
            break;


        default:
            include("view/home.php");
            break;

    }
} else {
    include("view/home.php");
}

include("view/footer.php");
