@extends('admin.layouts.app')

@section('content')
<style>

</style>

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
                                <h4 class="card-title">Ajouter categorie</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('product_categories.store')}}" method="post" class="row">
                                @csrf
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Titre</label>
                                                    <input id="name" class="form-control" type="text" name="name" placeholder="">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input id="description" class="form-control" type="text" name="description" placeholder="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Datatable des categories</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Titre</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $categorie)
                                            <tr>
                                                <td>{{$categorie->name}}</td>
                                                <td>{{$categorie->description}}</td>
                                                <td>
                                                    <form id="delete-form" method="post" action="{{ route('product_categories.destroy' , $categorie->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-primary btn-edit mr-lg-4" data-toggle="modal" data-target="#edit{{$categorie->id}}">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-delete" type="submit" data-toggle="tooltip" data-placement="top" title="Close">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="edit{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$categorie->id}}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="edit{{$categorie->id}}Label">Modifier categorie</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="{{ route('product_categories.update' , $categorie->id) }}" method="post" class="row">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Titre</label>
                                                                        <input id="name" class="form-control" type="text" value="{{$categorie->name}}" name="name" placeholder="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="description">Description</label>
                                                                        <input id="description" class="form-control" type="text" value="{{$categorie->description}}" name="description" placeholder="">
                                                                    </div>
                                                                </div>

                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                        </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                



                <script>
                document.getElementById('delete-form').addEventListener('submit', function(event) {
                var confirmDelete = confirm("Etes-vous sûr que vous voulez supprimer?");
                if (!confirmDelete) {
                    event.preventDefault();
                }
                });
                </script>
@endsection