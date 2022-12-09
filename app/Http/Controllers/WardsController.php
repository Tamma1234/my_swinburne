<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WardsController extends Controller
{
    public function index() {
        $wards = Wards::all();
        return view('admin.wards.index', compact('wards'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $districts = District::all();
        return view('admin.wards.create', compact('districts'));
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
            $wards = new Wards();
            $wards->create([
                'name' => $request->name,
                'type' => $request->type
            ]);
            DB::commit();
            return redirect()->route('wards.index')->with('msg-add', 'Create wards Successfuly');
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
        $wards = Wards::find($request->id);
        return view('admin.wards.edit', compact( 'wards'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $wards = Wards::find($request->id);
            $wards->update([
                'name' => $request->name,
                'type' => $request->type,
                'district_id' => $request->district_id
            ]);

            DB::commit();
            return redirect()->route('wards.index')->with('msg-update', 'Update wards Successfuly');
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
        $wards = Wards::find($request->id);
        $wards->delete();

        return redirect()->route('$wards.index')->with('msg-delete', 'Delete the wards and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function wardsTrashOut (Request $request) {
        $wards = Wards::onlyTrashed()->get();
        return view('admin.wards.trash', compact('wards'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        Wards::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('wards.trash')->with('msg-trash', 'Delete Wards Successfully');
    }
}
