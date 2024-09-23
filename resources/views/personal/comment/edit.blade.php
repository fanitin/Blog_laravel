@extends('personal.layouts.main')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Comment editing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("main.index")}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route("personal.comment.index")}}">Comment</a></li>
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
            <form action="{{route("personal.comment.update", $comment->id)}}" method="POST" autocomplete="off">
              @csrf
              @method('PATCH')
              <div class="card-body">
                <div class="form-group">
                  <label for="id_comment">Comment text</label>
                  <textarea name="comment" id="id_comment" cols="30" rows="10" class="form-control">{{$comment->comment}}</textarea>
                  @error('comment')
                      <div class="text-danger">
                        This field is required
                      </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update comment</button>
              </div>
            </form>
          </div>
        </div><!-- /.row -->
      </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection