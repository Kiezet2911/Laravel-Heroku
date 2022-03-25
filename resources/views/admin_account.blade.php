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

    if (!array_key_exists('data', $list)) {
    ?>
        <div class='Admin__Account-Empty'>
            <div class='Admin__Account-Empty-image'>
                <img src='https://i.pinimg.com/originals/ec/0c/0c/ec0c0c652f7a9fb965bf08f45c4403fe.gif' alt=''>
            </div>
            <span>Hiện Không Có Tài Khoản Nào Được Đăng Ký</span>
        </div>
        <?php
    } else {
        $total = $list['count'];

        foreach ($list['data'] as $user) {

        ?>
            <div class="Admin__Account-Account-Details">
                <div class="Checkbox__Account">
                    <input type="checkbox" name="" onclick="SetRole('<?php echo $user['_id'] ?>')" class="checkbox" id="checkbox__account">
                </div>

                <div class="User__username"><?php echo $user['Taikhoan'] ?></div>

                <?php
                if (isset($user['Email'])) echo "<div class='User__email' >{$user['Email']}</div>";
                else echo "<div class='User__email' >Chưa Cập Nhật</div>";
                ?>

                <?php
                if ($user['Role'] == true) echo "<div class='User__role' >Admin</div>";
                else { ?>
                    <div class='User__role'>Khách</div>

                    <div class='User__setting'>
                        <div class='User__setting-deleteAccount' onclick="showDialogDeleteAccount('<?php echo $user['_id'] ?>','<?php echo $user['Role'] ?>')">
                            Xóa Tài Khoản
                        </div>
                    </div>
                <?php    }
                ?>
            </div>
        <?php }
        ?>
        <ul class="pagination" id="pagination">
            <?php
            $TotalPage = ceil($total / $last);

            if ($pages > 1 && $TotalPage > 1) {
                echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages - 1) . '">Prev</a></li>';
            }
            //Lap so pages
            for ($i = 1; $i <= $TotalPage; $i++) {
                if ($pages == $i) {
            ?>
                    <li class="page-item active"><a class="page-link" href="?pages=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                } else {
                ?>
                    <li class="page-item"><a class="page-link" href="?pages=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php }
            }

            if ($pages < $TotalPage && $TotalPage > 1) {
                echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages + 1) . '">Next</a></li>';
            }
            ?>

        </ul>
    <?php
    } ?>



    <div onclick="CapQuyenAdmin()" class="UpdateAll__Setting">
        Cấp Quyền Admin
    </div>
</div>

<script type="text/javascript" src="/js/admin_account.js"> </script>
@endsection