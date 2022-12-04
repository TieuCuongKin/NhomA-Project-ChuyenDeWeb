<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Detail;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Other;
use App\Models\Payment;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use function GuzzleHttp\Promise\all;

class MyController extends Controller
{

    // session()->flush();
    function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }
    // User
    function mail()
    {
        $value = Product::where('star', '=', 5)->first();
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "hellking1230@gmail.com";
        $mail->Password = "osaxxenzvshofdgn";
        $mail->isHTML(true);
        $mail->addAddress(request()->mail, "recipient-name");
        $mail->setFrom("hellking1230@gmail.com", "IT Viet tuyen dung nhan su toan the gioi");
        $mail->addReplyTo("hellking1230@gmail.com", "reply-to-name");
        $mail->addCC("cc-recipient-email@domain", "cc-recipient-name");
        $content = "<h1>Hello: " . $value->user . "Rất hân hạnh được biết đến bạn, cô/cậu thật xinh đẹp" . "</h1><br><p>Star: " . $value->sale . "</p><p>Description: " . $value->description . "</p>";
        $mail->msgHTML($content);
        if (!$mail->send()) {
            echo "Error!";
        } else {
            echo "Email sent successfully";
        }
        return redirect()->route('index');
    }

    function createpayment()
    {
        if (!$this->userCan('view-page-guest')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $user = Auth::user();
        $allpayments = Payment::where('user_id', $user->id)->get();
        $allproducts = Product::all();
        $payment = new Payment;
        $payment->user_id = $user->id;
        if (count($allpayments) < 5) {
            $payment->discount = "3";
        } elseif (count($allpayments) > 10) {
            $payment->discount = "5";
        } else {
            $payment->discount = "0";
        }
        $payment->save();
        foreach ($allproducts as  $value) {
            if (session()->has('carts' . $value->product_id)) {
                $detail = new Detail;
                $detail->product_id = $value->product_id;
                $detail->payment_id = $payment->payment_id;
                $detail->quantity = session()->get('carts' . $value->product_id);
                $detail->save();
                session()->forget('carts' . $value->product_id);
            }
        }
        return redirect('/payments');
    }

   
    // Loc sp
    function sort($option, $key)
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
        } else {
            $allothers = [];
        }
        $allproducts = Product::all();
        $allmanus = Company::all();
        $topsellings = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(3)->get();
        //check description
        if ($option == 'description') {
            if (request()->sort == "asc") {
                $search = Product::where('description', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            } else if (request()->sort == "desc") {
                $search = Product::where('description', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            }
            $allsearchs = Product::where('description', 'like', '%' . request()->key . '%')->get();
            //check company
        } else if ($option == 'company_name') {
            if (request()->sort == "asc") {
                $search  = Product::where('company_name', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            } else if (request()->sort == "desc") {
                $search  = Product::where('company_name', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            }
            $allsearchs = Product::where('company_name', 'like', '%' . request()->key . '%')->get();
            // chưa check xong wishlist
        } else if (request()->option == "wishlist") {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get('product_id');
            $arrothers = [];
            foreach ($allothers as $value) {
                $arrothers[] = $value->product_id;
            }
            if (request()->sort == "asc") {
                $search = Product::whereIn('product_id', $arrothers)->orderBy('price', request()->sort)->paginate(6);
            } else if (request()->sort == "desc") {
                $search = Product::whereIn('product_id', $arrothers)->orderBy('price', request()->sort)->paginate(6);
            }
            $allsearchs = Product::whereIn('product_id', $arrothers)->get();
        }
        return view('search', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allproducts' => $allproducts,
            'search' => $search,
            'topsellings' => $topsellings,
            'allsearchs' => $allsearchs,
        ]);
    }
   
    // Tim kiem theo option
    function searchoption($option, $key = "")
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
        } else {
            $allothers = [];
        }
        $allproducts = Product::all();
        $allmanus = Company::all();
        $topsellings = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(3)->get();
        if (request()->check != NULL) {
            if ($option == 'description') {
                $search = Product::where('description', 'like', '%' . $key . '%')->whereIn('company_name', request()->check)->paginate(3);
                $allsearchs = Product::where('description', 'like', '%' . request()->key . '%')->get();
            } else if ($option == 'product_name') {
                $search = Product::where('product_name', 'like', '%' . $key . '%')->whereIn('company_name', request()->check)->paginate(3);
                $allsearchs = Product::where('product_name', 'like', '%' . request()->key . '%')->get();
            } else if ($option == 'company_name') {
                $manus = Company::where('company_name', 'like', '%' . $key . '%')->first();
                $search  = Product::where('company_id', $manus->company_id)->whereIn('company_id', request()->check)->paginate();
                $allsearchs = Product::where('company_id', $manus->company_id)->get();
                } else if (request()->option == "alls") {
                    $search = Product::whereIn('company_name', request()->check)->paginate(6);
                    $allsearchs = Product::whereNotNull('company_name')->get();
            } else if (request()->option == "wishlist") {
                $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get('product_id');
                $arrothers = [];
                foreach ($allothers as $value) {
                    $arrothers[] = $value->product_id;
                }
                $search = Product::whereIn('product_id', $arrothers)->whereIn('company_name', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
                $allsearchs = Product::whereIn('product_id', $arrothers)->get();
            }
            return view('search', [
                'user' => $user,
                'allmanus' => $allmanus,
                'allothers' => $allothers,
                'allproducts' => $allproducts,
                'search' => $search,
                'topsellings' => $topsellings,
                'allsearchs' => $allsearchs,
            ]);
        }
        return redirect('/search?option=' . $option . '&key=' . $key,);
    }
    // Tim kiem
    function search()
    {
        session()->put('option', request()->option);
        session()->put('key', request()->key);
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
        } else {
            $allothers = [];
        }
        $allmanus = Company::all();
        $allproducts = Product::all();
        $topsellings = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(3)->get();
        if (request()->option == 'description') {
            $search = Product::where('description', 'like', '%' . request()->key . '%')->paginate(3);
            $allsearchs = Product::where('description', 'like', '%' . request()->key . '%')->get();
        } else if (request()->option == 'product_name') {
            $search = Product::where('product_name', 'like', '%' . request()->key . '%')->paginate(3);
            $allsearchs = Product::where('product_name', 'like', '%' . request()->key . '%')->get();
        } else if (request()->option == 'company_name') {
            $manus = Company::where('company_name', 'like', '%' . request()->key . '%')->first();
            $search = Product::where('company_name', $manus->company_name)->paginate(3);
            $allsearchs = Product::where('company_name', $manus->company_name)->get();
        } else if (request()->option == "alls") {
            $search = Product::whereNotNull('description')->paginate(6);
            $allsearchs = Product::whereNotNull('description')->get();
        } else if (request()->option == "wishlist") {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get('product_id');
            $arrothers = [];
            foreach ($allothers as $value) {
                $arrothers[] = $value->product_id;
            }
            $search = Product::whereIn('product_id', $arrothers)->paginate(6);
            $allsearchs = Product::whereIn('product_id', $arrothers)->get();
        }
        return view('search', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allproducts' => $allproducts,
            'search' => $search,
            'topsellings' => $topsellings,
            'allsearchs' => $allsearchs,
        ]);
    }

