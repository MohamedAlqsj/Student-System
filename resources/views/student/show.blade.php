@extends('base_layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{$student->name}} </div>
             <div class="card-body">
            <div class="col-md-12">
                    <div class=" pull-right col-md-4">
                        <div class="card-image">
                                <img  class="image-card" src="{{asset('uploads/'.$student->image)}}" width="100%"  height ="300" alt="Student Image">

                        </div><br>

                    </div>

                <p>Student Number : {{$student->student_number}}</p>
                    <p>Name : {{$student->name}} </p>
                    <p>Email : {{$student->email}}</p>
                    <p>Gender : {{$student->gender ==1 ?'male':'female'}} </p>
                    <p>Identity Card Number : {{$student->id_card_number}}</p>
                    <p> Date Of Birth : {{$student->dob}} </p>
                    <p> Balance : {{is_null($student->balance)?'0':$student->balance}} </p><br>

                    <a href="#" class="btn btn-success">Print Personal Info</a>
                            <a href="#" class="btn btn-info">Print Grades</a>
                            <a href="#"class="btn btn-success">Print Finaicial Info</a>

             <br>
                </div>


           <br>

                @if(count($student_courses)>0)

                <div class="col-md-12">
                        <div class="table-responsive table--no-card m-b-30">
                                <h3>{{$student->name}} Grades</h3><br>

                            <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                        <tr>
                                         <th>#</th>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Grade</th>
                                        <th>Semester</th>
                                        <th>Year</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($student_courses as $index=> $course)
                                            @php
                                            $sum = 0;
                                            $count=1;

                                            @endphp
                                            <tr>
                                             <td>{{++$index}}</td>
                                            <td>{{$course->course_number}}</td>
                                            <td><a href="{{route('course.show',$course->id)}}">{{$course->title}}</a></td>
                                            <td>{{$course->pivot->grade}}</td>
                                            <td>{{$course->pivot->semester}}</td>
                                            <td>{{$course->pivot->year}}</td>
                                            @php
                                            $sum += $course->pivot->grade ;
                                                $count++;
                                            @endphp
                                            </tr>
                                            @endforeach
                                         </tbody>

                                        </table>
                                        <p>Avarage = {{$sum/($count-1)}} </p>
                            </div>
            </div>


            @endif


            @if(count($student_fees)>0)
            <div class="col-md-12">
            <div class="table-responsive table--no-card m-b-30">
            <h3>{{$student->name}} Fincial Report</h3>

                            <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                    <tr>
                                     <th>#</th>
                                    <th>Fee Type</th>
                                    <th>Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($student_fees as $index=> $fee)
                                        <tr>
                                         <td>{{++$index}}</td>
                                        <td>{{$fee->name}}</td>
                                       <td>{{$fee->pivot->value}} </td>

                                        </tr>
                                        @endforeach

                                     </tbody>
                                    </table>

                                   <div class="col-md-4">
                                   <p>current balance : {{$student->balance}}</p>
                                   <p>required balance from the student : {{$student->balance < 0 ? $student->balance : 0}}</p>
                                   </div>
                       </div>
        </div>
                @endif




              </div>


            </div>



</div>








@endsection
