<?php

namespace GabrielBerrios\LivewireToolsTable\Http\Livewire;

use GabrielBerrios\LivewireToolsTable\Features\Searchable;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

abstract class LivewireToolsTable extends Component
{
    public string $title = 'Default Title';

    public string $search = '';

    public bool $searchable = true;

    abstract public function columns(): array;

    abstract public function query(): Builder;


    public function getRowsProperty()
    {
        $query = $this->query();
        
        foreach ($this->columns() as $column) {
            if (method_exists($column, 'getSelectExpression')) {
                $query->addSelect(DB::raw($column->getSelectExpression() . ' as `' . $column->name . '`'));
            }
        }

        if ($this->searchable && $this->search !== '') {
            $query = Searchable::apply($query, $this->search, $this->columns());
        }

        return $query->get();
    }



    public function render()
    {
        return view('livewire-tools-table::livewire.tools-table', [
            'title' => $this->title,
            'columns' => $this->columns(),
            'rows' => $this->rows,
            'searchable' => $this->searchable,
            'search' => $this->search,
        ]);
    }
}
