<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= $GLOBALS['settingHome']["5"]["content"] ?>" />
    <meta name="keywords" content="<?= $GLOBALS['settingHome']["1"]["content"] ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="client/assets/css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <title><?= $GLOBALS['settingHome']["2"]["content"] ?></title>

</head>

<body>
    <header class="header">
        <div class="top_header">
            <div class="logo">
                <a href="?act=client" class="logo a_none">
                    <img src="../public/images/logo/dark.png" alt="" />
                </a>
            </div>
            <div class="box_search">
                <form action="index.php?act=client" method="post">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="search" placeholder="Tìm kiếm sản phẩm..." name="kyw">
                </form>
            </div>
            <div class="group_items">
                <div class="paper_group">
                    <button>
                        <img src="../public/images/languages/vi.svg" alt="" class="language" />
                        <span class="capitalize">Vietnam</span>
                        <span class="arrow"><i class="fa-solid fa-chevron-down"></i></span>
                    </button>
                    <a href="?act=wish-list" class="box_favourite ">
                        <div class="favourite"><i class="fa-regular fa-heart favourite" style="color: #ffffff;"></i>
                        </div>
                        <span class="capitalize">Yêu thích</span>
                    </a>

                    <div class="account">
                        <?php
                        if (!isset($_SESSION['user'])) {
                        ?>
                            <button class="box_favourite" onclick="toggleDropdown()">
                                <div class="favourite"><i class="fa-regular fa-user" style="color: #ffffff;"></i></div>
                                <p><span class="capitalize">Account</span></p>
                                <span class="arrow"><i class="fa-solid fa-chevron-down"></i></span>
                            </button>
                            <!-- Dropdown menu -->
                            <div class="account-dropdown" id="accountDropdown">
                                <a href="?act=register" class="dropdown-item register">Register your account</a>
                                <span class="or-text">OR</span>
                                <a href="?act=login" class="dropdown-item login">Login to your account</a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <a href="?act=profile">
                                <button class="box_favourite">
                                    <div class="favourite"><i class="fa-regular fa-user" style="color: #ffffff;"></i></div>
                                    <p><span class="capitalize"><?= $_SESSION['user']['name'] ?></span></p>
                                </button>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr">
        <div class="navbar_header">
            <div class="items flex center">
                <div class="item_left flex">
                    <div class="category_group">
                        <button class="btn_category" onclick="toggleNavbar()">
                            <i class="fa-solid fa-bars"></i>
                            <span class="capitalize">Browse Category</span>
                            <span class="arrow"><i class="fa-solid fa-chevron-down"></i></span>
                        </button>
                        <ul class="list_nav" id="listNav">
                            <?php foreach ($GLOBALS['listCate'] as $cate): ?>
                                <li class="category_item">
                                    <button class="category_menu">
                                        <span class="capitalize"> <?= $cate['name'] ?></span>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <nav class="nav_items">
                        <a href="?act=client" class="a_none capitalize">Trang chủ</a>
                        <a href="?act=products" class="a_none capitalize">Sản Phẩm</a>
                        <a href="?act=userLienHe" class="a_none capitalize">Liên Hệ</a>
                        <?php
                        if (isset($_SESSION['user']['role_id'])) {

                            echo ($_SESSION['user']['role_id'] == 3) ? '<a href="?act=admin" class="a_none capitalize" style="color: red;">Admin Panel</a>' : '';
                        }
                        ?>

                    </nav>
                </div>
                <div class="item_right">
                    <div class="item_right flex capitalize sub_right">
                        <?=
                        isset($_SESSION['user']) ? '
                            <div class="my_cart">
                            <a href="?act=carts" class=""><i class="fa-solid fa-basket-shopping"></i> My cart</a>
                        </div>
                            ' : "";
                        ?>
                        <div class="contact">
                            <i class="fa-solid fa-headphones-simple"></i>
                            <span><?= $GLOBALS['settingHome']["4"]["content"] ?></span>
                        </div>
                    </div>
                </div>
            </div>
    </header>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<script>
        toastr.warning('{$_SESSION['error']}');
      </script>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<script>
        toastr.success('{$_SESSION['success']}');
      </script>";
        unset($_SESSION['success']);
    }
    ?>