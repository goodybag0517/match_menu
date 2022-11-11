<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="antialiased">

        <div class="bg-white py-3">
            <div class="max-w-screen-xl px-4 md:px-8 mx-auto">
              <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
                <div>
                  <div class="h-100 md:h-2/3 bg-gray-100 overflow-hidden rounded-lg shadow-lg">
                    <img src="{{asset('logo/HOME_image.png')}}" loading="lazy" alt="Photo by Martin Sanchez" class="w-full h-full object-cover mx-auto" />
                  </div>
                </div>
          
                <div class="md:pt-8">
                  <p class="text-indigo-500 font-bold text-center md:text-left">Match Menuの概要</p>
          
                  <h1 class="text-gray-800 text-[20px] sm:text-[25px] font-bold text-left mb-4 md:mb-6">Match Menu</h1>
          
                  <p class="text-gray-500 sm:text-lg mb-12 md:mb-8 max-w-[500px]">
                    日々の献立作りに苦労されている方、新しいレシピに挑戦してみたい方に向けた献立アプリです。<br>
                    ニックネームとパスワード登録のみでアプリを使用することができます。
                  </p>
          
                  <h2 class="text-gray-800 text-[20px] sm:text-2xl font-semibold text-left mb-4 md:mb-6">主な機能</h2>
          
                  <h2 class="text-gray-800 text-[15px] sm:text-2xl font-semibold text-left mb-2 md:mb-4">献立作成</h2>

                  <p class="text-gray-500 sm:text-lg mb-10 md:mb-8 max-w-[500px]">
                    6品のレシピをランダムで生成します。<br>
                    これまでになかった料理との出会いをお楽しみいただけます。
                  </p>

                  <h3 class="text-gray-800 text-[15px] sm:text-2xl font-semibold text-left mb-2 md:mb-4">レシピ投稿</h2>

                  <p class="text-gray-500 sm:text-lg mb-12 md:mb-8 max-w-[500px]">
                    自身のレシピを投稿し、他のユーザーとの共有をすることができます。
                  </p>

                  @if (Route::has('login'))
                    <div class="">
                    @auth
                        <div class="text-center mb-5 md:text-left md:mt-12">
                            <a href="{{ route('post.index') }}" class="text-sm text-white font-bold  bg-amber-400 px-10 py-2 rounded-md">HOME</a>
                        </div>
                    @else
                        @if (Route::has('register'))
                            <div class="text-center mb-5 md:text-left md:mt-12">
                            
                                <a href="{{ route('login') }}" class="text-sm text-white font-bold  bg-amber-400 px-10 py-2 rounded-md mr-2">Log in</a>

                                
                                <a href="{{ route('register') }}" class="text-sm text-white font-bold  bg-amber-400 px-10 py-2 rounded-md">Register</a>
                            </div>
                        @endif
                    @endauth
                    </div>
                   @endif
                </div>
              </div>
            </div>
          </div>
          
    </body>
</html>
