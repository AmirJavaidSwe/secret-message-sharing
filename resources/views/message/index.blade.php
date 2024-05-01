<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Messages') }}</h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all sent {{ __('Messages') }}.</p>
                            <p class="mt-2 text-sm text-gray-700">Latest at the top.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('messages.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send a
                                new message</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>

									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Sent to</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                        <div class="flex items-center">
                                            <span>
                                                Message
                                            </span>
                                            <x-zondicon-question data-tippy-content="Decrypted message is truncated due to long encrypted string" class="ms-1 w-3 h-3" />
                                        </div>
                                    </th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                        <div class="flex items-center">
                                            <span>
                                                Identifier
                                            </span>
                                            <x-zondicon-question data-tippy-content="Recipient can open the message page with this URL" class="ms-1 w-3 h-3" />
                                        </div>
                                    </th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                        <div class="flex items-center">
                                            <span>Decryption Key</span>
                                            <x-zondicon-question data-tippy-content="Recipient must privde this decryption Key to decrypt the message" class="ms-1 w-3 h-3" />
                                        </div>
                                    </th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Read Once</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Auto Delete At</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Read At</th>

                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($messages as $message)
                                        <tr class="even:bg-gray-50">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>

										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $message->user->name }}</td>
										<td data-tippy-content="{{ $message->message }}" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ \Illuminate\Support\Str::of($message->message)->limit(20) }}
                                        </td>
                                        <td data-tippy-content="{{ url('/messages/'.$message->slug) }}"
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <a href="javascript:;">{{ \Illuminate\Support\Str::of(url('/messages/'.$message->slug))->limit(20) }}
                                            </a>
                                        </td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $message->decrypt_key }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $message->read_once == 1 ? 'Yes' : 'No' }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $message->auto_delete_at }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $message->read_at }}</td>

                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('messages.destroy', $message->id) }}" class="text-red-600 font-bold hover:text-red-900" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">{{ __('Delete') }}</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 px-4">
                                    {!! $messages->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>