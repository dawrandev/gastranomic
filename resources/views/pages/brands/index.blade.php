@extends('layouts.main')

@section('title', 'Бренды')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Бренды</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            @role('superadmin')
                            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @else
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @endrole
                            <li class="breadcrumb-item active">Бренды</li>
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
                                <h5>Все бренды</h5>
                                @can(\App\Permissions\BrandPermissions::CREATE)
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createBrandModal">
                                    <i class="fa fa-plus"></i> Новый бренд
                                </button>
                                @endcan
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('brands.index') }}">
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request('search') }}">
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
                                        <th style="width: 80px;">Логотип</th>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th style="width: 100px;">Рестораны</th>
                                        <th style="width: 120px">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = ($brands->currentPage() - 1) * $brands->perPage() + 1; @endphp
                                    @forelse ($brands as $brand)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td class="text-center">
                                            @if($brand->logo)
                                            <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->getTranslatedName() }}" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                                            @else
                                            <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $brand->getTranslatedName() ?? 'N/A' }}</strong></td>
                                        <td>
                                            @php $desc = $brand->getTranslatedDescription(); @endphp
                                            @if($desc)
                                            {{ Str::limit($desc, 50) }}
                                            @else
                                            <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info">{{ $brand->restaurants_count }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                @can(\App\Permissions\BrandPermissions::UPDATE)
                                                <button type="button" class="btn btn-outline-primary btn-sm edit-btn" data-id="{{ $brand->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                @endcan

                                                @can(\App\Permissions\BrandPermissions::DELETE)
                                                <form id="delete-brand-{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="margin-left: 5px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm btn-delete-confirm"
                                                        data-form-id="delete-brand-{{ $brand->id }}"
                                                        data-title="Удалить бренд?"
                                                        data-text="Вы уверены, что хотите удалить {{ $brand->name }}?"
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
                                        <td colspan="6" class="text-center">Данные не найдены</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">{{ $brands->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('pages.brands.create')
@include('pages.brands.edit')

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            let url = "{{ route('brands.edit', ':id') }}".replace(':id', id);

            // Reset form and clear all translation fields
            $('#editBrandForm').trigger("reset");
            $('.is-invalid').removeClass('is-invalid');

            // Clear all translation fields
            let languages = ['uz', 'ru', 'kk', 'en'];
            languages.forEach(function(lang) {
                $('#edit_' + lang + '_name').val('');
                $('#edit_' + lang + '_description').val('');
            });

            $('#current_logo_preview').attr('src', '').hide();

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    $('#edit_brand_id').val(data.id);

                    // Load translations for all languages
                    let translations = data.translations;
                    let languages = ['uz', 'ru', 'kk', 'en'];

                    languages.forEach(function(lang) {
                        let translation = translations[lang];
                        if (translation) {
                            $('#edit_' + lang + '_name').val(translation.name || '');
                            $('#edit_' + lang + '_description').val(translation.description || '');
                        } else {
                            $('#edit_' + lang + '_name').val('');
                            $('#edit_' + lang + '_description').val('');
                        }
                    });

                    if (data.logo) {
                        $('#current_logo_preview').attr('src', '/storage/' + data.logo).show();
                    }

                    let updateUrl = "{{ route('brands.update', ':id') }}".replace(':id', data.id);
                    $('#editBrandForm').attr('action', updateUrl);

                    $('#editBrandModal').modal('show');
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    alert('Ошибка при загрузке данных');
                }
            });
        });
    });
</script>
@endpush