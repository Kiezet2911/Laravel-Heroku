<div class="DialogDetailsPay__CloseBtn" onclick="closeDialog()">
    <ion-icon name="close-circle-outline"></ion-icon>
</div>
<div class="DialogDetailsPay__infoUser">
    <h1>THÔNG TIN ĐƠN HÀNG</h1>
    <div class="DialogDetailsPay__infoUser-Details">
        <span>
            @if (isset(Session::get('UserLogin')['HoTen']))
            <span style="font-weight: bold;">Tên Khách Hàng: </span><span></span> {{Session::get('UserLogin')['HoTen']}}
            @endif
        </span>
        <span>
            <span style="font-weight: bold;">Mã Đơn Hàng: </span><span></span>{{$idBill}}
        </span>
        <span>
            <span style="font-weight: bold;">Ngày Đặt: </span><span style="font-weight: bold;">{{$date}}</span>
        </span>
        <span>
            <span style="font-weight: bold;">Tổng Tiền: </span><span style="color: red; font-weight: 600;">{{$money}}</span>đ
        </span>
        <span>
            @if($TT == 'true')
            <span style="font-weight: bold;">Tình Trạng: </span> <span style="color: green; font-weight: bold;">Đã Giao Hàng</span>
            @else
            <span style="font-weight: bold;">Tình Trạng: </span> <span style="color: green; font-weight: bold;">Chưa Giao Hàng </span>
            @endif
        </span>
    </div>
</div>
<div class="DialogDetailsPay__infoPay">
    <div class="DialogDetailsPay__Title-Image">Ảnh</div>
    <div class="DialogDetailsPay__Title-BookName">Tên Sách</div>
    <div class="DialogDetailsPay__Title-Count">Số Lượng</div>
    <div class="DialogDetailsPay__Title-Price">Thành Tiền</div>
</div>

@if($listCTBill !=null)
@foreach($listCTBill as $item)
<div class="DialogDetailsPay__infoPay-Details">
    <div class="DialogDetailsPay__Image">
        <img id="Anh" src="{{$item['Anhbia']}}" alt="#">
    </div>
    <div id="Tensach" class="DialogDetailsPay__BookName">
        {{$item['Tensach']}}
    </div>
    <div id="Soluong" class="DialogDetailsPay__Count">
        {{$item['Soluong']}}
    </div>
    <div id="Dongia" class="DialogDetailsPay__Price">
        {{$item['Dongia']}}
    </div>
</div>
@endforeach
@else
<p>Lỗi</p>
@endif