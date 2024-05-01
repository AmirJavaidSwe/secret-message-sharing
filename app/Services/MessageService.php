<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class MessageService
{
    public function showMessage($id)
    {
        $message = Message::findBySlug($id);
        if (!$message) {
            abort(404);
        }

        if ($this->shouldDeleteMessage($message)) {
            $this->deleteMessage($message);
            abort(404);
        }

        $validator = $this->validateMessage(request()->all());
        if ($validator->fails()) {
            return view('message.show', compact('message', 'id'))->withErrors($validator);
        }

        if (!$this->checkDecryptionKey(request()->input('decryption_key'), $message)) {
            $validator->getMessageBag()->add('decryption_key', 'The decryption key did not match.');
            return view('message.show', compact('message', 'id'))->withErrors($validator);
        }

        $this->markMessageAsRead($message);

        if ($message->read_once == 1) {
            $this->markMessageAsDeleted($message);
        }

        return view('message.show', compact('message'));
    }

    protected function shouldDeleteMessage($message)
    {
        return $message->read_once == 0 && now() > $message->auto_delete_at;
    }

    protected function deleteMessage($message)
    {
        $message->delete();
    }

    protected function validateMessage($data)
    {
        return self::validate($data);
    }

    protected function checkDecryptionKey($decryptionKey, $message)
    {
        return $decryptionKey === $message->decrypt_key;
    }

    protected function markMessageAsRead($message)
    {
        if(!$message->read_at) {
            $message->update(['read_at' => now()]);
        }
    }

    protected function markMessageAsDeleted($message)
    {
        $message->deleted_at = now();
        $message->save();

    }

    public static function validate($data)
    {
        $rules = [
            'decryption_key' => 'required|string',
        ];

        return Validator::make($data, $rules);
    }
}
