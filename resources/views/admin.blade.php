<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin</title>
    <link rel="stylesheet" href="/css/admin/admin.css">
    <link rel="stylesheet" href="/css/admin/body_admin.css">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light border-bottom border-3 align-items-center">
        <div class="container-fluid justify-content-around align-items-center">
            <a class="navbar-brand d-flex align-items-center me-md-auto ms-md-5" href="/">
                <ion-icon name="book-outline"></ion-icon> MBook
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav text-center p-md-3 mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/admin">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page"
                            href="/admin/account-manager">Tài Khoản</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/bill-pay">Hóa Đơn</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/storage-products">Hàng Tồn Kho</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/admin/setting">Thiết Lập</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/add-newbook">Thêm Sách Mới</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="DialogDetailsPay__Container" id="DialogDetailsPay__Container">
        <div id="DialogDetailsPay" class="DialogDetailsPay"></div>
    </div>
    <div class="DialogDeleteAccount__Container" id="Dialog_Messenger">
        <div class="DialogDeleteAccount">
            <div class="DialogDeleteAccount__CloseBtn" onclick="closeDialogDeleteAccount()">
                <ion-icon name="close-circle-outline"></ion-icon>
            </div>
            <div class="DialogDeleteAccount__infoUser">
                <h1 style="margin: auto;">Bạn Muốn Xóa Tài Khoản Này?</h1>
                <h1>Tất Cả Dữ Liệu Của Tài Khoản Này Sẽ Bị Mất</h1>
            </div>
            <div class="DeleteAccount__Setting">
                <div class="DeleteAccount__Setting-details DeleteAccount__Setting-YES" onclick="DeleteAccount()">
                    Yes
                </div>
                <div class="DeleteAccount__Setting-details" onclick="closeDialogDeleteAccount()">
                    No
                </div>
            </div>
        </div>
    </div>
    <div class="DialogChangeDetailsProduct__Container" id="DialogChangeDetailsProduct__Container">
        <div class="DialogChangeDetailsProduct">
            <div class="DialogChangeDetailsProduct__CloseBtn" onclick="closeDialogChangeDetails()">
                <ion-icon name="close-circle-outline"></ion-icon>
            </div>
            <form id="UpdateBook">
                <div class="DialogChangeDetailsProduct__changeDetails">
                    <h1>Cập Nhật</h1>
                    Thêm số lượng tồn: <input type="text" required name="storageNum" id="storageNum">
                    Giá: <input type="text" name="storagePrice" required id="storagePrice">
                </div>
                <button type="submit"
                    class="DialogChangeDetailsProduct__Setting-details DialogChangeDetailsProduct__Setting-YES">
                    Cập Nhật
                </button>
            </form>
        </div>
    </div>
    <div class="Body__Container">
        @yield('admincontent')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="/js/admin.js"> </script>
</body>

</html>
