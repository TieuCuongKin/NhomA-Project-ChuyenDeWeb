<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    function index() {
        return view('index');
    }

    function blank() {
        return view('blank');
    }

    function checkout() {
        return view('checkout');
    }

    function store() {
        return view('store');
    }
    
    function product() {
        return view('product');
    }
}