<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Record;

class RecordController extends Controller
{
    public function index()
    {
        $records = Record::latest()->get();
        return response()->json($records, 200);
    }

    public function indexNames()
    {
        $records = Record::select('name')
            ->groupBy('name')
            ->orderBy('name', 'ASC')
            ->get()
            ->pluck('name')
            ->all();
        
        return response()->json($records, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
                'name' => ['required','string','min:1','max:255'],
                'location' => ['required','string','min:1','max:255'],
                'depth' => ['required','integer', 'min:0'],
                'duration' => ['required','integer','min:0']
            ]
        );

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $record = Record::create($data);
        
        return response()->json($record, 201);
    }

    public function showByName(string $name)
    {
        $record = Record::where('name', '=', $name)->latest()->get();
        return response()->json($record, 200);
    }

    public function indexByDeepestDivesByLocation()
    {
        $record = Record::orderBy('location', 'ASC')->orderBy('depth', 'DESC')->get();
        return response()->json($record, 200);
    }

    public function indexByLongestDivesByLocation()
    {
        $record = Record::orderBy('location', 'ASC')->orderBy('duration', 'DESC')->get();
        return response()->json($record, 200);
    }
    

    public function update(string $id, Request $request)
    {
        $record = Record::find($id);
        if(!$record) {
            return response()->json([
                "message" => "Record not found."
            ], 404);
        }

        $data = $request->all();
        $validator = Validator::make($data, [
                'name' => ['string','max:255'],
                'location' => ['string','max:255'],
                'depth' => ['integer', 'min:0'],
                'duration' => ['integer','min:0']
            ]
        );

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $record->name = isset($data['name']) ? $data['name'] : $record->name;
        $record->location = isset($data['location']) ? $data['location'] : $record->location;
        $record->depth = isset($data['depth']) ? $data['depth'] : $record->depth;
        $record->duration = isset($data['duration']) ? $data['duration'] : $record->duration;

        $record->save();

        return response()->json($record, 200);
    }

    public function destroy(string $id)
    {
        $record = Record::find($id);
        
        if(!$record) {
            return response()->json([
                "message" => "Record not found."
            ], 404);
        }
        
        $record->delete();

        return response()->json([
            "message" => "Record deleted."
        ], 200);

    }
}
