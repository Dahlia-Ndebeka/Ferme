@extends('layouts.appadmin')

@section('title')
    Ajouter categorie
@endsection

@section('contenu')
    
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ajouter Categorie</h4>

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
                            {{-- <form class="cmxform" id="commentForm" method="get" action="#"> --}}
                            {!!Form::open(['action' => 'CategoryController@sauvercategorie', 'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentForm'])!!}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    {{Form::label('', 'Nom de la categorie', ['for' => 'cname'])}}
                                    {{Form::text('category_name', '', ['id' => 'cname', 'class' => 'form-control'])}}
                                </div>

                                {{Form::submit('Ajouter', ['class' => 'btn btn-primary'])}}

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