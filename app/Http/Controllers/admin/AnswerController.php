<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\Question;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $answers = Answers::orderBy('id', 'asc')->paginate(15);
        return view('admin.answers.index', compact('answers'));
    }

    /**
     * @return void
     */
    public function create() {
        $questions = Question::all();
        $questionType = QuestionType::all();

        return view('admin.answers.create', compact('questions', 'questionType'));
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
            $answers = new Answers();

            $answers->create([
                'answers' => $request->answers,
                'question_id' => $request->question_id,
                'file_image' => $request->file_image,
            ]);

            DB::commit();
            return redirect()->route('answers.index')->with('msg-create', 'Create Answers Successfuly');
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
        $answers = Answers::find($request->id);
        $questions = Question::all();

        return view('admin.answers.edit', compact('questions', 'answers'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $answers = Answers::find($request->id);
            $answers->update([
                'answers' => $request->answers,
                'question_id' => $request->question_id,
                'file_image' => $request->file_image,
            ]);

            DB::commit();
            return redirect()->route('answers.index')->with('msg-update', 'Update Answers Successfuly');
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
        $answers = Answers::find($request->id);
        $answers->delete();

        return redirect()->route('answers.index')->with('msg-delete', 'Delete the Answers and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function answersTrashOut(Request $request) {
        $answers = Answers::onlyTrashed()->get();
        return view('admin.answers.trash', compact('answers'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        Answers::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('answers.trash')->with('msg-trash', 'Delete Answers Successfully');
    }
}
