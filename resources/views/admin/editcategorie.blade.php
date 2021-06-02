@extends('layouts.appadmin')

@section('title')
    Edit categorie
@endsection

@section('contenu')
    
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Categorie</h4>

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

                            {!!Form::open(['action' => 'CategoryController@modifiercategorie', 'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentForm'])!!}
                                {{ csrf_field() }}

                                <div class="form-group">
                                    {{Form::hidden('id', $categorie->id)}}
                                    {{Form::label('', 'Nom de la categorie', ['for' => 'cname'])}}
                                    {{Form::text('category_name', $categorie->category_name , ['id' => 'cname', 'class' => 'form-control'])}}
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