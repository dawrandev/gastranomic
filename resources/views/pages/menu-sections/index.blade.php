@extends('layouts.main')

@section('title', 'Разделы меню')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-4">
                        <h3>Разделы меню</h3>
                    </div>
                    <div class="col-8 d-flex justify-content-end align-items-center">
                        <div class="me-3">
                            <select class="form-select form-select-sm language-switcher" id="menu-language-select" style="width: auto;">
                                @php
                                    $currentLang = \App\Helpers\LanguageHelper::getCurrentLang();
                                    $allLanguages = \App\Models\Language::all();
                                @endphp
                                @foreach($allLanguages as $lang)
                                <option value="{{ $lang->code }}" {{ $currentLang == $lang->code ? 'selected' : '' }}>
                                    {{ $lang->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <ol class="breadcrumb mb-0">
                            @role('superadmin')
                            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @else
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @endrole
                            <li class="breadcrumb-item active">Разделы меню</li>
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
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Все разделы меню</h5>
                                @can(\App\Permissions\MenuSectionPermissions::CREATE)
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createSectionModal">
                                    <i class="fa fa-plus"></i> Новый раздел
                                </button>
                                @endcan
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('menu-sections.index') }}">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">№</th>
                                        <th>Название</th>
                                        <th style="width: 100px;">Порядок</th>
                                        <th style="width: 100px;">Кол-во блюд</th>
                                        <th style="width: 120px">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = ($sections->currentPage() - 1) * $sections->perPage() + 1; @endphp
                                    @forelse ($sections as $section)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td><strong>{{ $section->name }}</strong></td>
                                        <td class="text-center">{{ $section->sort_order }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-info">{{ $section->menu_items_count }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @can('update', $section)
                                                <button type="button" class="btn btn-outline-warning btn-sm edit-btn" data-id="{{ $section->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                @endcan

                                                @can('delete', $section)
                                                <form id="delete-section-{{ $section->id }}" action="{{ route('menu-sections.destroy', $section->id) }}" method="POST" style="margin-left: 5px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm btn-delete-confirm"
                                                        data-form-id="delete-section-{{ $section->id }}"
                                                        data-title="Удалить раздел?"
                                                        data-text="Вы уверены, что хотите удалить раздел {{ $section->name }}?"
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
                                        <td colspan="5" class="text-center">Данные не найдены</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">{{ $sections->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('pages.menu-sections.create')
@include('pages.menu-sections.edit')

@endsection

@push('scripts')
<script>
    // Language Switcher
    $('.language-switcher').on('change', function() {
        let langCode = $(this).val();

        $.ajax({
            url: "{{ route('language.switch') }}",
            method: 'POST',
            data: {
                lang: langCode,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            },
            error: function(xhr) {
                console.error('Error switching language:', xhr);
            }
        });
    });

    $(document).on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        let url = "{{ route('menu-sections.edit', ':id') }}".replace(':id', id);

        $('#editSectionForm').trigger("reset");
        $('.is-invalid').removeClass('is-invalid');

        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                $('#edit_section_id').val(data.id);
                $('#edit_sort_order').val(data.sort_order);

                // Fill translations
                @foreach($languages as $lang)
                if (data.translations['{{ $lang->code }}']) {
                    $('#edit_name_{{ $lang->code }}').val(data.translations['{{ $lang->code }}'].name);
                }
                @endforeach

                let updateUrl = "{{ route('menu-sections.update', ':id') }}".replace(':id', data.id);
                $('#editSectionForm').attr('action', updateUrl);

                var editModal = new bootstrap.Modal(document.getElementById('editSectionModal'));
                editModal.show();
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                swal({
                    title: "Ошибка!",
                    text: "Ошибка при загрузке данных",
                    icon: "error",
                    button: "Закрыть",
                });
            }
        });
    });
</script>
@endpush
