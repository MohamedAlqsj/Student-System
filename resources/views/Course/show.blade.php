@extends('base_layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{$course->title}}</div>
             <div class="card-body">
             <p>Course Number : {{$course->course_number}}</p>
             <p>Course Description : {{$course->desc}} </p>

             <br>
                @if(auth()->guard('admin')->check())
                <div class="col-md-12">

                  <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                            <thead>
                            <tr>
                             <th>#</th>
                            <th>Student Name</th>
                            <th>Grade</th>
                            <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $index=> $student)
                                <tr>
                                 <td>{{++$index}}</td>
                                <td>{{$student->name}}</td>
                                <td id="currentGrade" html-va>{{$student->pivot->grade}}</a></td>
                                <td>
                                <button  data-student_id = "{{$student->id}}" type="button" class="btn btn-primary updateGradeButton "
                                        data-toggle="modal"
                                        data-target="#gradeForm">
                                    edit
                                </button>
                                </td>
                                </tr>
                                @endforeach

                             </tbody>
                            </table>
                            </div>

                            </div>

                            @endif

                        </div>
            </div>
    </div>
</div>


<div class="modal fade" id="gradeForm" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Grade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group col-md-9 first-div">
                    <form id="submitForm"  method = "post" action="{{route('course.update',$course->id)}}">
                        @csrf()
                        @method('put')
                        <input type="hidden" name="student_id" id="studentId">
                                <div class="form-group">
                                        <label class="form-control-label"> New Grade : </label>
                                        <input type="text" name="grade" id="modalGrade" class="form-control" required>
                                    </div>

                                    <input type="submit" id="submitUpdateGrade" class="btn btn-info" value="Update">
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>


</div>

</div>

@section('script')

<script>

$('.updateGradeButton').click(function () {

    var id = $(this).data('student_id');
    $('#studentId').val(id);
    var row = $(this).closest("tr");
    var grade = row.find("#currentGrade").text();
      $('#modalGrade').val(grade);

        });


        $('#submitUpdateGrade').click(function (e) {
            e.preventDefault();
            let grade = $('#modalGrade').val();
            if (grade == '') {
                swal("please enter a grade", "", "error");
                return;
            }
            swal({
                text:
                  'Are you sure that you want to update the grade ?',
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,

            })
                .then((willSubmit) => {
                    if (willSubmit) {
                        $('#submitForm').submit();
                    }
                });
        });

</script>


@endsection




@endsection
