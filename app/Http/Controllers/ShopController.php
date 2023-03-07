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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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
        $reserve = $id;


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



    // 権限付与
    function userlist(Request $request)
    {
        $users = User::query();

        $email = $request->email;
        if (!empty($email)) {
            $users->where('email', 'LIKE', "%{$email}%");
        }
        $users = $users->paginate(10);
        return view('userlist', compact('users'));
    }

    function authorityadd($id)
    {
        $user = User::find($id);
        $user->role = 1;
        $user->save();

        return redirect('/userlist');
    }
    function authoritydel($id)
    {
        $user = User::find($id);
        $user->role = 0;
        $user->save();

        return redirect('/userlist');
    }


    // 店舗編集
    function shopmanagement(Request $request)
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

        return view('shopmanagement', compact('shops', 'favorites'));
    }
    function shopedit($id)
    {
        $shop = Shop::find($id);

        return view('shopedit', compact('shop'));
    }
    function shopeditsave(Request $request)
    {

        $shop = Shop::find($request->id);

        if (!empty($request->shop)) {
            $shop->shop = $request->shop;
        }
        if (!empty($request->img)) {
            $shop->img = $request->img;
        }
        if (!empty($request->area)) {
            $shop->area = $request->area;
        }
        if (!empty($request->genre)) {
            $shop->genre = $request->genre;
        }
        if (!empty($request->introduction)) {
            $shop->introduction = $request->introduction;
        }
        $shop->save();

        return redirect('/shopmanagement');
    }
    function shopadd()
    {
        return view('shopadd');
    }
    function shopaddsave(Request $request)
    {
        $shop = new Shop();
        $shop->shop = $request->shop;

        $file_name = $request->file('img')->getClientOriginalName();
        $request->file('img')->storeAs('public/img', $file_name);
        $shop->path = 'storage/img/' . $file_name;

        $shop->area = $request->area;
        $shop->genre = $request->genre;
        $shop->introduction = $request->introduction;
        $shop->save();

        return redirect('/shopmanagement');
    }
    function shopdel($id)
    {
        $shop = Shop::find($id);
        $shop->delete();

        return redirect('/shopmanagement');
    }

    // 予約管理
    function reservelist(Request $request)
    {
        $shops = Shop::all();

        $reserves = Reserve::query();
        if (empty($request->done)) {
            $reserves->where('date', '>=', date('Y-m-d'));
        } else {
            $reserves->where('date', '<', date('Y-m-d'));
        }
        if (!empty($request->shop_id)) {
            $reserves->where('shop_id', $request->shop_id);
        }
        if (!empty($request->date)) {
            $reserves->where('date', $request->date);
        }



        $reserves = $reserves->paginate(15);
        return view('reservelist', compact('reserves', 'shops'));
    }
    function reservelistedit(Request $request, $id)
    {
        $reserve = Reserve::find($id);
        $reserve->date = $request->date;
        $reserve->time = $request->time;
        $reserve->number = $request->number;
        $reserve->save();

        return redirect('/reservelist');
    }
    function reservelistdel($id)
    {
        $reserve = Reserve::find($id);
        $reserve->delete();


        return redirect('/reservelist');
    }
    function mailmessage($id)
    {
        $user = User::find($id);
        return view('mailmessage', compact('user'));
    }
    function mailsend(Request $request)
    {
        $email = $request->email;
        $subject = $request->subject;
        Mail::send('emails.mail_reserve', [
            'messagetext' => $request->text,
        ], function ($message) use ($email, $subject) {
            $message->to($email)
                ->subject($subject);
        });
        return redirect('/reservelist');
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
