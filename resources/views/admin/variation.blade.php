@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden vh-100">
    <div class="row">
        <div class="col-md-12 m-5">
            <h2>Variations</h2>
        </div>
        <div class="row">
            <div class="col-md-12 ml-5">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create variation
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
          <form id="formdata" >
      <div class="modal-body">
         <div class="form-group">
            <label for="" class="form-label">Name:</label>
            <input type="text" class="form-control"  name="name" id="name">
            <p></p>
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

{{-- create value modal  --}}
<div class="modal fade" id="valuemodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add <span class="valuetitle"></span> Value</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <form id="valuedata" >
      <div class="modal-body">
        <input type="text" name="variation_id" id="variation_id">
         <div class="form-group">
            <label for="" class="form-label">Value:</label>
            <input type="text" class="form-control"  name="value" id="value">
            <p></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary valuebtn">Save Value</button>
      </div>
    </form>

    </div>
  </div>
</div>
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
      <th scope="col">Name</th>
      <th scope="col" >values</th>
      <th scope="col">Add Value</th>
      <th scope="col" >Action</th>
    </tr>
  </thead>
  <tbody>
    @if ($variations->isNotEmpty())
        @foreach ($variations as $variation)
                <tr>
      <th scope="row">{{ $variation->id }}</th>
      {{-- {{ dd(url('uploads/banners/'.$banner->image)) }} --}}
      <td>{{ $variation->name }}</td>
      <td >
 
 @if ($variation->value->isNotEmpty())
           @foreach ($variation->value as $val)
                  <span>
             <button class="btn btn-info valdelete" data-id="{{ $val->id }}" >   {{ $val->value }}
              <i class="fa fa-times"></i>
             </button>
             </span>
           @endforeach
       @endif
        
      
        </td>

      <td>
        <button class="btn btn-secondary addvalue" data-toggle="modal" data-target="#valuemodel" data-id="{{ $variation->id }}" data-name="{{ $variation->name }}" >Add Value</button>
      </td>
     {{-- <td class="d-flex ">
      <a href="#" class="btn btn-success m-1 updatebtn" data-obj="{{ $variation }}"   data-toggle="modal" data-target="#updatemodal">Update</a>
      <button class="btn btn-danger m-1 deletebtn" data-toggle="modal" data-target="#deletemodal"   data-id="{{ $variation->id }}">Delete</button>
     </td> --}}
      
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
              //  $(".addbtn").prop('disabled',true);
               var formData=$(this).serialize();
               $.ajax({
                url:'{{ route('admin.variation.store') }}',
                type:'POST',
                data:formData,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                success:function(response){
                  if(response.status== false){
                  $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(response.error.name[0])
                
                  }else{
                    alert(response.message)
                    location.reload();
                  }
                
                },
               })
            })
$(".addvalue").click(function(e){
e.preventDefault();
var valueid=$(this).data('id');
var valuename=$(this).data('name');
$("#variation_id").val(valueid);
$(".valuetitle").text(valuename);
})


// value formdata 
   $("#valuedata").submit(function(e){
               e.preventDefault();
              //  $(".addbtn").prop('disabled',true);
               var formData=$(this).serialize();
               $.ajax({
                url:'{{ route('admin.valuestore.store') }}',
                type:'POST',
                data:formData,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                success:function(response){
                  if(response.status== false){
                  $("#value").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(response.error.value[0])
                
                  }else{
                    alert(response.message)
                    location.reload();
                  }
                
                },
               })
            })

$(".valdelete").click(function(e){
e.preventDefault();
var id=$(this).data('id');
var confirmation=confirm("Are you sure you want to delete the value")
var obj=$(this);
if(confirmation){
$.ajax({
  url:'{{ route('admin.valdestroy.delete') }}',
  type:'DELETE',
  data:{id:id},
     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
  success:function(response){
  alert(response.message);
  // location.reload();
  $(obj).parent().remove();
  }
})
}
})

})



        
    </script>
@endsection