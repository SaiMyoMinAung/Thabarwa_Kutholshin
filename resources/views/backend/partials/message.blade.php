@foreach(['success', 'danger'] as $status)
@if ($message = Session::get($status))
<div class="alert alert-{{$status}} alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@endforeach

@if($errors->has('transition_error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $errors->first('transition_error') }}</strong>
</div>
@endif

@if($errors->has('super_error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ $errors->first('super_error') }}
</div>
@endif

@if($errors->has('profile_error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ $errors->first('profile_error') }}
</div>
@endif

@if($message = Session::get('transition_success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif