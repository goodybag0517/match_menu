<x-app-layout>
  
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @include('common.errors')
    <x-message :message="session('message')"/>

    <div class="w-full flex justify-center my-16">
      <a href="{{ route('post.create') }}">
        <button class="font-bold  text-25px text-white text-center rounded-full bg-amber-400 py-3 w-[350px]" type="submit">新しいレシピを投稿する
        </button>
      </a>
    </div>

    <h2 class="font-bold text-30px text-gray-700 mx-3 mt-10 after:content-['»'] after:pl-3">新作のレシピ一覧</h2>
    {{-- 新しいレシピを表示 --}}
    <div class="w-full grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 items-center">
      {{-- 新しいレシピがない場合 --}}
      @if(count($posts) == 0)
        <p class="my-7 mx-3 text-gray-600 font-semibold text-20px">
          まだ投稿されたレシピがありません。
        </p>
        {{-- 新しいレシピがある場合 --}}
      @else
        @foreach($posts as $post)
          <div class="my-3 mx-3 hover:opacity-70">
            <a href="{{route('post.show',$post)}}">
              <img src="{{asset('storage/images/'.$post->image)}}" alt="献立の画像" class="object-cover h-[250px] w-full max-w-[320px] mx-auto"  style="border-radius:45px">
            </a>
          </div>
        @endforeach
      @endif
    </div>

   
    




  


    

  </div>
</x-app-layout>