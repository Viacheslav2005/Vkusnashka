<?php

namespace App\Http\Controllers;

use App\Models\Baskets;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function add_basket(Request $request, $id_prod)
    {
        $user = auth()->user();

            // Baskets::create([
            //     "users_id" => $user_id,
            //     "products_id" => $id_prod,
            //     "count" => $request -> count,
            //     "boolean" => 0,
            // ]);
            // return redirect()->route('personal_account');

            if ($user) {
                // Получаем информацию о товаре из базы данных
                $product = Products::find($id_prod);

                if (!$product) {
                    Log::error("Товар не найден: {$id_prod}");
                    return 1;
                    // return redirect()->route('menu')->with('message', 'Товар не найден')->with('alert_type', 'error');
                }

                // Проверяем доступное количество товара
                $availableStock = $product->count;

                // Проверяем, есть ли товар в корзине
                $cartItem = Baskets::where('users_id', $user->id) // Используем правильный user_id
                                   ->where('products_id', $id_prod)
                                   ->first();
                if ($cartItem) {
                    // Если товар уже в корзине, проверяем, можем ли увеличить количество
                    if ($cartItem->count < $availableStock) {
                        // Увеличиваем количество товара в корзине
                        $cartItem->count += 1; // Увеличиваем количество на 1
                        $cartItem->save(); // Сохраняем изменения в базе данных
                        return redirect()->route('personal_account')->with('message', 'Товар добавлен в корзину!')->with('alert_type', 'success');
                    } else {
                        Log::warning("Недостаточно товара на складе для продукта: {$id_prod}");
                        // return 2;
                        return redirect()->route('menu')->with('message', 'Недостаточно товара на складе')->with('alert_type', 'error');
                    }
                } else {
                    // Если товара нет в корзине, добавляем новый, если есть в наличии
                    if ($availableStock > 0) {
                        Baskets::create([
                            "users_id" => $user -> id,
                            "products_id" => $id_prod,
                            "price" => $request -> price,
                            "count" => $request -> count,
                            "boolean" => 0,
                        ]);
                        return redirect()->route('personal_account')->with('message', 'Товар добавлен в корзину!')->with('alert_type', 'success');
                    } else {
                        Log::warning("Товар отсутствует на складе: {$id_prod}");
                        // return 3;
                        return redirect()->route('menu')->with('message', 'Товар отсутствует на складе')->with('alert_type', 'error');
                    }
                }
            } else {
                Log::info("Попытка добавить товар в корзину неавторизованным пользователем.");
                // return 4;
                return redirect()->route('menu')->with('message', 'Пожалуйста, авторизуйтесь')->with('alert_type', 'error');
            }
    }

    public function basket() {
        $user = Auth::user();
        $user_id = $user->id;
        $baskets = DB::table('baskets')
            ->join('products', 'baskets.products_id', '=', 'products.id')
            ->select('baskets.*', 'products.image', 'products.title', 'products.description', 'products.price', 'products.country')
            ->where('baskets.users_id', $user_id)
            ->get();
        // $baskets = Baskets::where('users_id', $user_id)->get();
        return view('basket', compact('baskets'));
    }

    public function removeFromCart($id)
    {
        // Удаляем товар из корзины
        $basket = Baskets::findOrFail($id);
        $basket->delete();

        return redirect()->route('basket')->with('message', 'Товар удален из корзины');
    }

    public function increaseQuantity($id)
    {
        // Увеличиваем количество товара в корзине
        $basket = Baskets::findOrFail($id);
        $basket->count += 1;
        // Увеличиваем на 1
        $product = Products::findOrFail($basket->products_id);
        $basket->price = $basket->count * $product-> price;
        $basket->save();

        return redirect()->route('basket')->with('message', 'Количество товара увеличено');
    }

    public function decreaseQuantity($id)
    {
        // Уменьшаем количество товара в корзине, но не ниже 1
        $basket = Baskets::findOrFail($id);
        if ($basket->count > 1) {
            $basket->count -= 1;
            $product = Products::findOrFail($basket->products_id);
            $basket->price = $basket->count * $product-> price;// Уменьшаем на 1
            $basket->save();
        }

        return redirect()->route('basket')->with('message', 'Количество товара уменьшено');
    }


    public function create_order(Request $request)
    {

        $user = Auth::user();
        // Создание нового заказа
        $order = Orders::create([
            'users_id' => $user -> id,
        ]);
        $id_order = $order -> id;
        $id_user = $user -> id;
        foreach ($user->baskets as $basket) {
            Order_detail::create([
                'users_id' => $id_user,
                'orders_id' => $id_order,
                'products_id' => $basket->products_id,
                'count' => $basket->count,
                'price' => $basket->price
            ]);
        }

        $user -> baskets()->delete(); // Все работает

        return redirect()->route('basket')->with('message', 'Заказ успешно оформлен!');
    }

}
