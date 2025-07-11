@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center w-100" role="alert">
 {{ Session::get('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if (Session::has('danger'))
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
 {{ Session::get('danger') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif