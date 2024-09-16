@extends('admin.layouts.main')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User "{{$user->name}}" editing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("main.index")}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route("admin.user.index")}}">User</a></li>
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
            <form action="{{route("admin.user.update", $user->id)}}" method="POST" autocomplete="off">
              @csrf
              @method('PATCH')
              <div class="card-body">
                <div class="form-group">
                  <label for="id_name">User name</label>
                  <input type="text" class="form-control" id="id_name" name="name" placeholder="Enter username" value="{{old('name', $user->name)}}">
                  @error('name')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="id_email">E-mail</label>
                  <input type="email" class="form-control" id="id_email" name="email" placeholder="Enter your e-mail" value="{{old('email', $user->email)}}">
                  @error('email')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="form-group col-6">
                  <label>Choose roles</label>
                  <select class="select2 select2-hidden-accessible" multiple="multiple" name="role_ids[]" data-placeholder="Select roles" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                    @foreach ($roles as $role)
                      <option value="{{$role->id}}"
                        {{ is_array($user->roles->pluck('id')->toArray()) && in_array($role->id, $user->roles->pluck('id')->toArray()) ? ' selected="selected"' : ''}}  
                      >{{$role->name}}</option>
                    @endforeach
                  </select>
                  @error('role_ids')
                    <div class="text-danger">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit user</button>
              </div>
            </form>
          </div>
        </div><!-- /.row -->
      </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection