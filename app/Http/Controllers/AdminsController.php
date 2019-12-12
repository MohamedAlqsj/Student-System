<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    //


    public function index(){

        $courses = Course::where('admin_id',auth()->user()->id)->get();
        return view('admin.index')->with([
            'courses'=>$courses
        ]);
    }


    public function create_student(){
        return view('admin.students_create');
    }
}
