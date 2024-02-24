@extends('Front.layouts.front-layout' , ['title' => 'Forget Password'])
@section('content')
    <div class="untree_co-section">
        <div class="container">
            <div class="block">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8 pb-4">
                        @if(session('success'))
                            <div class="alert alert-success text-center">
                                {{session('success')}}
                            </div>
                        @endif
                        <div class="row mb-2">
                            <h1>
                                Reset Password
                            </h1>
                        </div>
                        <form action="{{route('users.reset-password')}} " method="POST">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-8">
                                    <div class="form-group mb-2">
                                        <label class="text-black" for="code">Enter Code You Received</label>
                                        <input type="text" class="form-control" id="code">
                                        @error('code')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="text-black" for="password">New Password</label>
                                        <input type="text" class="form-control" id="password">
                                        @error('password')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="text-black" for="confirm-password">Confirm Password</label>
                                        <input type="text" class="form-control" id="confirm-password">
                                        @error('password_confirmation')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-hover-outline">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
