@extends('layouts.app')
@section('content')
<div class="container">
</br></br>
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center">SubCategory List</h3>
              <a href="#"><button class="card-title btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSubCategory">Create SubCategory</button></a>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Action</th>
                   
                  </tr>
                </thead>
                <tbody> 
                    @foreach ($subcategories as $key=>$item )
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->title}}</td>
                      <td>{{$item->description}}</td>
                      <td>{{$item->category->title}}</td>
                      <td><button type="button" value="{{$item->id}}" class="delete_subcategory btn btn-danger">Delete</button></td>
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
  
  <!-- Create SubCategory Modal -->
  <div class="modal fade" id="createSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create SubCategory</h5>
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
        <div class="form-group">
            <label for="Category ID">Category ID</label>
            <select class="form-select" name="category_id" id="category_id" aria-label="Default select example" required>
                <option>Select Category</option>

                @foreach ($category as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
                @endforeach
            </select>            
        </div>
        
        <div class="modal-footer">
            <button type="button" id="submitButton" class="btn btn-primary add_subcategory">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  
          </div>
       
      </div>
    </div>
  </div>
  </div>

  <!-- Delete SubCategory Modal -->
  <div class="modal fade" id="deleteSubCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete SubCategory</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
            <input type="hidden" id="delete_subcategory_id">
            <h4>Are you sure? You want to delete this item?</h4>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" id="submitButton" class="btn btn-danger delete_subcategory_btn">Yes, Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  
          </div>
       
      </div>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

  <script>
   $(document).ready(function(){
   
    
    $('.add_subcategory').click(function(){
     
    var data={
        'title':$('#title').val(),
        'description':$('#description').val(),
        'category_id':$('#category_id').val(),
    }
    // console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/store/subcategory",
        data: data,
        dataType: "json",
        success:function(response){
        console.log(response);
       
        $('#createSubCategory').modal('hide');
        $('#createSubCategory').trigger('reset');
        location.reload();
        
        }
    });
    
  });

  $(document).on('click','.delete_subcategory',function(e){
    e.preventDefault();
    var id=$(this).val();
    $('#delete_subcategory_id').val(id);
    $('#deleteSubCategory').modal('show');
   });

   $(document).on('click','.delete_subcategory_btn',function(e){
    e.preventDefault();
    var id=$('#delete_subcategory_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      type:"DELETE",
      url:"/delete/subcategory/"+id,
      success:function(response){
        console.log(response);
        $('#deleteSubCategory').modal('hide');
        location.reload();
      }

    });
   });
});
  </script>
@endsection
