@extends('admin.layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
        </div>
    @endif


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Modifier les informations</h4>
                </div>

                <div class="card-body" id="edit{{$about->id}}">
                    <form action="{{ route('aboutus.update', $about->id) }}" method="post" class="row" enctype="multipart/form-data">
                        @csrf

                            @method('PUT')
                        <div class="row">

                            <div class="col-md-12">
                                <img src="{{ asset($about->image)}}" width="160" height="120">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="titre">titre</label>
                                    <input id="titre" class="form-control" type="text" name="titre" value="{{$about->titre}}" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sous_titre">sous titre</label>
                                    <input id="sous_titre" class="form-control" type="text" name="sous_titre" value="{{$about->sous_titre}}" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <input id="description" class="form-control" type="text" name="description" value="{{$about->description}}" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection