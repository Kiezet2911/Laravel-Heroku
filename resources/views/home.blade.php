@extends('layout')

@section('content')
<div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
    <!-- Start Banner -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner Banner__Container">
        <div class="carousel-item Banner active">
            <img src="{{$listBanner['Anh1']}}" class="" alt="...">
        </div>
        <div class="carousel-item Banner">
            <img src="{{$listBanner['Anh2']}}" class="" alt="...">
        </div>
        <div class="carousel-item Banner">
            <img src="{{$listBanner['Anh3']}}" class="" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> <!-- End Banner-->

<p class="Title">SÁCH BÁN CHẠY</p> <!-- Start Selling Books -->
<div id="carouselListSelling" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="Slide__Book">
                @foreach($book1 as $bk1)
                <a class="SellingBook" href="/details?id={{$bk1['id']}}">
                    <div class="ImgBook">
                        <img src="{{$bk1['Anh']}}" alt="">
                    </div>
                    <div class="BookContent">
                        <p class="BookTitle">
                            {{$bk1['Tensach']}}
                        </p>
                        <p class="Author">
                            {{$bk1['TenTG']}}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="carousel-item">
            <div class="Slide__Book">
                @foreach($book2 as $bk2)
                <a class="SellingBook" href="/details?id={{$bk2['id']}}">
                    <div class="ImgBook">
                        <img src="{{$bk2['Anh']}}" alt="">
                    </div>
                    <div class="BookContent">
                        <p class="BookTitle">
                            {{$bk2['Tensach']}}
                        </p>
                        <p class="Author">
                            {{$bk2['TenTG']}}
                        </p>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </div>
    <button class="carousel-control-prev btnCarousel" type="button" data-bs-target="#carouselListSelling" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next btnCarousel" type="button" data-bs-target="#carouselListSelling" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> <!-- End Selling Book -->

<p class="Title">SÁCH HAY</p>
<div id="carouselGoodBook" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sachhay as $sach)
        @if($active == 1)
        <div class="carousel-item active">
            <div class="Good__Book">
                <div class="Good__Book-image">
                    <img src="{{$sach['Anh']}}" alt="">
                </div>
                <div class="Good__Book-about">
                    <div class="Good__Book-header">
                        <h3>{{$sach["Tensach"]}}</h3>
                        <p>Tác Giả: {{$sach["TenTG"]}}</p>
                    </div>
                    <div class="Good__Book-body">
                        {{$sach["Mota"]}}
                    </div>
                    <div class="Good__Book-readnow" href="/details?id={{$sach['id']}}">
                        Đọc Ngay
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="carousel-item">
            <div class="Good__Book">
                <div class="Good__Book-image">
                    <img src="{{$sach['Anh']}}" alt="">
                </div>
                <div class="Good__Book-about">
                    <div class="Good__Book-header">
                        <h3>{{$sach["Tensach"]}}</h3>
                        <p>Tác Giả: {{$sach["TenTG"]}}</p>
                    </div>
                    <div class="Good__Book-body">
                        {{$sach["Mota"]}}
                    </div>
                    <a class="Good__Book-readnow" href="/details?id={{$sach['id']}}">
                        Đọc Ngay
                    </a>
                </div>
            </div>
        </div>
        @endif
        <?php $active++ ?>
        @endforeach
    </div>
    <button class="carousel-control-prev btnCarousel" type="button" data-bs-target="#carouselGoodBook" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next btnCarousel" type="button" data-bs-target="#carouselGoodBook" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span>
    </button>
</div>
@endsection