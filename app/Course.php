<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //

    protected $guarded = [];


    public function users(){
        return $this->belongsToMany(User::class,'users_courses');
    }


       /**
     * checks if the studenet registerd in the course
     */

    public function checkRegisterdStudent($id){
        $course = $this->users()->where('course_id',$this->id)->where('user_id',$id)->first();
        if(is_null($course)){
            return true;
        }
            return false;
    }
}
