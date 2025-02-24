<x-mail::message>
# Greeting! {{ $name }}

Your image has been reviewed!
<x-mail::panel style="background: rgb(242, 99, 99)">
    <img src="{{ $message->embed(asset('storage/photos/'. $image)) }}" alt="">
    Status: @if ($status == 'Accepted')
        <strong style="color: rgb(20, 236, 20);">{{ $status }}</strong> 
    @else
        <strong style="color: rgb(236, 20, 20);">{{ $status }}</strong> 
    @endif
</x-mail::panel> 

<x-mail::button :url="$url">
View profile page
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }} Teams

<hr>
If you're having trouble clicking the <strong><em>link</em></strong> button, <em>copy</em> and paste the URL below.
{{ $url }}

</x-mail::message>