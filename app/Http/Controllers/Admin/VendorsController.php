<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use DB;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(){
       $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);
       return view('admin.vendors.index',compact('vendors'));
    }
    public function create(){
        $categories = MainCategory::active()->where('translation_of',0)->get();
        return view('admin.vendors.create',compact('categories'));
    }
    public function store(VendorRequest $request){
        try {
    
           // dd('heeeeerrrr');
            $filePath = "";
            if ($request->has('photo')) {
              $filePath = uploadImage('vendors', $request->photo);
            }
            if (!$request->has('active')) {
                $request->request->add(['active' => '0']);
              }else{
                $request->request->add(['active' => '1']);
              }
            DB::beginTransaction();
          
              $vendor[] = [
                'name' => $request['name'],
                'category_id' => $request['category_id'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'active' => $request['active'],
                'photo' => $filePath,
              ];
            
          Vendor::insert($vendor);
          DB::commit();
          return redirect()->route('admin.vendors')->with(['success' => 'تم حفظ المتجر بنجاح']);
        } catch (\Exception $ex) {
          DB::rollBack();
          return redirect()->route('admin.vendors')->with(['erroe' => 'هناك خطأ ما حدث حاول مجددا']);
        }

    }
    public function edit($vendor_id){
        $vendor = Vendor::selection()->find($vendor_id);
           if(!$vendor)
              return redirect()->route('admin.vendors')->with(['erroe' => 'هذا المتجر غير موجود']);
              $categories = MainCategory::active()->where('translation_of',0)->get();
        return view('admin.vendors.edit', compact(['vendor','categories']));
      }
    public function update(){

    }
    public function changeStatus($vendor_id){
        $vendor = Vendor::find($vendor_id);
       if(!$vendor)
          return redirect()->route('admin.vendors')->with(['erroe' => 'هذا المتجر غير موجود']);

          $vendor->active = !$vendor->active;
          $vendor->save();
          return redirect()->route('admin.vendors')->with(['success' => 'تم تغيير حالة المتجر بنجاح']);
          

    }
}
