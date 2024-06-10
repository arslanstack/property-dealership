<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeEval;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $query = HomeEval::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('fname', 'like', '%' . $search_query . '%')
                    ->orWhere('lname', 'like', '%' . $search_query . '%')
                    ->orWhere('email', 'like', '%' . $search_query . '%')
                    ->orWhere('phone', 'like', '%' . $search_query . '%')
                    ->orWhere('city', 'like', '%' . $search_query . '%')
                    ->orWhere('state', 'like', '%' . $search_query . '%');
            });
        }
        $data['evals'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/evals/manage_evals', $data);
    }

    public function show(Request $request)
    {
        $eval = HomeEval::where('id', $request->id)->first();
        if (!empty($eval)) {
            $htmlresult = view('admin/evals/evals_ajax', compact('eval'))->render();
            $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
            return $finalResult;
        } else {
            return response()->json(['msg' => 'error', 'response' => 'Evaluation eval not found.']);
        }
    }
}
