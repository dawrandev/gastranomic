@extends('layouts.main')

@section('title', 'Foydalanuvchilar')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Foydalanuvchilar</h1>
                </div>
                <div class="col-sm-6">
                    <li class="breadcrumb-item">
                        <a href="{{ auth()->user()->hasRole('superadmin') ? route('dashboard.superadmin.index') : route('dashboard.admin.index') }}">
                            Bosh sahifa
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Barcha foydalanuvchilar</h3>
                            <div class="card-tools">
                                <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-plus"></i> Yangi foydalanuvchi
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('users.index') }}">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Ism yoki login bo'yicha qidirish..." value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-info">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ismi</th>
                                        <th>Login</th>
                                        <th>Restoran</th>
                                        <th>Status</th>
                                        <th style="width: 120px">Amallar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    @if($user->login !== 'superadmin')
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->login }}</td>
                                        <td>
                                            @if($user->restaurant)
                                            <span class="badge badge-info">{{ $user->restaurant->name }}</span>
                                            <br>
                                            <small class="text-muted">{{ $user->restaurant->address }}</small>
                                            @else
                                            <span class="text-muted">Restoran mavjud emas</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->hasRole('admin'))
                                            <span class="badge badge-warning">Admin</span>
                                            @else
                                            <span class="badge badge-secondary">Foydalanuvchi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Ushbu foydalanuvchini o\'chirishga ishonchingiz komilmi?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Ma'lumotlar topilmadi</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection