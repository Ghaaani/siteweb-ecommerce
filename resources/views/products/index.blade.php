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
                <h4 class="card-title">Ajouter produit</h4>
            </div>

            <div class="card-body">
                <form action="{{route('products.store')}}" method="post" class="row" enctype="multipart/form-data">
                    @csrf

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
                            <label for="category">Category</label>
                            <select id="category" class="form-control" name="category">
                                <option  value="" selected>--Please choose an option--</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">name</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="">
                        </div>
                    </div>
                    

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input id="description" class="form-control" type="text" name="description" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">price</label>
                            <input id="price" class="form-control" type="text" name="price" placeholder="">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Popular-Product">Product List</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="PopularProduct" name="PopularProduct">
                                    <label class="form-check-label" for="PopularProduct">Popular Product</label>
                                </div>
                            </div>
                        </div>
                            
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="SKU">SKU</label>
                            <input id="SKU" class="form-control" type="text" name="SKU" placeholder="">
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
                <h4 class="card-title">Datatable des produits</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered display" style="min-width: 845px">

                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>name</th>
                                <th>Description</th>
                                <th>price</th>
                                <th>SKU</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                                        
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td><img src="{{ asset('storage/images/product/'.$product->image)}}" width="160" height="120"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->SKU}}</td>
                                    <td>
                                        <form id="delete-form" method="post" action="{{ route('products.destroy' , $product->id) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-primary btn-edit mr-lg-4" data-toggle="modal" data-target="#edit{{$product->id}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                            <button class="btn btn-danger btn-delete" type="submit" data-toggle="tooltip" data-placement="top" title="Close">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                    <!-- Modal -->

                                    <div class="modal fade" id="edit{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="edit{{$product->id}} Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edit{{$product->id}}Label">Modifier product</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>

                                                <div class="modal-body">

                                                    <form action="{{ route('products.update' , $product->id) }}" method="post" class="row" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                    <div class="row">

                                                    <div class="col-md-12">
                                                        <img src="{{ asset('storage/images/product/'.$product->image)}}" width="160" height="120">
                                                    </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="image">Image</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="image">
                                                                    <label class="custom-file-label">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="category">Category</label>
                                                                <select id="category" class="form-control" name="category">
                                                                    <option  value="" selected>--Please update an option--</option>
                                                                @foreach ($categories as $categorie)
                                                                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">name</label>
                                                                <input id="name" class="form-control" type="text" value="{{$product->name}}" name="name" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <input id="description" class="form-control" type="text" value="{{$product->description}}" name="description" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="price">price</label>
                                                                <input id="price" class="form-control" type="text" value="{{$product->price}}" name="price" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="SKU">SKU</label>
                                                                <input id="SKU" class="form-control" type="text" value="{{$product->SKU}}" name="SKU" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="Popular-Product">Product List</label><br>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="PopularProduct" name="PopularProduct">
                                                                    <label class="form-check-label" for="PopularProduct">Popular Product</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                                        </div>

                                                    </div>
                                                    </form>
                                                </div>
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