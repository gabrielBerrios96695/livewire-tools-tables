<div class="tools-table-container {{ $style }}-style">
    @include("tools-table::styles.$style")

    <div class="table-controls">
        <div class="left-controls">
            <label>
                Mostrar
                <select>
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                registros
            </label>

            <input type="text" placeholder="Buscar...">
        </div>

        <div class="right-controls">
            <button>Filtrar</button>
            <button>Exportar</button>
            <button wire:click="resetSorting" title="Reiniciar ordenamiento">
                <i class="fas fa-sync-alt"></i> Reiniciar
            </button>
        </div>
    </div>

    <table class="tools-data-table" x-data>
        <thead>
            <tr>
                @foreach ($columns as $column)
                    @php
                        $sortable = method_exists($column, 'isSortable') && $column->isSortable();
                        $sortKey = method_exists($column, 'getFieldForSorting') ? $column->getFieldForSorting() : $column->field;
                        $isSortedSimple = $sortField === $sortKey;
                        $isSortedMulti = isset($multiSort[$sortKey]);
                        $direction = $isSortedMulti ? $multiSort[$sortKey] : ($isSortedSimple ? $sortDirection : null);
                        $orderIndex = $isSortedMulti ? array_search($sortKey, array_keys($multiSort)) + 1 : null;
                    @endphp
                    <th
                        @if ($sortable)
                            wire:click="sortByColumn('{{ $sortKey }}', $event.ctrlKey || $event.metaKey)"
                            class="sortable {{ $isSortedSimple || $isSortedMulti ? 'sorted' : '' }}"
                            style="cursor:pointer;"
                            title="{{ $sortable ? 'Click: Orden simple | Ctrl+Click: Orden múltiple' : '' }}"
                        @endif
                    >
                        <div class="th-content">
                            <span>{{ $column->title }}</span>
                            @if ($direction)
                                <span class="sort-icon">
                                    @if($multiSortActive && $orderIndex)
                                        <span class="order-badge">{{ $orderIndex }}</span>
                                    @endif
                                    {!! $direction === 'asc' ? '&#x25B2;' : '&#x25BC;' !!}
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

    <!-- Paginación -->
    <div class="pagination">
        <button>&laquo;</button>
        <button class="active">1</button>
        <button>2</button>
        <button>3</button>
        <button>&raquo;</button>
    </div>
</div>

