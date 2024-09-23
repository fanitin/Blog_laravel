@extends('admin.layouts.main')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tag</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("admin.index")}}">Home</a></li>
              <li class="breadcrumb-item active">Tag</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-2 mb-3">
            <a href="{{route("admin.tag.create")}}" class="btn btn-block btn-info btn-lg">Add new tag</a>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-8">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Creation date</th>
                      <th>Last update</th>
                      <th colspan="3" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                          <td>{{$tag->id}}</td>
                          <td>{{$tag->name}}</td>
                          <td>{{$tag->created_at}}</td>
                          <td>{{$tag->updated_at}}</td>
                          <td class="text-center"><a href="{{ route("admin.tag.show", $tag->id) }}"><i class="far fa-regular fa-eye"></i></a></td>
                          <td class="text-center"><a href="{{ route("admin.tag.edit", $tag->id) }}" class="text-success"><i class="fas fa-regular fa-pen"></i></a></td>
                          <td class="text-center">
                            <form action="{{route("admin.tag.delete", $tag->id)}}" method="POST">
                              @csrf
                              @method("DELETE")
                              <button type="submit" class="border-0 bg-transparent">
                                <i class="fas fa-solid fa-trash text-danger" role="button"></i>
                              </button>
                            </form>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection