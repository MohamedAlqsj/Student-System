<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\UserCourse;
use App\UserFee;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $courses = Course::paginate(10);
        return view('course.index')->with([
            'courses'=>$courses
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $student = User::findOrFail(auth()->user()->id);
        $course = Course::findOrFail($request->course_id);
        if($student->balance >= $course->price){
            $student->update(['balance'=>$student->balance - $request->price]);
            UserFee::create(['user_id'=>auth()->user()->id,'fee_id'=>$request->feetype,'value'=>-$request->price]);
            // $student->fees()->attach($request->feetype);
            // $student->fees()->where(['user_id'=>auth()->user()->id,'fee_id'=>$request->feetype])
            // ->update(['value'=>-$request->price]);
            UserCourse::create(['user_id'=>auth()->user()->id,'course_id'=>$request->course_id]);

            // $student->courses()->attcach($request->course_id);
            return redirect()->route('courses.index')->with('success','You have Enrolled successfully');
        }

        return redirect()->route('courses.index')->with('error','You dont have enough balance');

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

        $course =Course::findOrFail($id);
        $students=$course->users()->withPivot(['grade','year','semester'])->get();

        return view('course.show')->with([
            'course'=>$course,
            'students'=>$students
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
    public function update(Request $request, $id)
    {
        //
        $course = Course::findOrFail($id);
        $course->users()->where('user_id',$request->student_id)->update(['grade'=>$request->grade]);
        return redirect()->route('course.show',$id)->with('success','You have updated the grade successfully');
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
        $student = User::findOrFail(auth()->user()->id);
        $student->update(['balance'=>$student->balance + request()->price]);
        UserFee::create(['user_id'=>auth()->user()->id,'fee_id'=>request()->feetype,'value'=>request()->price]);
        UserCourse::where(['course_id'=>$id,'user_id'=>$student->id])->delete();
        // $student->fees()->attach(request()->feetype);
        // $student->fees()->where(['user_id'=>auth()->user()->id,'fee_id'=>request()->feetype])->update(['value'=>request()->price]);


        // $student->courses()->detach(request()->course_id);
        return redirect()->route('courses.index')->with('success','You have withdrawn successfully');

    }
}
