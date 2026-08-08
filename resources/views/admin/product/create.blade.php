  @extends('admin.master')

  @section('content')
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <div class="col-sm-6">
                          <h3 class="mb-0">Add New Products</h3>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-end">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Products</li>
                          </ol>
                      </div>
                  </div>
                  <!--end::Row-->
              </div>
              <!--end::Container-->
          </div>
          <!--end::App Content Header-->
          <!--begin::App Content-->
          <div class="app-content">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row g-4">
                      <div class="col-md-12">
                          <!--begin::Quick Example-->
                          <div class="card card-primary card-outline mb-4">
                              <!--begin::Header-->
                              <div class="card-header">
                                  <div class="card-title">Input Products Data</div>
                              </div>
                              <!--end::Header-->
                              <!--begin::Form-->
                              <form action="{{url('/manage/product-store')}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  <!--begin::Body-->
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-md-6 col-sm-12 col-12">
                                              <div class="mb-3">
                                                  <label for="name" class="form-label">products Name</label>
                                                  <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"/>
                                                  @error('name')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror
                                              </div>
                                          </div>

                                           <div class="col-md-6 col-sm-12 col-12">
                                              <div class="mb-3">
                                                  <label for="sku_code" class="form-label">product Sku Code (Optional)</label>
                                                  <input type="text" class="form-control" name="sku_code" id="sku_code" value="{{old('sku_code')}}"/>
                                              </div>
                                          </div>

                                          
                                          <div class="col-md-6 col-sm-12 col-12">
                                              <div class="mb-3">
                                                  <label for="cat_id" class="form-label">Select Category</label>
                                                  <select name="cat_id" id="cat_id" class="form-control">
                                                   <option value="" disable selected>select subcategory</option>
                                                      @foreach ($categories as $category)
                                                          <option value="{{$category->id}}">{{$category->name}}</option>
                                                      @endforeach
                                                  </select>

                                                   @error('cat_id')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror

                                              </div>
                                          </div>

                                          <div class="col-md-6 col-sm-12 col-12">
                                              <div class="mb-3">
                                                  <label for="subcat_id" class="form-label">Select SubCategory (Optional)</label>
                                                  <select name="subcat_id" id="subcat_id" class="form-control">
                                                    <option value="" disable selected>select subcategory</option>

                                                      @foreach ($subcategories as $subcategory)
                                                          <option value="{{$subcategory->id}}">{{$subcategory->name}}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                          </div>

                                            <div class="col-md-6 col-sm-12 col-12">
                                              <div class="mb-3" id="color_fields">
                                                  <label for="color_name" class="form-label">Color Name</label>
                                                  <input type="text" class="form-control mb-2" name="color_name[]" placeholder="Color Name" id="color_name" value="{{old('qty')}}"/>
                                                  <button type="button" class="btn btn-success mt-2" id="add_color">Add More</button>
                                              </div>
                                              </div>

                                             <div class="col-md-6 col-sm-12 col-12">
                                              <div class="mb-3" id="size_name">
                                                  <label for="size_name" class="form-label">Size (Optional)</label>
                                                  <input type="text" class="form-control mb-2" name="size_name[]" placeholder="Size Name" id="size_name" value="{{old('size_name')}}"/>
                                                  <button type="button" class="btn btn-success mt-2" id="add_size">Add More</button>
                                              </div>
                                              </div>

                                          <div class="col-md-4 col-sm-6 col-6">
                                              <div class="mb-3">
                                                  <label for="buying_price" class="form-label">product Buying Price</label>
                                                  <input type="number" class="form-control" name="buying_price" id="buying_price" value="{{old('buying_price')}}"/>

                                                   @error('buying_price')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror

                                              </div>
                                          </div>

                                            <div class="col-md-4 col-sm-6 col-6">
                                              <div class="mb-3">
                                                  <label for="regular_price" class="form-label">product Regular Price</label>
                                                  <input type="number" class="form-control" name="regular_price" id="regular_price" value="{{old('regular_price')}}"/>

                                                   @error('regular_price')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror

                                              </div>
                                          </div>

                                           <div class="col-md-4 col-sm-6 col-6">
                                              <div class="mb-3">
                                                  <label for="discount_price" class="form-label">product Discount Price (Optional)</label>
                                                  <input type="number" class="form-control" name="discount_price" id="discount_price" value="{{old('discount_price')}}"/>
                                              </div>
                                          </div>

                                         <div class="col-md-6 col-sm-6 col-12">
                                              <div class="mb-3">
                                                  <label for="qty" class="form-label">product Quentity</label>
                                                  <input type="number" class="form-control" name="qty" id="qty" value="{{old('qty')}}"/>

                                                   @error('qty')
                                                   <span class="text-sucess">{{$message}}</span>   
                                                  @enderror

                                              </div>
                                          </div>

                                        <div class="col-md-6 col-sm-6 col-12">
                                              <div class="mb-3">
                                                  <label for="product_type" class="form-label">product Type</label>
                                                  <select name="product_type" id="product_type" class="form-control">
                                                   <option value="" disable selected>select subcategory</option>
                                                    <option value="new">New product</option>
                                                    <option value="hot">Hot Product</option>
                                                    <option value="regular">Regular product</option>
                                                    <option value="discount">Discount Product</option>
                                                  </select>

                                                   @error('product_type')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror
                                              </div>
                                          </div>

                                      <div class="col-md-12">
                                       <div class="mb-3">
                                                <label for="summernote" class="form-label">Product Description</label>
                                                <textarea name="description" class="form-control" id="summernote">{{old('description')}}</textarea>

                                                 @error('description')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror
                                      </div>
                                      </div>
                                      
                                    <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="product_policy" class="form-label">Product policy (Optional)</label>
                                         <textarea name="product_policy" class="form-control" id="summernote_two">{{old('product_policy')}}</textarea>
                                    </div>
                                    </div>
                                  </div>
                                   <div class="input-group mb-3">
                                          <input type="file" class="form-control" name="image" id="image" accept="image/*"/>
                                          <label class="input-group-text" for="image">Main Image</label>
                                             @error('image')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror
                                      </div>

                                    <div class="input-group mb-3">
                                          <input type="file" class="form-control" name="gallery_image[]" id="gallery_image" accept="image/*" multiple/>
                                          <label class="gallery_image" for="gallery_image">Gallery Image</label>
                                             @error('gallery_image')
                                                   <span class="text-success">{{$message}}</span>   
                                                  @enderror
                                    </div>

                                    </div>
                                  <!--end::Body-->
                                  <!--begin::Footer-->
                                  <div class="card-footer">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                  <!--end::Footer-->
                              </form>
                              <!--end::Form-->
                          </div>
                          <!--end::Quick Example-->
                      </div>
                  </div>
              </div>
      </main>
  @endsection

  @push('script')
    <script>
        $(document).ready(function() {
  $('#summernote').summernote();
});
    </script>

    <script>
        $(document).ready(function() {
  $('#summernote_two').summernote();
});
    </script>

    //Add more color........ 
    <script>
      $(document).ready(function(){
        $("#add_color").click(function(){
        $(this).before('<input type="text" class="form-control mb-2" name="color_name[]" placeholder="Color Name" id="color_name"/>')

        })
      }) 
    </script>

    //Add size........ 
    <script>
      $(document).ready(function(){
        $("#add_size").click(function(){
            $(this).before('<input type="text" class="form-control mb-2" name="size_name[]" placeholder="Size Name" id="size_name"/>')
        })
      })  
        
    </script> 
@endpush
