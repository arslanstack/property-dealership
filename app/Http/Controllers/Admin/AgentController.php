<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $query = Agents::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('name', 'like', '%' . $search_query . '%')
                    ->orWhere('phone', 'like', '%' . $search_query . '%');
            });
        }
        $data['agents'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/agents/manage_agents', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'designation' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'error', 'response' => 'The following fields are required: ' . implode(', ', array_keys($validator->errors()->messages()))]);
        }

        $agent = new Agents();
        $agent->name = $request->name;
        $agent->description = $request->description;
        $agent->designation = $request->designation;
        $agent->phone = $request->phone;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/agents/'), $filename);
            $agent->image = $filename;
        }
        $agent->save();

        if ($agent->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Real Estate Agent added successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }

    public function show(Request $request)
    {
        $agent = Agents::where('id', $request->id)->first();
        if (!empty($agent)) {
            $htmlresult = view('admin/agents/agents_ajax', compact('agent'))->render();
            $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
            return $finalResult;
        } else {
            return response()->json(['msg
' => 'error', 'response' => 'Real Estate Agent not found.']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'designation' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'error', 'response' => 'The following fields are required: ' . implode(', ', array_keys($validator->errors()->messages()))]);
        }
        $agent = Agents::where('id', $request->id)->first();
        if (!empty($agent)) {
            $agent->name = $request->name;
            $agent->description = $request->description;
            $agent->designation = $request->designation;
            $agent->phone = $request->phone;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/agents/'), $filename);
                $agent->image = $filename;
            }
            $agent->save();
            return response()->json(['msg' => 'success', 'response' => 'Real Estate Agent updated successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Real Estate Agent not found.']);
        }
    }
    public function delete(Request $request)
    {
        $agent = Agents::find($request->id);
        if (!empty($agent)) {
            // delete image first 
            if (!empty($agent->image)) {
                $file_path = public_path() . '/uploads/agents/' . $agent->image;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $agent->delete();
            return response()->json(['msg' => 'success', 'response' => 'Real Estate Agent deleted successfully.']);
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Real Estate Agent not found.']);
        }
    }
}
