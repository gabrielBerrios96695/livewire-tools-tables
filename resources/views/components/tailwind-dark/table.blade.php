<div class="w-full overflow-x-auto rounded-xl shadow-md border border-neutral-300 dark:border-neutral-800">
    <table class="table-fixed w-full divide-y divide-neutral-200 dark:divide-neutral-700 text-sm text-center">
        <thead class="bg-neutral-200 dark:bg-neutral-800 text-xs font-semibold uppercase tracking-wider text-black dark:text-neutral-300">
            <tr>
                @foreach ($columns as $column)
                    @php
                        $sortable = method_exists($column, 'isSortable') && $column->isSortable();
                        $sortKey = method_exists($column, 'getFieldForSorting') ? $column->getFieldForSorting() : $column->field;
                    @endphp
                    <th
                        class="px-4 py-3 break-words {{ $sortable ? 'cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-700' : '' }}"
                        @if ($sortable)
                            wire:click="sortBy('{{ $sortKey }}')"
                        @endif
                    >
                        <div class="flex items-center justify-center space-x-1">
                            <span>{{ $column->title }}</span>

                            @if ($sortable && $sortField === $sortKey)
                                @if ($sortDirection === 'asc')
                                    <svg class="w-3 h-3 text-black dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                    </svg>
                                @elseif ($sortDirection === 'desc')
                                    <svg class="w-3 h-3 text-black dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                @endif
                            @endif
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody class="bg-white dark:bg-neutral-950 divide-y divide-neutral-200 dark:divide-neutral-800 text-black dark:text-neutral-200">
            @foreach ($records as $record)
                <tr>
                    @foreach ($columns as $column)
                        <td class="px-4 py-3 break-words whitespace-pre">
                            @if (method_exists($column, 'resolve'))
                                {!! $column->resolve($record) !!}
                            @else
                                {{ $record->{$column->field} }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
