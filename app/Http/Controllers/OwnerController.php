<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::with('cars')->get();
        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'role' => 'required'
        ]);

        Owner::create($request->all());

        return redirect()->route('insurance')
            ->with('success', 'Owner was created successfully.');
    }

    public function show(Owner $owner)
    {
        //
    }

    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, Owner $owner)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required'
        ]);

        $owner->update($request->all());

        return redirect()->route('insurance')
            ->with('success', 'Owner was updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();

        return redirect()->route('insurance')
            ->with('success', 'Owner was deleted successfully.');
    }
}
