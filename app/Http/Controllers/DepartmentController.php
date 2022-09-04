<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $departments = Department::latest()->get();
        return DepartmentResource::collection($departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return DepartmentResource
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::onlyTrashed()->where(['name' => $request->name])->first();
        if (!empty($department)) {
            $department->restore();
        } else {
            $data = $request->all();
            $data +=[
                'created_by' => auth()->id() ?? null,
                'updated_by' => auth()->id() ?? null
            ];
            $department = Department::create($data);
        }
        return new DepartmentResource($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return DepartmentResource
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentRequest  $request
     * @param  \App\Models\Department  $department
     * @return DepartmentResource
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $data = $request->all();
        $data += [
            'updated_by' => auth()->id() ?? null,
            'updated_at' => now(),
        ];
        $department->update($data);
        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->noContent();
    }
}
