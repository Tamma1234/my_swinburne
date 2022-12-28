<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\District;
use App\Models\Office;
use App\Models\Province;
use App\Models\Roles;
use App\Models\User;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function selectAddress(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = "";
            if ($data['action'] == 'city') {
                $districts = District::where('province_id', $data['id'])->orderby('id', 'ASC')->get();
                foreach ($districts as $item) {
                    $output.='<option value="'.$item->id.'">'.$item->name.'</option>';
                }
            } else {
                $wards = Wards::where('district_id', $data['id'])->orderby('id', 'ASC')->get();
                foreach ($wards as $item) {
                    $output.='<option value="'.$item->id.'">'.$item->name.'</option>';
                }
            }
        }
        return $output;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.users.create', compact('provinces'));
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
            $users = new User();
            $user = $users->create([
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
        $user = User::find($request->id);
        return view('admin.users.edit', compact( 'user'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $user = User::find($request->id);
            $user->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number
            ]);

            DB::commit();
            return redirect()->route('admin.dashboard')->with('msg-update', 'Update Account Successfuly');
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
        $user = User::find($request->id);
        $user->delete();

        return redirect()->route('users.index')->with('msg-delete', 'Delete the Users and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userTrashOut(Request $request) {
        $users = User::onlyTrashed()->get();
        return view('admin.users.trash', compact('users'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        User::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('users.trash')->with('msg-trash', 'Delete Account Successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request) {
        $user = User::withTrashed()->where('id', $request->id)->restore();

        return redirect()->route('users.index')->with('msg-add', 'Restore the User Successfully');
    }
}
