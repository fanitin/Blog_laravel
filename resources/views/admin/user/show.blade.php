@extends('admin.layouts.main')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex align-items-center">
            <h1 class="m-0 mr-2">User "{{$user->name}}"</h1>
            <a href="{{ route("admin.user.edit", $user->id) }}" class="text-success size-20"><i class="fas fa-regular fa-pen"></i></a>
            <form action="{{route("admin.user.delete", $user->id)}}" method="POST">
              @csrf
              @method("DELETE")
              <button type="submit" class="border-0 bg-transparent">
                <i class="fas fa-solid fa-trash text-danger size-20" role="button"></i>
              </button>
            </form>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("main.index")}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route("admin.user.index")}}">User</a></li>
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
          <div class="col-8">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <tbody>
                    <tr>
                      <td>ID</td>
                      <td>{{$user->id}}</td>
                    </tr>
                    <tr>
                      <td>Name</td>
                      <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                      <td>Roles</td>
                      <td>@foreach ($user->roles()->get()->toArray() as $role)
                        <span class="badge bg-primary">{{$role['name']}}</span>
                        @endforeach
                      </td>
                    </tr>
                    <tr>
                      <td>Creation date</td>
                      <td>{{$user->created_at}}</td>
                    </tr>
                    <tr>
                      <td>Last update</td>
                      <td>{{$user->updated_at}}</td>
                    </tr>
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