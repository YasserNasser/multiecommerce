<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\MainCategoryRequest;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class MainCategoriesController extends Controller
{
  public function index()
  {
    //dd('hereeee');
    $default_lang = get_default_lang();
    $categories =  MainCategory::where('translation_lang', $default_lang)->selection()->paginate(PAGINATION_COUNT);
    return view('admin.maincategories.index', compact(['categories']));
  }
  public function create()
  {

    //dd('hereeeeeeee');
    return view('admin.maincategories.create');
  }
  public function store(MainCategoryRequest $request)
  {
    try {

        $main_category = collect($request->category);
        $filter = $main_category->filter(function ($value, $key) {
          return $value['abbr'] == get_default_lang();
        });
        $default_category = array_values($filter->all())[0];

        $filePath = "";
        if ($request->has('photo')) {
          $filePath = uploadImage('maincategories', $request->photo);
        }
        if (!$default_category['active']) {
          $default_category['active'] = 0;
        }
        
        DB::beginTransaction();
        $default_category_id = MainCategory::insertGetId([
          'translation_lang' => $default_category['abbr'],
        'translation_of' => 0,
        'name' => $default_category['name'],
        'slug' => $default_category['name'],
        'active' => $default_category['active'],
        'photo' => $filePath,

      ]);
      // dd($default_category_id);
      $categories = $main_category->filter(function ($value, $key) {
        return $value['abbr'] != get_default_lang();
      });

      if (isset($categories) && ($categories->count() > 0)) {
        $categories_arr = [];
        foreach ($categories as $category) {
          if (!isset($category['active'])) {
            $category['active'] = 0;
          }
          $categories_arr[] = [
            'translation_lang' => $category['abbr'],
            'translation_of' => $default_category_id,
            'name' => $category['name'],
            'slug' => $category['name'],
            'active' => $category['active'],
            'photo' => $filePath,
          ];
        }
      }
      MainCategory::insert($categories_arr);
      DB::commit();
      return redirect()->route('admin.maincategories')->with(['success' => 'تم حفظ القسم بنجاح']);
    } catch (\Exception $ex) {
      DB::rollBack();
      return redirect()->route('admin.maincategories')->with(['erroe' => 'هناك خطأ ما حدث حاول مجددا']);
    }
  }
  public function edit($mainCat_id){
    $mainCategory = MainCategory::with('categories')->selection()->find($mainCat_id);
       if(!$mainCategory)
          return redirect()->route('admin.maincategories')->with(['erroe' => 'هذا القسم غير موجود']);
    return view('admin.maincategories.edit', compact(['mainCategory']));
  }


  public function update($mainCat_id, MainCategoryRequest $request){

    try {
      //code...
    
    $mainCategory = MainCategory::find($mainCat_id);
       if(!$mainCategory)
          return redirect()->route('admin.maincategories')->with(['erroe' => 'هذا القسم غير موجود']);
          
          $category = array_values($request->category)[0];
         
          if (!$request->has('category.0.active')) {
            $request->request->add(['active' => '0']);
          }else{
            $request->request->add(['active' => '1']);

          }
          MainCategory::where('id',$mainCat_id)->update([
            'name' => $category['name'] ? $category['name']  : $mainCategory->name ,
            'active' => $request->active,
            ]);
            
            if ($request->has('photo')) {
              $filePath = uploadImage('maincategories', $request->photo);
              MainCategory::where('id',$mainCat_id)->update([
                'photo' => $filePath
              ]);
            }
            return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
          } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ ما حدث حاول مجددا']);
              //throw $th;
            }
          }
}
