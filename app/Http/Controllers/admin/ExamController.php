<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\GroupTest;
use App\Models\Question;
use App\Models\Questions;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exam.index', compact('exams'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $group_test = GroupTest::all();
        $questions = Question::all();
        $questionType = QuestionType::all();

        return view('admin.exam.create', compact('group_test', 'questions', 'questionType'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $exams = new Exam();
        $exam = $exams->create([
            'date_test' => $request->date_test,
            'time_id' => $request->time_id,
            'question_type' => $request->question_type
        ]);
        $questios = $request->question_id;
        foreach ($questios as $item) {
            $exam->questions()->attach($item);
        }

        return redirect()->route('exam.index')->with('msg-add', 'Create Exam Successfully');

    }

    /**
     * @param Request $request
     * @return string
     */
    public function getQuestion(Request $request)
    {
        $exam_id = $request->exam_id;

        if ($exam_id == null) {
            $id = $request->id;
            $question = Questions::where('question_type', $id)
                ->where('parent_id', 0)
                ->orderby('id', 'ASC')->get();
            $output = "";
            foreach ($question as $item) {
                $output .= '<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">';
                $output .= '<input type="checkbox" value="' . $item->id . '" name="question_id[]">' . $item->question_content . '<span></span>';
                $output .= '</label>';
                $output .= '<br>';
            }
            return $output;
        } else {
            $id = $request->id;
            $question = Questions::where('question_type', $id)
                ->where('parent_id', 0)
                ->orderby('id', 'ASC')->get();

            $exam = Exam::where('id', $exam_id)->first();
            $output = "";
            if ($exam) {
                foreach ($question as $item) {
                    $checked = $exam->questions->contains('id', $item->id) ? 'checked' : "";
                    $output .= '<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">';
                    $output .= '<input type="checkbox" value="' . $item->id . '" name="question_id[]" ' . $checked . ' >' . $item->question_content . '<span></span>';
                    $output .= '</label>';
                    $output .= '<br>';
                }
                return $output;
            } else {
                foreach ($question as $item) {
                    $output .= '<label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">';
                    $output .= '<input type="checkbox" value="' . $item->id . '" name="question_id[]">' . $item->question_content . '<span></span>';
                    $output .= '</label>';
                    $output .= '<br>';
                }
                return $output;
            }

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $exam = Exam::find($id);
        $group_test = GroupTest::all();
        $questionType = QuestionType::all();
        return view('admin.exam.edit', compact('exam', 'group_test', 'questionType'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $exam = Exam::find($id);
        $data = $request->except('_token');
        $question = $exam->questions;
        if ($question) {
            $exam->questions()->detach($question);
        }
        $exam->questions()->attach($data['question_id']);

        return redirect()->route('exam.index')->with('msg-add', 'Update Exam Successfully');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $exam = Exam::find($request->id);
        $exam->delete();

        return redirect()->route('exam.index')->with('msg-delete', 'Delete the Question and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function examTrashOut(Request $request)
    {
        $exam = Exam::onlyTrashed()->get();
        return view('admin.exam.exam-trash', compact('exam'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request)
    {
        $exam = Exam::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('exam.trash')->with('msg-trash', 'Delete Question Successfully');
    }

    /**
     * @param Request $request
     * @return void
     */
    public function restore(Request $request) {
        $id = $request->id;
        $exam = Exam::withTrashed()->where('id', $id)->restore();

        return redirect()->route('exam.index')->with('msg-add', 'Restore the exam successfully');

    }
}
