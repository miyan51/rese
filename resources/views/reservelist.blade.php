<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  @vite('resources/css/app.css')
</head>

<body class="mt-8 ">

  <header class="text-gray-600 body-font ">
    <div class="container mx-auto flex justify-between items-center pt-4">
      @include('parts.logo')
    </div>
  </header>

  <main class=" flex justify-center min-h-screen bg-gray-100 ">
    <div class=" bg-white shadow-2xl border border-gray-300 rounded-2xl overflow-hidden w-3/4 absolute top-40 p-10 ">

      <div class="mb-10 flex justify-between mx-10 ">
        <form action="/reservelist" method="post">
          @csrf
          <select type="number" class="rounded-xl border-gray-400" name="shop_id">
            <option value="" selected>店舗名</option>
            @foreach($shops as $shop)
            <option value="{{ $shop->id }}">{{ $shop->shop }}</option>
            @endforeach
          </select>

          <input class="rounded-xl border-gray-400" type="date" name="date" value="">
          <select type="text" class="rounded-xl border-gray-400 " name="done">
            <option value="" selected>未来分</option>
            <option value="1">過去分</option>
          </select>

          <button class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
            検索
          </button>
        </form>

        <div>
          {{ $reserves->total() }}件中
          {{ $reserves->firstItem() }}〜{{ $reserves->lastItem() }} 件を表示
          {{ $reserves->appends(request()->input())->render('vendor.pagination.custom') }}
        </div>
      </div>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                店舗
              </th>
              <th scope="col" class="px-6 py-3">
                ユーザー名
              </th>
              <th scope="col" class="px-6 py-3">
                日にち
              </th>
              <th scope="col" class="px-6 py-3">
                時間
              </th>
              <th scope="col" class="px-6 py-3">
                人数
              </th>
              <th scope="col" class="px-6 py-3">
                評価
              </th>
              <th scope="col" class="px-6 py-3">
              </th>
              <th scope="col" class="px-6 py-3">
              </th>
            </tr>
          </thead>

          @foreach($reserves as $reserve)


          <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 h-4">
            <td scope="row" class="px-6 font-medium text-gray-500 whitespace-nowrap dark:text-white">
              {{ $reserve->shop->shop }}
            </td>
            <td class="px-6 ">
              <form action="/mailmessage/{{ $reserve->user->id }}" method="post">
                @csrf
                <button class="px-4 py-1 font-medium tracking-wide  capitalize transition-colors duration-300 transform  rounded-lg hover:bg-blue-200 focus:outline-none focus:ring focus:ring-blue-100 focus:ring-opacity-80">{{ $reserve->user->name }}</button>
              </form>
            </td>
            
            <form action="/reservelistedit/{{ $reserve->id }}" method="post">
              @csrf
              <td class="">
                <input class=" border-none" type="date" name="date" value="{{ $reserve->date }}">
              </td>

              <td class="">
                <select type="text" class="rounded-xl border-none px-8" name="time">
                  <option value="{{date('G:i', strtotime($reserve->time))}}" selected>{{date('G:i', strtotime($reserve->time))}}</option>
                  <option value="10:00">10:00</option>
                  <option value="10:30">10:30</option>
                  <option value="11:00">11:00</option>
                  <option value="11:30">11:30</option>
                  <option value="12:00">12:00</option>
                  <option value="12:30">12:30</option>
                  <option value="13:00">13:00</option>
                  <option value="13:30">13:30</option>
                  <option value="14:00">14:00</option>
                  <option value="14:30">14:30</option>
                  <option value="15:00">15:00</option>
                  <option value="15:30">15:30</option>
                  <option value="16:00">16:00</option>
                  <option value="16:30">16:30</option>
                  <option value="17:00">17:00</option>
                  <option value="17:30">17:30</option>
                  <option value="18:00">18:00</option>
                  <option value="18:30">18:30</option>
                  <option value="19:00">19:00</option>
                  <option value="19:30">19:30</option>
                  <option value="20:00">20:00</option>
                </select>
              </td>
              <td class="">
                <select type="text" class="rounded-xl border-none px-6" name="number">
                  <option value="{{ $reserve->number }}">{{ $reserve->number }}人</option>
                  <option value="1">1人</option>
                  <option value="2">2人</option>
                  <option value="3">3人</option>
                  <option value="4">4人</option>
                  <option value="5">5人</option>
                  <option value="6">6人</option>
                  <option value="7">7人</option>
                  <option value="8">8人</option>
                  <option value="9">9人</option>
                  <option value="10">10人</option>
                  <option value="11">11人</option>
                  <option value="12">12人</option>
                  <option value="13">13人</option>
                  <option value="14">14人</option>
                  <option value="15">15人</option>
                  <option value="16">16人</option>
                  <option value="17">17人</option>
                  <option value="18">18人</option>
                  <option value="19">19人</option>
                  <option value="20">20人</option>
                </select>
              </td>
              <td class="px-6">
                @if(!empty( $reserve->history->first()->evaluation ))
                {{$reserve->history->first()->evaluation}}
                @endif
              </td>

              <td class="">
                <button class="px-4 py-1 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-green-600 rounded-lg hover:bg-green-500 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-80">
                  変更を保存
                </button>
              </td>
            </form>

            <td class="">
              <form action="/reservelistdel/{{ $reserve->id }}" method="post">
                @csrf
                <button class="px-4 py-1 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-500 rounded-lg hover:bg-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-80">
                  削除
                </button>
              </form>
            </td>
          </tr>

          @endforeach
        </table>
      </div>

    </div>

  </main>

</body>

</html>