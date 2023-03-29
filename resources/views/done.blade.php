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

  <main class="flex justify-center min-h-screen bg-gray-100 ">
    <div class=" mt-4 bg-white shadow-2xl border border-gray-300 rounded-2xl overflow-hidden w-1/2 absolute top-80 py-16">
      <h1 class="text-center font-bold text-2xl tracking-widest">ご予約ありがとうございます</h1>
      <div class="text-center mt-10 mb-4">
        <form action="/mypage" method="get">
          @csrf
          <button class="px-8 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-900 tracking-widest ">戻る</button>
        </form>
      </div>
    </div>
  </main>

</body>

</html>