@extends('Front.layouts.front-layout', ['title' => 'Join Us'])
@section('content')
    <div class="untree_co-section">
        <div class="container">

            <div class="block">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8 pb-4">
                        <div class="row mb-5">
                            <h1>
                                Register
                            </h1>
                        </div>
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="row mb-2">
                                    <div class="form-group">
                                        <label class="text-black" for="name">First name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-black" for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label class="text-black" for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="text-black" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="text-black" for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                        @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <a href="{{route('users.login')}}">Have an account ?</a>
                            </div>

                            <button type="submit" class="btn btn-primary-hover-outline">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection
