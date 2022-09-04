<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardCategoryResource;
use App\Models\CardCategory;
use App\Http\Requests\StoreCardCategoryRequest;
use App\Http\Requests\UpdateCardCategoryRequest;

class CardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $cardCategories = CardCategory::latest()->get();
        return CardCategoryResource::collection($cardCategories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCardCategoryRequest  $request
     * @return CardCategoryResource
     */
    public function store(StoreCardCategoryRequest $request)
    {
        $cardCategory = CardCategory::onlyTrashed()->where(['name' => $request->name])->first();
        if (!empty($cardCategory)) {
            $cardCategory->restore();
        } else {
            $data = $request->all();
            $data +=[
                'created_by' => auth()->id() ?? null,
                'updated_by' => auth()->id() ?? null
            ];
            $cardCategory = CardCategory::create($data);
        }

        return new CardCategoryResource($cardCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardCategory  $cardCategory
     * @return CardCategoryResource
     */
    public function show(CardCategory $cardCategory)
    {
        return new CardCategoryResource($cardCategory);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardCategoryRequest  $request
     * @param  \App\Models\CardCategory  $cardCategory
     * @return CardCategoryResource
     */
    public function update(UpdateCardCategoryRequest $request, CardCategory $cardCategory)
    {
        $data = $request->all();
        $data += [
            'updated_by' => auth()->id() ?? null,
            'updated_at' => now(),
        ];
        $cardCategory->update($data);
        return new CardCategoryResource($cardCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardCategory  $cardCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardCategory $cardCategory)
    {
        $cardCategory->delete();
        return response()->noContent();
    }
}
