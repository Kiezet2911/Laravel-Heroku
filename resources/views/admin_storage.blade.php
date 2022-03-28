@extends('admin')

@section('admincontent')
<div class="Admin__Storage-Header">

    <div class="Title__Product-Image">Ảnh</div>
    <div class="Title__Product-Name">Tên Sách</div>
    <div class="Title__Product-Count">Còn</div>
    <div class="Title__Product-Price">Giá</div>

    <div class="Title__Setting">Thiết Lập</div>
</div>
<div class="Admin__Storage-Body">
    <?php

    use App\Http\Pagination;
    use Illuminate\Support\Facades\Http;

    $url = "https://bookingapiiiii.herokuapp.com/";

    $listcount = json_decode(Http::get($url . 'sach'), true);
    $config = array(
        'current_page'  => isset($_GET['pages']) ? $_GET['pages'] : 1, // Trang hiện tại
        'count'  => count($listcount), // Tổng số record
        'limit'         => 2, // limit
        'link_full'     => '?pages={page}', // Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => '/admin/storage-products', // Link trang đầu tiên
        'range'         => 3 // Số button trang bạn muốn hiển thị 
    );

    $paging = new Pagination();

    $paging->init($config);

    $pages = $paging->_config['current_page'];

    $list = json_decode(Http::get($url . "sachpagination/$pages/2"), true);

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
        echo $paging->html();
    } ?>


</div>
@endsection