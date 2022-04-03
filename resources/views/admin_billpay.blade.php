@extends('admin')
@section('admincontent')
    <div class="Admin__HistoryPay-Header">

        <div class="Title__BillID">Mã Đơn</div>
        <div class="Title__Username">Tên Khách</div>
        <div class="Title__DatePay">Thời Gian Đặt</div>

        <div class="Title__Setting">Thiết Lập</div>
    </div>
    <div class="Admin__HistoryPay-Body">
        <?php

    use App\Http\Pagination;
    use Illuminate\Support\Facades\Http;


    $url = "https://bookingapiiiii.herokuapp.com/";
    $listcount = json_decode(Http::get($url . 'DonHang'), true);
    $config = array(
        'current_page'  => isset($_GET['pages']) ? $_GET['pages'] : 1, // Trang hiện tại
        'count'  => count($listcount), // Tổng số record
        'limit'         => 2, // limit
        'link_full'     => '?pages={page}', // Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => '/admin/bill-pay', // Link trang đầu tiên
        'range'         => 3 // Số button trang bạn muốn hiển thị 
    );

    $paging = new Pagination();

    $paging->init($config);

    $pages = $paging->_config['current_page'];

    $list = json_decode(Http::get($url . "DonHang/$pages/2"), true);
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

            <div class="Bill__BillID"><?php echo $bill['id']; ?></div>
            <div class="Bill__Username"><?php echo $bill['HoTen']; ?></div>
            <div class="Bill__DatePay"><?php echo date('j \\ F Y', strtotime($bill['Ngaydat'])); ?></div>

            <div class="Bill__Setting">
                <div class="Bill__Setting-details"
                    onclick="showDialog('<?php echo $bill['id']; ?>','<?php echo date('j \\ F Y', strtotime($bill['Ngaydat'])); ?>','<?php echo $bill['TongTien']; ?>','<?php echo $bill['Tinhtranggiaohang']; ?>')">
                    Chi
                    Tiết</div>
                <div class="Bill__Setting-status">
                    <?php if($bill['Tinhtranggiaohang'] == true){ ?>
                    <div class="Status" style="color: rgba(10, 103, 10); font-weight: 700;">
                        Đã Giao Hàng
                    </div>
                    <?php }else{ ?>
                    <select id="Setting__Status" onchange="changeStatusBill('<?php echo $bill['id']; ?>')">
                        <option selected hidden value="false">Chưa Giao</option>
                        <option value="true">Đã Giao</option>
                    </select>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php }
        echo $paging->html();
    }
    ?>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script type="text/javascript">
        function changeStatusBill(id) {
            $.ajax({
                url: "/admin/change-bill-pay/" + id,
                type: "GET",
                success: () => {
                    document.getElementsByTagName('select').selectedIndex = "0";
                    location.reload();
                }
            })
        }
    </script>
@endsection
