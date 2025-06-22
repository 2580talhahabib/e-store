@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden vh-100">
    <div class="row">
        <div class="col-md-12 m-5">
            <h2>Menus</h2>
        </div>
        <div class="row">
            <div class="col-md-12 m-5">
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
            </div>
        </div>
    </div>

</div>


@endsection
@section('admin-script')
    <script>
      $(document).ready(function(){
        $("#menu-data").submit (function(e){
        e.preventDefault();
        var formData=$(this).serialize();
$(".createBtn").prop('disabled',true)
        $.ajax({
          url:'{{ route('admin.menus.store') }}',
          type:'Post',
          dataType:'json',
          data:formData,
           headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
          success:function(response){
             console.log(response);
        $(".createBtn").prop('disabled',false)

          }
        })
        })
      })
    </script>
@endsection