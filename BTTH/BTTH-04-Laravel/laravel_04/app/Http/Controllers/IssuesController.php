<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Computer;

class IssuesController extends Controller
{
    public function index()
    {
        $issues = Issue::with('computer_hello')->orderBy('id', 'desc')->paginate(10);
        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'nullable',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required',
        ]);

        Issue::create($validatedData);
        return redirect()->route('issues.index')->with('success', 'The issue has been added successfully!');
    }

    public function edit($id)
    {
        $issue = Issue::find($id);
        $computers = Computer::all();
        return view('issues.edit', compact('issue', 'computers'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'nullable',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required',
        ]);

        $issue = Issue::find($id);
        $issue->update($validatedData);
        return redirect()->route('issues.index')->with('success', 'Issue updated successfully');
    }

    public function destroy($id)
    {
        $issue = Issue::find($id);
        $issue->delete();
        return redirect()->route('issues.index')->with('success', 'The issue has been successfully deleted!');
    }
}
