<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishRequest;
use App\Models\Wish;
use App\Types\Types;
use Illuminate\Validation\ValidationException;

class WishController extends Controller
{

    /**
     * Return wishes with specific type.
     *
     * @param  String  $type
     * @return \Inertia\Response
     */
    public function wishes(String $type)
    {
        $type = Types::get($type);

        if (!$type) {
            abort(404);
        }

        $wishes = Wish::where([
                    'user_id' => auth()->id(),
                    'type' => $type->name,
                    'status' => 'in_progress'
                ])
                ->get();

        return inertia('Wishes', ['type' => $type, 'wishes' => $wishes]);
    }

    /**
     * Show the form for creating a new wish.
     *
     * @param  String  $type
     * @return \Inertia\Response
     */
    public function create($type = 'book')
    {
        $type = Types::get($type);

        if (!$type) {
            abort(404);
        }

        return inertia('Wish', ['type' => $type]);
    }

    /**
     * Store a newly created wish in database.
     *
     * @param  \App\Http\Requests\WishRequest $request
     */
    public function store(WishRequest $request)
    {
        $wish = Wish::create($request->validated() + ['user_id' => auth()->id()]);

        if (!$wish) {
            throw ValidationException::withMessages([
                'error' => 'Some error happend.',
            ]);
        }
    }

    /**
     * Show the form for editing the specified wish.
     *
     * @param  Wish  $wish
     * @return \Inertia\Response
     */
    public function edit(Wish $wish)
    {
        $type = Types::get($wish->type);

        return inertia('Wish', ['wish' => $wish, 'type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\WishRequest $request
     * @param  Wish  $wish
     * @return \Inertia\Response
     */
    public function update(Wish $wish, WishRequest $request)
    {
        $wish->update($request->validated());

        return redirect()->route('wishes.index', $wish->type);
    }

    /**
     * Complete the specified wish from database.
     *
     * @param  Wish  $wish
     */
    public function complete(Wish $wish)
    {
        $wish->update(['status' => 'completed']);
    }

    /**
     * Remove the specified wish from database.
     *
     * @param  Wish  $wish
     */
    public function destroy(Wish $wish)
    {
        $wish->delete();
    }
}
