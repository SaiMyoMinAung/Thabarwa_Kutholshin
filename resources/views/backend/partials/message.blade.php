@foreach(['success', 'error'] as $status)
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