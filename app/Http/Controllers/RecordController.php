<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\RecordResource;
use App\Http\Resources\RecordWithFileResource;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RecordController extends Controller
{
    public function index()
    {
        return response()->json(['data' => RecordResource::collection(Record::paginate(10))], ResponseAlias::HTTP_OK);
    }

    public function show($id)
    {
        try{
            $record = Record::find($id);
            return response()->json([
                'data' => is_null($record) ? [] : new RecordWithFileResource($record)
            ], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request) 
    {
        try{
            $record = Record::create($this->validateRecord($request));
            $imageFile=$request->file;
            $fileName = Storage::putFileAs('images',$imageFile,$record->id . '.' . $imageFile->getClientOriginalExtension());
            $record->file = $fileName;
            $record->update();
            return response()->json(['data' => new RecordResource($record)], ResponseAlias::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function validateRecord(Request $request)
    {
        return $request->validate([
            'name'  => ['required', 'string','max:50'],
            'description'  => ['required', 'string','max:250'],
            'type'  => ['required', 'integer', Rule::in([1,2,3]) ],
            'file' => ['required','image', 'max:5120'],
        ]);
    }
}
