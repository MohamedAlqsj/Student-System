@extends('base_layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Add Student</div>
            <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                     <p>   {{session('success')}}   </p>
                    </div>
         @endif

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

                        <div class="form-group">
                                <label>Balance</label>
                                <input class="au-input au-input--full" type="text" name="balance" placeholder="Balance">
                            </div>





                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

            </form>


</div>
@endsection
