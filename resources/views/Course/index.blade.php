@extends('base_layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Avaliable Coruses</div>
             <div class="card-body">
             <h3>Welcome Mr {{auth()->user()->name}}</h3><br>
             <p>Your current balance : {{is_null(auth()->user()->balance)?0:auth()->user()->balance}}</p><br>
                <div class="col-md-12">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                         <p>   {{session('success')}}   </p>
                        </div>
             @endif
                             @if (session()->has('error'))
                             <div class="alert alert-danger">
                                    <p>   {{session('error')}}   </p>

                             </div>
                         @endif
                  <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                            <thead>
                            <tr>
                             <th>#</th>
                            <th>Course Code</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $index=> $course)
                                <tr>
                                 <td>{{++$index}}</td>
                                <td>{{$course->course_number}}</td>
                                <td><a href="{{route('course.show',$course->id)}}">{{$course->title}}</a></td>
                                <td>{{$course->price}}</td>

                                @if($course->checkRegisterdStudent(auth()->user()->id))
                                <td>
                                <form action="{{route('courses.store')}}" method="post">
                                       @csrf
                                <input type="hidden" name="price" value="{{$course->price}}">
                                <input type="hidden" name="feetype" value="2">
                                <input type="hidden" name="course_id" value="{{$course->id}}">

                                    <input type="submit" class="btn btn-success" value="Enroll">
                                   </form>
                                </td>
                                @else
                            <form action="{{route('courses.destroy',$course->id)}}" method="post">
                                <td>
                                @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="price" value="{{$course->price}}">
                                        <input type="hidden" name="feetype" value="3">

                                     <input type="submit" class="btn btn-danger" value="withdraw">
                                    </form>
                                </td>
                                @endif

                                </tr>
                                @endforeach

                             </tbody>
                            </table>
                            {{$courses->links()}}

                            </div>

                            </div>
            </div>
            </div>
    </div>
</div>
@endsection
