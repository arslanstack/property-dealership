<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agents::all();
        foreach ($agents as $agent) {
            $agent->image = asset('uploads/agents/' . $agent->image);
        }
        return response()->json(['message' => 'Agents retrieved successfully.', 'data' => $agents], 200);
    }

    public function show($id)
    {
        $agent = Agents::find($id);
        if ($agent) {
            $agent->image = asset('uploads/agents/' . $agent->image);
            return response()->json(['message' => 'Agent retrieved successfully.', 'data' => $agent], 200);
        } else {
            return response()->json(['message' => 'Agent not found.'], 404);
        }
    }
}
