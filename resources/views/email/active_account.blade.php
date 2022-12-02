<h2>Xin chào {{ $customer->name }}</h2>
<p>
    <b>Delicious xin cảm ơn quý khách!!! Bạn đã đăng kí tài khoản thành công tại cửa hàng của chúng tôi</b>
</p>
<h4>Để sử dụng tài khoản được cho các dịch vụ vui lòng ấn vào nút kích hoạt bên dưới</h4>
<p>
    <a href="{{ route('customer.active',['customer'=> $customer->id,'token' => $customer->token]) }} " 
    style="display: inline-block; background:green;color: #fff; padding: 7px 25px; font-weight:bold">Kích hoạt tài khoản</a>
</p>