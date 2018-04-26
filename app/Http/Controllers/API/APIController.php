<?php

use App\Model\Student
use App\Model\Teacher
use App\Model\Results
use App\Model\School
use App\Http\Controllers\StudentController
use App\Http\Controllers\TeacherController
use App\Http\Controllers\ResultsController
use App\Http\Controllers\SchoolController


class APIController extends Controller
{

	 public function getStudentProfile($id)
    {
        $profile = StudentsController::getStudentProfile( $id);

        return response()->json($profile);

    }
     public function getTeacherProfile($id)
    {
        $profile = new TeachersController();
        $profile->teacherProfile($id);

        return response()->json($profile);
    }

}

