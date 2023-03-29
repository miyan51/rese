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

  <main class="container mx-auto">
    <div class="container flex flex-wrap">

      <div class="ontainer mt-20 lg:w-1/3 w-full pr-8">
        <h3 class="text-2xl font-extrabold mb-4">予約状況</h3>


        <!-- 生きた予約のカウント用変数 -->
        <?php $i = 1; ?>


        @foreach($reserves as $reserve)

        @if(date('Y-m-d') <= $reserve->date && strtotime(date('G:i:S')) <= strtotime($reserve->time))
            <div class="bg-blue-600 text-white rounded-xl p-6 mb-4 shadow-2xl @if(in_array($reserve->id , $history)) hidden @endif">

              <div class="flex justify-between">
                <div class="flex items-center">
                  @include('parts.clock')
                  <p class="ml-6">予約 {{$i++}}</p>
                </div>

                <!-- 削除-->
                <form action="/reservedel/{{ $reserve->id }}" method="post">
                  @csrf
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                      <circle cx="12" cy="12" r="10"></circle>
                      <line x1="15" y1="9" x2="9" y2="15"></line>
                      <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                  </button>
                </form>
              </div>

              <div class="flex ">
                <table class="mt-4 space-y-4 ">
                  <tr class="">
                    <th class="py-2 pr-12 text-left">Shop</th>
                    <td class=" ">{{$reserve->shop->shop}}</td>
                  </tr>
                  <tr>
                    <th class="py-2 pr-12 text-left">Date</th>
                    <td>{{$reserve->date}}</td>
                  </tr>
                  <tr>
                    <th class="py-2 pr-12 text-left">Time</th>
                    <td>{{date('G:i', strtotime($reserve->time))}}</td>
                  </tr>
                  <tr>
                    <th class="py-2 pr-12 text-left">Number</th>
                    <td>{{$reserve->number}}</td>
                  </tr>
                </table>

                <form action="/reservationchange/{{ $reserve->id }}" method="post">
                  @csrf
                  <button class="h-10 rounded relative inline-flex group items-center justify-center px-3.5 py-1 mb-4 cursor-pointer active:shadow-none shadow-lg bg-gradient-to-tr from-blue-400 to-blue-500  text-white mt-40">
                    <span class="">予約内容</span>
                  </button>
                </form>
              </div>
            </div>


            @else
            <div class="bg-gray-500 text-white rounded-xl p-6 mb-4 shadow-2xl @if(in_array($reserve->id , $history)) hidden @endif">
              <div class="flex justify-between">
                <div class="flex items-center">
                  @include('parts.clock')
                </div>

                <!-- 非表示-->
                <form action="/reservehidden/{{ $reserve->id }}" method="post">
                  @csrf
                  <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                      <circle cx="12" cy="12" r="10"></circle>
                      <line x1="15" y1="9" x2="9" y2="15"></line>
                      <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                  </button>
                </form>
              </div>

              <div class="flex ">
                <table class="mt-4 space-y-4 ">
                  <tr class="">
                    <th class="py-2 pr-12 text-left">Shop</th>
                    <td class=" ">{{$reserve->shop->shop}}</td>
                  </tr>
                  <tr>
                    <th class="py-2 pr-12 text-left">Date</th>
                    <td>{{$reserve->date}}</td>
                  </tr>
                  <tr>
                    <th class="py-2 pr-12 text-left">Time</th>
                    <td>{{date('G:i', strtotime($reserve->time))}}</td>
                  </tr>
                  <tr>
                    <th class="py-2 pr-12 text-left">Number</th>
                    <td>{{$reserve->number}}</td>
                  </tr>
                </table>

                <form action="/review/{{ $reserve->id }}" method="post">
                  @csrf
                  <button class="ml-5 h-10 rounded relative inline-flex group items-center justify-center px-3.5 py-1 mb-4 cursor-pointer active:shadow-none shadow-lg bg-gradient-to-tr from-blue-400 to-blue-500  text-white mt-40">
                    <span class="">評価する</span>
                  </button>
                </form>
              </div>
            </div>
            @endif
            @endforeach
      </div>


      <div class="ontainer lg:w-2/3">
        <h2 class="text-4xl font-extrabold">{{$name}} さん</h2>
        <h3 class="text-2xl font-extrabold mt-8">お気に入り店舗</h3>

        <section class="text-gray-600 body-font ">
          <div class="container px-5 py-12 mx-auto">

            <div class="flex flex-wrap -m-4">

              @foreach($shops as $shop)
              <div class="md:w-1/2 p-2">
                <div class="bg-gray-100 border border-gray-300 shadow-2xl rounded-2xl ">
                  @include('parts.card')
                </div>
              </div>

              @endforeach
            </div>
          </div>
        </section>
      </div>


    </div>
  </main>

</body>

</html>