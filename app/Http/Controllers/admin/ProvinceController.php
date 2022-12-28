<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProvinceController extends Controller
{
    public function index() {
        $provinces = Province::all();
        return view('admin.province.index', compact('provinces'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.province.create');
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
            $province = new District();
            $province->create([
                'name' => $request->name,
                'type' => $request->type
            ]);
            DB::commit();
            return redirect()->route('province.index')->with('msg-add', 'Create Province Successfuly');
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
        $province = Province::find($request->id);
        return view('admin.province.edit', compact( 'province'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        try {
            DB::beginTransaction();
            $province = Province::find($request->id);
            $province->update([
                'name' => $request->name,
                'type' => $request->type,
            ]);

            DB::commit();
            return redirect()->route('province.index')->with('msg-update', 'Update Province Successfuly');
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
        $province = Province::find($request->id);
        $province->delete();

        return redirect()->route('province.index')->with('msg-delete', 'Delete the Province and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function provinceTrashOut (Request $request) {
        $provinces = Province::onlyTrashed()->get();
        return view('admin.province.trash', compact('provinces'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request) {
        Province::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('province.trash')->with('msg-trash', 'Delete Province Successfully');
    }

    /**
     * @return void
     */
    public function restore(Request $request) {
        $province = Province::withTrashed()->where('id', $request->id)->restore();

        return redirect()->route('province.index')->with('msg-add', 'Restore the Province Successfully');
    }
}
