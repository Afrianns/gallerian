@php
    $type ="";
    $getUrlType = request()->get("type");
    if($getUrlType){
        $type = $getUrlType;
    }
@endphp
<form method="get" action="" class="flex z-10 w-full md:w-1/2 items-stretch justify-stretch rounded-xl {{$classNameInput}} px-5 md:px-0">
        <input type="text" name="query" id="query" class="m-0 px-3 border-0 w-full h-full rounded-s-md focus:ring-0" placeholder="Search Images">
        <input type="hidden" name="type" value="{{$type}}">
    <button type="submit" class="{{ $className }} px-8 flex items-center gap-x-2 rounded-r-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-darkPurple"><path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path></svg> Search</button>
</form>