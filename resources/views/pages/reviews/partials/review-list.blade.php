<div class="p-2">
    @forelse($reviews as $review)
    <div class="review-card d-flex align-items-start gap-3 py-3 px-3 border-bottom">

        {{-- Avatar --}}
        <div class="flex-shrink-0">
            @if($review->client?->image_path)
            <img src="{{ asset('storage/' . $review->client->image_path) }}"
                alt="{{ $review->client->first_name }}"
                class="rounded-circle"
                style="width: 40px; height: 40px; object-fit: cover;">
            @elseif($review->client)
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-semibold"
                style="width: 40px; height: 40px; font-size: 15px;">
                {{ strtoupper(substr($review->client->first_name, 0, 1)) }}
            </div>
            @else
            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                style="width: 40px; height: 40px;">
                <i class="fa fa-user" style="font-size: 14px;"></i>
            </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="flex-grow-1 min-w-0">

            {{-- Top row: name + restaurant --}}
            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                @if($review->client)
                <span class="fw-semibold text-dark" style="font-size: 14px;">
                    {{ $review->client->first_name }} {{ $review->client->last_name }}
                </span>
                @endif

                <span class="badge bg-dark text-white" style="font-size: 12px; font-weight: 500; padding: 6px 10px;">
                    <i class="fa fa-utensils me-1" style="font-size: 11px;"></i>
                    <strong>{{ $review->restaurant->name }}</strong>
                    @if($review->restaurant->branch_name)
                    <span class="ms-1">{{ $review->restaurant->branch_name }}</span>
                    @endif
                </span>
            </div>

            {{-- Rating + Date --}}
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="d-flex align-items-center gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 13px;"></i>
                    @endfor
                    <span class="fw-semibold text-warning ms-1" style="font-size: 13px;">{{ $review->rating }}/5</span>
                </div>
                <small class="text-muted" style="font-size: 12px;">{{ $review->created_at->format('d.m.Y H:i') }}</small>
            </div>

            {{-- Phone number --}}
            @if($review->phone)
            <div class="mb-2">
                <span class="badge bg-light text-primary border border-primary border-opacity-25" style="font-size: 12px; padding: 4px 10px; font-weight: 500;">
                    <i class="fa fa-phone me-1" style="font-size: 10px;"></i>{{ $review->phone }}
                </span>
            </div>
            @endif

            {{-- Comment --}}
            @if($review->comment)
            <div class="mb-2 p-2 bg-light rounded" style="border-left: 3px solid #0d6efd;">
                <p class="mb-0 text-dark" style="font-size: 13px; line-height: 1.6;">
                    <i class="fa fa-quote-left text-muted me-2" style="opacity: 0.5;"></i>
                    {{ $review->comment }}
                </p>
            </div>
            @endif

            {{-- Selected answers/options --}}
            @if($review->selectedOptions && $review->selectedOptions->count() > 0)
            @php
            $currentLocale = $locale ?? 'ru';
            // Load all questions with their children for reference
            $allQuestions = \App\Models\QuestionCategory::with('translations', 'children.translations')->get()->keyBy('id');
            $groupedOptions = [];

            foreach($review->selectedOptions as $option) {
                // Find which question this option belongs to
                $question = $allQuestions->first(function($q) use ($option) {
                    return $q->options->contains($option->id);
                });

                if($question) {
                    $questionTitle = $question->getTranslatedTitle($currentLocale);
                    if(!isset($groupedOptions[$question->id])) {
                        $groupedOptions[$question->id] = [
                            'title' => $questionTitle,
                            'options' => []
                        ];
                    }
                    $groupedOptions[$question->id]['options'][] = $option;
                }
            }
            @endphp

            @if(count($groupedOptions) > 0)
            <div class="mt-3 pt-2 border-top">
                <p class="text-dark fw-semibold mb-2" style="font-size: 12px;">
                    <i class="fa fa-check-circle me-1 text-success"></i> Выбранные ответы:
                </p>
                @foreach($groupedOptions as $questionData)
                <div class="mb-2">
                    <div class="fw-semibold text-dark mb-1" style="font-size: 12px;">
                        {{ $questionData['title'] }}
                    </div>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach($questionData['options'] as $option)
                        <span class="badge bg-success text-white"
                            style="font-size: 11px; padding: 5px 8px; font-weight: 500;">
                            <i class="fa fa-check me-1" style="font-size: 9px;"></i>
                            {{ $option->getTranslatedText($currentLocale) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @endif
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