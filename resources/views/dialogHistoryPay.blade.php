<div class="DialogDetailsHistoryPay__CloseBtn" onclick="closeDialog_HistoryPay()">
    <ion-icon name="close-circle-outline"></ion-icon>
</div>
<div class="DialogDetailsHistoryPay__infoUser">

    <h1>THÔNG TIN ĐƠN HÀNG</h1>
    <div class="DialogDetailsHistoryPay__infoUser-Details">
        <span>
            @if (isset(Session::get('UserLogin')['HoTen']))
            <span style="font-weight: bold;"> Tên KháchHàng:</span> {{Session::get('UserLogin')['HoTen']}}
            @endif
        </span>

        <span>
            <span style="font-weight: bold;">Mã Đơn Hàng:</span>{{$idBill}}
        </span>
        <span>
            <span style="font-weight: bold;">Ngày Đặt Hàng: </span> {{$dateformat }}
        </span>
        <span>
            <span style="font-weight: bold;">Tổng Tiền: </span><span style="color: red; font-weight: 600;">{{$money}}đ</span>
        </span>
        <span>
            @if($TT == 'false')
            <span style="font-weight: bold;">Tình Trạng:</span><span style="color: red; font-weight: 600;"> Chưa Giao Hàng</span>
            @else
            <span style="font-weight: bold;">Tình Trạng:</span><span style="color: rgba(12, 134, 1, 0.767); font-weight: 600;">Đã Giao Hàng</span>
            @endif
        </span>
    </div>


</div>

<div class="DialogDetailsHistoryPay__infoPay">
    <div class="DialogDetailsHistoryPay__Title-Image">Ảnh</div>
    <div class="DialogDetailsHistoryPay__Title-BookName">Tên Sách</div>
    <div class="DialogDetailsHistoryPay__Title-Count">Số Lượng</div>
    <div class="DialogDetailsHistoryPay__Title-Price">Thành Tiền</div>
</div>
@if($listCTBill !=null)
<?php foreach ($listCTBill as $item) { ?>
    <div class="DialogDetailsHistoryPay__infoPay-Details">

        <div class="DialogDetailsHistoryPay__Image">
            <img src="<?php echo $item['Anhbia'] ?>" alt="Ảnh Sách">
        </div>
        <div class="DialogDetailsHistoryPay__BookName"><?php echo $item['Tensach'] ?></div>
        <div class="DialogDetailsHistoryPay__Count"> <?php echo $item['Soluong'] ?></div>
        <div class="DialogDetailsHistoryPay__Price"><?php $money = $item['Dongia'] * $item['Soluong'];
                                                    echo number_format($money, 3, ",", "."); ?> đ</div>

    </div>
<?php } ?>
@endif