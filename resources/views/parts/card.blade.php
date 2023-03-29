              <img class="h-40 rounded w-full object-cover object-center mb-4" src=" {{ asset($shop->path) }}" alt="">

              <div class="mx-4">
                <h1 class="text-2xl text-gray-900 font-extrabold title-font mb-1">
                  <font style="vertical-align: inherit;">{{$shop->shop}}</font>
                </h1>
                <h2 class="tracking-widest text-gray-500 text-2xs font-medium title-font mb-4">
                  <font style="vertical-align: inherit;">#{{$shop->area}} #{{$shop->genre}}</font>
                </h2>

                <div class="flex justify-between">
                  <form action="/reserve/{{ $shop->id }}" method="post">
                    @csrf
                    <button class="rounded relative inline-flex group items-center justify-center px-3.5 py-1 mb-4 cursor-pointer border-b-4 border-l-2 active:border-blue-600 active:shadow-none shadow-lg bg-gradient-to-tr from-blue-600 to-blue-500 border-blue-600 text-white">
                      <span class="absolute w-0 h-0 transition-all duration-300 ease-out bg-white rounded-full group-hover:w-32 group-hover:h-32 opacity-10"></span>
                      <span class="relative">詳しく見る</span>
                    </button>
                  </form>

                  @auth
                  @if(in_array($shop->id , $favorites))
                  <form action="/favoritedel/{{ $shop->id }}" method="post">
                    @csrf
                    <button type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                        <path class="fill-red-700 " d="M14 20.408c-.492.308-.903.546-1.192.709-.153.086-.308.17-.463.252h-.002a.75.75 0 0 1-.686 0 16.709 16.709 0 0 1-.465-.252 31.147 31.147 0 0 1-4.803-3.34C3.8 15.572 1 12.331 1 8.513 1 5.052 3.829 2.5 6.736 2.5 9.03 2.5 10.881 3.726 12 5.605 13.12 3.726 14.97 2.5 17.264 2.5 20.17 2.5 23 5.052 23 8.514c0 3.818-2.801 7.06-5.389 9.262A31.146 31.146 0 0 1 14 20.408Z "></path>
                      </svg>
                    </button>
                  </form>
                  @else
                  <form action="/favoriteadd/{{ $shop->id }}" method="post">
                    @csrf
                    <button type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                        <path class="fill-gray-400 " d="M14 20.408c-.492.308-.903.546-1.192.709-.153.086-.308.17-.463.252h-.002a.75.75 0 0 1-.686 0 16.709 16.709 0 0 1-.465-.252 31.147 31.147 0 0 1-4.803-3.34C3.8 15.572 1 12.331 1 8.513 1 5.052 3.829 2.5 6.736 2.5 9.03 2.5 10.881 3.726 12 5.605 13.12 3.726 14.97 2.5 17.264 2.5 20.17 2.5 23 5.052 23 8.514c0 3.818-2.801 7.06-5.389 9.262A31.146 31.146 0 0 1 14 20.408Z "></path>
                      </svg>
                    </button>
                  </form>
                  @endif
                  @endauth

                  @guest
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                    <path class="fill-gray-400 " d="M14 20.408c-.492.308-.903.546-1.192.709-.153.086-.308.17-.463.252h-.002a.75.75 0 0 1-.686 0 16.709 16.709 0 0 1-.465-.252 31.147 31.147 0 0 1-4.803-3.34C3.8 15.572 1 12.331 1 8.513 1 5.052 3.829 2.5 6.736 2.5 9.03 2.5 10.881 3.726 12 5.605 13.12 3.726 14.97 2.5 17.264 2.5 20.17 2.5 23 5.052 23 8.514c0 3.818-2.801 7.06-5.389 9.262A31.146 31.146 0 0 1 14 20.408Z "></path>
                  </svg>
                  @endguest


                </div>
              </div>
