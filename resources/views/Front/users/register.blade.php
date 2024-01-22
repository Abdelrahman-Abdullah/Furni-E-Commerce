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

                        <form>
                            <div class="row mb-2">
                                    <div class="form-group">
                                        <label class="text-black" for="name">First name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-black" for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="text-black" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="text-black" for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <a href="#">Have an account ?</a>
                            </div>

                            <button type="submit" class="btn btn-primary-hover-outline">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection
