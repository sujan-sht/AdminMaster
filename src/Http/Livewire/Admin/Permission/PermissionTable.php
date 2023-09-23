<?php

namespace SujanSht\LaraAdmin\Http\Livewire\Admin\Permission;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use SujanSht\LaraAdmin\Models\Admin\Permission;
use SujanSht\LaraAdmin\Models\Admin\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PermissionTable extends DataTableComponent
{
    // protected $model = Permission::class;
    public function builder(): Builder
    {
        return Permission::whereHas('role', function ($query) {
            $query->where('name', '!=', 'Super Admin');
        });
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }


    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            BooleanColumn::make('Browse'),
            BooleanColumn::make('Read'),
            BooleanColumn::make('Edit'),
            BooleanColumn::make('Add'),
            BooleanColumn::make('Delete'),
            Column::make("Role", "role.name")
                ->sortable()
                ->searchable()
                ->format([$this,'nullCheck']),
            Column::make("Name", "name")
                ->sortable()
                ->searchable()
                ->format([$this,'nullCheck']),
            Column::make("Model", "model")
                ->sortable()
                ->searchable(),
            Column::make("Can/Cannot", "can")
                ->format([$this,'nullCheck']),
            Column::make("Action")
                ->label(
                    fn ($row) => Blade::render('<x-lara-admin-action :model="$model" route="permissions" :show="false" />', ['model' => $row])
                )
                ->html(),
        ];
    }

    public function filters() : array
    {
        $roles = Role::pluck('name', 'id')->toArray();
        return [
            SelectFilter::make('Role')
            ->options($roles)
            ->filter(function (Builder $builder, string $value) {
                $builder->where('role_id', $value);
            }),
        ];
    }

    public function nullCheck($value){
        $data = $value ?? '<span class="badge bg-primary p-1"> N/A </span>';
        return new HtmlString($data);
    }

}
