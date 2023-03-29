<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reserve;
use App\Models\History;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\ShopAddRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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


        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $favorites = Favorite::All();
            $favorites = $favorites->where('user_id', $user_id);
            $favorites = $favorites->pluck("shop_id")->toArray();
        } else {
            $favorites = null;
        }

        return view('index', compact('shops', 'favorites'));
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
    function reserveadd(ReserveRequest $request)
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
    function reservationchange($id)
    {
        $shop = Reserve::find($id)->shop;
        $reserve = Reserve::find($id);


        return view('reservationchange', compact('shop', 'reserve'));
    }
    function reserveedit(ReserveRequest $request, $id)
    {
        $reserve = Reserve::find($id);
        $reserve->date = $request->date;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();

        return redirect('mypage');
    }
    function mypage()
    {
        $user_id = Auth::user()->id;

        $reserves = Reserve::all();
        $reserves = $reserves->wherein('user_id', $user_id);
        $reserves = $reserves->sortBy('date');

        $shops = Shop::all();
        $favorite = Favorite::all();
        $favorite = $favorite->wherein('user_id', $user_id);
        $favorite_shop_id = $favorite->pluck('shop_id');
        $shops = $shops->wherein('id', $favorite_shop_id);

        $favorites = Favorite::All();
        $favorites->where('user_id', $user_id);
        $favorites = $favorites->pluck("shop_id")->toArray();

        $name = Auth::user()->name;

        $history = History::pluck('reserve_id')->toArray();



        return view('mypage', compact('shops', 'reserves', 'favorites', 'name', 'history'));
    }
    function reservedel($id)
    {
        $reserve = Reserve::find($id);
        $reserve->delete();
        return back();
    }
    function review($id)
    {
        $shop = Reserve::find($id)->shop;
        $reserve = $id;


        return view('review', compact('shop', 'reserve'));
    }
    function reviewadd(Request $request)
    {
        $history = new History();
        $history->evaluation = $request->evaluation;
        $history->review = $request->review;
        $history->reserve_id = $request->reserve_id;
        $history->save();

        return redirect('/mypage');
    }
    function reservehidden($id)
    {
        $history = new History();
        $history->reserve_id = $id;
        $history->save();

        return redirect('/mypage');
    }



    // 認証
    function reselogin()
    {

        return view('reselogin');
    }
    function reseregistration()
    {
        Auth::logout();
        return view('reseregistration');
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
