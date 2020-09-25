<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redis;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return JsonResource::collection($subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $subject = Subject::create($request->all());
        return new JsonResource($subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subject)
    {
        $subject = Subject::findOrFail($subject);
        $subject->load("department");

        return new JsonResource($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->fill($request->all());
        $subject->save();

        Redis::publish('core.subject.update', json_encode($subject->toArray()));

        return new JsonResource($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject)
    {
        $subject = Subject::find($subject);
        if(! $subject) {
            return response()->json(['error' => 'This subject does not exists'], 404);
        }
        Redis::publish('core.subject.destroy', json_encode($subject->toArray()));

        $subject->delete();

        return response()->json(['message' => 'Subject deletion successful!'], 200);
    }
}
