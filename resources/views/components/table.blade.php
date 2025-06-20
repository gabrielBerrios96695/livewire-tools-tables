<div class="table-container">
    <table class="data-table">
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
                            class="sortable"
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
