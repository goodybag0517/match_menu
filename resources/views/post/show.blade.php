<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold  text-30px text-white text-center rounded-full bg-amber-400 py-2" >
      献立レシピ
    </h2>
  </x-slot>
    {{-- 献立個別表示 --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      @include('common.errors')
      <x-message :message="session('message')"/>
      <div class="">
        <!-- もし$niceがあれば＝ユーザーが「いいね」をしていたら -->
        @if($nice)
        <!-- 「いいね」取消用ボタンを表示 -->
          <div class="flex items-center ml-8 py-2">
            <a href="{{ route('unnice', $post) }}" class="btn btn-success btn-sm">
              <img src="{{asset('logo/keep.png')}}" alt="" class="w-[20px] hover:opacity-40">
            </a>
            <!-- 「いいね」の数を表示 -->
            <span class="badge ml-3 text-amber-500 font-bold text-[18px]">
              {{ $post->nices->count() }}いいね
            </span>
          </div>
        @else
        <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
          <div class="flex items-center ml-8 py-2">
            <a href="{{ route('nice', $post) }}" class="btn btn-secondary btn-sm">
              <img src="{{asset('logo/keep.png')}}" alt="" class="w-[20px] hover:opacity-40">
              <!-- 「いいね」の数を表示 -->
            </a>
            <span class="badge ml-3 text-gray-500 font-bold text-[18px]">
              {{ $post->nices->count() }}いいね
            </span>
          </div>
        @endif

      </div>


      <div class="flex mb-6 items-center">
        
          <h3 class="font-bold text-30px text-amber-500 bg-white border border-gray-300 rounded-full w-[300px] px-4 py-1  ml-4">
            {{$post->title}}
          </h3>

        <div class="ml-auto text-center">
          <p class="text-15px text-gray-400">{{$post->created_at}}</p>
          @can('delete',$post)
            <form method="post" class="flex justify-center" action="{{route('post.destroy', $post)}}">
              @csrf
              @method('delete')
              <button class=" text-15px font-semibold text-gray-500 bg-gray-300 mx-auto px-5 py-1 rounded-md" onClick="return confirm('本当に削除しますか？');">削除</button>
            </form>
          @endcan
        </div>
      </div>
      
      {{-- 献立画像と食材の表示 --}}
      <div class="flex flex-col md:flex-row px-4 mb-5">
          <div class="mb-5">
            <img src="{{asset('storage/images/'.$post->image)}}" alt="献立の画像" class="object-cover h-[280px] w-[340px]" style="border-radius:45px">
          </div>
          <div class="md:ml-8">
            <h4 class="text-22px font-bold text-gray-500 ">食材</h4>
            <ul class="grid grid-cols-1 md:grid-cols-2">
              @for($i = 1; $i < 10; $i++)
                @php
                 $food_num = "food".$i ;   
                @endphp
                  @if($post->$food_num==null)
                  @break
                  @endif
                  <li class="font-bold text-20px text-amber-500 bg-white border border-gray-300 rounded-full w-[175px] px-4 py-1 my-1 md:ml-1">
                    {{$post->$food_num}}
                  </li>
              @endfor
            </ul>
          </div> 
      </div>
      {{-- 献立の工程表示 --}}
      <div class="px-4 mb-8">
        <h5 class="text-22px font-bold text-gray-500 ">レシピ行程</h4>
            <ul class="">
              @for($i = 1; $i < 6; $i++)
                @php
                 $step_num = "step".$i ;   
                @endphp
                @if($post->$step_num==null)
                @break
                @endif
                  <li class="font-bold text-20px text-amber-500 bg-white border border-gray-300 rounded-full w-full px-4 py-1 my-2">
                    {{$post->$step_num}}
                  </li>
              @endfor
            </ul>
      </div>
      {{-- 編集ボタン --}}
      @can('update',$post)
        <div class="flex justify-end mb-10 px-8">
          <a href="{{route('post.edit',$post)}}">
            <button class="font-bold  text-25px text-white text-center rounded-full bg-amber-400 py-2 w-[150px]" type="submit">レシピ編集</button>
          </a>
        </div>
      @endcan
    </div>
</x-app-layout>