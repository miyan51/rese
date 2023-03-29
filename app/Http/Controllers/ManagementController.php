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

class ManagementController extends Controller
{
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
    function shopaddsave(ShopAddRequest $request)
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

    // メール送信
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
}
