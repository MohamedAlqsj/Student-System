<!DOCTYPE html>
<html lang="en">

@include('base_layout.header_meta')

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                           <h3>Student System</h3>
                        </div>
                        <div class="login-form">

                            @if(session()->has('success'))
                           <div class="alert alert-success">
                            <p>   {{session('success')}}   </p>
                           </div>
                @endif
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                        <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">


                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">

                                </div>

<div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div>


                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Sign In</button>

                            </form>
                            <div class="register-link">
                                <p>
                                        Don't you have account?
                                    <a href="{{route('register')}}">Sign up here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

   @include('base_layout.footer_meta')
</body>

</html>
<!-- end document-->
