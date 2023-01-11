<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\School;
use App\Models\StudentUser;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index() {
        $schools = School::all();
        return view('admin.schools.index', compact('schools'));
    }

    public function create() {
        $provinces = Province::all();
        return view('admin.schools.create', compact('provinces'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $school = new School();
        $school->fill($data);
        $school->save();

        return redirect()->route('school.index')->with('msg-add', 'Create School Successfully');
    }

    public function edit(Request $request) {
        $id = $request->id;
        $school = School::find($id);
        $provinces = Province::all();
        return view('admin.schools.edit', compact('school', 'provinces'));
    }

    public function update(Request $request) {
        $id = $request->id;
        $school = School::find($id);
        $data = $request->all();
        $school->update($data);

        return redirect()->route('school.index')->with('msg-add', 'Update School Successfully');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $school = School::find($request->id);
        $school->delete();

        return redirect()->route('school.index')->with('msg-delete', 'Delete the School and cancel in the trash');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function schoolTrashOut(Request $request)
    {
        $schools = School::onlyTrashed()->get();
        return view('admin.schools.trash', compact('schools'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCompletely(Request $request)
    {
        School::withTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->route('school.trash')->with('msg-trash', 'Delete School Successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request) {
        $school = School::withTrashed()->where('id', $request->id)->restore();

        return redirect()->route('school.index')->with('msg-add', 'Restore the School Successfully');
    }
}
