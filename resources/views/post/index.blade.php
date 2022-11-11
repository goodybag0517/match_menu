<x-app-layout>
  
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @include('common.errors')
    <x-message :message="session('message')"/>

    <div class="w-full flex justify-center  my-16">
      <a href="{{ route('post.create') }}">
        <button class="font-bold  text-25px text-white text-center rounded-full bg-amber-400 py-3 w-[350px]" type="submit">新しいレシピを投稿する
        </button>
      </a>
    </div>
    <h2 class="font-bold text-30px text-gray-700 mx-3 mt-10 after:content-['»'] after:pl-3">
      <a href="{{ route('post.newmenu') }}">
        新作のレシピ一覧
      </a>
    </h2>

    <div class="w-full grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 items-center">
      @foreach($posts as $post)
        <div class="my-3 mx-3 hover:opacity-70">
          <a href="{{route('post.show',$post)}}">
            <img src="{{asset('storage/images/'.$post->image)}}" alt="献立の画像" class="object-cover h-[250px] w-full max-w-[320px] mx-auto"  style="border-radius:45px">
          </a>
        </div>
      @endforeach
    </div>

    <h3 class="font-bold text-30px text-gray-700 mx-3 mt-10 after:content-['»'] after:pl-3">
      <a href="{{ route('post.nicemenu') }}">
        人気のレシピ一覧
      </a>
    </h3>

    <div class="w-full grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 items-center">
      @if(count($NicePosts) == 0)
        <p class="my-7 mx-3 text-gray-600 font-semibold text-20px">
          まだ保存されたレシピがありません。
        </p>
      @endif
      @foreach($NicePosts as $post)
        <div class="my-3 mx-3 hover:opacity-70">
          <a href="{{route('post.show',$post)}}">
            <img src="{{asset('storage/images/'.$post->image)}}" alt="献立の画像" class="object-cover h-[250px] w-full max-w-[320px] mx-auto"  style="border-radius:45px">
          </a>
        </div>
      @endforeach
    </div>

    <h4 class="font-bold text-30px text-gray-700 mx-3 mt-10 after:content-['»'] after:pl-3">
      <a href="{{ route('post.mymenu') }}">
        投稿済みレシピ一覧
      </a>
    </h3>

    <div class="w-full grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 items-center">
      @if(count($MyPosts) == 0)
        <p class="my-7 mx-3 text-gray-600 font-semibold text-20px">
          まだレシピ投稿がありません。
        </p>
      @endif
      @foreach($MyPosts as $post)
        <div class="my-3 mx-3 hover:opacity-70">
          <a href="{{route('post.show',$post)}}">
            <img src="{{asset('storage/images/'.$post->image)}}" alt="献立の画像" class="object-cover h-[250px] w-full max-w-[320px] mx-auto"  style="border-radius:45px">
          </a>
        </div>
      @endforeach
    </div>
    
    




  


    

  </div>
</x-app-layout>