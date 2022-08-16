@if($errors->any())
<div class="alert alert-error text-danger" role="alert">
    <p class="float-left"><strong>({{ $errors->count() }}) {{ Str::plural('form field validation error', $errors->count()) }} prevented the form from submitting</strong></p>
    <button class="close" data-dismiss="alert"></button>
    <div class="clearfix"></div>
    <ul>
        @foreach ($errors->all() as $error )
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif
