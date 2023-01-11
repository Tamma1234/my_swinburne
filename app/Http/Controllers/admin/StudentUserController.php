<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\StudentUser;
use App\Models\User;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentUserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.student-user.create', compact('provinces'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateStudentRequest $request)
    {
        try {
            DB::beginTransaction();
        $link = "http://127.0.0.1:8000";
        $students = new StudentUser();
        $string = "123@123a";
        $password = Hash::make($string);
        $student = $students->create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'ward_id' => $request->ward_id,
            'password' => $password
        ]);
        $id = $student->id;
        $hashId = Hash::make($id . 'swin');
        $hashString = substr($hashId, 0, 14);
        $path = 'qr-code/' . $hashString . ".svg";
        QrCode::size(300)->margin(10)->generate($link, public_path($path));
        $link = $hashString . ".svg";
        StudentUser::where('id', $id)->update([
            'hash_id' => $hashString,
            'path' => $link
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
    public function edit(Request $request)
    {
        $provinces = Province::all();
        $districts = District::all();
        $wards = Wards::all();
        $student = StudentUser::find($request->id);

        return view('admin.student-user.edit', compact('student', 'provinces', 'districts', 'wards'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $student = StudentUser::find($request->id);
            $student->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'ward_id' => $request->ward_id,
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
    public function delete(Request $request)
    {
        $student = StudentUser::find($request->id);
        $student->delete();

        return redirect()->route('admin.dashboard')->with('msg-delete', 'Delete the Student User and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function studentTrashOut(Request $request)
    {
        $students = StudentUser::onlyTrashed()->get();
        return view('admin.student-user.trash', compact('students'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request)
    {
        StudentUser::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('student.trash')->with('msg-trash', 'Delete Account Successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request) {
        $studenUser = StudentUser::withTrashed()->where('id', $request->id)->restore();

        return redirect()->route('admin.dashboard')->with('msg-add', 'Restore the Account Successfully');
    }
}
