<x-guest-layout>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap.min.css') }} " rel="stylesheet">
    <div class="content-wrapper">
        <div class="content">
            <div class="signup-wrapper shadow-box">
                <div class="company-details ">
                    <div class="shadow"></div>
                    <div class="wrapper-1">
                        <a href="{{ route('index') }}">
                            <div class="logo">
                                <div class="icon-job">
                                </div>
                            </div>
                        </a>
                        <h1 class="title">Find Job</h1>
                        <div class="slogan">Con đường dẫn tới nhiều tiền</div>
                    </div>
                </div>
                <div class="signup-form ">
                    <div class="wrapper-2">
                        <div class="form-title">Đăng ký</div>
                        <div class="form">
                            <form method="post" action="" role="form">
                                @csrf
                                <!-- Name -->
                                <p class="content-item">
                                    <label for="name">Tên Của Bạn
                                        <input id="name" class="block w-full" type="text" name="full_name" />
                                    </label>
                                    @if($errors->has('full_name'))
                                <p style="color:red"> {{$errors->first('full_name') }} !!!</p>
                                @endif
                                </p>

                                <!-- Email Address -->
                                <p class="content-item">
                                    <label for="email">Địa Chỉ Email
                                        <input id="email" class="block w-full" type="text" name="email" />
                                        @if($errors->has('email'))
                                        <p style="color:red"> {{$errors->first('email') }} !!!</p>
                                        @endif
                                    </label>

                                </p>

                                <!-- Password -->
                                <p class="content-item">
                                    <label for="password">Mật Khẩu
                                        <input id="password" class="block w-full" type="password" name="password" />
                                    </label>
                                    @if($errors->has('password'))
                                <p style="color:red"> {{$errors->first('password') }} !!!</p>
                                @endif
                                </p>

                                <!-- Confirm Password -->
                                <p class="content-item">
                                    <label for="confirm_password">Nhập Lại Mật Khẩu
                                        <input id="confirm_password" class="block w-full" type="password" name="confirm_password" />
                                    </label>
                                    @if($errors->has('confirm_password'))
                                <p style="color:red"> {{$errors->first('confirm_password') }} !!!</p>
                                @endif
                                </p>

                                <!-- Phone -->
                                <p class="content-item">
                                    <label for="phone">Số điện thoại
                                        <input id="phone" class="block w-full" type="text" name="phone" />
                                    </label>
                                    @if($errors->has('phone'))
                                <p style="color:red"> {{$errors->first('phone') }} !!!</p>
                                @endif
                                </p>

                                <!-- Address -->
                                <p class="content-item">
                                    <label for="address">Địa chỉ
                                        <input id="address" class="block w-full" type="text" name="address" />
                                    </label>
                                </p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Người tìm việc
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Nhà tuyển dụng
                                    </label>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}"></a>
                                    <button type="submit" class="signup">Đăng ký</button>
                                    <a href="{{route('login')}}" class="login">Đăng nhập</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
</x-guest-layout>