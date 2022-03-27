@extends('layout')

@section('content')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="{{url('signin')}}" method="POST">
                @csrf
                <span class="login100-form-title p-b-43">
                    <ion-icon name="book-outline"></ion-icon>Mbook
                </span>
                <?php if (isset($mess)) : ?>
                    <h1>{{ $mess }}</h1>
                <?php endif; ?>
                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="username" required>
                    <span class="focus-input100"></span>
                    <span class="label-input100">Tên Tài Khoản</span>
                </div>


                <div class="wrap-input100 validate-input">
                    <input class="input100" type="password" name="pass" required>
                    <span class="focus-input100"></span>
                    <span class="label-input100">Mật Khẩu</span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection