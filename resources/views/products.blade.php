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
                    <select class="form-select" aria-label="-- Loại Sắp Xếp --">
                        <option selected>Giá Tăng Dần</option>
                        <option value="1">Giá Giảm Dần</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="Product__List" style="float: left;">
            <?php

            use App\Http\Controllers\WebController;

            $last = 8;
            $pages = 1;

            if (isset($_GET["pages"])) {
                $pages = $_GET["pages"];
            }
            //Lấy Danh Sách Sản Phẩm
            $list = WebController::getlist($pages, $last);

            if (!array_key_exists('count', $list)) {
            ?>
                <h4><?php echo 'Không Có Sách Này' ?></h4>
        </div>
        <?php
            } else {
                $total = $list['count'];
                foreach ($list['data'] as $data) {
                    if (isset($data["Messager"])) {

        ?>
                <h4><?php echo $data["Messager"] ?></h4>
            <?php
                    } else {
            ?>
                <a class="Book" href="/details?id={{$data['id']}}">
                    <div class="Book__Img">
                        <img src="<?php echo $data["Anh"] ?>" alt="">
                    </div>
                    <div class="Book__Content">
                        <div class="Book__Content-BookName">
                            <h3><?php echo $data["Tensach"] ?></h3>
                            <p class="Book__Content-Author"><?php echo $data["TenTG"] ?></p>
                            <p class="Book__Content-Price"><?php echo number_format($data["Giaban"], 3, '.', '') ?>đ</p>
                        </div>
                    </div>
                </a>
        <?php
                    }
                } ?>
    </div>

    <ul class="pagination" id="pagination">
        <?php
                $TotalPage = ceil($total / $last);

                if ($pages > 1 && $TotalPage > 1) {
                    if (isset($_GET["chude"])) {
                        echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages - 1) . '&chude=' . $_GET["chude"] . '">Prev</a></li>';
                    } elseif (isset($_GET["search"])) {
                        echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages - 1) . '&chude=' . $_GET["search"] . '">Prev</a></li>';
                    } else {
                        echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages - 1) . '">Prev</a></li>';
                    }
                }
                //Lap so pages
                for ($i = 1; $i <= $TotalPage; $i++) {

                    if (isset($_GET["chude"])) {

                        if ($pages == $i) {
        ?>
                    <li class="page-item active"><a class="page-link" href="?pages=<?php echo $i ?>&chude=<?php echo $_GET["chude"] ?>"><?php echo $i ?></a></li>
                <?php
                        } else {
                ?>
                    <li class="page-item"><a class="page-link" href="?pages=<?php echo $i ?>&chude=<?php echo $_GET["chude"] ?>"><?php echo $i ?></a></li>
                <?php
                        }
                    } elseif (isset($_GET["search"])) {
                        if ($pages == $i) {
                ?>
                    <li class="page-item active"><a class="page-link" href="?pages=<?php echo $i ?>&search=<?php echo $_GET["search"] ?>"><?php echo $i ?></a></li>
                <?php
                        } else {
                ?>
                    <li class="page-item"><a class="page-link" href="?pages=<?php echo $i ?>&search=<?php echo $_GET["search"] ?>"><?php echo $i ?></a></li>
                <?php
                        }
                    } else {
                        if ($pages == $i) {
                ?>
                    <li class="page-item active"><a class="page-link" href="?pages=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php
                        } else {
                ?>
                    <li class="page-item"><a class="page-link" href="?pages=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php }
                    }
                }

                if ($pages < $TotalPage && $TotalPage > 1) {
                    if (isset($_GET["chude"])) {
                        echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages + 1) . '&chude=' . $_GET["chude"] . '">Next</a></li>';
                    } elseif (isset($_GET["search"])) {
                        echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages + 1) . '&chude=' . $_GET["search"] . '">Next</a></li>';
                    } else {
                        echo '  <li class="page-item"><a class="page-link" href="?pages=' . ($pages + 1) . '">Next</a></li>';
                    }
                }
            }
    ?>
    </ul>


</div>
</div>
@endsection