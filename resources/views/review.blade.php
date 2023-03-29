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

  <form action="/reviewadd" method="post">
    @csrf
    <section class="text-gray-600 body-font overflow-hidden">
      <div class="container px-5 pt-24 mx-auto">
        <div class=" mx-auto flex flex-wrap h-full">
          <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 lg:mt-0 pr-10">
            <div class="flex items-center">
              <a href="{{route('mypage')}}">
                <svg class="bg-gray-200 rounded-xl shadow-2xl border border-gray-100 " xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="bevel">
                  <path d="M15 18l-6-6 6-6" />
                </svg>
              </a>
              <h1 class="text-gray-900 text-3xl font-medium mb-1 ml-2 ">
                {{$shop->shop}}
              </h1>
            </div>
            <img alt="eコマース" class="w-full lg:h-auto h-64 object-cover object-center rounded mt-8" src="{{ asset($shop->path) }}">
            <div class="">
            </div>
            <p class="mt-6 text-xl">#{{$shop->area}} #{{$shop->genre}}</p>
            <p class="leading-relaxed my-6 text-xl">
              {{$shop->introduction}}
            </p>
          </div>

          <form action="" method="post" class="">
            @csrf
            <div class="container mt-auto lg:w-1/2 w-full lg:mt-20  bg-blue-600 rounded-xl font-mono overflow-hidden relative h-1/2 ">

              <div class="">
                <h1 class="text-white text-3xl font-bold my-6 text-center">ご来店ありがとうございました</h1>
                <h2 class="text-white text-2xl font-bold text-center">サービスはいかがでしたか？</h2>
                <h3 class="text-white text-xl font-bold text-center">よろしければ、ご感想をお聞かせください</h3>


                <div class="flex justify-center">
                  <div class="rate-form">
                    <input id="star5" type="radio" name="evaluation" value="5">
                    <label for="star5">★</label>
                    <input id="star4" type="radio" name="evaluation" value="4">
                    <label for="star4">★</label>
                    <input id="star3" type="radio" name="evaluation" value="3">
                    <label for="star3">★</label>
                    <input id="star2" type="radio" name="evaluation" value="2">
                    <label for="star2">★</label>
                    <input id="star1" type="radio" name="evaluation" value="1">
                    <label for="star1">★</label>
                  </div>
                </div>



              </div>
              <div class="flex justify-center h-full mb-10">
                <textarea type="text" class="m-10 w-full h-20" name="review"></textarea>
              </div>

              <input type="hidden" name="reserve_id" value="{{$reserve}}">

              <button class=" absolute bottom-0 bg-blue-800 w-full flex items-center justify-center h-16">
                <p class="text-2xl font-bold text-white ">内容を保存する</p>
              </button>
            </div>

          </form>
        </div>
      </div>
    </section>
  </form>


</body>

</html>