@if(count($errors) > 0)

    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>

@endif


{{--@if ($errors->has('ship_sample_num'))--}}
    {{--<span style="color: #ef3d38">{{ __('admin.required') }}</span>--}}
{{--@endif--}}




