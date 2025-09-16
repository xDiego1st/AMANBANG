@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
@if (Auth::user()->profile_photo_path)
<img class="user-avatar sm" src="{{Auth::user()->profile_photo_url}}" style="object-fit:cover;">
@else
<img class="user-avatar sm" src="{{ Avatar::create(Auth::user()->username)->toBase64() }}">
@endif
@endif
