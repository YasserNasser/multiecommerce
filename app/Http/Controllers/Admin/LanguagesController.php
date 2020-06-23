<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguagesController extends Controller
{

    public function index()
    {
        $languages = Language::paginate(PAGINATION_COUNT);
        //$languages = Language::all();
        // dd($languages);
        return view('admin.languages.index', compact(['languages']));
    }
    public function create()
    {

        return view('admin.languages.create');
    }
    public function store(LanguageRequest $request)
    {
        try {
            if (!$request['active']) {
                $request['active'] = 0;
            }
            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ ما قد حصل']);
        }
    }

    public function edit($id)
    {

        $language = Language::find($id);
        if (!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة']);
        }

        return view('admin.languages.edit', compact(['language']));
    }

    public function update($id, LanguageRequest $request)
    {
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.edit', $id)->with(['error' => 'هذه اللغة غير موجودة']);
            }
            if (!$request['active']) {
                $request['active'] = 0;
            }

            $language->update($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم تحديث اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ ما قد حصل']);
        }
    }
    public function destroy($id)
    {
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.edit', $id)->with(['error' => 'هذه اللغة غير موجودة']);
            }

            $language->delete();
            return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ ما قد حصل']);
        }
    }
}
