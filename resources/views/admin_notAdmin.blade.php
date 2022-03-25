@extends('admin')

@section('admincontent')
    <div class="NotAdminPage__Container">
        <div class="NotAdminPage__Container-Image">
            <img src="https://c.tenor.com/aiyNkzmKPwEAAAAC/meong_cat.gif" alt="">
        </div>
        <div class="NotAdminPage__Container-Announce">
            <div class="NotAdminPage__Container-Announce-Content">
                Bạn Không Thể Truy Cập! <br>
                Vui Lòng Quay Về Trang Chủ
            </div>
            <a class="NotAdminPage__Container-Announce-BtnBack" href="/">
                Trang Chủ
            </a>
        </div>
    </div>
@endsection