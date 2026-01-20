@extends('layouts.main')

@section('title', 'Категории')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Категории</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            @role('superadmin')
                            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @else
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @endrole
                            <li class="breadcrumb-item active">Категории</li>
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
                                <h5>Все категории</h5>
                                @can(\App\Permissions\CategoryPermissions::CREATE)
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                    <i class="fa fa-plus"></i> Новая категория
                                </button>
                                @endcan
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('categories.index') }}">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">№</th>
                                        <th style="width: 80px;">Иконка</th>
                                        <th>Переводы</th>
                                        <th style="width: 120px">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = ($categories->currentPage() - 1) * $categories->perPage() + 1; @endphp
                                    @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td class="text-center">
                                            @if($category->icon)
                                            <img src="{{ asset('storage/' . $category->icon) }}" alt="Category icon" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                                            @else
                                            <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->translations->count() > 0)
                                            @foreach($category->translations as $translation)
                                            <span class="badge badge-info me-1">{{ strtoupper($translation->code) }}: {{ $translation->name }}</span>
                                            @endforeach
                                            @else
                                            <span class="text-muted">Нет переводов</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @can(\App\Permissions\CategoryPermissions::UPDATE)
                                                <button type="button" class="btn btn-outline-primary btn-sm edit-btn" data-id="{{ $category->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                @endcan

                                                @can(\App\Permissions\CategoryPermissions::DELETE)
                                                <form id="delete-category-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="margin-left: 5px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm btn-delete-confirm"
                                                        data-form-id="delete-category-{{ $category->id }}"
                                                        data-title="Удалить категорию?"
                                                        data-text="Вы уверены, что хотите удалить эту категорию?"
                                                        data-confirm-text="Да, удалить"
                                                        data-cancel-text="Отмена">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Данные не найдены</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">{{ $categories->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('pages.categories.create')
@include('pages.categories.edit')

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Edit button
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            let url = "{{ route('categories.edit', ':id') }}".replace(':id', id);

            $('#editCategoryForm').trigger("reset");
            $('.is-invalid').removeClass('is-invalid');
            $('#current_icon_preview').attr('src', '').hide();

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    $('#edit_category_id').val(data.id);

                    // Icon preview
                    if (data.icon) {
                        $('#current_icon_preview').attr('src', '/storage/' + data.icon).show();
                    }

                    // Clear all translation fields first
                    $('[id^="edit_translation_"]').val('');

                    // Load translations
                    if (data.translations) {
                        $.each(data.translations, function(langCode, name) {
                            $('#edit_translation_' + langCode).val(name);
                        });
                    }

                    let updateUrl = "{{ route('categories.update', ':id') }}".replace(':id', data.id);
                    $('#editCategoryForm').attr('action', updateUrl);

                    $('#editCategoryModal').modal('show');
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    alert('Ошибка при загрузке данных');
                }
            });
        });

        // Delete confirmation - avtomatik SweetAlert ishlaydi
    });
</script>
@endpush