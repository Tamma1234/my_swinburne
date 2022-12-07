<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function question() {
        $questions = Question::orderBy('id', 'asc')->paginate(15);
        return view('admin.exam.index', compact('questions'));
    }

    /**
     * @return void
     */
    public function create() {
       return view('admin.exam.question-create');
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
            $questions = new Question();

            $user = $questions->create([
                'question_type_name' => $request->question_type_name,
                'question_content' => $request->question_content,
                'file_image' => $request->file_image,
            ]);

            DB::commit();
            return redirect()->route('exam.question')->with('msg-create', 'Create Question Successfuly');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--GetLine' . $exception->getLine());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request) {
        $question = Question::find($request->id);
        $answers = $question->answers;

        return view('admin.exam.question-edit', compact('question', 'answers'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $question = Question::find($request->id);
            $question->update([
                'question_type_name' => $request->question_type_name,
                'question_content' => $request->question_content,
                'file_image' => $request->file_image,
            ]);

            DB::commit();
            return redirect()->route('exam.question')->with('msg-update', 'Update Question Successfuly');
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
    public function delete(Request $request) {
        $question = Question::find($request->id);
        $question->delete();

        return redirect()->route('exam.question')->with('msg-delete', 'Delete the Question and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userTrashOut(Request $request) {
        $question = Question::onlyTrashed()->get();
        return view('admin.exam.question-trash', compact('question'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        $question = Question::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('question.trash')->with('msg-trash', 'Delete Question Successfully');
    }
}
