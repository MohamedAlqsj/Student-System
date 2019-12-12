@extends('base_layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
             <div class="card-body">
             <h3>Welcome Mr {{auth()->user()->name}}</h3><br>

                <div class="col-md-12">

                  <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                            <thead>
                            <tr>
                             <th>#</th>
                            <th>Course Code</th>
                            <th>Title</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $index=> $course)
                                <tr>
                                 <td>{{++$index}}</td>
                                <td>{{$course->course_number}}</td>
                                <td><a href="{{route('course.show',$course->id)}}">{{$course->title}}</a></td>
                                </tr>
                                @endforeach

                             </tbody>
                            </table>
                            </div>

                            </div>
            </div>
            </div>
    </div>
</div>
@endsection
