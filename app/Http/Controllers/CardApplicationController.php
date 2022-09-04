<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardApplicationResource;
use App\Models\CardApplication;
use App\Http\Requests\StoreCardApplicationRequest;
use App\Http\Requests\UpdateCardApplicationRequest;
use Illuminate\Http\Request;

class CardApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $itemsPerPage = request('per_page') ?? 20;
        $status = request('status') ?? 'all';
        $search = request('search');
        $date = request('date');
        $usrFilter = request('user_filter');

        if ($usrFilter == 'admin') {
            $cardApplication = CardApplication::query();
        } else {
            $cardApplication = CardApplication::where('user_id', auth()->id());
        }

        if ($search) {
            $cardApplication->whereLike(['user.name','user.phone','user.email', 'customer_name', 'organization_name', 'card_number', 'client_id', 'phone'], $search);
        }
        if ($status == 'active' || $status == 'pending' || $status == 'rejected') {
            $cardApplication->where('status', $status);
        }
        if ($date) {
            $cardApplication->whereDate('created_at', $date);
        }
        $cardApplications = $cardApplication->with('user')->latest()->paginate($itemsPerPage);

        return CardApplicationResource::collection($cardApplications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCardApplicationRequest  $request
     * @return CardApplicationResource
     */
    public function store(StoreCardApplicationRequest $request)
    {
        $data = $request->all();
        $data += ['user_id' => auth()->id() ?? null];
        $cardApplication = CardApplication::create($data);
        $cardApplication->load('user');

        return new CardApplicationResource($cardApplication);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardApplication  $cardApplication
     * @return CardApplicationResource
     */
    public function show(CardApplication $cardApplication)
    {
        return new CardApplicationResource($cardApplication);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardApplicationRequest  $request
     * @param  \App\Models\CardApplication  $cardApplication
     * @return CardApplicationResource
     */
    public function update(UpdateCardApplicationRequest $request, CardApplication $cardApplication)
    {
        $data = $request->all();
        $cardApplication->update($data);
        $cardApplication->load('user');
        return new CardApplicationResource($cardApplication);
    }

    public function toggle(CardApplication $cardApplication, Request $request)
    {
        $status = $request->action;
        $cardApplication->update(['status' => $status]);
        return new CardApplicationResource($cardApplication);
    }

    public function dashboardReport()
    {
        $active = CardApplication::where('status', 'active')->count();
        $pending = CardApplication::where('status', 'pending')->count();
        $rejected = CardApplication::where('status', 'rejected')->count();
        $expired = CardApplication::where('status', 'expired')->count();

        $userActive = CardApplication::where(['status' => 'active', 'user_id' => auth()->id()])->count();
        $userPending = CardApplication::where(['status' => 'pending', 'user_id' => auth()->id()])->count();
        $useRejected = CardApplication::where(['status' => 'rejected', 'user_id' => auth()->id()])->count();
        $userExpired = CardApplication::where(['status' => 'expired', 'user_id' => auth()->id()])->count();

        $dashboard =  ['active' => $active, 'pending' => $pending, 'rejected' => $rejected, 'expired' => $expired];
        $user = ['active' => $userActive, 'pending' => $userPending, 'rejected' => $useRejected, 'expired' => $userExpired];
        return response()->json(['status' => 'success', 'dashboard' => $dashboard, 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardApplication  $cardApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardApplication $cardApplication)
    {
        $cardApplication->delete();
        return response()->noContent();
    }
}
