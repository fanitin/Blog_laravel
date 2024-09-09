@extends('admin.layouts.main')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tag "{{$tag->name}}" editing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("main.index")}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route("admin.tag.index")}}">Tag</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-6">
            <form action="{{route("admin.tag.update", $tag->id)}}" method="POST" autocomplete="off">
              @csrf
              @method('PATCH')
              <div class="card-body">
                <div class="form-group">
                  <label for="id_name">Tag name</label>
                  <input type="text" class="form-control" id="id_name" name="name" placeholder="Enter the name of tag" value="{{$tag->name}}">
                  @error('name')
                      <div class="text-danger">
                        This field is required
                      </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update tag</button>
              </div>
            </form>
          </div>
        </div><!-- /.row -->
      </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection