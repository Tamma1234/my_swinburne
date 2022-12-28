<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\Answers;
use App\Models\District;
use App\Models\Question;
use App\Models\Questions;
use App\Models\QuestionType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class QuestionController extends ExamController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function question()
    {
        $questions = Questions::where('parent_id', 0)->
        orderBy('id', 'asc')->paginate(15);
        return view('admin.question.index', compact('questions'));
    }

    public function selectQuestion(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = "";
            if ($data['action'] == 'question') {
                $question = Questions::where('question_type', $data['id'])->get();
                foreach ($question as $item) {
                    $output .= '<option value="' . $item->id . '">' . $item->question_content . '</option>';
                }
            } else {
                $answers = Answers::where('id', $data['id'])->get();
                foreach ($answers as $item) {
                    $output .= '<option value="' . $item->id . '">' . $item->name . '</option>';
                }
            }
        }
        return $output;
    }

    /**
     * @return void
     */
    public function create()
    {
        $questionType = QuestionType::all();
        return view('admin.question.question-create', compact('questionType'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $questions = new Questions();

            $user = $questions->create([
                'question_type' => $request->question_type,
                'question_content' => $request->question_content,
                'file_image' => $request->file_image,
                'type_answers' => $request->type_answers,
                'parent_id' => 0
            ]);
            $id = $user->id;
            $answers = $request->answers;
            foreach ($answers as $item) {
                $questions->insert([
                    'question_type' => $request->question_type,
                    'question_content' => $item,
                    'parent_id' => $id,
                    'type_answers' => $request->type_answers
                ]);
            }
            DB::commit();
            return redirect()->route('question.question')->with('msg-add', 'Create Question Successfuly');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--GetLine' . $exception->getLine());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request)
    {
        $question = Questions::find($request->id);
        $answers = Questions::where('parent_id', $request->id)->get();
        $questionType = QuestionType::all();

        return view('admin.question.question-edit', compact('question', 'answers', 'questionType'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request)
    {

        try {
            DB::beginTransaction();
            $question = Questions::find($request->id);
            $question->update([
                'question_type' => $request->question_type,
                'question_content' => $request->question_content,
                'file_image' => $request->file_image,
            ]);
            $answerQuestion = Questions::where('parent_id', $request->id)
                ->select('id', 'question_content')
                ->pluck('question_content', 'id')
                ->toArray();
            $answers = $request->answers;
            $notAnswer = array_diff($answers, $answerQuestion);
            if (!empty($notAnswer)) {
               $questionAnswer = new Questions();
               foreach ($notAnswer as $key => $value) {
                   $questionAnswer->insert([
                       'question_type' => $request->question_type,
                       'question_content' => $value,
                       'parent_id' => $request->id
                   ]);
               }
            }
            foreach ($answers as $key => $val) {
                $answer = Questions::find($key);
                $answer->update([
                    'question_type' => $request->question_type,
                    'question_content' => $val,
                    'parent_id' => $request->id
                ]);
            }

            DB::commit();
            return redirect()->route('question.question')->with('msg-update', 'Update Question Successfuly');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--GetLine' . $exception->getLine());
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $question = Questions::find($request->id);
        $question->delete();

        return redirect()->route('question.question')->with('msg-delete', 'Delete the Question and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userTrashOut(Request $request)
    {
        $question = Questions::onlyTrashed()->get();
        return view('admin.question.question-trash', compact('question'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request)
    {
        $question = Questions::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('question.trash')->with('msg-trash', 'Delete Question Successfully');
    }

    /**
     * @return void
     */
    public function restore(Request $request) {
        $question = Questions::withTrashed()->where('id', $request->id)->restore();

        return redirect()->route('question.question')->with('msg-add', 'Restore the Question Successfully');
    }
}
