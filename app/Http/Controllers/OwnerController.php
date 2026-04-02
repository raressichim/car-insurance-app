<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRequest;
use App\Models\Owner;

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

    public function store(OwnerRequest $request)
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

    public function update(OwnerRequest $request, Owner $owner)
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
