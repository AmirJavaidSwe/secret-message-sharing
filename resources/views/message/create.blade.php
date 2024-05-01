<x-app-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }} Message
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full w-1/2 mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Create') }} Message</h1>
                            <p class="mt-2 text-sm text-gray-700">Add a new {{ __('Message') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('messages.index') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" action="{{ route('messages.store') }}"  role="form" enctype="multipart/form-data">
                                    @csrf

                                    @include('message.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript">
            flatpickr("#auto_delete_at", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                altInput: true,
                minDate: "today", // Limit selection to today
                minTime: new Date().getHours() + 2 + ":" + new Date().getMinutes(), // 2 hours from now
            });
        </script>
    </x-slot>
</x-app-layout>
