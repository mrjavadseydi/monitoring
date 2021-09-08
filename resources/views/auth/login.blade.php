<!DOCTYPE html>
<html lang="fa">
<head>
    <title>ورود</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('loginAsset/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('loginAsset/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist/css/custom-style.css')}}">
        <!--===============================================================================================-->
    <style>
        *{
            font-family: Vazir!important;
        }
    </style>
</head>
<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">

            <form class="login100-form validate-form"  method="POST" action="{{ route('login') }}">
					<span class="login100-form-title p-b-43">
						ورود به پنل
					</span>
                @error('email')
                <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                @error('password')
                <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="email">
                    <span class="focus-input100"></span>
                    <span class="label-input100">ایمیل</span>
                </div>

@csrf
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                    <span class="label-input100">رمز عبور</span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                        <label class="label-checkbox100" for="ckb1">
                            بخاطر سپردن
                        </label>
                    </div>

{{--                    <div>--}}
{{--                        <a href="{{ route('password.request') }}" class="txt1">--}}
{{--                            فراموش کردن رمز عبور--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        ورود
                    </button>
                </div>

            </form>

            <div class="login100-more" style="background-image: url('{{asset('loginAsset/images/bg-01.jpg')}}');">
            </div>
        </div>
    </div>
</div>





<!--===============================================================================================-->
<script src="{{asset('loginAsset/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('loginAsset/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('loginAsset/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('loginAsset/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('loginAsset/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('loginAsset/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('loginAsset/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('loginAsset/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('loginAsset/js/main.js')}}"></script>

</body>
</html>
