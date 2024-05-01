<?php

namespace App\Observers;

use App\Models\Message;
use Illuminate\Support\Str;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        $message->slug = (string) Str::uuid().'-'.time();
        $message->decrypt_key = (string) uniqid().'-'.time();
        $message->created_by = auth()->id();
        $message->save();

    }

    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
