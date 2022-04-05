@extends('layout')

@section('content')

<body>
    <div class="Details__container">
        <?php
        foreach ($bookdetails as $bk) {
        ?>
            <div class="Book__details">
                <div class="Book__image">
                    <img src="<?php echo $bk['Anh']; ?>" alt="">
                </div>
                <div class="Book__info">
                    <div class="Book__info-Name">
                        <?php echo $bk['Tensach']; ?>
                    </div>
                    <div class="Book__info-Author">
                        <span>Tác giả: <b><?php echo $bk['TenTG']; ?></b> </span>
                    </div>
                    <div class="Book__info-Publishing-company">
                        <span>Nhà xuất bản: <b><?php echo $bk['TenNXB']; ?></b> </span>
                    </div>
                    <div class="Book__info-Publishing-company">
                        <span>Thể Loại: <b><?php
                                            $count = count($bk['ChuDe']);
                                            foreach ($bk['ChuDe'] as $chude) {
                                                if (count($bk['ChuDe']) == 1) {
                                                    echo $chude;
                                                } else if ($chude === $bk['ChuDe'][$count - 1]) {
                                                    echo $chude;
                                                } else {
                                                    echo $chude . ', ';
                                                }
                                            } ?></b> </span>
                    </div>
                    <div class="Book__info-Price">
                        <b class="price"><?php echo number_format($bk['Giaban'], 3, '.', ''); ?>đ</b>
                    </div>
                    <div class="Book__info-Pay">
                        <b>Số Lượng:</b>
                        <div class="Book__info-Count">
                            <div class="Book__info-Button">
                                <button onclick="lessProducts()">
                                    <img src="https://frontend.tikicdn.com/_desktop-next/static/img/pdp_revamp_v2/icons-remove.svg" alt="remove-icon" width="20" height="20">
                                </button>
                                <input type="text" id="inputNum" value="1" placeholder="1" class="input" name="detailInput">
                                <button onclick="moreProducts()">
                                    <img src="https://frontend.tikicdn.com/_desktop-next/static/img/pdp_revamp_v2/icons-add.svg" alt="add-icon" width="20" height="20">
                                </button>
                            </div>
                        </div>
                        <a class="Book__info-btnCart" href="/CreateCart?id=<?php echo $bk['id']; ?>&name=<?php echo $bk['Tensach']; ?>&image=<?php echo $bk['Anh']; ?>&price=<?php echo number_format($bk['Giaban'], 3, '.', ''); ?>">
                            <span>Chọn Mua</span>
                        </a>
                    </div>
                </div>
                <div class="Book__info-About">
                    <h3>Thông Tin Sản Phẩm:</h3>
                    <span>
                        <?php echo $bk['Mota']; ?>
                    </span>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
@endsection