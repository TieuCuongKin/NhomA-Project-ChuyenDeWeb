<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\PostJob;
use Facade\FlareClient\View;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Location;
use App\Models\WishList;
use App\Models\Comment;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class MyController extends Controller
{
  
  
  //Wish view:
  public function wishView()
  {
    $wishList = WishList::where('customer_id', Auth::guard('cus')->user()->id)->get();

    return view('wishlist', ['wishlist' => $wishList]);
  }

  //Thêm vào ds yêu thích
  public function addToWish($jobID)
  {
    if (Auth::guard('cus')->check()) {
      $wishPresent = WishList::where('customer_id', Auth::guard('cus')->user()->id)->where('post_job_id', $jobID)->get();
      if ($wishPresent->count() == 0) {
        $wishList = new WishList;
        $wishList->customer_id = Auth::guard('cus')->user()->id;
        $wishList->product_id = $jobID;
        $wishList->save();
        return back()->with('success', 'Thêm vào wish list thành công');
      } else {
        return back()->with('error', 'Sản phẩm này đã có trong wish list của bạn');
      }
    }
    return redirect()->route('login')->with('error', 'Vui lòng đăng nhập');;
  }

  // Xóa khỏi danh sách yêu thích
  public function removeToWish($jobID)
  {
    WishList::where('customer_id', Auth::guard('cus')->user()->id)->where('post_job_id', $jobID)->delete();
    return back();
  }

  //contact
  public function contact()
  {
    return view('contact');
  }
  //mail
  //Gửi contact:
  function mail(Request $request)
  {
    Mail::send('email.contact', [
      'name' => $request->name,
      'content' => $request->content,
      'email' => $request->email,
    ], function ($mail) use ($request) {
      $mail->to('ntm748664@gmail.com', $request->name);
      $mail->from($request->email);
      $mail->subject($request->subject);
    });
    return redirect()->route('contact')->with('success', 'Gửi mail thành công');
  }

  //hien thi chi tiet san pham
  function chitietsp($id)
  {
    $modal = PostJob::find($id);
    $comment = Comment::with('customer')->Where('post_job_id',$id)->orderBy('id','DESC')->get();
    $sosao = Comment::where('post_job_id',$id)->avg('rating');
    $sosao = round($sosao);
    return view('jobdetail', [
      'jobdetail' => $modal,
      'comments'=>$comment,
      'sosao' => $sosao,

    ]);
  }
  //tim kiem
  public function getSearch(Request $req)
  {
    $postjob = PostJob::where('job_title', 'like', '%' . $req->key . '%')->orWhere('job_description', $req->key)->get();
    return view('search', compact('postjob'));
  }

 //Gửi contact:
 function post_contact(Request $request){
  Mail::send('email.contact',[
      'name' => $request->name,
      'content' => $request->content,
      'email' => $request->email,
  ],function($mail) use($request){
      $mail->to('ntmpphuong990@gmail.com',$request->name);
      $mail->from($request->email);
      $mail->subject($request->subject);
  });
  return redirect()->route('contact')->with('success','Gửi mail thành công');
}
  //Cập nhật thông tin cá nhân
  public function update_Profile(Request $request)
  {
    $this->validate($request, [
      'full_name' => 'required',
      'phone' => 'required',
      'address' => 'required',
    ], [
      'full_name.required' => 'Tên người dùng không được để trống',
      'address.required' => 'Địa chỉ không được để trống',
      'phone.required' => 'Số điện thoại không được để trống',
    ]);
    $request->offsetUnset('_token');
    Customer::where(['id' => Auth::guard('cus')->user()->id])->update($request->all());
    return back()->with('success', 'Sửa thông tin thành công');
  }

  //Thoát
  public function logout()
  {
    Auth::guard('cus')->logout();
    return redirect()->route('index');
  }

  //Hiển thị trang Đăng nhập
  public function login()
  {
    return view('login');
  }

  //Kiểm tra và tiến hành đăng nhập
  public function post_login(Request $req)
  {
    $this->validate($req, [
      'email' => 'required',
      'password' => 'required',
    ], [
      'email.required' => 'Vui lòng nhập địa chỉ email',
      'password.required' => 'Vui lòng nhập mật khẩu'
    ]);

    if (Auth::guard('cus')->attempt($req->only('email', 'password'))) {

      return redirect()->route('index');
    } else {
      return redirect()->back()->with('error', 'Sai email hoặc password');
    }
  }

  //Đăng kí tài khoản
  public function register()
  {
    return view('register');
  }


    //Kiểm tra và tiến hành tạo tài khoản và gửi email yêu cầu xác nhận
    public function post_register(Request $request){
      $this->validate($request,[
          'customer_name' => 'required',
          'email' => 'required|email|unique:customer,email',
          'password' => 'required',
          'confirm_password' => 'required|same:password',
      ],[
          'customer_name.required' => 'Tên người dùng không được để trống',
          'email.required' => 'Email không được để trống',
          'email.unique' => 'Email đã được sử dụng',
          'email.email' => 'Email phải đúng định dạng',
          'password.required' => 'Mật khẩu không được để trống',
          'confirm_password.required' => 'Xác nhận mật khẩu không được để trống',
          'confirm_password.same' => 'Nhập lại mật khẩu không chính xác'

      ]);
      $token = strtoupper( random_int(1000000000,9999999999));
      $password_h = bcrypt($request->password);
      $data = $request->only('customer_name','email','password','phone','address');
      $data['password'] = $password_h;
      $data['token'] = $token;   
      if($customer = Customer::create($data)){
          Mail::send('email.active_account',compact('customer'),
              function($mail) use ($customer){
                  $mail->to($customer->email,$customer->customer_name);
                  $mail->from('ntmphuong990@gmail.com');
                  $mail->subject('Delicious Cake - Xác nhận tài khoản');
              });
              return redirect()->route('login')->with('success','Đăng kí tài khoản thành công vui lòng xác nhận email');
      }
      return redirect()->back();
}

//Kích hoạt tài khoản
public function actived (Customer $customer,$token){
  if($customer->token === $token){
      $customer->update(['status'=>1,'token' => null]);
      return redirect()->route('home.login')->with('success','Xác nhận tài khoản thành công');
  }
  else{
      return redirect()->route('home.login')->with('error','Xác nhận tài khoản thất bại');
  }
}


  //tim kiem
  function searchoption($option, $key = "")
  {
    if (request()->check != NULL) {
      if ($option == 'junior') {
        $search = PostJob::where('job_title', 'like', '%' . $key . '%')->whereIn('post_job_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
        $allsearchs = PostJob::where('job_title', 'like', '%' . request()->key . '%')->get();
      } else if ($option == 'junior') {
        $search = PostJob::where('job_title', 'like', '%' . $key . '%')->whereIn('post_job_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
        $allsearchs = PostJob::where('job_title', 'like', '%' . request()->key . '%')->get();
      } else if ($option == 'senior') {

        $search = PostJob::where('job_title', 'like', '%' . $key . '%')->whereIn('post_job_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
        $allsearchs = PostJob::where('job_title', 'like', '%' . request()->key . '%')->get();
      }
      return view('search', [
        'search' => $search,
        'allsearchs' => $allsearchs,
      ]);
    }
    return redirect('/search?option=' . $option . '&key=' . $key,);
  }

  function search()
  {
    session()->put('option', request()->option);
    session()->put('key', request()->key);

    if ($key = request()->key) {
      $search = PostJob::where('job_title', 'Like', '%' . $key . '%')->paginate(8);
    } else if (request()->option == 'junior') {
      $search = PostJob::where('job_title', 'like', '%' . request()->key . '%')->paginate(6);
      $allsearchs = PostJob::where('job_title', 'like', '%' . request()->key . '%')->get();
    } else if (request()->option == 'senior') {
      $search = PostJob::where('job_title', 'like', '%' . request()->key . '%')->paginate(6);
      $allsearchs = PostJob::where('job_title', 'like', '%' . request()->key . '%')->get();
    } else if (request()->option == 'fresher') {
      $search = PostJob::where('job_title', 'like', '%' . request()->key . '%')->paginate(6);
      $allsearchs = PostJob::where('job_title', 'like', '%' . request()->key . '%')->get();
      // } else if (request()->option == "hochiminh") {
      //   $search = Location::where('hochiminh', 'like', '%' . request()->key . '%')->paginate(6);
      //   $allsearchs = Location::where('hochiminh', 'like', '%' . request()->key . '%')->get();
      // } else if (request()->option == "danang") {
      //   $search = Location::where('danang', 'like', '%' . request()->key . '%')->paginate(6);
      //   $allsearchs = Location::where('danang', 'like', '%' . request()->key . '%')->get();
      // } else if (request()->option == "hanoi") {
      //   $search = Location::where('hanoi', 'like', '%' . request()->key . '%')->paginate(6);
      //   $allsearchs = Location::where('hanoi', 'like', '%' . request()->key . '%')->get();
      // } else if (request()->option == "khac") {
      //   $search = Location::whereNotNull('location_id')->paginate(6);
      //   $allsearchs = Location::whereNotNull('location_id')->get();       
      return view('search', [

        'search' => $search,
        'allsearchs' => $allsearchs,
      ]);
    }
  }
  //
  //joblist
  function joblist()
  {
    $allproducts = PostJob::all();
    $company = Company::all();
    $feature = PostJob::where('job_type_id', 1)->orderBy('job_salary_max', 'desc')->take(4)->get();
    $parttime = PostJob::where('job_type_id', 2)->orderBy('job_salary_max', 'desc')->take(4)->get();
    $fulltime = PostJob::where('job_type_id', 3)->orderBy('job_salary_max', 'desc')->take(4)->get();
    return view('joblist', [
      'allproducts' => $allproducts,
      'company' => $company,
      'feature' => $feature,
      'parttime' => $parttime,
      'fulltime' => $fulltime,
    ]);
  }

  function index($name = 'index')
  {

   
    //return view('index',['data'=>$product]);
    $allproducts = PostJob::all();
    $company = Company::all();
    $comment = Comment::with('customer')->orderBy('id','DESC')->limit(4)->get();
    $feature = PostJob::where('job_type_id', 1)->orderBy('job_salary_max', 'desc')->take(4)->get();
    $parttime = PostJob::where('job_type_id', 2)->orderBy('job_salary_max', 'desc')->take(4)->get();
    $fulltime = PostJob::where('job_type_id', 3)->orderBy('job_salary_max', 'desc')->take(4)->get();
    return view($name, [
      'comment'=>$comment,
      'allproducts' => $allproducts,
      'company' => $company,
      'feature' => $feature,
      'parttime' => $parttime,
      'fulltime' => $fulltime,

    ]);
  }

  function company()
  {
    $allproducts = PostJob::all();
    $company = Company::all();
    $feature = PostJob::where('job_type_id', 1)->orderBy('job_salary_max', 'desc')->take(4)->get();
    $parttime = PostJob::where('job_type_id', 2)->orderBy('job_salary_max', 'desc')->take(4)->get();
    $fulltime = PostJob::where('job_type_id', 3)->orderBy('job_salary_max', 'desc')->take(4)->get();
    return view('company', [
      'allproducts' => $allproducts,
      'company' => $company,
      'feature' => $feature,
      'parttime' => $parttime,
      'fulltime' => $fulltime,
    ]);
  }

  function testimonial()
  {
    return view('testimonial');
  }
}
