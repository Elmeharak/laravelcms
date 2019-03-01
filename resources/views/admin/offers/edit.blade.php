@extends('layouts.Admin')@section('styles')    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">@stop@section('content')    <h1>Edit Offer</h1>    <div class="row">        {!! Form::model($offer,['method' => 'PATCH', 'action' => ['AdminOffersController@update', $offer->offer_id] , 'files' => true ]) !!}        <div class="form-group">            {{ Form::label('title','Title') }}            {{ Form::text('title',null, [ 'placeholder'=>'Enter Offer Title', 'class'=>'form-control' ]) }}        </div>        <div class="form-group">            {{ Form::label('description','Description') }}            {{ Form::textarea('description',null, [ 'placeholder'=>'Enter Offer Title', 'class'=>'form-control' , 'rows' => 3]) }}        </div>        <div class="form-group">            {{ Form::label('price','Price') }}            {{ Form::number('price',null, [ 'placeholder'=>'Enter Offer Title', 'class'=>'form-control' ]) }}        </div>        <div class="form-group">            {!! Form::label('country_id', 'Countries') !!}            {!! Form::select('country_id', ['' => 'choose country'] + $countries, null, ['class' => 'form-control']) !!}        </div>        <div class="form-group">            {!! Form::label('gov_id', 'Governorates') !!}            {!! Form::select('gov_id', ['' => 'choose governorate']+ $govs,null, ['class' => 'form-control']) !!}        </div>        <div class="form-group">            {!! Form::label('image','Photo') !!}            @if($offer->image)            <div class="clearfix">                <a class="deleteImg" href="#" data-id="{{$offer->offer_id}}">                    <img src="{{url('images/offers')}}/{{$offer->image}}" height="100px" alt="">                </a>            </div>            @endif            <script>                $(function(){                    $.ajax({                        url: '',                        method: '',                        data: ''                    }).done(function(r){                    });                    $('.deleteImg').click(function(){                        if( !confirm('Confirm Delete ?') )                            return false;                        var that = $(this);                        var id = that.data('id');                        $.ajax({                            method: "POST",                            data: {id : id},                            url: '{{url('deleteOfferImage')}}'                        }).done(function(data){                            if( data == 1 ){                                that.fadeOut(500);                            }                        });                        return false;                    })                })            </script>            <input type="file" class="form-control" name="image">        </div>        @if($images)        <div class="form-group col-md-12">            @foreach($images as $id => $img)                <a class="removeImage col-md-2" href="#" data-id="{{$id}}">                    <img class="img-responsive" src="{{url('images')}}/{{$img}}" style="width: 150px; height: 150px;" alt="">                </a>            @endforeach        </div>        <script>            $(function(){                $('.removeImage').click(function(){                    if( !confirm("Confirm Delete image ?") ){                        return false;                    }                    var that = $(this);                    var id = $(this).attr('data-id');                    console.log(id);                    $.ajax({                        url: '{{action('AdminOffersController@deleteGallery')}}',                        method: 'POST',                        data: {image_id: id}                    }).done(function(response){                        var data = $.parseJSON(response);                        if( data.status == 1 ){                            that.fadeOut(800)                        }                    })                    return false;                })            })        </script>        @endif                <div class="form-group col-md-12">            {!! Form::label('images','Images') !!}            {!! Form::file('images[]',['class' =>'dropzone', 'multiple'=>'multiple'],null) !!}        </div>        <div class="form-group">            {!! Form::submit('Update Offer', ['class' => 'btn btn-primary col-sm-6']) !!}        </div>        {!! Form::close()  !!}        {!! Form::open(['method' => 'DELETE', 'action' =>['AdminOffersController@destroy', $offer->offer_id]] ) !!}        <div class="form-group">            {!! Form::submit('Delete Offer', ['class' => 'btn btn-danger col-sm-6 check'] )!!}        </div>        {!! Form::close()  !!}    </div><br>    <div class="row">        @include('includes.form_error')    </div>@stop@section('scripts')    <script>        $(document).ready(function () {            $('select[name="country_id"]').on('change', function () {//                console.log('lis')                var country_id = $(this).val();                $.ajax({                    url: '{{url('GetSubCountry')}}/' + country_id,                    type: 'GET',                    dataType: 'json',                    success: function (data) {                        $('select[name="gov_id"]').empty();                        $.each(data, function (key, value) {                            $('select[name="gov_id"]').append('<option value="' + key + '">' + value + '</option>');                        });                    }                });            });        });    </script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>@stop