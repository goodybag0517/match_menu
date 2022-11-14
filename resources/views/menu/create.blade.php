<x-app-layout>
  
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
    <div class="w-full flex justify-center my-16">
      <a href="{{ route('menu.create') }}">
        <button class="font-bold  text-25px text-white text-center rounded-full bg-amber-400 py-3 w-[350px]" type="submit">新しい献立を作成する
        </button>
      </a>
    </div>
    
      <ul class="slider">
        @foreach($menus as $menu)
          <li class="mx-3 hover:opacity-70 flex justify-center">
            <a href="{{route('post.show',$menu->id)}}">
              <img src="{{asset('storage/images/'.$menu->image)}}" alt="献立の画像" class="object-cover h-[250px] w-full lg:max-w-[320px] mx-auto"  style="border-radius:45px">
            </a>
          </li>
        @endforeach
      </ul>
     
      <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
      @vite(['resources/js/slider.js'])
     




  


    

  </div>
</x-app-layout>

  