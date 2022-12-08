<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentUserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.student-user.create');
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $students = new StudentUser();
            $students->create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number
            ]);
            DB::commit();
            return redirect()->route('admin.dashboard')->with('msg-add', 'Create Account Successfuly');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--GetLine' . $exception->getLine());
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request) {
        $student = StudentUser::find($request->id);
        return view('admin.student-user.edit', compact( 'student'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $student = StudentUser::find($request->id);
            $student->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number
            ]);

            DB::commit();
            return redirect()->route('admin.dashboard')->with('msg-update', 'Update Account Student Successfuly');
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
        $student = StudentUser::find($request->id);
        $student->delete();

        return redirect()->route('admin.dashboard')->with('msg-delete', 'Delete the Student User and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function studentTrashOut (Request $request) {
        $students = StudentUser::onlyTrashed()->get();
        return view('admin.student-user.trash', compact('students'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        StudentUser::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('student.trash')->with('msg-trash', 'Delete Account Successfully');
    }
}
