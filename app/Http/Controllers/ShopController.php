<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    function index(Request $request)
    {
        $shops = Shop::query();

        $area = $request->area;
        if (!empty($area)) {
            $shops->where('area', $area);
        }

        $genre = $request->genre;
        if (!empty($genre)) {
            $shops->where('genre', $genre);
        }

        $text = $request->text;
        if (!empty($text)) {
            $shops->where('shop', 'LIKE', "%{$text}%");
        }

        $shops = $shops->get();

        return view('index', compact('shops'));
    }
    function reselogin()
    {

        return view('reselogin');
    }
    function reseregistration()
    {

        return view('reseregistration');
    }
    function done()
    {

        return view('done');
    }
    function thanks()
    {

        return view('thanks');
    }
    function menu1()
    {

        return view('menu1');
    }
    function menu2()
    {

        return view('menu2');
    }
    function reserve($id)
    {
        $shop = Shop::find($id);

        return view('reserve', compact('shop'));
    }
    function mypage()
    {
        $user_id = Auth::user()->id;

        $reserves = Reserve::all();
        $reserves = $reserves->wherein('user_id', $user_id);

        $shops = Shop::all();
        $favorite = Favorite::all();
        $favorite = $favorite->wherein('user_id', $user_id);
        $favorite_shop_id = $favorite->pluck('shop_id');
        $shops = $shops->wherein('id', $favorite_shop_id);

        return view('mypage', compact('shops', 'reserves'));
    }
    function reservedel($id)
    {
        $reserve = Reserve::find($id);
        $reserve->delete();
        return redirect('/mypage');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
