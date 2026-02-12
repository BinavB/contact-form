@extends('contact-form::layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">
                            <i class="fas fa-tachometer-alt mr-3 text-purple-600"></i>
                            Trippldee Dashboard
                        </h1>
                        <p class="text-gray-600 mt-2">Manage contact form submissions</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Logged in as:</p>
                        <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            {{ auth()->user()->role }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-filter mr-2"></i>Filter Submissions
            </h2>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500"
                        placeholder="Filter by email"
                        value="{{ request('email') }}"
                    >
                </div>
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                    <input 
                        type="date" 
                        id="date_from" 
                        name="date_from" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500"
                        value="{{ request('date_from') }}"
                    >
                </div>
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                    <input 
                        type="date" 
                        id="date_to" 
                        name="date_to" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500"
                        value="{{ request('date_to') }}"
                    >
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 transition-colors">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Submissions Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-envelope mr-2"></i>Contact Submissions
                    <span class="ml-2 text-sm font-normal text-gray-500">({{ $submissions->total() }} total)</span>
                </h2>
            </div>

            @if($submissions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($submissions as $submission)
                                <tr class="hover:bg-gray-50 {{ !$submission->is_read ? 'bg-blue-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $submission->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $submission->name }}
                                        @if($submission->user)
                                            <br><span class="text-xs text-gray-500">{{ $submission->user->name }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $submission->email }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-xs truncate" title="{{ $submission->subject }}">
                                            {{ $submission->subject }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $submission->created_at->format('M j, Y g:i A') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($submission->is_read)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>Read
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-envelope mr-1"></i>Unread
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            @if(!$submission->is_read)
                                                <form method="POST" action="{{ route('admin.mark-read', $submission->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900" title="Mark as read">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <button 
                                                onclick="showMessage({{ $submission->id }})" 
                                                class="text-blue-600 hover:text-blue-900" 
                                                title="View message"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form method="POST" action="{{ route('admin.delete', $submission->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this submission?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $submissions->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-5xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No submissions found</h3>
                    <p class="text-gray-500">No contact form submissions match your criteria.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Message Modal -->
<div id="messageModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Message Details</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="modalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function showMessage(id) {
    const submissions = @json($submissions->items());
    const submission = submissions.find(s => s.id === id);
    
    if (submission) {
        const content = `
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">From:</label>
                    <p class="text-gray-900">${submission.name} (${submission.email})</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subject:</label>
                    <p class="text-gray-900">${submission.subject}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Message:</label>
                    <p class="text-gray-900 whitespace-pre-wrap">${submission.message}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Submitted:</label>
                    <p class="text-gray-900">${new Date(submission.created_at).toLocaleString()}</p>
                </div>
            </div>
        `;
        document.getElementById('modalContent').innerHTML = content;
        document.getElementById('messageModal').classList.remove('hidden');
    }
}

function closeModal() {
    document.getElementById('messageModal').classList.add('hidden');
}
</script>
@endsection
