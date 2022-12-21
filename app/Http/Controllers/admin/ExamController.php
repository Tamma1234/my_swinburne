<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\GroupTest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exam.index', compact('exams'));
    }

    public function create()
    {
        $group_test = GroupTest::all();
        $questions = Question::all();
        return view('admin.exam.create', compact('group_test', 'questions'));
    }

    public function store(Request $request)
    {
        $exams = new Exam();
        $exam = $exams->create([
            'date_test' => $request->date_test,
            'time_id' => $request->time_id
        ]);
        $exam->questions()->attach($request->question_id);

        return redirect()->route('exam.index')->with('msg-add', 'Create Exam Successfully');

    }
}
