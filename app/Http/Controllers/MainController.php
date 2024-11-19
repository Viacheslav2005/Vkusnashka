<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Products;

use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function index() {
        return view('index');
    }
    public function login() {
        return view('/auth/login');
    }
    public function register() {
        return view('/auth/register');
    }
    public function menu() {
        $prod = ['prod' => Products::all()];
        return view('/menu', $prod);
    }
    public function find_us() {
        return view('/find_us');
    }
    public function personal_account() {
        $order = DB::table('order_details')
        ->join('orders', 'order_details.orders_id', '=', 'orders.id')
        ->select('order_details.*', 'orders.*')
        ->get();
        return view('/personal_account', compact('order'));
    }
    public function food(Products $prod) {
        return view('/food', ['prod' => $prod]);
    }
    public function admin() {
        return view('admin/admin');
    }
    public function detail(Products $prod) {
        return view('detail', ['prod' => $prod]);
    }

}
