@extends('layout')

@section('content')
<div class="Product__Container">
    <div class="Product__ListCategory">
        <h6>THỂ LOẠI SẢN PHẨM</h6>
        <ul>
            @foreach ($chude as $chude)
            <li><a href="?chude={{$chude['_id']}}">{{$chude["TenChuDe"]}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="Product__ListProduct">
        <form action="{{url('products')}}" method="GET">
            <div class="Product__ListProduct-Sort">
                <input type="text" name="search" class="form-control" placeholder="Search..." />
                <div class="Product__ListProduct-SortArea">
                    <h5>Sắp xếp theo:</h5>
                    <select name="sort" class="form-select" aria-label="-- Loại Sắp Xếp --">
                        <option value="increase" selected>Giá Tăng Dần</option>
                        <option value="decrease">Giá Giảm Dần</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="Product__List" style="float: left;">
            <?php

            use App\Http\PaginationAPI;


            $api =   "PhanTrang";
            $body = '';
            $link_full = '?pages={page}';
            $link_first = '/products';
            //
            if (isset($_GET["chude"])) {
                //
                $api =   "PhanTrangChuDe/" . $_GET["chude"];
                $link_full = '?pages={page}&chude=' . $_GET["chude"];
                $link_first = '/products?chude=' . $_GET["chude"];
                //
            } elseif (isset($_GET["search"]) && $_GET["search"] != null) {
                //
                $api = "PhanTrangSearch";
                $body =  $_GET["search"];
                $link_full = '?pages={page}&search=' . $_GET["search"];
                $link_first = '/products?search=' . $_GET["search"];
            }

            //Lấy Danh Sách Sản Phẩm
            $config = array(
                'api'  => $api,
                'body'  => $body,
                'current_page'  => isset($_GET['pages']) ? $_GET['pages'] : 1, // Trang hiện tại          
                'limit'         => 8, // limit
                'link_full'     => $link_full, // Link full có dạng như sau: domain/com/page/{page}
                'link_first'    => $link_first, // Link trang đầu tiên
                'range'         => 3 // Số button trang bạn muốn hiển thị 
            );

            $paging = new PaginationAPI();

            $paging->init($config);

            $list = $paging->Getlist();

            if ($list == null) {
                echo "  
                <div class='Cart__Products-Empty'>
                    <div class='Cart__Products-Empty-image'>
                        <img src='https://i.pinimg.com/originals/ec/0c/0c/ec0c0c652f7a9fb965bf08f45c4403fe.gif' alt=''>
                    </div>
                    <span>Not Found</span>
                </div>
                ";
            } else {
                foreach ($list as $data) {

            ?>
                    <a class="Book" href="/details?id={{$data->id}}">
                        <div class="Book__Img">
                            <img src="<?php echo $data->Anh ?>" alt="">
                        </div>
                        <div class="Book__Content">
                            <div class="Book__Content-BookName">
                                <h3><?php echo $data->Tensach ?></h3>
                                <p class="Book__Content-Author"><?php echo $data->TenTG ?></p>
                                <p class="Book__Content-Price"><?php echo number_format($data->Giaban, 3, ",", ".") ?>đ</p>
                            </div>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </div>
        <?php    echo $paging->html(); ?>
    </div>
</div>
@endsection