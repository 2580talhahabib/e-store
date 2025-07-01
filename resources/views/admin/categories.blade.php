@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden vh-100">
  <div class="row">
    <div class="col-md-12 m-5">
      <h2>Categories</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 ml-5">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Create Category
      </button>

      <!-- create Model -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                 <form id="submitBtn">
            <div class="modal-body">
         
                <div class="form-group">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                  <label for="" class="">Parent Category</label>
                  <select name="parent_id" id="parent_id" class="form-control">
                    @if ($categories->isNotEmpty())
                    <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                            
                        @endforeach
                    @endif
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit"  class="btn btn-primary">Save changes</button>
            </div>
              </form>

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
      <td >{{ $category->children->name }}</td>
     
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
  $("#submitBtn").submit(function(e){
e.preventDefault();
// console.log("Hello world")
var data=$(this).serialize();
$.ajax({
  url:"{{ route('admin.category.store') }}",
  type:"POST",
  data: data,
     headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
  success:function(response){
   location.reload();
  }
})

  })
})
</script>
@endsection