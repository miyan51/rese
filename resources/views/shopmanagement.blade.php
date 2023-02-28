<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="container mx-auto mt-8">

  <header class="text-gray-600 body-font pt-2">
    <div class="container mx-auto flex justify-between items-center">

      @include('parts.logo')

      <form action="/shopmanagement" method="get" class="relative mt-1 shadow-xl shadow-black/20 flex w-1/2 border border-gray-300 rounded-2xl">
        @csrf

        <select name="area" class=" w-2/5 h-16 px-4 py-0 pl-2 text-gray-500 bg-transparent border-t border-b border-r border-transparent focus:ring-indigo-500 bo focus:border-indigo-500 pr-7 sm:text-sm rounded-l-md font-extrabold">
          <option value="">All area</option>
          @foreach($shops->unique('area') as $shop)
          <option value="{{$shop -> area}}">{{$shop -> area}}</option>
          @endforeach
        </select>

        <select name="genre" class="w-2/5 h-16 px-4 py-0 pl-2 text-gray-500 bg-transparent border-t border-b border-r border-transparent focus:ring-indigo-500 bo focus:border-indigo-500 pr-7 sm:text-sm font-extrabold">
          <option value="">All genre</option>
          @foreach($shops->unique('genre') as $shop)
          <option value="{{$shop -> genre}}">{{$shop -> genre}}</option>
          @endforeach
        </select>
        <button class="rounded relative inline-flex group items-center justify-center  cursor-pointer border-b-4 border-l-2 active:border-blue-600 active:shadow-none shadow-lg bg-gradient-to-tr from-blue-600 to-blue-500 border-blue-600 text-white w-1/5">
          検索
        </button>
      </form>
    </div>

  </header>

  <main>


    <section class="text-gray-600 body-font ">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-4">

          <a href="/shopadd" class="bg-gray-800 border border-gray-300 shadow-2xl rounded-2xl flex justify-center py-32 xl:w-1/4 md:w-1/2 p-2">
            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24" aria-labelledby="addIconTitle" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none" color="white">
              <path d="M17 12L7 12M12 17L12 7" />
              <circle cx="12" cy="12" r="10" />
            </svg>
          </a>

          @foreach($shops as $shop)
          <div class="xl:w-1/4 md:w-1/2 p-2">
            <div class="bg-gray-100 border border-gray-300 shadow-2xl rounded-2xl ">
              @include('parts.managementcard')
            </div>
          </div>

          @endforeach
        </div>
      </div>
    </section>

  </main>




</body>

</html>