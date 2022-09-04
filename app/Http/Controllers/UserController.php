<?php

namespace App\Http\Controllers;

use App\Actions\Common\UploadManager;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\MinimumUserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $itemsPerPage = request('per_page') ?? 20;
        $type = request('type') ?? 'all';
        $search = request('search');

        $user = User::query();
        if($search) {
            $user->whereLike(['name','phone','email'], $search);
        }
        if($type == 'employee') {
            $user->where('type', 'employee');
        } else if ($type == 'admin') {
            $user->where('type', 'admin');
        } else {
            $user = User::latest();
        }
        $users = $user->paginate($itemsPerPage);
        return UserResource::collection($users);
    }

    public function search(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $rules = [
            'query' => 'required|string',
        ];
        validator(request()->query(), $rules)->validate();

        $query = request('query');

        $User =  User::whereLike(['name','phone','email','username'],$query)->get();
        return userResource::collection($User);
    }

    /**
     * @param UserStoreRequest $request
     * @return UserResource
     */
    public function store(UserStoreRequest $request): UserResource
    {
        $data = $request->except('password');
        $data += [ 'created_by' => auth()->id() ?? null ];
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
//        if ($request->hasFile('photo')) {
//            $file = $request->file('photo');
//            $data['photo'] = (new UploadManager())->inputFile($file)->uploadFile('users');
//        }
        $user = User::create($data);
        return new UserResource($user);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function show(Request $request, User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $data += [ 'updated_at' => now() ];
//        if ($request->hasFile('photo')) {
//            $file = $request->file('photo');
//            $data['photo'] = (new UploadManager())->inputFile($file)->uploadFile('users');
//        }
        $user->update($data);
        return new UserResource($user);
    }

    public function bulkDelete(Request $request): JsonResponse
    {
        $___users = [];
        if ($request->items) {
            $users = User::whereIn('id', $request->items);
            $___users = $users->get();
            $users->delete();
        }
        return response()->json($___users);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function destroy(Request $request, User $user): UserResource
    {
        $user->delete();
        return new UserResource($user);
    }
}
