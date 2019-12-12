<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\UserFee;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $students = User::where([]);
        if (request()->has('search')) {
            $students = $students->where('name', 'like', '%' . request()->input('search') . '%')->
            orWhere('student_number', 'like', '%' . request()->input('search') . '%');
        }


        $students = $students->paginate(10);
        $students->appends(['search'=>request()->input('search')]);
        return view('admin.students_index')->with([
            'students'=>$students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('student.register');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        //
        $data =$request->except(['password','image']);
        $data['password']= bcrypt($request->password);
        $max_student_number = User::where('id', User::max('id'))->first();
        if(is_null($max_student_number)){
            $data['student_number']='20190';
        }else{

            $data['student_number']='2019'.$max_student_number->id;
        }

        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/'.$request->image->hashName()));
            $data['image']= $request->image->hashName();

        }

        User::create($data);
        if(auth()->guard('admin')->check()){
            return redirect()->route('student.create')->with('success','You Have Added The Student Successfully !!');

        }
        return redirect()->route('login')->with('success','You Have Registerd successfully !!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


        $student = User::findOrFail($id);
        $student_courses=$student->courses()->withPivot(['grade','year','semester'])->get();
        $student_fees=$student->fees()->withPivot(['value','created_at'])->orderBy('pivot_created_at','desc')->get();

        return view('student.show')->with([
            'student'=>$student,
            'student_courses'=>$student_courses,
            'student_fees'=>$student_fees
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //

        $student= User::findOrFail($id);
        $student->update(['balance'=>$student->balance + $request->balance]);
        UserFee::create(['user_id'=>$id,'fee_id'=>1,'value'=>$request->balance]);
        return redirect()->route('student.index')->with('success','You have updated the balance successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
