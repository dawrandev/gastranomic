@extends('layouts.main')

@section('title', 'Категории вопросов')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Категории вопросов для отзывов</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Вопросы</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Все категории вопросов</h5>
                                <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-plus"></i> Новая категория
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('questions.index') }}">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">№</th>
                                            <th>Ключ</th>
                                            <th>Названия</th>
                                            <th style="width: 100px;">Обязателен</th>
                                            <th style="width: 80px;">Порядок</th>
                                            <th style="width: 80px;">Статус</th>
                                            <th style="width: 100px;">Варианты</th>
                                            <th style="width: 120px">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = ($questions->currentPage() - 1) * $questions->perPage() + 1; @endphp
                                        @forelse ($questions as $question)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>
                                                <code>{{ $question->key }}</code>
                                            </td>
                                            <td>
                                                @if($question->translations->count() > 0)
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($question->translations as $translation)
                                                    <span class="badge bg-info">{{ strtoupper($translation->lang_code) }}: {{ $translation->title }}</span>
                                                    @endforeach
                                                </div>
                                                @else
                                                <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($question->is_required)
                                                <span class="badge bg-success">Да</span>
                                                @else
                                                <span class="badge bg-secondary">Нет</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $question->sort_order }}</td>
                                            <td class="text-center">
                                                @if($question->is_active)
                                                <span class="badge bg-success">Активно</span>
                                                @else
                                                <span class="badge bg-danger">Неактивно</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-warning">{{ $question->options()->count() }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('questions.edit', $question) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('questions.destroy', $question) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Вы уверены?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Нет категорий вопросов</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $questions->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
