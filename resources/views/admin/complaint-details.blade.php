<tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
    @forelse($complaints as $complaint)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                #{{ $complaint->id }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $complaint->user->name ?? 'Unknown' }}
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                    @if($complaint->status === 'New') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                    @elseif($complaint->status === 'In Progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                    @endif">
                    {{ $complaint->status }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                    @if(isset($complaint->priority) && $complaint->priority === 'High') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                    @elseif(isset($complaint->priority) && $complaint->priority === 'Medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                    @endif">
                    {{ $complaint->priority ?? 'Low' }} <!-- Default to Low if not set -->
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <a href="{{ route('admin.complaint.show', $complaint->id) }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                    View Details
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                No complaints found.
            </td>
        </tr>
    @endforelse
</tbody>
