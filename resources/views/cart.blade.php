@extends('layout')


@section('content')
<div class="Cart__Container">
    <form>
        <h3>GIỎ HÀNG</h3>
        <?php if (session()->has('Mess')) : ?>
            <h1><?php echo session('Mess') ?></h1>
        <?php endif; ?>
        <div class="Cart__Body">
            <div class="Cart__Products">
                <div class="Cart__Products-Header">
                    <div class="Checkbox__All-Product">
                        <input type="checkbox" name="" class="checkbox" id="checkbox__all-product" onclick="onCheckAll()">
                    </div>
                    <span>Chọn tất cả (1 sản phẩm)</span>
                    <div class="Title__Count">Số lượng</div>
                    <div class="Title__Price">Giá</div>
                    <div style="flex-basis: 5%;"></div>
                </div>
                <?php
                if ($listCart == null || $listCart == [] || !isset($listCart)) {
                    echo "  
                        <div class='Cart__Products-Empty'>
                            <div class='Cart__Products-Empty-image'>
                                <img src='https://i.pinimg.com/originals/ec/0c/0c/ec0c0c652f7a9fb965bf08f45c4403fe.gif' alt=''>
                            </div>
                            <span>Bạn hiện chưa chọn sách nào</span>
                        </div>
                        ";
                } else {
                ?>
                    <?php
                    foreach ($listCart as $item) {
                    ?>
                        <div class="Cart__Products-Body">
                            <div class="Cart__Products-item">
                                <div class="checkbox__product">
                                    <input type="checkbox" name="" class="checkbox" id="checkbox__product">
                                </div>
                                <div class="imgbook">
                                    <img src="<?php echo $item['image']; ?>" class="Img__Book" alt="">
                                </div>
                                <a class="Cart__Products-BookName">
                                    <?php echo $item['name']; ?>
                                </a>
                                <div class="Cart__Products-group-product-info">
                                    <div class="Cart__Products-Count">
                                        <div class="Cart__Products-Button">
                                            <a href="/minusCountItem?id=<?php echo $item['id']; ?>">
                                                <img src="https://frontend.tikicdn.com/_desktop-next/static/img/pdp_revamp_v2/icons-remove.svg" alt="remove-icon" width="20" height="20">
                                            </a>
                                            <input id="inputNum" type="text" value="<?php echo $item['count']; ?>" placeholder="<?php echo $item['count']; ?>" class="input" name="cartInput">
                                            <a href="/plusCountItem?id=<?php echo $item['id']; ?>">
                                                <img src="https://frontend.tikicdn.com/_desktop-next/static/img/pdp_revamp_v2/icons-add.svg" alt="add-icon" width="20" height="20">
                                            </a>
                                        </div>
                                    </div>
                                    <span class="Cart__Products-group-product-info-price"><?php echo number_format($item['price'] * $item['count'],  3, ",", "."); ?>đ</span>
                                    <a class="btnDeleteItem" href="/CreateCart?deleteid=<?php echo $item['id']; ?>">
                                        <ion-icon id="btn-del" name="trash-outline"></ion-icon>
                                    </a>
                                </div>
                            </div>

                        </div>
                <?php }
                } ?>
                <a class="Cart__Products-Footer" href="/CreateCart?deleteAll" id="deleteAll">
                    Xóa Tất Cả
                </a>
            </div>
            <div class="Cart__Bill">
                <form action="" method="get">
                    <h2>HÓA ĐƠN</h2>
                    <div class="Cart__Bill-Info">
                        <span class="Cart__Bill-Info-Name">
                            Tên:
                            @if (isset($data['HoTen']))
                            {{ $data['HoTen'] }}
                            @endif
                        </span>
                        <span class="Cart__Bill-Info-Email">
                            Email:
                            @if (isset($data['Email']))
                            {{ $data['Email'] }}
                            @endif
                        </span>
                        <span class="Cart__Bill-Info-Phone">
                            SDT:
                            @if (isset($data['DienthoaiKH']))
                            {{ $data['DienthoaiKH'] }}
                            @endif
                        </span>
                        <span class="Cart__Bill-Info-Date">
                            Ngày Giao Dịch:
                            <?php
                            $date = date('Y-m-d H:i:s');
                            echo $date;
                            ?>
                        </span>
                    </div>
                    <div class="Cart__Bill-Pay">
                        <div class="Cart__Bill-Pay-Price">
                            Tổng <span class="cart-total-price">

                                <?php
                                $totalPrice = 0;

                                foreach ($listCart as $item) {
                                    $totalPrice += $item['price'] * $item['count'];
                                }
                                echo number_format($totalPrice, 3, ",", ".") . 'đ';
                                ?>
                            </span>
                        </div>
                        <a class="Cart__Bill-Pay-BtnPay" href="/CreateCart?pay">
                            Thanh Toán
                        </a>
                </form>
            </div>
    </form>
</div>
</div>
</div>
@endsection