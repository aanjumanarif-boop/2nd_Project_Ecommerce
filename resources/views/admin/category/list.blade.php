@extends('admin.master')
@section('content')
   <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Category List</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>image</th>
                          <th>Category Name</th>
                          <th style="width: 40px">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach ($categories as $category)
                         <tr class="align-middle">
                          <td>{{$loop->index+1}}</td>

                          <td>
                            <img src="{{$category->image}}" height="100" width="100">
                        </td>

                          <td>{{$category->name}}</td>
                          <td>
                          <div class="d-flex gap-2">
                            <a href="{{url('/manage/category-edit/'.$category->id)}}" class="btn btn-success">Edit</a>
                            <a href="{{url('/manage/category-delete/'.$category->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                          </div>
                          </td>
                        </tr>   
                       @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item">
                        <a class="page-link" href="#">&laquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">&raquo;</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /.card -->
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
             
                    

                   
                  </div>
                 
                </div>
                <!-- /.card -->

              
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
 
@endsection