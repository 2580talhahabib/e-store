@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden vh-100">
    <div class="row">
        <div class="col-md-12 m-5">
            <h2>Menus</h2>
        </div>
        <div class="row">
            <div class="col-md-12 ml-5">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create Menu
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="menu-data">
        @csrf
      <div class="modal-body">
        <div class="form-group">
            <label for="" class="form-label">Menu Name :</label>
            <input type="text" class="form-control" name="name" required>
        </div>
          
        <div class="form-group">
            <label for="" class="form-label">URL :</label>
            <input type="text" class="form-control" name="url" required>
        </div>
     
        <div class="form-group d-flex ">
            <label for="" class="form-label">Is External Link </label>
            <input type="checkbox" class="mb-1 ml-1" style="width: 15px" value="1" name="is_extenal">
           
        </div>
        
        <div class="form-group">
            <label for="" class="form-label">Positon :</label>
            <select  id="" class="form-control" name="position">
                <option value="main">Main</option>
                <option value="quick_links_1">Quick Links 1</option>
                <option value="quick_links_2">Quick Links 2</option>
            </select>
        </div>
        @if ($parents->isNotEmpty())
         <div class="form-group">
            <label for="" class="form-label">Parent Manu :</label>
            <select name="parent_id" id="" class="form-control">
              <option value=" " >Add parent Category</option>
              @foreach ($parents as $parent)
             <option value="{{ $parent->id }}">{{ $parent->name }}</option>                 
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
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="menu-data">

        <input type="hidden">
      <div class="modal-body">
     <p>Are you sure you want to delete the Menue</p>    
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
        <h5 class="modal-title" id="exampleModalLongTitle">Update Menu</h5>
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
            <label for="" class="form-label">Menu Name :</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
          
        <div class="form-group">
            <label for="" class="form-label">URL :</label>
            <input type="text" class="form-control" name="url" id="url" required>
        </div>
     
        <div class="form-group d-flex ">
            <label for="" class="form-label">Is External Link </label>
            <input type="checkbox" class="mb-1 ml-1" style="width: 15px" id="is_extenal" value="1" name="is_extenal">
           
        </div>
        
        <div class="form-group">
            <label for="" class="form-label">Positon :</label>
            <select  id="" class="form-control" name="position" id="position">
                <option value="main">Main</option>
                <option value="quick_links_1">Quick Links 1</option>
                <option value="quick_links_2">Quick Links 2</option>
            </select>
        </div>
        @if ($parents->isNotEmpty())
         <div class="form-group">
            <label for="" class="form-label">Parent Manu :</label>
            <select name="parent_id" id="" class="form-control" id="parent_id">
              <option value=" " >Add parent Category</option>
              @foreach ($parents as $parent)
             <option value="{{ $parent->id }}">{{ $parent->name }}</option>                 
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
      <th scope="col">Menu</th>
      <th scope="col">URL</th>
      <th scope="col">External</th>
      <th scope="col">Position</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @if ($parents->isNotEmpty())
        @foreach ($parents as $parent)
                <tr>
      <td >{{ $parent->id }}</td>
      <td >{{ $parent->name }}</td>
      <td>{{ $parent->url }}</td>
      <td>{{ $parent->is_extenal == 0 ? 'No' : 'Yes' }}</td>
      <td>{{ $parent->position }}</td>
      <td class="text-center">
        <a class="btn btn-danger text-white deletebtn"   data-toggle="modal" data-target="#deletemenu" data-id="{{ $parent->id }}" >Delete</a>
        <a type="submit"  class="btn btn-secondary text-white updatebtn"  data-toggle="modal" data-target="#updatemenu" data-obj="{{ $parent }}" data-id="{{ $parent->id }}" >Update</a>
      </td>
      
    </tr>
            @endforeach
    @endif

  </tbody>
</table>
   {{ $parents->links('pagination::bootstrap-5') }}
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
            url: '{{ route("admin.menus.store") }}',
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
                var url = "{{ route('admin.menus.delete', 'id') }}".replace('id', currentId);
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
        $("#url").val(data.url);
        $("#is_extenal").prop('checked', data.is_extenal);
        $("#position").val(data.position);
        $("#parent_id").val(data.parent_id);
    });
    

    $("#update-data").submit(function(e){
        e.preventDefault();
        $(".update").prop('disabled', true);
        
        // Include the ID in the URL
        var url = '{{ route("admin.menus.update", ":id") }}'.replace(':id', currentMenuId);
        
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