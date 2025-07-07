@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden vh-100">
    <div class="row">
        <div class="col-md-12 m-5">
            <h2>Prodcuts</h2>
        </div>
        <div class="row">
            <div class="col-md-12 ml-5">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Create Product
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
          <form id="formdata"  enctype="multipart/form-data">
      <div class="modal-body">
         <div class="form-group">
            <label for="" class="form-label">Image:</label>
            <input type="file" class="form-control"  name="image[]" id="image" required multiple accept=".jpg, .jpeg, .png,">
            <p></p>
        </div>
            <div class="form-group">
            <label for="" class="form-label">Title:</label>
            <input type="text" class="form-control"  name="title" id="title" placeholder="Enter Title">
            <p></p>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="" class="form-label">Price:(pkr)</label>
               <input name="pkr_price" id="pkr_price" class="form-control">
            </div>
             <div class="col-md-6">
              <label for="" class="form-label">Price:(usd)</label>
               <input name="usd_price" id="usd_price" class="form-control">
            </div>
          </div>
        </div>
               <div class="form-group">
            <label for="" class="form-label">Stock:</label>
            <input type="number" class="form-control"  name="stock" id="stock" placeholder="Enter your quantity">
            <p></p>
        </div> 
                      <div class="form-group">
            <label for="" class="form-label">Sku:</label>
            <input type="number" class="form-control"  name="sku" id="sku" placeholder="Enter your sku">
            <p></p>
        </div>   


           <div class="form-group">
           <div class="row">
            <div class="col-md-6">
              <label for="" class="form-label">Parent Categories:</label>
           <select name="category_id"  class="parent_category form-control" id="category_id">
            <option value="">Enter your Parent category</option>
            
             @if (getcategories()->isNotEmpty())
             
                 @foreach (getcategories() as $getcategory)
                     <option value="{{ $getcategory->id }}">{{ $getcategory->name }}</option>
                   
                 @endforeach
             @endif
           </select>
            <p></p>
            </div>
            <div class="col-md-6">
             <label for="" class="form-label">Child Categories:</label>
           <select name="childcategory" id="childcategory" class="form-control">
            <option value="">Enter your category</option>
         
           </select>
            <p></p>
            </div>
           </div>
          
        </div>
        <div  class="cart">
        <label for="" class="form-label">Variations:</label>
           <div class="form-group">
              @if (getvariations()->isNotEmpty())
                  @foreach ( getvariations() as $variation)
                        <label for="" class="form-label">{{ $variation->name }}</label>
          <select class="form-control" name="variation[]" id="variation" multiple>
            @foreach ($variation->value as $val)
            <option value="{{ $val->id }}">{{ $val->value }}</option>
            @endforeach
          </select>
                  @endforeach
              @endif
       
         </div>  
       
        </div>
              <div class="form-group">
            <label for="" class="form-label">Descripation:</label>
           <textarea name="descripation" id="descripation" class="form-control"></textarea>
        </div>   
             <div class="form-group">
            <label for="" class="form-label">Additional Information:</label>
           <textarea name="add_information" id="add_information" class="form-control"></textarea>
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

 @endsection
 @section('admin-script')
 <script>
     $(".parent_category").change(function(){
var id= $(this).val();


    $.ajax({
      url:'{{ route('product.childcategory') }}',
      type:'GET',
      data:{id:id},
       headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
      success:function(response){
if(response.status == true){
  console.log(response);
   $('#childcategory').empty().append('<option value="">Select a Subcategory</option>');
                    response.category.forEach(function(e) {
                        $('#childcategory').append('<option value="' + e.id + '">' +
                            e.name + '</option>');
                    });

}
      }
     })
     })
 



     $("#formdata").submit(function(e){
      e.preventDefault();
      var formData=new FormData(this);
      $.ajax({
        url:'{{ route('admin.product.store') }}',
        type:'POST',
        processData:false,
        contentType:false,
        data:formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
        success:function(response){
     console.log(response)
        }  
      })
     })

 </script>
 @endsection
 