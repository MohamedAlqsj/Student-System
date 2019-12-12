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
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach

                                </div>
                            @endif
                        <form action="{{route('student.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>

                                <div class="form-group">
                                        <label>Identity Card Number</label>
                                        <input class="au-input au-input--full" type="text" name="id_card_number" placeholder="Identity Card Number">
                                    </div>

                                    <div class="form-group">
                                            <label>Date Of Birth</label>
                                            <input class="au-input au-input--full" type="date" name="dob">
                                        </div>

                                        <div class="form-group">
                                            <label for="select" class=" form-control-label">Gender</label>
                                            <select name="gender" id="select" class="form-control">
                                            <option selected disabled>Select Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            </select>
                                            </div>

                                    <div class="form-group">
                                            <label>Image</label>
                                            <input class="au-input au-input--full form-control-file" type="file" name="image" >

                                        </div>


                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                <a href="{{route('login')}}">Sign In</a>
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
