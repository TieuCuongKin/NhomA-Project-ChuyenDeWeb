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
use App\Models\Other;
use  Illuminate\Support\Facades\DB;

class MyController extends Controller
{
  //hien thi chi tiet san pham
  function jobdetail($id)
    {
        $postjob = PostJob::all();
        $company = Company::find($id);
        $alllocation = Location::all();
     
     
        return view('jobdetail',['dulieu'=>$postjob,'congty'=>$company,'thanhpho'=>$alllocation]);
    }
    //
  public function getSearch(Request $req){
    $postjob = PostJob::where('job_title','like','%'.$req->key.'%')->orWhere('job_description',$req->key)->get();
    return view ('search',compact('postjob'));
  }

   //Cập nhật thông tin cá nhân
   public function update_Profile(Request $request){
    $this->validate($request,[
        'full_name' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ],[
            'full_name.required' => 'Tên người dùng không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
    ]);
  
    Customer::where(['id'=>Auth::guard('cus')->user()->id])->update($request->all());
    return back()->with('success','Sửa thông tin thành công');
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
          'full_name' => 'required',
          'email' => 'required|email|unique:customer,email',
          'password' => 'required',
          'confirm_password' => 'required|same:password',
      ],[
          'full_name.required' => 'Tên người dùng không được để trống',
          'email.required' => 'Email không được để trống',
          'email.unique' => 'Email đã được sử dụng',
          'email.email' => 'Email phải đúng định dạng',
          'password.required' => 'Mật khẩu không được để trống',
          'confirm_password.required' => 'Xác nhận mật khẩu không được để trống',
          'confirm_password.same' => 'Nhập lại mật khẩu không chính xác'

      ]);
    
      $password_h = bcrypt($request->password);
      $data = $request->only('full_name','email','password','phone','address');
      $data['password'] = $password_h;
      
      if($customer = Customer::create($data)){
         
              return redirect()->route('login');
      }
      return redirect()->back();
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
   

    $alllocation = Location::all();
    $allproducts = PostJob::all();


    return view('joblist', [
       
 
        'alllocation' => $alllocation,

        'allproducts' => $allproducts,

    ]);
}

 function index($name = 'index')
 {   $allproducts = PostJob::all();
    $company = Company::all();
     $feature = PostJob::where('job_type_id', 1)->orderBy('job_salary_max', 'desc')->take(4)->get();
     $parttime = PostJob::where('job_type_id', 2)->orderBy('job_salary_max', 'desc')->take(4)->get();
     $fulltime = PostJob::where('job_type_id', 3)->orderBy('job_salary_max', 'desc')->take(4)->get(); 
     return view($name, [
         'allproducts' => $allproducts,
         'company' => $company,
         'feature' => $feature,
         'parttime' => $parttime,
         'fulltime' => $fulltime,

     ]);
 }

  function company()
  {
    return view('company');
  }

  function testimonial()
  {
    return view('testimonial');
  }

}
