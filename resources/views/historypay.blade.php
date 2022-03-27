@extends('layout')

@section('content')
<div class="DialogDetailsHistoryPay__Container" id="DialogDetailsHistoryPay__Container">
    <div class="DialogDetailsHistoryPay">


    </div>
</div>

<div class="HistoryPay__Container">
    <h1>Lịch sử mua hàng</h1>
    <div class="HistoryPay__Header">

        <div class="HistoryPay__Title-BillID">Mã Đơn</div>
        <div class="HistoryPay__Title-Status">Trạng Thái</div>
        <div class="HistoryPay__Title-DatePay">Thời Gian Đặt</div>

        <div class="HistoryPay__Title-Setting">Thiết Lập</div>
    </div>
    <div class="HistoryPay__Body">
        <?php
        if ($listHistoryPay == null) {
        ?>
            <div class='Cart__Products-Empty'>
                <div class='Cart__Products-Empty-image'>
                    <img src='https://i.pinimg.com/originals/ec/0c/0c/ec0c0c652f7a9fb965bf08f45c4403fe.gif' alt=''>
                </div>
                <span>Hiện Chưa Có Đơn Hàng Nào Được Đặt</span>
            </div>
            <?php
        } else {


            foreach ($listHistoryPay as $data) {   ?>
                <div class="HistoryPay__Details">

                    <div class="HistoryPay__Bill-BillID"><?php echo $data->_id; ?></div>
                    <?php if ($data->Dathanhtoan == true) { ?>

                        <?php if ($data->Tinhtranggiaohang == true) { ?>
                            <div class="HistoryPay__Bill-Status" style="color: rgb(50, 238, 50)">Đã Giao Hàng</div>
                        <?php } else { ?>
                            <div class="HistoryPay__Bill-Status" style="color: red">Chưa Giao Hàng</div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="HistoryPay__Bill-Status" style="color: red">Chưa Thanh Toán</div>
                    <?php } ?>

                    <div class="HistoryPay__Bill-DatePay"><?php echo  date('j \\ F Y', strtotime($data->Ngaydat)); ?></div>

                    <div class="HistoryPay__Bill-Setting">
                        <div class="HistoryPay__Bill-Setting-details" onclick="showDialog_HistoryPay('<?php echo $data->_id; ?>','<?php echo $data->Ngaydat; ?>','<?php echo $data->TongTien; ?>','<?php echo $data->Tinhtranggiaohang; ?>')">Chi Tiết</div>
                    </div>

                </div>

            <?php }
            ?>
            <ul class="pagination" id="pagination">
                <?php

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

    </div>
</div>


@endsection