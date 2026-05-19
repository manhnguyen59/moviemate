<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AiRecommendation;
use App\Models\Cinema;
use App\Models\Genre;
use App\Services\AiMovieRecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiController extends Controller
{
    public function __construct(
        protected AiMovieRecommendationService $recommendationService
    ) {}

    public function recommend()
    {
        return view('user.ai.recommend', $this->viewData());
    }

    public function recommendStore(Request $request)
    {
        $preferences = $request->validate([
            'genres' => ['nullable', 'array'],
            'genres.*' => ['string', 'max:100'],
            'mood' => ['required', 'string', 'max:50'],
            'preferred_time' => ['required', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:150'],
            'companion' => ['required', 'string', 'max:50'],
        ], [
            'mood.required' => 'Vui lòng chọn tâm trạng.',
            'preferred_time.required' => 'Vui lòng chọn thời gian muốn xem.',
            'companion.required' => 'Vui lòng chọn người đi cùng.',
        ]);

        $preferences['genres'] = array_values($preferences['genres'] ?? []);
        $preferences['location'] = trim((string) ($preferences['location'] ?? ''));

        $result = $this->recommendationService->recommend($preferences);

        if (Auth::check()) {
            AiRecommendation::create([
                'user_id' => Auth::id(),
                'input_data' => $preferences,
                'result_data' => $result,
            ]);
        }

        return view('user.ai.recommend', $this->viewData([
            'preferences' => $preferences,
            'recommendations' => $result['recommendations'],
            'recommendationMeta' => $result,
        ]));
    }

    protected function viewData(array $overrides = []): array
    {
        return array_merge([
            'genres' => Genre::orderBy('name')->get(),
            'cinemas' => Cinema::where('status', 'active')->orderBy('name')->get(),
            'preferences' => [],
            'recommendations' => null,
            'recommendationMeta' => null,
        ], $overrides);
    }
}
