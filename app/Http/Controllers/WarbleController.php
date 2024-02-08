<?php

namespace App\Http\Controllers;

use App\Models\Warble;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class WarbleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('warble.index', [
            'warbles' => Warble::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->warble()->create($validated);

        return redirect(route('warble.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Warble $warble)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warble $warble): View
    {
        $this->authorize('update', $warble);

        return view('warble.edit', [
            'warble' => $warble,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warble $warble): RedirectResponse
    {
        $this->authorize('update', $warble);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $warble->update($validated);

        return redirect(route('warble.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warble $warble)
    {
        //
    }
}
