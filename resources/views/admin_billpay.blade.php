@extends('admin')
@section('admincontent')
<div class="Admin__HistoryPay-Header">

    <div class="Title__BillID">Mã Đơn</div>
    <div class="Title__Username">Tên Khách</div>
    <div class="Title__role">Thời Gian Đặt</div>

    <div class="Title__Setting">Thiết Lập</div>
</div>
<div class="Admin__HistoryPay-Body">
    <?php

    if ($list == null) {
    ?>
        <div class='Cart__Products-Empty'>
            <div class='Cart__Products-Empty-image'>
                <img src='https://i.pinimg.com/originals/ec/0c/0c/ec0c0c652f7a9fb965bf08f45c4403fe.gif' alt=''>
            </div>
            <span>Hiện Chưa Có Đơn Hàng Nào Được Đặt</span>
        </div>
        <?php
    } else {
        foreach ($list as $bill) {
        ?>
            <div class="Admin__HistoryPay-Details">

                <div class="Bill__BillID"><?php echo $bill['id'] ?></div>
                <div class="Bill__Username"><?php echo $bill['HoTen'] ?></div>
                <div class="Bill__DatePay"><?php echo date('j \\ F Y', strtotime($bill['Ngaydat'])) ?></div>

                <div class="Bill__Setting">
                    <div class="Bill__Setting-details" onclick="showDialog('<?php echo $bill['id'] ?>','<?php echo date('j \\ F Y', strtotime($bill['Ngaydat'])) ?>','<?php echo $bill['TongTien'] ?>','<?php echo $bill['Tinhtranggiaohang'] ?>')">Chi
                        Tiết</div>
                </div>
            </div>
    <?php }
    }
    ?>

    <ul class="pagination" id="pagination">
        <?php
        //Button Number pages
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

</div>
@endsection