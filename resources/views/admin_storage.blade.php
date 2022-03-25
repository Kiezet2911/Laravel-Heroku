@extends('admin')

@section('admincontent')
<div class="Admin__Storage-Header">

    <div class="Title__Product-Image">Ảnh</div>
    <div class="Title__Product-Name">Tên Sách</div>
    <div class="Title__Product-Count">Số Lượng Tồn</div>
    <div class="Title__Product-Price">Giá</div>

    <div class="Title__Setting">Thiết Lập</div>
</div>
<div class="Admin__Storage-Body">
    <?php

    if ($list == null) {
    ?>
        <div class='Cart__Products-Empty'>
            <div class='Cart__Products-Empty-image'>
                <img src='https://i.pinimg.com/originals/ec/0c/0c/ec0c0c652f7a9fb965bf08f45c4403fe.gif' alt=''>
            </div>
            <span>Hiện Không Có Hàng Tồn Nào</span>
        </div>
        <?php
    } else {
        foreach ($list as $book) {
        ?>
            <div class="Admin__Storage-Details">
                <div class="Product__Image">
                    <img src="<?php echo $book['Anh']; ?>" alt="">
                </div>
                <div class="Product__Name"><?php echo $book['Tensach']; ?></div>
                <div class="Product__Count"><?php echo $book['Soluongton']; ?></div>
                <div class="Product__Price"><?php echo $book['Giaban']; ?></div>

                <div class="Bill__Setting">
                    <div class="Bill__Setting-details" onclick="showDialogChangeDetailsProduct('<?php echo $book['id']; ?>','<?php echo $book['Giaban']; ?>',<?php echo $book['Soluongton']; ?>)">
                        Thay Đổi
                    </div>
                </div>
            </div>
    <?php }
    } ?>

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
                <li class="page-item active"><a class="page-link" href="?pages=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" href="?pages=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
        <?php }
        }
        if ($pages < $TotalPage && $TotalPage > 1) {
            echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages + 1) . '">Next</a></li>';
        }
        ?>
    </ul>


</div>
@endsection