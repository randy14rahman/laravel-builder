@extends('layouts.app-master')

@section('title_prefix', 'Role Management -')

@section('stylesheets')
<link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@stop

@section('content_header')
<h1 class="m-0 text-dark">Role Management</h1>
@stop

@section('content')

    <?php if (auth()->user()->hasRole('Admin')) { ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Role list</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-role">Add new role</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <table id="datatable-1" class="table table-striped table-bordered" style="width:100%" style="width:100%"></table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-role">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-add-role" novalidate="novalidate">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <input type="number" name="level" class="form-control" placeholder="Level">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary btn-submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-role">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-edit-role" novalidate="novalidate">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <input type="number" name="level" class="form-control" placeholder="Level">
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary btn-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php } else if (auth()->user()->hasRole('Super Admin')) { ?>

    <div class="bg-light p-4 rounded">
        <div class="lead">
            Manage your roles here.
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add role</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Name</th>
             <th width="3%" colspan="3">Action</th>
          </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $roles->links() !!}
        </div>

    </div>

    <?php } ?>
@endsection

<?php if (auth()->user()->hasRole('Admin')) { ?>
@section('scripts')
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="/assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/assets/app/roles/index.js"></script>
@stop
<?php } ?>