<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::orderBy('created_at')->where('villain_id', Auth::id())->paginate(25)->onEachSide(0);

        foreach ($messages as $message) {
            $message->formatted_created_at= $message->created_at->format('d/m/Y - H:i');
            $message->mobile_formatted_created_at = $message->created_at->format('d/m/y');

        }

        $columns = [
            ['label' => 'Sender', 'field' => 'full_name'],
            ['label' => 'Sent', 'field' => 'created_at_formatted'],
        ];

        return view('admin.messages.index', compact('messages', 'columns'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        if ($message->villain_id == Auth::id()) {
            return view('admin.messages.show', compact('message'));
        }

        return redirect()->route('admin.messages.index')->with('error', 'messaggio non trovato!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Messaggio eliminato con successo');
    }
}