//danh gia
    function star($prodcut_id, $user_id)
    {
        // if (!$this->userCan('view-page-guest')) {
        //     abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        // }
        if ($user_id == 0) {
            $other = new Other;
            $other->product_id = $prodcut_id;
            $other->user_id = $user_id;
            $other->like = NULL;
            $other->submit = request()->email . '#' . request()->submit . '#';
            $other->star = request()->rating;
            $other->save();
            return redirect('/products' . '/' . $prodcut_id);
        } else {
            $other = new Other;
            $other->product_id = $prodcut_id;
            $other->user_id = $user_id;
            $other->like = NULL;
            $other->submit = request()->submit;
            $other->star = request()->rating;
            $other->save();
            return redirect('/products' . '/' . $prodcut_id);
        }
    }

    function clearcompare()
    {
        $allproducts = Product::all();
        session()->forget('compare');
        foreach ($allproducts as $value) {
            if (session()->has('compare' . $value->product_id)) {
                session()->forget('compare' . $value->product_id);
            }
        }
        return redirect()->route('index');
    }

//comment, like, sao hien thi len cot cmmt
   function others($name, $product_id, $user_id, $option = 'description', $key = '')
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
        } else {
            $allothers = [];
        }
        $allmanus = Company::all();
        $allproducts = Product::all();
        if (request()->action == "wishlist") {
            if ($user_id != "0") {
                $other = Other::where('product_id', $product_id)->where('user_id', $user_id)->first();
                if ($other == Null) {
                    $like = new Other;
                    $like->product_id = $product_id;
                    $like->user_id = $user_id;
                    $like->like = "1";
                    $like->submit = NULL;
                    $like->star = NULL;
                    $like->save();
                } else {
                    $like = Other::find($other->other_id);
                    if ($other->like == "0") {
                        $like->like = "1";
                    } else {
                        $like->like = "0";
                    }
                    $like->save();
                }
                if ($name == "search") {
                    return redirect('/search?option=' . $option . '&key=' . $key);
                }
                return redirect()->route($name);
            }
            return redirect()->route($name);
        }
        //so sanh 
        if (request()->action == "compare") {
            if (session()->get('compare') > 1) {
                session()->forget('compare');
                foreach ($allproducts as $value) {
                    if (session()->has('compare' . $value->product_id)) {
                        session()->forget('compare' . $value->product_id);
                    }
                }
            }
            if (session()->has('compare' . $product_id)) {
                session()->forget('compare' . $product_id);
                session()->decrement('compare');
            } else {
                if (session()->has('compare')) {
                    session()->put('compare' . $product_id, 1);
                    session()->increment('compare');
                } else {
                    session()->put('compare' . $product_id, 1);
                    session()->put('compare', 1);
                }
            }
            if (session()->get('compare') == 2) {
                return view('compare', [
                    'user' => $user,
                    'allmanus' => $allmanus,
                    'allothers' => $allothers,
                    'allproducts' => $allproducts,

                ]);
            } else {
                if ($name == "search") {
                    return redirect('/search?option=' . $option . '&key=' . $key);
                }
                return redirect()->route($name);
            }
        }
    }

    function carts()
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
        } else {
            $allothers = [];
        }
        $allmanus = Company::all();
        $allproducts = Product::all();
        return view('carts', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allproducts' => $allproducts,
        ]);
    }

    function products($product_id)
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
        } else {
            $allothers = [];
        }
        $others = Other::where('product_id', $product_id)->whereNotNull('submit')->paginate(3);
        $allmanus = Company::all();
        $allproducts = Product::all();
        $product = Product::where('product_id', $product_id)->first();

        return view('products', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allproducts' => $allproducts,
            'others' => $others,
            'allmanus' => $allmanus,
            'product' => $product,
        ]);
    }


    function index($name = 'index')
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        $allmanus = Company::all();
        $allproducts = Product::all();
        $newproducts = Product::orderBy('created_at', 'desc')->take(10)->get();
        if ($name == 'checkout') {
            // can clear session
            return view('checkout', [
                'user' => $user,
                'allmanus' => $allmanus,
                'allothers' => $allothers,
                'allproducts' => $allproducts,
                'allpayments' => $allpayments,
            ]);
        }
        if ($name == 'payments') {
            return view('payments', [
                'user' => $user,
                'allmanus' => $allmanus,
                'allothers' => $allothers,
                'allproducts' => $allproducts,
                'allpayments' => $allpayments,
            ]);
        }
        return view($name, [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allproducts' => $allproducts,
            'allpayments' => $allpayments,
            'newproducts' => $newproducts,
        ]);
    }


    function payments() {
        if (!$this->userCan('view-page-guest')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        $allproducts = Product::all();
        $allmanus = Company::all();
        $alldetails = Detail::all();
        return view('payments', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allproducts' => $allproducts,
            'allpayments' => $allpayments,
            'alldetails' => $alldetails,
            'allproducts' => $allproducts,
        ]);
    }
     //
     function page() {
         $user = Auth::user();
         $allproducts = Product::all();
         if ($user != NULL) {
             $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
             $allpayments = Payment::where('user_id', $user->id)->get();
         } else {
             $allothers = [];
             $allpayments = [];
         }
         if (!$this->userCan('view-page-guest')) {
             abort('403', __('Bạn không có quyền thực hiện thao tác này'));
         }
         $allmanus = Company::all();
         $page = Product::orderBy('product_id', 'desc')->paginate(10);
         return view('store', [
             'user' => $user,
             'allmanus' => $allmanus,
             'allothers' => $allothers,
             'allpayments' => $allpayments,
             'allproducts' => $allproducts,
             'page' => $page,
         ]);
     }
}

