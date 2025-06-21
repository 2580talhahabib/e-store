@extends('layout.admin.app')
@section('admin-content')
<div class="container overflow-hidden ">
      <div class="row">
            <div class="col-md-12 m-5">
                  <h2>App data</h2>
            </div>
            @include('layout.auth.message')
      </div>
      <form action="{{ route('admin.updateappdata') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
    <div class="row m-5">
            <div class="col-md-6">
                  <label for="" class="form-label">Logo First Text</label>
                  <input type="text" class="form-control border border-dark border-1" name="logo_first_text" placeholder="Log First Text" value="{{ isset($data->logo_first_text) ? $data->logo_first_text : '' }}">
                      @error('logo_first_text')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
        
            <div class="col-md-6">
                  <label for="" class="form-label">Logo Second Text</label>
                  <input type="text" class="form-control border border-dark border-1" name="logo_second_text" placeholder="Logo Second Text"value="{{ isset($data->logo_second_text) ? $data->logo_second_text : '' }}">
                       @error('logo_second_text')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Heading</label>
                  <input type="text" class="form-control border border-dark border-1" name="heading" placeholder="Heading" value="{{ isset($data->heading) ? $data->heading : '' }}">
                       @error('heading')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
            <div class="col-md-6">
                  <label for="" class="form-label">Location</label>
                  <input type="text" class="form-control border border-dark border-1" name="location" placeholder="Location" value="{{ isset($data->location) ? $data->location : '' }}"  >
                       @error('location')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Email</label>
                  <input type="email" class="form-control border border-dark border-1" name="email" placeholder="Email" value="{{ isset($data->email) ? $data->email : '' }}">
                       @error('email')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
            <div class="col-md-6">
                  <label for="" class="form-label">Phone</label>
                  <input type="number" class="form-control border border-dark border-1" name="phone" placeholder="Phone" value="{{ isset($data->phone) ? $data->phone : '' }}">
                       @error('phone')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Site Name</label>
                  <input type="text" class="form-control border border-dark border-1" name="site_name" placeholder="Site Name" value="{{ isset($data->site_name) ? $data->site_name : '' }}">
                       @error('site_name')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
            <div class="col-md-6">
                  <label for="" class="form-label">Fasebook URl</label>
                  <input type="url" class="form-control border border-dark border-1" name="fasebook" placeholder="Fasebook Url" value="{{ isset($data->fasebook) ? $data->fasebook : '' }}">
                  
            </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Twitter URl</label>
                  <input type="url" class="form-control border border-dark border-1" name="twitter" placeholder="Twitter Url" value="{{ isset($data->twitter) ? $data->twitter : '' }}">
            </div>
            <div class="col-md-6">
                  <label for="" class="form-label">Linkedin URl</label>
                  <input type="url" class="form-control border border-dark border-1" name="linkdin" placeholder="Linkedin Url" value="{{ isset($data->linkdin) ? $data->linkdin : '' }}">
            </div>
               <div class="col-md-6">
                  <label for="" class="form-label">Instagram URl</label>
                  <input type="url" class="form-control border border-dark border-1" name="instagram" placeholder="Instagram Url" value="{{ isset($data->instagram) ? $data->instagram : '' }}">
            </div>
            <div class="col-md-6">
                  <label for="" class="form-label">Youtube URl</label>
                  <input type="url" class="form-control border border-dark border-1"name="youtube" placeholder="Youtube Url" value="{{ isset($data->youtube) ? $data->youtube : '' }}">
            </div>
               <div class="col-md-6">
                  <label for="" class="form-label">Contact Touch First</label>
                  <input type="text" class="form-control border border-dark border-1" name="contact_touch_text" placeholder="Contact Touch First" value="{{ isset($data->contact_touch_text) ? $data->contact_touch_text : '' }}">
                       @error('contact_touch_text')
                <div class="text text-danger">
                  {{ $message }}
                </div>
            @enderror
            </div>
            <div class="col-md-12 my-3">
           <button type="submit" value="update" class="btn btn-success" >Update</button>

            </div>
     </div>
      </form>
 
           
</div>
@endsection