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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use function GuzzleHttp\Promise\all;

class MyController extends Controller
{
    // return redirect()->route('index');
    // session()->flush();
    function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }

    // Admin
    function admin()
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $allproducts = Product::all();
        $allmanus = Manufacturer::all();
        $allpayments = Payment::all();
        $alldetails = Detail::all();
        $allothers = Other::all();
        $allusers = User::all();
        return view('admin.index', [
            'allproducts' => $allproducts,
            'allmanus' => $allmanus,
            'allpayments' => $allpayments,
            'alldetails' => $alldetails,
            'allothers' => $allothers,
            'allusers' => $allusers,
        ]);
    }

    // User
    function mail()
    {
        $value = Product::where('sale', '>=', 15)->first();
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
        $mail->setFrom("hellking1230@gmail.com", "Project BE2");
        $mail->addReplyTo("hellking1230@gmail.com", "reply-to-name");
        $mail->addCC("cc-recipient-email@domain", "cc-recipient-name");
        $mail->Subject = "NEWSLETTER (PROJECT-AUTO-MAIL)";
        $content = "<h1>Product name: ".$value->product_name."</h1><br><p>Price: ".number_format($value->price)."</p><br><p>Sale: ".$value->sale."</p><p>Description: ".$value->description."</p>";
        $mail->msgHTML($content);
        if (!$mail->send()) {
            echo "Error!";
        }
        else {
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

    function payments()
    {
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
        $allmanus = Manufacturer::all();
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

    function page()
    {
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
        $allmanus = Manufacturer::all();
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

    function sort($option, $key)
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        $allproducts = Product::all();
        $allmanus = Manufacturer::all();
        $topsellings = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(3)->get();
        if ($option == 'description') {
            if (request()->sort == "asc") {
                $search = Product::where('description', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            } else if (request()->sort == "desc") {
                $search = Product::where('description', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            }
            $allsearchs = Product::where('description', 'like', '%' . request()->key . '%')->get();
        } else if ($option == 'product_name') {
            if (request()->sort == "asc") {
                $search = Product::where('product_name', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            } else if (request()->sort == "desc") {
                $search = Product::where('product_name', 'like', '%' . $key . '%')->orderBy('price', request()->sort)->paginate(6);
            }
            $allsearchs = Product::where('product_name', 'like', '%' . request()->key . '%')->get();
        } else if ($option == 'manu_name') {
            $manus = Manufacturer::where('manu_name', 'like', '%' . $key . '%')->first();
            if (request()->sort == "asc") {
                $search  = Product::where('manu_id', $manus->manu_id)->orderBy('price', request()->sort)->paginate(6);
            } else if (request()->sort == "desc") {
                $search  = Product::where('manu_id', $manus->manu_id)->orderBy('price', request()->sort)->paginate(6);
            }
            $allsearchs = Product::where('manu_id', $manus->manu_id)->get();
        } else if (request()->option == "alls") {
            if (request()->sort == "asc") {
                $search = Product::orderBy('price', request()->sort)->paginate(6);
            } else if (request()->sort == "desc") {
                $search = Product::orderBy('price', request()->sort)->paginate(6);
            }
            $allsearchs = Product::orderBy('price', 'desc')->get();
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
            'allpayments' => $allpayments,
            'allproducts' => $allproducts,
            'search' => $search,
            'topsellings' => $topsellings,
            'allsearchs' => $allsearchs,
        ]);
    }

    function searchoption($option, $key = "")
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        $allproducts = Product::all();
        $allmanus = Manufacturer::all();
        $topsellings = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(3)->get();
        if (request()->check != NULL) {
            if ($option == 'description') {
                $search = Product::where('description', 'like', '%' . $key . '%')->whereIn('manu_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
                $allsearchs = Product::where('description', 'like', '%' . request()->key . '%')->get();
            } else if ($option == 'product_name') {
                $search = Product::where('product_name', 'like', '%' . $key . '%')->whereIn('manu_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
                $allsearchs = Product::where('product_name', 'like', '%' . request()->key . '%')->get();
            } else if ($option == 'manu_name') {
                $manus = Manufacturer::where('manu_name', 'like', '%' . $key . '%')->first();
                $search  = Product::where('manu_id', $manus->manu_id)->whereIn('manu_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
                $allsearchs = Product::where('manu_id', $manus->manu_id)->get();
            } else if (request()->option == "alls") {
                $search = Product::whereIn('manu_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
                $allsearchs = Product::whereNotNull('manu_id')->get();
            } else if (request()->option == "wishlist") {
                $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get('product_id');
                $arrothers = [];
                foreach ($allothers as $value) {
                    $arrothers[] = $value->product_id;
                }
                $search = Product::whereIn('product_id', $arrothers)->whereIn('manu_id', request()->check)->where('price', '>=', number_format(request()->min) * 1000000)->where('price', '<=', number_format(request()->max) * 1000000)->paginate(6);
                $allsearchs = Product::whereIn('product_id', $arrothers)->get();
            }
            return view('search', [
                'user' => $user,
                'allmanus' => $allmanus,
                'allothers' => $allothers,
                'allpayments' => $allpayments,
                'allproducts' => $allproducts,
                'search' => $search,
                'topsellings' => $topsellings,
                'allsearchs' => $allsearchs,
            ]);
        }
        return redirect('/search?option=' . $option . '&key=' . $key,);
    }

    function search()
    {
        session()->put('option', request()->option);
        session()->put('key', request()->key);
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        $topsellings = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(3)->get();
        if (request()->option == 'description') {
            $search = Product::where('description', 'like', '%' . request()->key . '%')->paginate(6);
            $allsearchs = Product::where('description', 'like', '%' . request()->key . '%')->get();
        } else if (request()->option == 'product_name') {
            $search = Product::where('product_name', 'like', '%' . request()->key . '%')->paginate(6);
            $allsearchs = Product::where('product_name', 'like', '%' . request()->key . '%')->get();
        } else if (request()->option == 'manu_name') {
            $manus = Manufacturer::where('manu_name', 'like', '%' . request()->key . '%')->first();
            $search = Product::where('manu_id', $manus->manu_id)->paginate(6);
            $allsearchs = Product::where('manu_id', $manus->manu_id)->get();
        } else if (request()->option == "alls") {
            $search = Product::whereNotNull('manu_id')->paginate(6);
            $allsearchs = Product::whereNotNull('manu_id')->get();
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
            'allpayments' => $allpayments,
            'allproducts' => $allproducts,
            'search' => $search,
            'topsellings' => $topsellings,
            'allsearchs' => $allsearchs,
        ]);
    }

    function star($manu_id, $prodcut_id, $user_id)
    {
        // if (!$this->userCan('view-page-guest')) {
        //     abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        // }
        if ($user_id == 0) {
            $other = new Other;
            $other->product_id = $prodcut_id;
            $other->user_id = $user_id;
            $other->like = NULL;
            $other->submit = request()->name . '#' . request()->email . '#' . request()->submit . '#';
            $other->star = request()->rating;
            $other->save();
            return redirect('/products' . '/' . $prodcut_id . '/' . $manu_id);
        } else {
            $other = new Other;
            $other->product_id = $prodcut_id;
            $other->user_id = $user_id;
            $other->like = NULL;
            $other->submit = request()->submit;
            $other->star = request()->rating;
            $other->save();
            return redirect('/products' . '/' . $prodcut_id . '/' . $manu_id);
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

    function others($name, $product_id, $user_id, $option = 'description', $key = '')
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        $allmanus = Manufacturer::all();
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
                    'allpayments' => $allpayments,
                ]);
            } else {
                if ($name == "search") {
                    return redirect('/search?option=' . $option . '&key=' . $key);
                }
                return redirect()->route($name);
            }
        }
    }

    function carts($action = "", $product_id = "")
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        if ($action == "add") {
            if (session()->has('carts' . $product_id)) {
                if (request()->quantity != null) {
                    for ($i = 0; $i < (int)request()->quantity; $i++) {
                        session()->increment('carts' . $product_id);
                    }
                } else {
                    session()->increment('carts' . $product_id);
                }
            } else {
                session()->put('carts' . $product_id, 1);
            }
        }
        if ($action == "+") {
            session()->increment('carts' . $product_id);
        }
        if ($action == "-") {
            if (session()->decrement('carts' . $product_id) == 0) {
                session()->pull('carts' . $product_id);
            }
        }
        if ($action == "delete") {
            session()->pull('carts' . $product_id);
        }
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        return view('carts', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allproducts' => $allproducts,
            'allpayments' => $allpayments,
        ]);
    }

    function products($product_id, $manu_id)
    {
        $user = Auth::user();
        if ($user != NULL) {
            $allothers = Other::where('user_id', $user->id)->where('like', 1)->whereNotNull('like')->get();
            $allpayments = Payment::where('user_id', $user->id)->get();
        } else {
            $allothers = [];
            $allpayments = [];
        }
        $others = Other::where('product_id', $product_id)->whereNotNull('submit')->paginate(3);
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        $product = Product::where('product_id', $product_id)->first();
        $productManus = Product::where('manu_id', $manu_id)->get();
        return view('products', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'allpayments' => $allpayments,
            'allproducts' => $allproducts,
            'others' => $others,
            'allmanus' => $allmanus,
            'product' => $product,
            'productManus' => $productManus,
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
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        $newproducts = Product::orderBy('created_at', 'desc')->take(10)->get();
        $newproduct1 = Product::where('manu_id', 1)->orderBy('created_at', 'desc')->take(3)->get();
        $newproduct2 = Product::where('manu_id', 2)->orderBy('created_at', 'desc')->take(3)->get();
        $newproduct3 = Product::where('manu_id', 3)->orderBy('created_at', 'desc')->take(3)->get();
        $newproduct4 = Product::where('manu_id', 4)->orderBy('created_at', 'desc')->take(3)->get();
        $newproduct5 = Product::where('manu_id', 5)->orderBy('created_at', 'desc')->take(3)->get();
        $topsellings = Product::where('sale', '>', 0)->get();
        $topselling1 = Product::where('manu_id', 1)->where('sale', '>', 0)->get();
        $topselling2 = Product::where('manu_id', 2)->where('sale', '>', 0)->get();
        $topselling3 = Product::where('manu_id', 3)->where('sale', '>', 0)->get();
        $topselling4 = Product::where('manu_id', 4)->where('sale', '>', 0)->get();
        $topselling5 = Product::where('manu_id', 5)->where('sale', '>', 0)->get();
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
            'newproduct1' => $newproduct1,
            'newproduct2' => $newproduct2,
            'newproduct3' => $newproduct3,
            'newproduct4' => $newproduct4,
            'newproduct5' => $newproduct5,
            'topsellings' => $topsellings,
            'topselling1' => $topselling1,
            'topselling2' => $topselling2,
            'topselling3' => $topselling3,
            'topselling4' => $topselling4,
            'topselling5' => $topselling5,
        ]);
    }
}
