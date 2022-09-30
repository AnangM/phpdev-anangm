<?php

namespace App\Http\Controllers\API\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Utilities\FileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:candidate-list', ['only' => 'list']);
        $this->middleware('permission:candidate-create', ['only' => 'create']);
        $this->middleware('permission:candidate-update', ['only' => 'update']);
        $this->middleware('permission:candidate-read', ['only' => 'read']);
    }

    /**
     * @OA\Get(
     * path="/candidates",
     * security={
     * {"passport"={}}
     * },
     * operationId="listCandidates",
     * tags={"Candidates"},
     * summary="List all available candidates. Paginated per 20 items",
     * @OA\Response(
     * response=200,
     * description="Successfull response",
     * @OA\JsonContent(ref="#/components/schemas/ListResponseSchema"),
     * ),
     * @OA\Response(
     * response=401,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="Unauthenticated, please make sure bearer token are provided"
     * )
     * )
     */
    public function list()
    {
        $candidates = Candidate::paginate(20);

        return response()->json($candidates, 200);
    }

    /**
     * @OA\Post(
     * path="/candidates",     
     * security={
     * {"passport"={}}
     * },
     *  @OA\RequestBody(
     *  required=true,
     *  @OA\JsonContent(ref="#/components/schemas/UpsertCandidateSchema")
     *  ),
     * operationId="createCandidates",
     * tags={"Candidates"},
     * summary="Create new candidate",
     * @OA\Response(
     * response=201,
     * description="Successfull response",
     * @OA\JsonContent(ref="#/components/schemas/CandidateSchema")
     * ),
     * @OA\Response(
     * response=400,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="Client error, please check response to see more detail and make sure your payload is in accordance with validation rules"
     * ),
     * @OA\Response(
     * response=401,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="Unauthenticated, please make sure bearer token are provided"
     * ),
     * @OA\Response(
     * response=403,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="The user does not have privilege to perform this action"
     * )
     * )
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'education' => 'required',
            'birthday' => 'required|date',
            'experience' => 'required|max:100',
            'last_position' => 'required|max:255',
            'applied_position' => 'required|max:255',
            'top_skills' => 'required|array',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:15|min:10',
            'resume' => 'required|base64mimes:pdf|base64max:8192'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->only(['name', 'education', 'birthday', 'experience', 'last_position', 'applied_position', 'email', 'phone']);
        $data["top_skills"] = json_encode($request->input('top_skills'));
        $data[ 'resume_url'] = FileStorage::store($request->input('resume'), "resumes", "pdf");

        $candidate = Candidate::create($data);

        return response()->json($candidate, 201);
    }

    /**
     * @OA\Get(
     * path="/candidates/{id}",
     * operationId="readCandidates",
     * tags={"Candidates"},
     * security={
     * {"passport"={}}
     * },
     * summary="View single candidate data",
     * @OA\Parameter(
     * name="id",
     * description="Candidate Id",
     * in="path"
     * ),
     * @OA\Response(
     * response=200,
     * @OA\JsonContent(ref="#/components/schemas/CandidateSchema"),
     * description="Successfull response"
     * ),
     * @OA\Response(
     * response=401,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="Unauthenticated, please make sure bearer token are provided"
     * )
     * )
     */
    public function read($id)
    {
        $candidate = Candidate::where('id', $id)->first();
        if ($candidate == null) {
            return response()->json(["message" => "Candidate with given id $id not found"], 404);
        }

        return response()->json($candidate, 200);
    }

    /**
     * @OA\Put(
     * path="/candidates/{id}",
     * operationId="updateCandidates",
     * tags={"Candidates"},
     * summary="Update existing candidate data",
     * @OA\Parameter(
     * name="id",
     * description="Candidate Id",
     * in="path"
     * ),
     *  @OA\RequestBody(
     *  required=true,
     *  @OA\JsonContent(ref="#/components/schemas/UpsertCandidateSchema")
     *  ),
     * security={
     * {"passport"={}}
     * },
     * @OA\Response(
     * response=200,
     * @OA\JsonContent(ref="#/components/schemas/CandidateSchema"),
     * description="Successfull response"
     * ),
     * @OA\Response(
     * response=400,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="Client error, please check response to see more detail and make sure your payload is in accordance with validation rules"
     * ),
     * @OA\Response(
     * response=401,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="Unauthenticated, please make sure bearer token are provided"
     * ),
     * @OA\Response(
     * response=403,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="The user does not have privilege to perform this action"
     * ),
     * * @OA\Response(
     * response=404,
     * @OA\JsonContent(ref="#/components/schemas/ErrorSchema"),
     * description="The candidate you want to edit does not exists"
     * )
     * )
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'education' => 'required',
            'birthday' => 'required|date',
            'experience' => 'required|max:100',
            'last_position' => 'required|max:255',
            'applied_position' => 'required|max:255',
            'top_skills' => 'required|array',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:15|min:10',
            'resume' => 'base64mimes:pdf|base64max:8192'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $candidate = Candidate::where('id', $id)->first();

        if ($candidate == null) {
            return response()->json(["message" => "Candidate with given id $id not found"], 404);
        }

        $data = $request->only(['name', 'education', 'birthday', 'experience', 'last_position', 'applied_position', 'email', 'phone']);
        $data["top_skills"] = json_encode($request->input('top_skills'));
        if($request->input('resume') != null){
            FileStorage::delete($candidate->resume_url);
            $data[ 'resume_url'] = FileStorage::store($request->input('resume'), "resumes", "pdf");
        }

        Candidate::where('id', $id)->update($data);
        $candidate = Candidate::where('id', $id)->first();
        $candidate->top_skills = json_decode($candidate->top_skills);

        return response()->json($candidate, 200);
    }
    public function delete($id)
    {
        $candidate = Candidate::where('id', $id)->first();
        if ($candidate == null) {
            return response()->json(["message" => "Candidate with given id $id not found"], 404);
        }

        $candidate->delete();

        return response()->json($candidate, 200);
    }
}
