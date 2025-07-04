@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden vh-100">
    <div class="row">
        <div class="col-md-12 m-5">
            <h2>Banners</h2>
        </div>
        <div class="row">
            <div class="col-md-12 ml-5">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create Banner
</button>


<!-- Create Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form id="formdata" enctype="multipart/form-data">
      <div class="modal-body">

            <div class="form-group">
            <label for="" class="form-label">Select Banner:</label>
            <input type="file" class="form-control" name="image" required>
        </div>
            <div class="form-group">
            <label for="" class="form-label">Paragraph:</label>
            <input type="text" class="form-control" name="paragraph">
        </div>
         <div class="form-group">
            <label for="" class="form-label">Heading:</label>
            <input type="text" class="form-control" name="heading" required>
        </div>
         <div class="form-group">
            <label for="" class="form-label">Button Text:</label>
            <input type="text" class="form-control" name="btn_text">
        </div>
         <div class="form-group">
            <label for="" class="form-label">Link:</label>
            <input type="url" class="form-control" name="link">
        </div>
           <div class="form-group">
            <label for="" class="form-label">Status:</label>
            
            <select name="status" id="" class="form-control">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
            </select>
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary addbtn">Save changes</button>
      </div>
    </form>

    </div>
  </div>
</div>
            </div>
        </div>
    </div>





<!-- Delete modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  id="deleteform">
        @csrf
        @method('DELETE')
      <div class="modal-body">
        <input type="text" name="id" id="iddelete">
       <p>Are you sure you want to delete the Banner</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger ">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>


{{-- update model  --}}

<div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="updatedata" enctype="multipart/form-data">
      <div class="modal-body">
       <input type="text" name="id" id="updateid" >
            <div class="form-group">
            <label for="" class="form-label">Select Banner:</label>
            <input type="file" class="form-control" name="image" id="image" >
        </div>
            <div class="form-group">
            <label for="" class="form-label">Paragraph:</label>
            <input type="text" class="form-control" name="paragraph" id="paragraph">
        </div>
         <div class="form-group">
            <label for="" class="form-label">Heading:</label>
            <input type="text" class="form-control" name="heading" id="heading" required>
        </div>
         <div class="form-group">
            <label for="" class="form-label">Button Text:</label>
            <input type="text" class="form-control" name="btn_text" id="btn_text">
        </div>
         <div class="form-group">
            <label for="" class="form-label">Link:</label>
            <input type="url" class="form-control" name="link" id="link"> 
        </div>
           <div class="form-group">
            <label for="" class="form-label">Status:</label>
            
            <select name="status" id="" class="form-control" id="status">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
            </select>
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary addbtn">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="container">
       <div class="row">
   <div class="col-md-12 my-2">
    <table class="table table-striped ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Paragraph</th>
      <th scope="col">Heading</th>
      <th scope="col">Button Text</th>
      <th scope="col">Link</th>
      <th scope="col">Status</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @if ($banners->isNotEmpty())
        @foreach ($banners as $banner)
                <tr>
      <th scope="row">{{ $banner->id }}</th>
      {{-- {{ dd(url('uploads/banners/'.$banner->image)) }} --}}
      <td>
        @if ($banner->image)
        <img src="{{ url($banner->image) }}" width="100px" height="100px" alt="{{ $banner->paragraph }}">
        @else
            <h6>Image did not exist</h6>
        @endif
      </td>
      <td>{{ $banner->paragraph }}</td>
      <td>{{ $banner->heading }}</td>
      <td>{{ $banner->btn_text }}</td>
      <td>{{ $banner->link }}</td>
     <td>{{ $banner->status == 1 ? 'Enable' : 'Disable' }}</td>
     <td class="d-flex ">
      <a href="#" class="btn btn-success m-1 updatebtn" data-obj="{{ $banner }}"   data-toggle="modal" data-target="#updatemodal">Update</a>
      <button class="btn btn-danger m-1 deletebtn" data-toggle="modal" data-target="#deletemodal"   data-id="{{ $banner->id }}">Delete</button>
     </td>
      
    </tr>
        @endforeach
    @endif

  </tbody>
</table>
   </div>
  </div>
</div>
</div>

 
@endsection
@section('admin-script')
    <script>
      // submit banner 
        $(document).ready(function(){
            $("#formdata").submit(function(e){
               e.preventDefault();
               $(".addbtn").prop('disabled',true);
               var formData=new FormData(this);
               $.ajax({
                url:'{{ route('admin.banner.store') }}',
                type:'POST',
                data:formData,
                contentType:false,
                processData:false,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                success:function(response){
                 alert(response.message)
                 location.reload()
                },
               })
            })

//  delete banner 
$(".deletebtn").click(function(e){
e.preventDefault();
var deleteid=$(this).data('id');
$("#iddelete").val(deleteid);



})

$("#deleteform").submit(function(e){
e.preventDefault();
const formData=$(this).serialize();
console.log(formData);
$.ajax({
  url:'{{ route('admin.banner.delete') }}',
  type:'DELETE',
  data:formData,
   headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
success: function(response) {
    // Create alert element
    const alert = `<div class="alert alert-success alert-dismissible fade show" role="alert">
        ${response.message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`;
    
    // Prepend to container
    $('.container').prepend(alert);
    
    // Reload after delay
    setTimeout(() => {
        location.reload();
    }, 2000);
}
})
})


// update banner 
$(".updatebtn").click(function(e){
e.preventDefault();
var updatedata=$(this).data('obj');
  // $("#image").val(updatedata.image);
  $("#updateid").val(updatedata.id)
  $("#paragraph").val(updatedata.paragraph);
  $("#heading").val(updatedata.heading);
  $("#btn_text").val(updatedata.btn_text);
  $("#link").val(updatedata.link);
 $("select[name='status']").val(updatedata.status);
})


$("#updatedata").submit(function(e){
e.preventDefault();
//  var id =$("#updateid").val(updatedata.id);
var formData=new FormData(this);
$.ajax({
  url:'{{ route('admin.banner.update') }}',
  type:'POST',
  data:formData,
  processData: false,
contentType: false,
     headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
  success:function(response){
console.log(response)
  }
})
})


        })
    </script>
@endsection