<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>

  @vite('resources/css/app.css')
  @vite('resources/js/app.js')

  <meta name="csrf-token" content="{{ csrf_token() }}">

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
            @foreach($shops->unique('area') as $shop)
            <option value="{{$shop -> area}}">{{$shop -> area}}</option>
            @endforeach
          </select>

          <select name="genre" class="w-1/2 h-16 px-4 py-0 pl-2 text-gray-500 bg-transparent border-t border-b border-r border-transparent focus:ring-indigo-500 bo focus:border-indigo-500 pr-7 sm:text-sm font-extrabold">
            <option value="">All genre</option>
            @foreach($shops->unique('genre') as $shop)
            <option value="{{$shop -> genre}}">{{$shop -> genre}}</option>
            @endforeach
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
              @include('parts.card')
            </div>
          </div>

          @endforeach
        </div>
      </div>
    </section>

  </main>



</body>

</html>