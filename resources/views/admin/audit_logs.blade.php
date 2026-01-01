<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center h-10">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('System Audit Logs') }}
            </h2>

            <a href="{{ route('dashboard') }}" class="bg-indigo-600 text-white text-sm font-bold py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition">
                Back to Profile
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    User
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    IP Address
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Time
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                {{ $log->user ? $log->user->name : 'Unknown' }}
                                            </p>
                                            <p class="text-gray-600 text-xs">{{ $log->user ? $log->user->email : '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span class="relative inline-block px-3 py-1 font-semibold leading-tight
                                        {{ $log->action == 'Login' ? 'text-green-900' : 'text-blue-900' }}">
                                        <span aria-hidden class="absolute inset-0 opacity-50 rounded-full
                                            {{ $log->action == 'Login' ? 'bg-green-200' : 'bg-blue-200' }}">
                                        </span>
                                        <span class="relative">{{ $log->action }}</span>
                                    </span>
                                    <p class="text-gray-600 text-xs mt-1">{{ $log->details }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $log->ip_address }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $log->created_at->format('d M Y, h:i A') }}</p>
                                </td>
                                
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                    <form action="{{ route('admin.logs.delete', $log->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this log entry?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</x-app-layout>