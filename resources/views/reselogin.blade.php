<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  @vite('resources/css/app.css')
</head>

<body class="container mx-auto mt-8">

  <header class="text-gray-600 body-font">
    <div class="container mx-auto flex justify-between items-center pt-4">
      @include('parts.logo')
    </div>
  </header>

  <main class="flex items-center justify-center min-h-screen bg-gray-100 ">
    <div class="mt-4 text-left bg-white shadow-lg border border-gray-400 rounded-2xl overflow-hidden w-1/2 absolute top-80">
      <div class=" bg-blue-600 h-20 flex items-center ">
        <h3 class="text-2xl font-bold text-white ml-4">Login</h3>
      </div>

      <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-4 px-12 ">
          <div class="flex">
            <svg class="mt-2 mx-2" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
              <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
            <x-input type="email" placeholder="Email" class="w-full px-4 py-3 mt-2 focus:outline-none focus:ring-1 focus:ring-blue-600 border-x-0 border-t-0 " name="email" :value="old('email')" required autofocus />
          </div>

          <div class="mt-4 flex items-center">
            <svg class="mt-2 mx-2" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <x-input type="password" placeholder="Password" class="w-full px-4 py-3 mt-2 focus:outline-none focus:ring-1 focus:ring-blue-600 border-x-0 border-t-0" name="password" required autocomplete="current-password" />
          </div>

          <div class="flex items-baseline justify-end py-4 ">
            <x-button class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900 tracking-widest">ログイン</x-button>

          </div>
        </div>
      </form>
    </div>
  </main>

</body>

</html>