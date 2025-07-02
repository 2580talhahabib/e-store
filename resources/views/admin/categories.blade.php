@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden vh-100">
    <div class="row">
        <div class="col-md-12 m-5">
            <h2>Categories</h2>
        </div>
        <div class="row">
            <div class="col-md-12 ml-5">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create Category
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="menu-data">
        @csrf
      <div class="modal-body">
        <div class="form-group">
            <label for="" class="form-label">Category Name :</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        @if ($categories->isNotEmpty())
         <div class="form-group">
            <label for="" class="form-label">Parent Category :</label>
            <select name="parent_id" id="" class="form-control">
              <option value="" >Add parent Category</option>
              @foreach ($categorys as $category)
             <option value="{{ $category->id }}">{{ $category->name }}</option>                 
              @endforeach
            </select>
        </div>
      </div>
             @endif
             
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary createBtn">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Model -->
<div class="modal fade" id="deletemenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="menu-data">

        <input type="hidden">
      <div class="modal-body">
     <p>Are you sure you want to delete the Category</p>    
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger confirm_delete">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Update Model -->
<div class="modal fade" id="updatemenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="update-data">
      @csrf
        <input type="hidden">
      <div class="modal-body">
        
             <form  id="menu-data">
        @csrf
      <div class="modal-body">
        <div class="form-group">
            <label for="" class="form-label">Menu Category :</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        @if ($categories->isNotEmpty())
         <div class="form-group">
            <label for="" class="form-label">Parent Category :</label>
            <select name="parent_id" id="" class="form-control" id="parent_id">
              <option value=" " >Add parent Category</option>
              @foreach ($categorys as $category)
             <option value="{{ $category->id }}">{{ $category->name }}</option>                 
              @endforeach
            </select>
        </div>
      </div>
        @endif

             
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success update ">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
            </div>
        </div>
    </div>
<div class="container">
  <div class="row ml-1 mt-1">
    <div class="col-md-12">
{{-- Menus list  --}}

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Parent Category</th>
  
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @if ($categories->isNotEmpty())
        @foreach ($categories as $category)
                <tr>
      <td >{{ $category->id }}</td>
      <td >{{ $category->name }}</td>
      <td >{{ $category->children->name  ?? 'Nullable'}}</td>
      
      <td class="text-center">
        <a class="btn btn-danger text-white deletebtn"   data-toggle="modal" data-target="#deletemenu" data-id="{{ $category->id }}" >Delete</a>
        <a type="submit"  class="btn btn-secondary text-white updatebtn"  data-toggle="modal" data-target="#updatemenu" data-obj="{{ $category }}" data-id="{{ $category->id }}" >Update</a>
      </td>
      
    </tr>
            @endforeach
    @endif

  </tbody>
</table>
   {{ $categories->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
</div>


@endsection
@section('admin-script')
    <script>
        
 $(document).ready(function(){
    var currentMenuId = 0; // Store the current menu ID
    
    // Menu Creation 
    $("#menu-data").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $(".createBtn").prop('disabled', true);
        // ,_token: "{{ csrf_token() }}"
        $.ajax({
            url: '{{route('admin.category.store') }}',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                console.log(response);
                $(".createBtn").prop('disabled', false);
                location.reload();
            }
        });
    });
    
    // Menu Deletion 
    $(".deletebtn").click(function(e){
        e.preventDefault();
        var currentId = $(this).data('id');
        
        $(".confirm_delete").click(function(e){
            e.preventDefault();
            if(currentId > 0){
                var url = "{{ route('admin.category.delete', 'id') }}".replace('id', currentId);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        location.reload();
                    }    
                });
            }
        });
    });
    
    // Menu edit 
    $('.updatebtn').click(function(e){
        e.preventDefault();
        var data = $(this).data('obj');
        currentMenuId = $(this).data('id'); 
        
        console.log(data);
        $("#name").val(data.name);
        $("#parent_id").val(data.parent_id);
    });
    

    $("#update-data").submit(function(e){
        e.preventDefault();
        $(".update").prop('disabled', true);
        
        // Include the ID in the URL
        var url = '{{ route("admin.category.update", ":id") }}'.replace(':id', currentMenuId);
        
        $.ajax({
            url: url,
            type: 'POST', 
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                console.log(response);
                $(".update").prop('disabled', false);
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                $(".update").prop('disabled', false);
            }
        });
    });
});
 

    </script>
@endsection