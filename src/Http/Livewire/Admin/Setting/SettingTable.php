<?php

namespace SujanSht\AdminMaster\Http\Livewire\Admin\Setting;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use SujanSht\AdminMaster\Models\Admin\Setting;
use SujanSht\AdminMaster\Models\Admin\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SettingTable extends DataTableComponent
{
    protected $model = Setting::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "setting_name")
                ->searchable(),
            Column::make("Type", "setting_type")
                ->sortable(),
            Column::make("Group", "setting_group")
                ->sortable()
                ->searchable(),
            Column::make("Action")
                ->label(
                    fn ($row) => Blade::render('<x-admin-master-action :model="$model" route="settings" :show="false" />', ['model' => $row])
                )
                ->html(),
        ];
    }

    // public function filters() : array
    // {
    //     $roles = Role::pluck('name', 'id')->toArray();
    //     return [
    //         SelectFilter::make('Role')
    //         ->options($roles)
    //         ->filter(function (Builder $builder, string $value) {
    //             $builder->where('role_id', $value);
    //         }),
    //     ];
    // }

    // public function nullCheck($value){
    //     $data = $value ?? '<span class="badge bg-primary p-1"> N/A </span>';
    //     return new HtmlString($data);
    // }

}
