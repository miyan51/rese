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

  <form action="/mailsend" method="post">
    @csrf
    <section class=" text-gray-600 body-font overflow-hidden mt-20">

      <div class="container mx-auto lg:w-2/3 w-full mt-6 lg:mt-0  bg-blue-600 rounded-xl font-mono overflow-hidden relative h-full pb-20">

        <div class=" px-10">
          <h1 class="text-white text-3xl font-bold my-8">{{$user -> email}}へメールを送信</h1>
        </div>
        <div class="container px-20">


          <div class="mb-6">
            <label for="subject" class="block text-lg font-medium text-white dark:text-white">件名</label>
            <input name="subject" type="text" id="subject" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light " required>


            <label for=" text" class="block text-lg font-medium text-white dark:text-white mt-2">紹介文</label>
            <textarea name="text" id="text" rows="12" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
          </div>
        </div>

        <input type="hidden" name="email" value="{{$user -> email}}">

        <button class=" absolute bottom-0 bg-blue-800 w-full flex items-center justify-center h-16">
          <p class="text-2xl font-bold text-white ">送信する</p>
        </button>


      </div>
      </div>
      </div>
    </section>
  </form>


</body>

</html>