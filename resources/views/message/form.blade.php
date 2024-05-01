<div class="space-y-6">

    <div>
        <x-input-label for="recipient_id" :value="__('Recipient')" />
        <x-select-box id="recipient_id" name="recipient_id" class="mt-1 block w-full" :options="$users" :selected="old('recipient_id', $message?->recipient_id)"
            autocomplete="recipient_id" />
        <x-input-error class="mt-2" :messages="$errors->get('recipient_id')" />
    </div>
    <div>
        <x-input-label for="message" :value="__('Message')" />
        <x-textarea id="message" name="message" rows="3" cols="1-" class="mt-1 block w-full" placeholder="Message" :value="old('message', $message?->message)" />
        <x-input-error class="mt-2" :messages="$errors->get('message')" />
    </div>
    <div>
        <div class="flex space-x-4">
            <x-input-label :value="__('Read Once')" />
            <div class="flex items-center space-x-1">
                <x-radio-box id="read_once_false" name="read_once" class="inline" :value="1" :checked="old('read_once', $message?->read_once)" />
                <x-input-label for="read_once_false" :value="__('Yes')" />
            </div>
            <div class="flex items-center space-x-1">
                <x-radio-box id="read_once_true" name="read_once" class="inline" :value="0"
                    :checked="old('read_once', $message?->read_once)" />
                <x-input-label for="read_once_true" :value="__('No')" />
            </div>
        </div>
        <x-input-error class="mt-2" :messages="$errors->get('read_once')" />
    </div>
    <div>
        <x-input-label for="auto_delete_at" :value="__('Auto Delete At')" />
        <x-text-input id="auto_delete_at" name="auto_delete_at" type="text" class="mt-1 block w-full"
            :value="old('auto_delete_at', $message?->auto_delete_at)" autocomplete="auto_delete_at" placeholder="Auto Delete At" />
        <x-input-error class="mt-2" :messages="$errors->get('auto_delete_at')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>
