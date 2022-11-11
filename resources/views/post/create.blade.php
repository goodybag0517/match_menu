<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold  text-30px text-white text-center rounded-full bg-amber-400 py-2" >
      献立投稿
    </h2>
  </x-slot>

  <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
    @include('common.errors')
    <x-message :message="session('message')"/>
    <div class="mx-4 sm:marker:p-8">
      <form method="post" action={{route('post.store')}} enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col mt-8">
          <!--料理名入力欄-->
          <div class="flex justify-start items-center mb-20">
            <label for="body" class="font-bold md:text-20px text-gray-600 min-w-fit">料理名：</label>
            <input type="text" name="title" class=" py-2 placeholder-gray-400 border border-gray-400 rounded-full w-[750px]" id="title" value="{{old('title')}}" placeholder="料理名を入力してください">
          </div>
          <!--料理写真入力欄-->
          <div class="flex justify-start items-center mb-20">
            <label for="image" class="font-bold md:text-20px text-gray-600 min-w-fit">画像　：</label>
            <input type="file" name="image" id="image">
          </div>
          <!--食材入力欄-->
          <div class="flex justify-start leading-10  mb-10">
            <label for="body" class="font-bold md:text-20px text-gray-600 min-w-fit">材料名：</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
              @for($i=1; $i < 10; $i++)
                <input type="text" name="food{{$i}}" class=" py-2 placeholder-gray-400 border border-gray-400 rounded-full w-[250px] mr-3 mb-5" id="food{{$i}}" value="{{old('food'.$i)}}" placeholder="材料名{{$i}}を入力してください">
              @endfor
            </div>
            
          </div>
          <!--行程入力欄-->
          <div class="flex justify-start leading-10  mb-10">
            <label for="body" class="font-bold md:text-20px text-gray-600 min-w-fit">　行程：</label>
            <div class="w-full flex flex-col">
              @for($i=1; $i < 6; $i++)
                <input type="text" name="step{{$i}}" class="py-2 placeholder-gray-400 border border-gray-400 rounded-full w-max-[700px] mb-5" id="step{{$i}}" value="{{old('step'.$i)}}" placeholder="行程{{$i}}を入力してください">
              @endfor
            </div>
          </div>
          <button class="block ml-auto mb-10 font-bold  text-25px text-white text-center rounded-full bg-amber-400 py-2 w-[150px]" type="button" onclick="submit();">
            投稿
          </button>
        </div>

        

        


      </form>
    </div><!--mx-4-->
  </div><!--max-w-1/2-->

</x-app-layout>


 