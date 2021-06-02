@extends('layouts.appadmin')

@section('title')
    Ajouter Slider
@endsection

@section('contenu')
    

            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ajouter Slider</h4>
                            @if (Session::has('status'))
                                <div class="alert alert-success">
                                    {{Session::get('status')}}
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {!!Form::open(['action' => 'SliderController@modifierslider', 'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentForm', 'enctype' => 'multipart/form-data'])!!}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    {{Form::hidden('id', $slider->id)}}
                                    {{Form::label('', 'Description one', ['for' => 'pname'])}}
                                    {{Form::text('description1', $slider->description1, ['id' => 'pname', 'class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('', 'Description two', ['for' => 'pprice'])}}
                                    {{Form::text('description2', $slider->description2, ['id' => 'pprice', 'class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('', 'Image du produit', ['for' => 'pimg'])}}
                                    {{Form::file('slider_image',  ['id' => 'pimg', 'class' => 'form-control'])}}
                                </div>

                                {{Form::submit('Modifier', ['class' => 'btn btn-primary'])}}

                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('scripts')
    {{-- <script src="backend/js/form-validation.js"></script>
    <script src="backend/js/bt-maxLength.js"></script> --}}
@endsection