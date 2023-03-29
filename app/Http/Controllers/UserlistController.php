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

class UserlistController extends Controller
{
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
}
