@extends('layouts.app')
@section('content')
<div class="container">
</br></br>
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center">Category List</h3>
              <a href="#"><button class="card-title btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategory">Create Category</button></a>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                   
                  </tr>
                </thead>
                <tbody> 
                    
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
  
  <!-- Create Category Modal -->
  <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <ul id="save_msgList"></ul>
          <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" required>
        </div>
        <div class="modal-footer">
            <button type="button" id="submitButton" class="btn btn-primary add_category">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  
          </div>
       
      </div>
    </div>
  </div>
  </div>

  <!-- Delete Category Modal -->
  <div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
            <input type="hidden" id="delete_category_id">
            <h4>Are you sure? You want to delete this item?</h4>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" id="submitButton" class="btn btn-danger delete_category_btn">Yes, Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  
          </div>
       
      </div>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

  <script>
   $(document).ready(function(){
    fetchCategory();
    function fetchCategory()
    {
        $.ajax({
        type: "GET",
        url: "/fetch/category",
        dataType: "json",
            success:function(response){
              $('tbody').html("");
                $.each(response.categories, function (key, item) {
                    key=key+1;
                    $('tbody').append('<tr>\
                        <td>'+key+'</td>\
                        <td>'+item.title+'</td>\
                        <td>'+item.description+'</td>\
                        <td><button type="button" value="'+item.id+'" class="delete_category btn btn-danger">Delete</button></td>\
                    </tr>');
                });    
            }
        });
    }
    
    $('.add_category').click(function(){
     
    var data={
        'title':$('#title').val(),
        'description':$('#description').val(),
    }
    // console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/store/category",
        data: data,
        dataType: "json",
        success:function(response){
        console.log(response);
       
        $('#createCategory').modal('hide');
        $('#createCategory').trigger('reset');
        fetchCategory();
        
        }
    });
    
  });

  $(document).on('click','.delete_category',function(e){
    e.preventDefault();
    var id=$(this).val();
    $('#delete_category_id').val(id);
    $('#deleteCategory').modal('show');
   });

   $(document).on('click','.delete_category_btn',function(e){
    e.preventDefault();
    var id=$('#delete_category_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      type:"DELETE",
      url:"/delete/category/"+id,
      success:function(response){
        console.log(response);
        $('#deleteCategory').modal('hide');
        fetchCategory();
      }

    });
   });
});
  </script>
@endsection
