@extends('layout')

@section('content')
<?php if (isset($mess)) : ?>
    <h1>{{$mess}}</h1>
<?php else : ?>
    <h1>{{Session::get('mess')}}</h1>
<?php endif;
$ID = Session()->get('UserLogin')['id']; ?>
<section class="py-5 my-5">
    <div class="container">
        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
                <div class="p-4">
                    <div class="img-circle text-center mb-3">
                        @if(isset($data['HoTen']))
                        <img id="Anh" src="{{$data['Anh']}}" alt="Image" class="shadow">
                        @else
                        <img id="Anh" src="#" alt="Image" class="shadow">
                        @endif
                    </div>
                    @if(isset($data['HoTen']))
                    <h4 class="text-center">{{$data['HoTen']}}</h4>
                    @endif
                    <input type="file" onchange="loadimg(event)" name="image" accept="image/*">
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                        <i class="fa fa-home text-center mr-1"></i>
                        Cập Nhật Tài Khoản
                    </a>
                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                        <i class="fa fa-key text-center mr-1"></i>
                        Đổi Mật Khẩu
                    </a>
                </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <form id="Profile" enctype="multipart/form-data">
                        <h3 class="mb-4">Account Settings</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Họ Và Tên</label>
                                    @if(isset($data['HoTen']))
                                    <input type="text" class="form-control" id="ten" required value="{{$data['HoTen']}}">
                                    @else
                                    <input type="text" class="form-control" id="ten" required>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    @if(isset($data['Email']))
                                    <input type="email" class="form-control" id="mail" value="{{$data['Email']}}" required>
                                    @else
                                    <input type="text" class="form-control" id="mail" required>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Địa Chỉ</label>
                                    @if(isset($data['DiachiKH']))
                                    <input type="text" class="form-control" id="diachi" value="{{$data['DiachiKH']}}" required>
                                    @else
                                    <input type="text" class="form-control" id="diachi" required>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số Điện Thoại (nhập đủ 10 số) </label>
                                    @if(isset($data['DienthoaiKH']))
                                    <input type="tel" class="form-control" id="sdt" value="{{$data['DienthoaiKH']}}" pattern="[0-9]{10}" required>
                                    @else
                                    <input type="text" class="form-control" id="sdt" required>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày Sinh</label>
                                    @if(isset($data['Ngaysinh']))
                                    <input type="date" class="form-control" id="date" value="{{$data['Ngaysinh']}}" required>
                                    @else
                                    <input type="date" class="form-control" id="date" required>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <h3 class="mb-4">Password Settings</h3>
                    <form id="changepass" method="post">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mật Khẩu Hiện Tại</label>
                                    <input type="password" id="oldpass" class="form-control" required>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mật Khẩu Mới</label>
                                    <input type="password" id="newpass" class="form-control" minlength="6" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Xác Nhận Mật Khẩu</label>
                                    <input type="password" id="compass" class="form-control" minlength="6" required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary">Đổi Mật Khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    let imgchoose;
    loadimg = function(event) {
        const anh = document.getElementById('Anh');
        anh.src = URL.createObjectURL(event.target.files[0]);
        imgchoose = event.target
    }
    var idUser = '<?php echo $ID; ?>';  
</script>
<script src="/js/profile.js"></script>
@endsection