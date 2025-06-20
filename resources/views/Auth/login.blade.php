@extends('frontant.layout.auth.app')
@section('frontant-content')
    
    <!-- Navbar End -->
    @include('frontant.layout.message')
{{-- Registration Form  --}}
 <h1 class="text-center my-2 text-bold">Login </h1>
<form  action="{{ route('authlogin') }}" method="POST">
    @csrf
    <div class="container">

    <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
  </div>
    @error('email')
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

  <button type="submit" class="btn btn-primary">Login</button>
    </div>

</form>
  <a href="{{ route('forgotpassword') }}" class="btn btn-primary my-3 ml-5">Forgot Password</a>

  
@endsection