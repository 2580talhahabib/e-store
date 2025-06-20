@extends('frontant.layout.auth.app')
@section('frontant-content')
      <!-- Navbar End -->
    @include('frontant.layout.message')
{{-- Registration Form  --}}
 <h1 class="text-center my-2 text-bold">Register </h1>
<form  action="{{route('authregister') }}" method="POST">
    @csrf
    <div class="container">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your Name">
  </div>
  @error('name')
      <div class="text text-danger">
        {{ $message }}
      </div>
  @enderror
    <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
  </div>
    @error('email')
      <div class="text text-danger">
        {{ $message }}
      </div>
  @enderror
   <div class="form-group  ">
    <label for="exampleInputEmail1" class="form-label">Phone</label>
    <br>
    <input type="hidden" name="country_code" id="code">
    <input type="number" name="phone_number" value="{{ old('phone_number') }}" class="form-control" id="phone_number" aria-describedby="emailHelp" placeholder="Enter your Phone">
  </div>
    @error('phone_number')
      <div class="text text-danger">
        {{ $message }}
      </div>
  @enderror
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
    @error('password')
      <div class="text text-danger">
        {{ $message }}
      </div>
  @enderror
   <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Confirm-password">
  </div>
    @error('password_confirmation')
      <div class="text text-danger">
        {{ $message }}
      </div>
  @enderror
  <button type="submit" class="btn btn-primary">Register</button>
    </div>

</form>
@endsection
  
