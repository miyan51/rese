<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  @vite('resources/css/app.css')
</head>

<body class="container mx-auto mt-8">

  <header class="text-gray-600 body-font pt-2">
    <div class="container mx-auto flex justify-between items-center">

      @include('parts.logo')

      <form action="/" method="get" class="relative mt-1 shadow-xl shadow-black/20 flex w-1/2 border border-gray-300 rounded-2xl">
        @csrf

        <div class="right-0 flex items-center w-1/3">
          <select name="area" class=" w-1/2 h-16 px-4 py-0 pl-2 text-gray-500 bg-transparent border-t border-b border-r border-transparent focus:ring-indigo-500 bo focus:border-indigo-500 pr-7 sm:text-sm rounded-l-md font-extrabold">
            <option value="">All area</option>
            <option value="東京都">東京都</option>
            <option value="大阪府">大阪府</option>
            <option value="福岡県">福岡県</option>
          </select>

          <select name="genre" class="w-1/2 h-16 px-4 py-0 pl-2 text-gray-500 bg-transparent border-t border-b border-r border-transparent focus:ring-indigo-500 bo focus:border-indigo-500 pr-7 sm:text-sm font-extrabold">
            <option value="">All genre</option>
            <option value="寿司">寿司</option>
            <option value="焼肉">焼肉</option>
            <option value="居酒屋">居酒屋</option>
            <option value="イタリアン">イタリアン</option>
            <option value="ラーメン">ラーメン</option>
          </select>
        </div>

        <input type="text" name="text" class="w-2/3 h-16 px-4 py-2 pr-12 border-white  focus:ring-indigo-500 focus:border-indigo-500 pl-3 sm:text-sm rounded-r-md" placeholder="Search  ..." />
      </form>
    </div>
  </header>

  <main>


    <section class="text-gray-600 body-font ">
      <div class="container px-5 py-24 mx-auto">

        <div class="flex flex-wrap -m-4">

          @foreach($shops as $shop)
          <div class="xl:w-1/4 md:w-1/2 p-2">
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
                  <form action="/reserve/{{ $shop->id }}" method="post">
                    @csrf
                    <button class="rounded relative inline-flex group items-center justify-center px-3.5 py-1 mb-4 cursor-pointer border-b-4 border-l-2 active:border-blue-600 active:shadow-none shadow-lg bg-gradient-to-tr from-blue-600 to-blue-500 border-blue-600 text-white">
                      <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-white rounded-full group-hover:w-32 group-hover:h-32 opacity-10"></span>
                      <span class="relative">詳しく見る</span>
                    </button>
                  </form>

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

  </main>





</body>

</html>