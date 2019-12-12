@extends('base_layout.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Students</div>
             <div class="card-body">

                <div class="col-md-12">
                <a href="{{route('student.create')}}" class="btn btn-success btn" style="margin-bottom: 20px"> <i class="fa fa-plus"></i> Add Student </a>

                <div class="pull-right">
                        <form class="form-header" action="" method="GET">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="search for a student" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                </div>
                  <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                            <thead>
                            <tr>
                             <th>#</th>
                             <th>Student Number</th>
                            <th>Student name</th>
                            <th>Gender</th>
                            <th>Balance</th>
                            <th>Update Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $index=> $student)
                                <tr>
                                 <td>{{++$index}}</td>
                                <td><a href="{{route('student.show',$student->id)}}">{{$student->student_number}}</a></td>
                                <td><a href="{{route('student.show',$student->id)}}">{{$student->name}}</a></td>
                                <td>{{$student->gender ==1 ?'male':'female'}}</td>
                                <td id="currentBalance">{{$student->balance}}</td>
                               <td>
                                    <form id="submitForm"  method = "post" action="{{route('student.update',$student->id)}}">
                                            @csrf()
                                            @method('put')
                              <input type="text" name="balance" id="modalBalance" class="form-control" required>
                               <input type="submit" id="submitUpdateBalance" class="btn btn-info" value="Update" style="margin-left: 75px">

                              </form>
                                {{-- <button  data-student_id = "{{$student->id}}" type="button" class="btn btn-primary updateBalanceButton "
                                    data-toggle="modal"
                                    data-target="#balanceForm">
                                edit
                            </button> --}}

                        </td>
                        {{-- <div class="modal fade" id="balanceForm" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group col-md-9 first-div">
                    <form id="submitForm"  method = "post" action="{{route('student.update',$student->id)}}">
                        @csrf()
                        @method('put')
                        {{$student->id}}
                                <div class="form-group">
                                        <label class="form-control-label"> Add Balance : </label>
                                        <input type="text" name="balance" id="modalBalance" class="form-control" required>
                                    </div>

                                    <input type="submit" id="submitUpdateBalance" class="btn btn-info" value="Update">
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div> --}}
                                </tr>





                                @endforeach

                             </tbody>
                            </table>
                            {{$students->links()}}

                            </div>

                            </div>
            </div>
            </div>
    </div>
</div>





</div>

</div>

@section('script')

<script>

$('.updateBalanceButton').click(function () {

    var row = $(this).closest("tr");
    var balance = row.find("#currentBalance").text();
      $('#modalBalance').val(balance);

        });


        $('#submitUpdateBalance').click(function (e) {
            e.preventDefault();
            let balance = $('#modalBalance').val();
            if (balance== '') {
                swal("please enter a balance", "", "error");
                return;
            }
            swal({
                text:
                  'Are you sure that you want to update the balance ?',
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
