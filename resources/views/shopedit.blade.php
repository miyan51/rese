<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  @vite('resources/css/app.css')
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>

<body class="mt-8 ">

  <header class="text-gray-600 body-font ">
    <div class="container mx-auto flex justify-between items-center pt-4">
      @include('parts.logo')
    </div>
  </header>

  <form action="/shopeditsave" method="post">
    @csrf
    <section class=" text-gray-600 body-font overflow-hidden">
      <div class="container px-5 pt-24 mx-auto ">
        <div class="container mx-auto flex flex-wrap h-full">
          <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 pr-10">
            <div class="flex items-center">
              <a href="/shopmanagement">
                <svg class="bg-gray-200 rounded-xl shadow-2xl border border-gray-100 " xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="bevel">
                  <path d="M15 18l-6-6 6-6" />
                </svg>
              </a>
              <h1 class="text-gray-900 text-3xl font-medium mb-1 ml-2 ">
                {{$shop->shop}}
              </h1>
            </div>
            <img class="w-full lg:h-auto h-64 object-cover object-center rounded mt-8" src="{{ asset($shop->path) }}">
            <p class="mt-6 text-xl">#{{$shop->area}} #{{$shop->genre}}</p>
            <p class="leading-relaxed mt-6 text-xl">
              {{$shop->introduction}}
            </p>
          </div>


          <div class="container mx-auto lg:w-1/2 w-full mt-6 lg:mt-0  bg-blue-600 rounded-xl font-mono overflow-hidden relative h-full pb-20">

            <div class=" px-10">
              <h1 class="text-white text-3xl font-bold my-8">店舗情報編集</h1>
            </div>
            <div class="container px-20">


              <div class="mb-6">
                <label for="shop" class="block text-lg font-medium text-white dark:text-white">店名</label>
                <input name="shop" type="shop" id="shop" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{$shop->shop}}">

                <label for="img" class="block text-lg font-medium text-white dark:text-white mt-2">img</label>
                <input name="img" type="text" id="img" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{ asset($shop->path) }}">

                <label for=" area" class="block text-lg font-medium text-white dark:text-white mt-2">エリア</label>
                <input name="area" type="text" id="area" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{$shop->area}}">

                <label for=" genre" class="block text-lg font-medium text-white dark:text-white mt-2">ジャンル</label>
                <input name="genre" type="text" id="genre" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" value="{{$shop->genre}}">

                <label for=" introduction" class="block text-lg font-medium text-white dark:text-white mt-2">紹介文</label>
                <textarea name="introduction" id="introduction" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{$shop->introduction}}"></textarea>

                <input name="id" value="{{$shop->id}}" hidden>

              </div>
            </div>



            <button class=" absolute bottom-0 bg-blue-800 w-full flex items-center justify-center h-16">
              <p class="text-2xl font-bold text-white ">保存する</p>
            </button>


          </div>
        </div>
      </div>
    </section>
  </form>


</body>

</html>