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


<!-- Modal -->
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
    </tr>
  </thead>
  <tbody>
    @if ($banners->isNotEmpty())
        @foreach ($banners as $banner)
                <tr>
      <th scope="row">{{ $banner->id }}</th>
      {{-- {{ dd(url('uploads/banners/'.$banner->image)) }} --}}
      <td><img src="{{ url($banner->image) }}" width="100px" height="100px" alt="{{ $banner->paragraph }}"></td>
      <td>{{ $banner->paragraph }}</td>
      <td>{{ $banner->heading }}</td>
      <td>{{ $banner->btn_text }}</td>
      <td>{{ $banner->link }}</td>
     <td>{{ $banner->status == 1 ? 'Enable' : 'Disable' }}</td>
      
    </tr>
        @endforeach
    @endif

  </tbody>
</table>
   </div>
  </div>

</div>

 
@endsection
@section('admin-script')
    <script>
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
        })
    </script>
@endsection