<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ optional($message)?->name ?? __('Show') . ' ' . __('Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Show') }} Message</h1>
                            <p class="mt-2 text-sm text-gray-700">Details of {{ __('Message') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('messages.received') }}"
                                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <div class="mt-6 border-t border-gray-100">
                                    <dl class="divide-y divide-gray-100">
                                        @if ($errors->isNotEmpty())
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Decryption Key
                                                </dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                    <form action="{{ route('messages.show', $id) }}"
                                                        method="GET">
                                                        <x-text-input id="decryption_key" name="decryption_key"
                                                            type="text" class="mt-1 block w-full" :value="old(
                                                                'decryption_key',
                                                                request()?->decryption_key,
                                                            )"
                                                            placeholder="Provide decryption Key to view the message" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('decryption_key')" />
                                                        <div class="mt-6 flex items-center gap-4">
                                                            <x-primary-button>Submit</x-primary-button>
                                                        </div>
                                                    </form>
                                                </dd>
                                            </div>
                                        @else
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Recipient Id
                                                </dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                    {{ $message->sender->name }}</dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Message</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                    {!! Crypt::decryptString($message->message) !!}</dd>
                                            </div>
                                            @if($message->read_once)
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900"></dt>
                                                <dd class="mt-1 text-sm leading-6 text-red-700 sm:col-span-2 sm:mt-0">
                                                    This Message is now deleted!</dd>
                                            </div>
                                            @else
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Read At</dt>
                                                <dd class="mt-1 text-sm leading-6 text-green-700 sm:col-span-2 sm:mt-0">
                                                    {{ $message->read_at }}</dd>
                                            </div>
                                            @endif
                                        @endif

                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
