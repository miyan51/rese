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
    <div class=" bg-white shadow-2xl border border-gray-300 rounded-2xl overflow-hidden w-3/4  absolute top-40 p-10">

      <div class="mb-10 flex justify-between mx-10">
        <form action="/userlist" method="post">
          @csrf
          <input type="text" class="rounded-md shadow-2xl " name="email">
          <button class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
            アドレスで検索
          </button>
        </form>

        <div>
          {{ $users->total() }}件中
          {{ $users->firstItem() }}〜{{ $users->lastItem() }} 件を表示
          {{ $users->appends(request()->input())->render('vendor.pagination.custom') }}
        </div>
      </div>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                ユーザー名
              </th>
              <th scope="col" class="px-6 py-3">
                メールアドレス
              </th>
              <th scope="col" class="px-6 py-3">
                権限
              </th>
              <th scope="col" class="px-6 py-3">

              </th>
            </tr>
          </thead>

          @foreach($users as $user)

          <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              {{$user -> name}}
            </th>
            <td class="px-6 py-4">
              {{$user -> email}}
            </td>
            <td class="px-6 py-4">
              @if($user -> role == 2)管理者 @endif
              @if($user -> role == 1)店舗責任者 @endif
              @if($user -> role == 0)ユーザー @endif
            </td>

            <!-- 権限付与ボタン -->
            <td class="px-6 py-4">
              @if($user -> role == 1)
              <form action="/authoritydel/{{$user -> id}}" method="post">
                @csrf
                <button class="px-4 py-1 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-600 rounded-lg hover:bg-red-400 focus:outline-none focus:ring focus:ring-red-100 focus:ring-opacity-80">
                  権限を剥奪
                </button>
              </form>
              @endif
              @if($user -> role == 0)
              <form action="/authorityadd/{{$user -> id}}" method="post">
                @csrf
                <button class="px-4 py-1 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                  権限を付与
                </button>
              </form>
              @endif
            </td>
          </tr>

          @endforeach
        </table>
      </div>

    </div>

  </main>

</body>

</html>