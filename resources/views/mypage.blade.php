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
    <div class="flex flex-wrap">

      <div class="mt-20 lg:w-1/3 w-full pr-8">
        <h3 class="text-2xl font-extrabold mb-4">予約状況</h3>


        @foreach($reserves as $reserves)
        <div class="bg-blue-600 text-white rounded-xl p-6 mb-4 shadow-2xl">
          <div class="flex justify-between">
            <div class="flex items-center">
              @include('parts.clock')
              <p class="ml-6">予約1</p>
            </div>

            <!-- 削除-->
            <form action="/reservedel/{{ $reserves->id }}" method="post">
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
          <table class="mt-4 space-y-4">
            <tr class="">
              <th class="py-2 pr-12 text-left">Shop</th>
              <td class=" ">{{$reserves->shop->shop}}</td>
            </tr>
            <tr>
              <th class="py-2 pr-12 text-left">Date</th>
              <td>{{$reserves->date}}</td>
            </tr>
            <tr>
              <th class="py-2 pr-12 text-left">Time</th>
              <td>{{$reserves->time}}</td>
            </tr>
            <tr>
              <th class="py-2 pr-12 text-left">Number</th>
              <td>{{$reserves->number}}</td>
            </tr>
          </table>
        </div>

        @endforeach



      </div>

      <div class=" lg:w-2/3">
        <h2 class="text-4xl font-extrabold">testさん</h2>
        <h3 class="text-2xl font-extrabold mt-8">お気に入り店舗</h3>

        <section class="text-gray-600 body-font ">
          <div class="container px-5 py-12 mx-auto">

            <div class="flex flex-wrap -m-4">

              @foreach($shops as $shop)
              <div class="md:w-1/2 p-2">
                <div class="bg-gray-100 border border-gray-300 shadow-2xl rounded-2xl ">
                  <img class="h-40 rounded w-full object-cover object-center mb-4" src="{{$shop->img}}" alt="">

                  <div class="mx-4">
                    <h2 class="text-2xl text-gray-900 font-extrabold title-font mb-1">
                      <font style="vertical-align: inherit;">{{$shop->shop}}</font>
                    </h2>
                    <h3 class="tracking-widest text-gray-500 text-2xs font-medium title-font mb-4">
                      <font style="vertical-align: inherit;">#{{$shop->area}} #{{$shop->genre}}</font>
                    </h3>

                    <div class="flex justify-between">
                      <a href="#_" class="rounded relative inline-flex group items-center justify-center px-3.5 py-1 mb-4 cursor-pointer border-b-4 border-l-2 active:border-blue-600 active:shadow-none shadow-lg bg-gradient-to-tr from-blue-600 to-blue-500 border-blue-600 text-white">
                        <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-white rounded-full group-hover:w-32 group-hover:h-32 opacity-10"></span>
                        <span class="relative">詳しく見る</span>
                      </a>

                      <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                          <path class="fill-red-700 " d="M14 20.408c-.492.308-.903.546-1.192.709-.153.086-.308.17-.463.252h-.002a.75.75 0 0 1-.686 0 16.709 16.709 0 0 1-.465-.252 31.147 31.147 0 0 1-4.803-3.34C3.8 15.572 1 12.331 1 8.513 1 5.052 3.829 2.5 6.736 2.5 9.03 2.5 10.881 3.726 12 5.605 13.12 3.726 14.97 2.5 17.264 2.5 20.17 2.5 23 5.052 23 8.514c0 3.818-2.801 7.06-5.389 9.262A31.146 31.146 0 0 1 14 20.408Z "></path>
                        </svg>
                      </a>
                    </div>
                  </div>
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