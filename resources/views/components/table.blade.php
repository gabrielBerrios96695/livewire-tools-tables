{{-- resources/views/components/table.blade.php --}}
<div class="tools-table-container {{ config('tools-table.style', 'dark') }}-style">
    <table class="tools-data-table">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    @php
                        $sortable = method_exists($column, 'isSortable') && $column->isSortable();
                        $sortKey = method_exists($column, 'getFieldForSorting') ? $column->getFieldForSorting() : $column->field;
                    @endphp
                    <th
                        @if ($sortable)
                            wire:click="sortBy('{{ $sortKey }}')"
                            class="{{ $sortable ? 'sortable' : '' }} {{ $sortField === $sortKey ? 'sorted' : '' }}"
                        @endif
                    >
                        <div class="th-content">
                            <span>{{ $column->title }}</span>
                            @if ($sortable && $sortField === $sortKey)
                                <span class="sort-icon">
                                    {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                                </span>
                            @endif
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($records as $record)
                <tr>
                    @foreach ($columns as $column)
                        <td>
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

@push('styles')
    @if(View::exists('tools-table::components.styles.'.config('tools-table.style', 'dark')))
        @include('tools-table::components.styles.'.config('tools-table.style', 'dark'))
    @else
        @include('tools-table::components.styles.dark')
    @endif
@endpush
