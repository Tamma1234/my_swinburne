<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DistrictController extends Controller
{
    public function index() {
        $districts = District::all();
        return view('admin.districts.index', compact('districts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.districts.create', compact('provinces'));
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
            $district = new District();
            $district->create([
                'name' => $request->name,
                'type' => $request->type,
                'province_id' => $request->province_id
            ]);
            DB::commit();
            return redirect()->route('district.index')->with('msg-add', 'Create District Successfuly');
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
        $district = District::find($request->id);
        return view('admin.districts.edit', compact( 'district'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $district = District::find($request->id);
            $district->update([
                'name' => $request->name,
                'type' => $request->type,
                'province_id' => $request->province_id
            ]);

            DB::commit();
            return redirect()->route('district.index')->with('msg-update', 'Update District Successfuly');
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
        $district = District::find($request->id);
        $district->delete();

        return redirect()->route('district.index')->with('msg-delete', 'Delete the District and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function districtTrashOut (Request $request) {
        $districts = District::onlyTrashed()->get();
        return view('admin.districts.trash', compact('districts'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        District::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('district.trash')->with('msg-trash', 'Delete District Successfully');
    }
}
