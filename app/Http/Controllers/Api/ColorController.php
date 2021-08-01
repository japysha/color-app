<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateColorRequest;
use App\Http\Requests\DeleteColorRequest;
use App\Http\Resources\ColorResource;
use App\Services\ColorService;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ColorController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function getColors(): AnonymousResourceCollection
    {
        return ColorResource::collection(Color::all());
    }

    /**
     * @param CreateColorRequest $request
     * @return Color
     */
    public function store(CreateColorRequest $request): Color
    {
        return ColorService::create($request->validated());
    }

    /**
     * @param DeleteColorRequest $request
     * @return int
     */
    public function destroy(DeleteColorRequest $request): int
    {
        return ColorService::delete($request->validated());
    }
}
