              <img class="h-40 rounded w-full object-cover object-center mb-4" src="{{ asset($shop->path) }}" alt="">

              <div class="mx-4">
                <h1 class="text-2xl text-gray-900 font-extrabold title-font mb-1">
                  <font style="vertical-align: inherit;">{{$shop->shop}}</font>
                </h1>
                <h2 class="tracking-widest text-gray-500 text-2xs font-medium title-font mb-4">
                  <font style="vertical-align: inherit;">#{{$shop->area}} #{{$shop->genre}}</font>
                </h2>

                <div class="flex justify-between">
                  <form action="/shopedit/{{$shop->id}}" method="post">
                    @csrf
                    <button class="rounded relative inline-flex group items-center justify-center px-3.5 py-1 mb-4 cursor-pointer border-b-4 border-l-2 active:border-blue-600 active:shadow-none shadow-lg bg-gradient-to-tr from-blue-600 to-blue-500 border-blue-600 text-white">
                      <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-white rounded-full group-hover:w-32 group-hover:h-32 opacity-10"></span>
                      <span class="relative">店舗情報編集
                      </span>
                    </button>
                  </form>
                  <form action="/shopdel/{{$shop->id}}" method="post">
                    @csrf
                    <button class="rounded relative inline-flex group items-center justify-center px-3.5 py-1 mb-4 cursor-pointer border-b-4 border-l-2 active:border-red-600 active:shadow-none shadow-lg bg-gradient-to-tr from-red-600 to-red-500 border-red-600 text-white">
                      <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-white rounded-full group-hover:w-32 group-hover:h-32 opacity-10"></span>
                      <span class="relative">店舗情報削除
                      </span>
                    </button>
                  </form>

                </div>
              </div>