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


  <section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 pt-24 mx-auto">
      <div class=" mx-auto flex flex-wrap ">
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 pr-10">
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
          <p class="leading-relaxed mt-6 text-xl">
            {{$shop->introduction}}
          </p>

          <div class="flex justify-between mt-8">
            <div class="">
              店員にご提示ください
              <div class="ml-4">
                {!! QrCode::generate('reservationID='.$reserve->id) !!}
              </div>
            </div>

            <div class="mt-8">
              <form action="{{ asset('charge') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="amount" value="1000">
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}" data-amount="1000" data-name="Stripe" data-label="￥1000を支払う" data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
                </script>
              </form>
            </div>
          </div>
        </div>

        <div id="app" class="container mx-auto lg:w-1/2 w-full mt-6 lg:mt-0  bg-blue-600 rounded-xl font-mono overflow-hidden relative">

          <div class=" px-10 pb-28">
            <form action="/reserveedit/{{$reserve->id}}" method="post">
              @csrf
              <h2 class="text-white text-3xl font-bold my-8">予約の変更</h2>


              <input v-model="date" type="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" class="block mb-4 rounded-xl border-none w-1/3 h-10" name="date">
              <select v-model="time" type="text" class="block mb-4 rounded-xl border-none w-full h-10" name="time">
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
              <select v-model="number" type="mumber" class="block mb-6 rounded-xl border-none w-full h-10" name="number">
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

              <div class="p-6 bg-blue-500 rounded-xl text-white text-2xl">
                <table>
                  <tr>
                    <td class="py-2 pr-24">Shop</td>
                    <td>{{$shop->shop}}</td>
                    <input type="text" hidden value="{{$shop->id}}" name="shop_id">
                  </tr>
                  <tr>
                    <td class="py-2 pr-24">Date</td>
                    <td>@{{ date }}</td>
                  </tr>
                  <tr>
                    <td class="py-2 pr-24">time</td>
                    <td>@{{ time }}</td>
                  </tr>
                  <tr>
                    <td class="py-2 pr-24">Number</td>
                    <td>@{{ number }}</td>
                  </tr>
                </table>
              </div>
            </form>
          </div>

          <button class="absolute bottom-0 bg-blue-800 w-full flex items-center justify-center h-16">
            <p class="text-2xl font-bold text-white ">変更内容を保存する</p>
          </button>

        </div>
      </div>
    </div>
  </section>








  <script>
    Vue.createApp({
      data: () => ({
        date: '2023-01-10',
        time: '10:00',
        number: '1',
      }),
      methods: {},
    }).mount('#app')
  </script>
</body>

</html>