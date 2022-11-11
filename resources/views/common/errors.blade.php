@if($errors->any())
  <div class="mt-2 p-4 text-red-500 border border-red-500 rounded-lg font-semibold">
    <ul>
      @foreach ($errors->all() as $error)
        <li class="pb-1"> {{ $error }}</li> 
      @endforeach

      @if(empty($errors->first('image')))
        <li>画像ファイルがあれば、再度選択してください。</li>
      @endif
    </ul>
  </div>
@endif