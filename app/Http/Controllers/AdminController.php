<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    private const BB_VALIDATOR = [
        'title' => 'required',
        'description' => 'required',
        'image' => 'required',
        'price' => 'required|numeric',
        'count' => 'required|numeric',
        'country' => 'required',
        'category' => 'required',
        'structure' => 'required'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/admin', ['prod' => Products::all()]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Categories $categories)
    {
        $categories = Categories::all();
        return view('admin/admin_add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(self::BB_VALIDATOR);
        Products::create([
            'title' =>  $validated['title'],
            'image' => $validated['image'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'count' => $validated['count'],
            'country' => $validated['country'],
            'categories_id' => $validated['category'],
            'structure' => $validated['structure']
        ]);
        return redirect()->route('admin');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $prod, Categories $categories)
    {
        $categories = Categories::all();
        return view('admin/admin_edit', compact('prod', 'categories'));
    }

    public function update(Request $request, Products $prod)
    {
        // $validated = $request->validate(self::BB_VALIDATOR);
        $prod -> fill([
            'title' => $request -> title,
            // 'image' => $validated['image'],
            'description' => $request -> description,
            'price' => $request -> price,
            'country' => $request -> country,
            'categories_id' => $request -> category,
            'structure' => $request -> structure
        ]);
        $prod -> save();
        return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Products $prod)
    {
        return view('admin/admin_delete', ['prod' => $prod]);
    }

    public function destroy(Products $prod)
    {
        $prod -> delete();
        return redirect()->route('admin');
    }

    public function admin_order(Request $request) {
        // Получаем параметры фильтрации и сортировки
        $statusFilter = $request->input('status');
        $sortOrder = $request->input('sort', 'asc'); // По умолчанию 'asc' для сортировки по возрастанию

        // Создаем запрос к базе данных с учетом фильтрации и сортировки
        $productQuery = DB::table('order_details')
            ->join('products', 'order_details.products_id', '=', 'products.id')
            ->join('users', 'order_details.users_id', '=', 'users.id')
            ->join('orders', 'order_details.orders_id', '=', 'orders.id')
            ->select('order_details.*', 'orders.*', 'products.image', 'products.title', 'products.description', 'products.price', 'products.country', 'users.name');

        // Фильтрация по статусу
        if ($statusFilter) {
            $productQuery->where('orders.status', $statusFilter);
        }

        // Сортировка по общей цене
        $productQuery->orderBy(DB::raw('order_details.count * products.price'), $sortOrder);

        // Пагинация (10 записей на страницу)
        $product = $productQuery->paginate(5);

        // Возвращаем данные в шаблон
        return view('admin/admin_order', compact('product', 'statusFilter', 'sortOrder'));
    }

    public function admin_accept(Orders $id_order) {
        $id_order -> fill([
            'status' => 'accept',
        ]);
        $id_order -> save();
        return redirect()->route('admin_order');
    }
    public function admin_reject(Orders $id_order) {
        $id_order -> fill([
            'status' => 'reject',
        ]);
        $id_order -> save();
        return redirect()->route('admin_order');
    }
}
