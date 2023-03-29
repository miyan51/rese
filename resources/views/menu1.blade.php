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
    <a class="container mx-auto flex justify-between items-center pt-4 ml-20 " href="/">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="60" height="60" viewBox="0 0 500 500" xml:space="preserve">
        <desc>Created with Fabric.js 4.6.0</desc>
        <defs>
        </defs>
        <g transform="matrix(1.67 0 0 1.67 250 250)" id="vEgBWXx0BXsfPs9y925Xa">
          <path style="stroke: rgb(36,149,73); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,76,156); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke" transform=" translate(0, 0)" d="M -140.21382 -80.72613 C -140.21382 -113.58027 -113.58028 -140.21381 -80.72614 -140.21381 L 80.72612 -140.21381 L 80.72612 -140.21381 C 113.58026 -140.21381 140.2138 -113.58027 140.2138 -80.72613 L 140.2138 80.72614 L 140.2138 80.72614 C 140.2138 113.58028 113.58026 140.21382 80.72612 140.21382 L -80.72614 140.21382 L -80.72614 140.21382 C -113.58028 140.21382 -140.21382 113.58028 -140.21382 80.72614 z" stroke-linecap="round" />
        </g>
        <g transform="matrix(1 0 0 1 106.09 115.54)" id="QB3-fJyyjkTuSaxDBDfCZ">
          <path style="stroke: rgb(0,0,0); stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-opacity: 0; fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke" transform=" translate(0, 0)" d="M 0 0" stroke-linecap="round" />
        </g>
        <g transform="matrix(3.85 0 0 3.85 250 250)" id="OF33rQBLEe3QryF_wGz1F">
          <path style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke" transform=" translate(-40, -40)" d="M 63.366 80 L 40 56.634 L 16.634 80 L 0 63.366 L 23.366 40 L 0 16.634 L 16.634 0 L 40 23.366 L 63.366 0 L 80 16.634 L 56.634 40 L 80 63.366 L 63.366 80 z" stroke-linecap="round" />
        </g>
      </svg>
    </a>
  </header>

  <main class="flex justify-center ">
    <div class="mt-20 font-bold text-blue-600 text-2xl w-1/2 h-1/2 text-center ">
      <a class="block text-4xl mt-4" href="/">Home</a>
      <a class="block text-4xl mt-4" href="/logout">Logout</a>
      <a class="block text-4xl mt-4" href="/mypage">Mypage</a>

      @can('manager')
      <a class="block text-4xl mt-20" href="/shopmanagement">店舗情報管理</a>
      <a class="block text-4xl mt-4" href="/reservelist">予約情報管理</a>
      @endcan
      @can('admin')
      <a class="block text-4xl mt-8" href="/userlist">管理者権限付与</a>
      @endcan
    </div>


  </main>

</body>

</html>