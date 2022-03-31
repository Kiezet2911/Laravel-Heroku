@extends('admin')

@section('admincontent')
<div class="Admin__Account-Header">
    <div class="Checkbox__All-Account">

    </div>
    <div class="Title__username">Tài Khoản</div>
    <div class="Title__email">Email</div>
    <div class="Title__role">Loại Tài Khoản</div>

    <div class="Title__setting">Thiết Lập</div>
</div>
<div class="Admin__Account-Body">


    <?php

    use App\Http\PaginationAPI;
    //Lấy Danh Sách Sản Phẩm

    $config = array(
        'api'  => "khachhangforadmin/false",
        'current_page'  => isset($_GET['pages']) ? $_GET['pages'] : 1, // Trang hiện tại          
        'limit'         => 4, // limit
        'link_full'     => '?pages={page}', // Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => '/admin/account-manager', // Link trang đầu tiên
        'range'         => 3 // Số button trang bạn muốn hiển thị 
    );

    $paging = new PaginationAPI();

    $paging->init($config);

    $list = $paging->Getlist();

    if ($list == null) {
    ?>
        <div class='Admin__Account-Empty'>
            <div class='Admin__Account-Empty-image'>
                <img src='https://i.pinimg.com/originals/ec/0c/0c/ec0c0c652f7a9fb965bf08f45c4403fe.gif' alt=''>
            </div>
            <span>Hiện Không Có Tài Khoản Nào Được Đăng Ký</span>
        </div>


        <?php } else {
        foreach ($list as $user) {
        ?>
            <div class="Admin__Account-Account-Details">
                <div class="Checkbox__Account">
                    <input type="checkbox" name="" onclick="SetRole('<?php echo $user->_id ?>')" class="checkbox" id="checkbox__account">
                </div>

                <div class="User__username"><?php echo $user->Taikhoan ?></div>

                <?php
                if (isset($user->Email)) echo "<div class='User__email' >{$user->Email}</div>";
                else echo "<div class='User__email' >Chưa Cập Nhật</div>";
                ?>

                <?php
                if ($user->Role == true) echo "<div class='User__role' >Admin</div>";
                else { ?>
                    <div class='User__role'>Khách</div>

                    <div class='User__setting'>
                        <div class='User__setting-deleteAccount' onclick="showDialogDeleteAccount('<?php echo $user->_id ?>','<?php echo $user->Role ?>')">
                            Xóa Tài Khoản
                        </div>
                    </div>
                <?php    }
                ?>
            </div>
    <?php }
        echo $paging->html();
    }
    ?>



    <div onclick="CapQuyenAdmin()" class="UpdateAll__Setting" id="UpdateAll__Setting">
        Cấp Quyền Admin
    </div>
</div>

<script type="text/javascript" src="/js/admin_account.js"> </script>
@endsection