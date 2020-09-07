<?php

namespace App\Http\Controllers\API\V1;

use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return JsonResource::collection($departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $data = $request->all();
        $department = Department::create($data);
        return new JsonResource($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($department)
    {
        $department = Department::findOrFail($department);
        return new JsonResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $request->validated();
        $data = $request->all();

        $department->update($data);

        return new JsonResource($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($department)
    {
        $department = Department::find($department);
        if(! $department) {
            return response()->json(['error' => 'This department does not exists'], 404);
        }
        $department->delete();

        return response()->json(['message' => 'Department Deletion Successful!'], 200);
    }
}
