<div class="p-2">
    @forelse($reviews as $review)
    <div class="review-card d-flex align-items-start gap-2 py-2 px-3 border-bottom">

        {{-- Avatar --}}
        <div class="flex-shrink-0">
            @if($review->client?->image_path)
            <img src="{{ asset('storage/' . $review->client->image_path) }}"
                alt="{{ $review->client->first_name }}"
                class="rounded-circle"
                style="width: 36px; height: 36px; object-fit: cover;">
            @elseif($review->client)
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-semibold"
                style="width: 36px; height: 36px; font-size: 14px;">
                {{ strtoupper(substr($review->client->first_name, 0, 1)) }}
            </div>
            @else
            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                style="width: 36px; height: 36px;">
                <i class="fa fa-user" style="font-size: 13px;"></i>
            </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="flex-grow-1 min-w-0">

            {{-- Top row: name + branch + stars + date --}}
            <div class="d-flex align-items-center flex-wrap gap-1 mb-1">
                @if($review->client)
                <span class="fw-semibold text-dark" style="font-size: 13px;">
                    {{ $review->client->first_name }} {{ $review->client->last_name }}
                </span>
                @endif

                <span class="badge bg-light text-secondary border" style="font-size: 11px; font-weight: 500;">
                    <i class="fa fa-map-marker-alt me-1" style="font-size: 10px;"></i>{{ Str::limit($review->restaurant->branch_name, 18) }}
                </span>

                <div class="ms-auto d-flex align-items-center gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 12px;"></i>
                        @endfor
                        <small class="text-muted ms-1" style="font-size: 11px;">{{ $review->created_at->format('d.m.y') }}</small>
                </div>
            </div>

            {{-- Comment --}}
            @if($review->comment)
            <p class="mb-1 text-secondary" style="font-size: 13px; line-height: 1.5;">
                {{ Str::limit($review->comment, 120) }}
            </p>
            @endif

            {{-- Selected options --}}
            @if($review->selectedOptions && $review->selectedOptions->count() > 0)
            @php
            $currentLocale = $locale ?? 'ru';
            $groupedOptions = $review->selectedOptions->groupBy('questions_category_id');
            $categories = \App\Models\QuestionCategory::whereIn('id', $groupedOptions->keys())
            ->with('translations')->get()->keyBy('id');
            @endphp
            <div class="mt-1">
                @foreach($groupedOptions as $categoryId => $options)
                @php
                $category = $categories->get($categoryId);
                $categoryTitle = $category ? $category->getTranslatedTitle($currentLocale) : '';
                @endphp
                <div class="d-flex align-items-center flex-wrap gap-1 mb-1">
                    <span class="text-muted fw-semibold" style="font-size: 12px; white-space: nowrap;">
                        {{ Str::limit($categoryTitle, 25) }}:
                    </span>
                    @foreach($options as $option)
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25"
                        style="font-size: 11px; padding: 3px 7px; font-weight: 500;">
                        <i class="fa fa-check me-1" style="font-size: 9px;"></i>{{ Str::limit($option->getTranslatedText($currentLocale), 30) }}
                    </span>
                    @endforeach
                </div>
                @endforeach
            </div>
            @endif

        </div>

        {{-- Delete button --}}
        @can('delete', $review)
        <div class="flex-shrink-0">
            <form id="delete-review-{{ $review->id }}" action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="btn btn-outline-danger btn-sm btn-delete-confirm px-2 py-1"
                    data-form-id="delete-review-{{ $review->id }}"
                    data-title="Удалить отзыв?"
                    data-text="Вы уверены, что хотите удалить этот отзыв?"
                    data-confirm-text="Да, удалить"
                    data-cancel-text="Отмена">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </div>
        @endcan

    </div>
    @empty
    <div class="text-center py-5">
        <i class="fa fa-comments fa-3x text-muted mb-3 d-block"></i>
        <p class="text-muted mb-0">Отзывы не найдены</p>
    </div>
    @endforelse
</div>

@if($reviews->hasPages())
<div class="card-footer bg-white py-2 px-3">
    {{ $reviews->links() }}
</div>
@endif