@extends('layouts.appadmin')

@section('title')
    Ajouter Produit
@endsection

@section('contenu')
    
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ajouter Produit</h4>

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

                                {!!Form::open(['action' => 'ProductController@sauverproduit', 'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentForm', 'enctype' => 'multipart/form-data'])!!}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    {{Form::label('', 'Nom du produit', ['for' => 'pname'])}}
                                    {{Form::text('product_name', '', ['id' => 'pname', 'class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('', 'Prix du produit', ['for' => 'pprice'])}}
                                    {{Form::number('product_price', '', ['id' => 'pprice', 'class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('', 'Categorie du produit')}}
                                    {{Form::select('product_category', $categories, null, ['placeholder' => 'selectionner categorie', 'class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('', 'Image du produit', ['for' => 'pimg'])}}
                                    {{Form::file('product_image', ['id' => 'pimg', 'class' => 'form-control'])}}
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