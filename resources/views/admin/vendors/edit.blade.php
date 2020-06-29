@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.vendors')}}"> المتاجر </a>
                            </li>
                            <li class="breadcrumb-item active">إضافة متجر
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> إضافة متجر </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.vendors.update',$vendor->id)}}" method="POST"
                                        enctype="multipart/form-data">
                                          @csrf
                                       <input type="hidden" id="id" name="id" value="{{$vendor->id}}">
                                      <div class="form-group">
                                          <label> صوره القسم </label>
                                      <img src="{{asset($vendor->photo)}}" style="width: 150px">
                                          <label id="projectinput7" class="file center-block">
                                              <input type="file" id="file" name="photo">
                                              <span class="file-custom"></span>
                                          </label>
                                          @error("photo")
                                           <span class="text-danger">{{$message}} </span>
                                           @enderror
                                       </div>

                                      <div class="form-body">

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات  المتجر </h4>
                                            {{-- @if(get_languages()->count() > 0)
                                            @foreach (get_languages() as $index=> $lang) --}}
                                                
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="name">  اسم المتجر </label>
                                                    <input type="text" value="{{$vendor->name}}" id="name"
                                                               class="form-control"
                                                               placeholder="ادخل اسم المتجر  "
                                                               name="name">
                                                               @error("name")
                                                               <span class="text-danger">{{$message}} </span>
                                                               @enderror
                                                     </div>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="category_id">  اختر القسم </label>
                                                    <select  id="category_id"
                                                               class="select2 form-control"
                                                               name="category_id">
                                                            <optgroup placeholder="اختر القسم ">

                                                                @if($categories && $categories->count() > 0)
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{$category->id}}" @if($vendor->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                                    @endforeach
                                                                @endif

                                                            </optgroup>
                                                            
                                                            </select>
                                                               @error("category_id")
                                                               <span class="text-danger">{{$message}} </span>
                                                               @enderror
                                                     </div>
                                                </div>
                                                
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="mobile">  رقم الهاتف </label>
                                                    <input type="text"  id="mobile"
                                                               class="form-control"
                                                               value="{{$vendor->mobile}}"
                                                               placeholder="ادخل رقم الهاتف  "
                                                               name="mobile">
                                                               @error("mobile")
                                                               <span class="text-danger">{{$message}} </span>
                                                               @enderror
                                                     </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="emial">  البريد الالكتروني </label>
                                                    <input type="text"  id="email"
                                                               class="form-control"
                                                               value="{{$vendor->email}}"
                                                               placeholder="البريد الالكتروني  "
                                                               name="email">
                                                               @error("email")
                                                               <span class="text-danger">{{$message}} </span>
                                                               @enderror
                                                     </div>
                                                </div>
                                               
                                            </div>
                                            {{-- @endforeach
                                            @endif --}}
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  value="1" name="active"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                               @if($vendor->active == 1) checked @endif/>
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">  الحالة </label>
                                                               @error("active")
                                                               <span class="text-danger">{{$message}} </span>
                                                               @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
@endsection