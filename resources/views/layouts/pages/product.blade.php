@extends('layouts.app')
@section('content')
<div class="container">
</br></br>
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center">Product List</h3>
              <a href="#"><button class="card-title btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProduct">Create Product</button></a>
              <div class="card-tools">
                <form action="{{route('product.index')}}" method="GET">
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <input value="{{$key}}" type="text" name="search" class="form-control float-right" placeholder="Search">
  
                      <button type="submit" class="btn btn-primary ">
                        <i class="fa fa-search">Search</i>
                      </button>
                    
                  </div>
                </form>
              
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Price</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $key=>$item )
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->title}}</td>
                      <td>{{$item->description}}</td>
                      <td>{{$item->category->title}}</td>
                      <td>{{$item->subcategory->title}}</td>
                      <td>{{$item->price}}</td>
                      <td><button type="button" value="{{$item->id}}" class="delete_product btn btn-danger">Delete</button></td>
                    </tr>  
                    @endforeach
                 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
  
  <!-- Create Product Modal -->
  <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         
          <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" required>
        </div>
        <div class="form-group">
          <label for="Category ID">Category </label>
          <select class="form-select" name="category_id" id="category_id" aria-label="Default select example" required>
              <option>Select Category</option>

              @foreach ($category as $item)
              <option value="{{$item->id}}">{{$item->title}} </option>
              @endforeach
          </select> 
        </div>
        <div class="form-group">
          <label for="SubCategory ID">SubCategory </label>
          <select class="form-select" name="subcategory_id" id="subcategory_id" aria-label="Default select example" required>
              <option>Select SubCategory</option>

              @foreach ($subcategory as $item)
              <option value="{{$item->id}}">{{$item->title}}</option>
              @endforeach
          </select> 
        </div>
        <div class="form-group">
            <label for="Price">Price</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price" required>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="submitButton" class="btn btn-primary add_product">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Product Modal -->
  <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
            <input type="hidden" id="delete_product_id">
            <h4>Are you sure? You want to delete this item?</h4>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" id="submitButton" class="btn btn-danger delete_product_btn">Yes, Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  
          </div>
       
      </div>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

  <script>
   $(document).ready(function(){
    // fetchProduct();
    // function fetchProduct()
    // {
    //     $.ajax({
    //     type: "GET",
    //     url: "/fetch/product",
    //     dataType: "json",
    //         success:function(response){
    //           console.log(response);
    //           $('tbody').html("");
    //             $.each(response.products, function (key, item) {
    //                 $('tbody').append('<tr>\
    //                     <td>'+item.id+'</td>\
    //                     <td>'+item.title+'</td>\
    //                     <td>'+item.description+'</td>\
    //                     <td>'+item.category.title+'</td>\
    //                     <td>'+item.subcategory_id+'</td>\
    //                     <td>'+item.price+'</td>\
    //                     <td><button type="button" value="'+item.id+'" class="delete_product btn btn-danger">Delete</button></td>\
    //                 </tr>');
    //             });    
    //         }
    //     });
    // }
    
    $('.add_product').click(function(){
     
    var data={
        'title':$('#title').val(),
        'description':$('#description').val(),
        'category_id':$('#category_id').val(),
        'subcategory_id':$('#subcategory_id').val(),
        'price':$('#price').val(),
    }
    // console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/store/product",
        data: data,
        dataType: "json",
        success:function(response){
        console.log(response);
       
        $('#createProduct').modal('hide');
        $('#createProduct').trigger('reset');
        location.reload();
        
        }
    });
    
  });

  $(document).on('click','.delete_product',function(e){
    e.preventDefault();
    var id=$(this).val();
    $('#delete_product_id').val(id);
    $('#deleteProduct').modal('show');
   });

   $(document).on('click','.delete_product_btn',function(e){
    e.preventDefault();
    var id=$('#delete_product_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      type:"DELETE",
      url:"/delete/product/"+id,
      success:function(response){
        console.log(response);
        $('#deleteProduct').modal('hide');
        location.reload();
      }

    });
   });
});
  </script>
@endsection
