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
                            {{-- <form class="cmxform" id="commentForm" method="get" action="#"> --}}
                            {!!Form::open(['action' => 'SliderController@sauverslider', 'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentForm'])!!}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    {{Form::label('', 'Description one', ['for' => 'pname'])}}
                                    {{Form::text('description1', '', ['id' => 'pname', 'class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('', 'Description two', ['for' => 'pprice'])}}
                                    {{Form::text('description2', '', ['id' => 'pprice', 'class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('', 'Image du produit', ['for' => 'pimg'])}}
                                    {{Form::file('slider_image', '', ['id' => 'pimg', 'class' => 'form-control'])}}
                                </div>

                                {{Form::submit('Ajouter', ['class' => 'btn btn-primary'])}}

                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('scripts')
    <script src="backend/js/form-validation.js"></script>
    <script src="backend/js/bt-maxLength.js"></script>
@endsection