<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Message;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Services\MessageService;


class MessageController extends Controller
{

    protected $messageService;


    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $messages = Message::with('user')->where('created_by', auth()->user()->id)->latest()->paginate();

        return view('message.index', compact('messages'))
            ->with('i', ($request->input('page', 1) - 1) * $messages->perPage());
    }

    /**
     * Display a listing of the resource.
     */
    public function messagesReceived(Request $request): View
    {
        $messages = Message::with('sender')->where('recipient_id', auth()->user()->id)->latest()->paginate();

        return view('message.received-index', compact('messages'))
            ->with('i', ($request->input('page', 1) - 1) * $messages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $message = new Message();

        $users = User::where('id', '<>', auth()->user()->id)->get();

        return view('message.create', compact('message', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request): RedirectResponse
    {
        Message::create($request->validated());

        return Redirect::route('messages.index')
            ->with('success', 'Message created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): View
    {
        return $this->messageService->showMessage($slug);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $message = Message::with('user')->find($id);

        return view('message.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MessageRequest $request, Message $message): RedirectResponse
    {
        $message->update($request->validated());

        return Redirect::route('messages.index')
            ->with('success', 'Message updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Message::find($id)->delete();

        return Redirect::route('messages.index')
            ->with('success', 'Message deleted successfully');
    }
}
