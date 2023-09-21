<?php

namespace SujanSht\LaraAdmin\Http\Livewire\Admin\Role;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use SujanSht\LaraAdmin\Models\Admin\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;

class RoleTable extends DataTableComponent
{
    // protected $model = Role::class;

    public function builder(): Builder
    {
        return Role::where('name', '!=', 'super admin');
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->searchable()
                ->collapseOnTablet(),
            Column::make("Action")
                ->label(
                    fn ($row) => Blade::render('<x-action :model="$model" route="roles" :show="true" />', ['model' => $row])
                )
                ->html(),
        ];
    }
}
