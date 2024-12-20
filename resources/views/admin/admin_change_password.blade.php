@extends('admin.admin_master')
@section('admin')
 

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Change Password Page </h4><br><br>
                        
                        <!-- @if(count($errors))
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                            @endforeach
                        @endif -->

                        <form method="post" action="{{ route('update.password') }}" >
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" type="password" value="{{ old('oldpassword') }}"  id="oldpassword">
                                    @error('oldpassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                            <input name="newpassword" class="form-control @error('newpassword') is-invalid @enderror" type="password" value="{{ old('newpassword') }}" id="newpassword">
                            @error('newpassword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" type="password" value="{{ old('confirm_password') }}"  id="confirm_password">
                                @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row --> 
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
@endsection 
