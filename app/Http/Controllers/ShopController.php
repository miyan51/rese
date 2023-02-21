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

        $user_id = Auth::user()->id;
        $favorites = Favorite::All();
        $favorites = $favorites->where('user_id', $user_id);
        $favorites = $favorites->pluck("shop_id")->toArray();


        return view('index', compact('shops', 'favorites'));
    }
    function reselogin()
    {

        return view('reselogin');
    }
    function reseregistration()
    {
        Auth::logout();
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
    function favoriteadd($id)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::user()->id;
        $favorite->shop_id = $id;
        $favorite->save();

        return back();
    }
    function favoritedel($id)
    {
        $user_id = Auth::user()->id;
        $favorite = Favorite::where('user_id', $user_id)->where('shop_id', $id);
        $favorite->delete();

        return back();
    }

    function reserve($id)
    {
        $shop = Shop::find($id);

        return view('reserve', compact('shop'));
    }
    function reserveadd(Request $request)
    {
        $reserve = new Reserve();
        $reserve->user_id = Auth::user()->id;
        $reserve->shop_id = $request->shop_id;
        $reserve->date = $request->date;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();

        return redirect('done');
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

        $favorites = Favorite::All();
        $favorites->where('user_id', $user_id);
        $favorites = $favorites->pluck("shop_id")->toArray();

        return view('mypage', compact('shops', 'reserves', 'favorites'));
    }
    function reservedel($id)
    {
        $reserve = Reserve::find($id);
        $reserve->delete();
        return back();
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
