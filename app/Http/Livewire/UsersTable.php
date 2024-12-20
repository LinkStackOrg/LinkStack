<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Link;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class UsersTable extends DataTableComponent
{
    protected $listeners = ['refresh' => '$refresh'];
    
    public $columnSearch = [
        'name' => null,
        'email' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['users.id as id'])
            ->setDefaultSort('created_at', 'asc')
            ->setPerPageAccepted([50, 100, 250, 500, 1000, -1])
            ->setHideBulkActionsWhenEmptyEnabled();

        $attributes = [
            'default' => false,
            'default-colors' => true,
            'default-styling' => false,
        ];
            
        $this->setTableAttributes(['class' => 'table table-striped']);
        $this->setTrAttributes(fn($row, $index) => $attributes);
        $this->setTheadAttributes($attributes);
        $this->setTbodyAttributes($attributes);
        $this->setTrAttributes(fn($row, $index) => $attributes);

    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.Name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.E-Mail'), 'email')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.Page'), "littlelink_name")
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    if (!$row->littlelink_name == NULL) {
                        return "<a href='" . url('') . "/@" . htmlspecialchars($row->littlelink_name) . "' target='_blank' class='text-info'><i class='bi bi-box-arrow-up-right'></i>&nbsp; " . htmlspecialchars($row->littlelink_name) . " </a>";
                    } else {
                        return 'N/A';
                    }
                })
                ->html(),
            Column::make(__('messages.Role'), "role")
                ->sortable()
                ->searchable(),
            Column::make(__('messages.Links'))
                ->label(fn ($row, Column $column) => Link::where('user_id', $row->id)->count())
                ->sortable(function (Builder $query, string $direction) {
                    $direction = ($direction === 'asc') ? 'desc' : 'asc';
                    return $query->orderBy(
                        Link::selectRaw('COUNT(*)')
                            ->whereColumn('user_id', 'users.id'),
                        $direction
                    );
                }),
            Column::make(__('messages.Clicks'))
                ->label(fn ($row, Column $column) => Link::where('user_id', $row->id)->sum('click_number'))
                ->sortable(function (Builder $query, string $direction) {
                    $direction = ($direction === 'asc') ? 'desc' : 'asc';
                    return $query->orderBy(
                        Link::selectRaw('SUM(click_number)')
                            ->whereColumn('user_id', 'users.id'),
                        $direction
                    );
                }),
            Column::make(__('messages.E-Mail'), "email_verified_at")
                ->hideIf(env('REGISTER_AUTH') === 'auth')
                ->sortable()
                ->format(function ($value, $row, Column $column) {
                    if ($row->role == 'admin' && $row->email_verified_at != '') {
                        return '<div class="text-center">-</div>';
                    } else {
                        if($row->email_verified_at == ''){
                            $verifyLinkBool = 'true';
                        } else {
                            $verifyLinkBool = 'false';
                        }
                        $verifyLink = route('verifyUser', [
                            'verify' => $verifyLinkBool,
                            'id' => $row->id
                        ]);
                        if ($row->email_verified_at == '') {
                            return '<div class="text-center"><a style="cursor:pointer" data-id="'.$verifyLink.'" class="user-email text-danger"><span class="badge bg-danger">' . __('messages.Pending') . '</span></a></div>';
                        } else {
                            return '<div class="text-center"><a style="cursor:pointer" data-id="'.$verifyLink.'" class="user-email text-danger"><span class="badge bg-success">' . __('messages.Verified') . '</span></a></div>';
                        }
                    }
                })->html(),
            Column::make(__('messages.Status'), "block")
                ->sortable()
                ->format(function ($value, $row, Column $column) {
                    if ($row->role === 'admin' && $row->id === 1) {
                        return '<div class="text-center">-</div>';
                    } else {
                        $route = route('blockUser', ['block' => $row->block, 'id' => $row->id]);
                        if ($row->block === 'yes') {
                            $badge = '<div class="text-center"><a style="cursor:pointer" data-id="'.$route.'" class="user-block text-danger"><span class="badge bg-danger">'.__('messages.Pending').'</span></a></div>';
                        } elseif ($row->block === 'no') {
                            $badge = '<div class="text-center"><a style="cursor:pointer" data-id="'.$route.'" class="user-block text-danger"><span class="badge bg-success">'.__('messages.Approved').'</span></a></div>';
                        }
                        return "<a href=\"$route\">$badge</a>";
                    }
                })
                ->html(),
            Column::make(__('messages.Created at'), "created_at")
                ->sortable()
                ->format(function ($value) {
                    if ($value) {
                        return $value->format('d/m/y');
                    } else {
                        return '';
                    }
                }),
            Column::make(__('messages.Last seen'), "updated_at")
                ->sortable()
                ->format(function ($value) {
                    $now = now();
                    $diff = $now->diff($value);
            
                    if ($diff->d < 1 && $diff->h < 1) {
                        return 'Now';
                    } elseif ($diff->d < 1 && $diff->h < 24) {
                        return $diff->h . ' hours ago';
                    } elseif ($diff->d < 365) {
                        return $diff->d . ' days ago';
                    } else {
                        return $diff->y . ' years ago';
                    }
                }),
                Column::make(__('messages.Action'), "id")
                ->format(function ($value, $row, Column $column) {
                    return view('components.table-components.action', ['user' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make(__('messages.Name'), 'name')
                ->config([
                    'maxlength' => 5,
                    'placeholder' => __('messages.Name'),
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('users.name', 'like', '%'.$value.'%');
                }),
            SelectFilter::make(__('messages.E-Mail'), 'email_verified_at')
                ->setFilterPillTitle(__('messages.Status'))
                ->options([
                    ''    => 'Any',
                    'yes' => __('messages.Verified'),
                    'no'  => __('messages.Pending'),
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->whereNotNull('email_verified_at');
                    } elseif ($value === 'no') {
                        $builder->whereNull('email_verified_at');
                    }
                }),
            SelectFilter::make(__('messages.Status'), 'block')
                ->setFilterPillTitle(__('messages.Status'))
                ->setFilterPillValues([
                    'no' => __('messages.Approved'),
                    'yes' => __('messages.Pending'),
                ])
                ->options([
                    '' => 'All',
                    'no' => __('messages.Approved'),
                    'yes' => __('messages.Pending'),
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === 'yes') {
                        $builder->where('block', 'yes');
                    } elseif ($value === 'no') {
                        $builder->where('block', 'no');
                    }
                }),
            DateFilter::make('Created Start')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('created_at', '>=', $value);
                }),
            DateFilter::make('Created End')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('created_at', '<=', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return User::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('users.name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => $query->where('users.email', 'like', '%' . $email . '%'));
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Approve Users',
            'deactivate' => 'Block Users',
            'delete' => 'Delete Users',
        ];
    }

    public function rendered()
    {
        $this->dispatch('table-loaded');
    }

    public function activate()
    {
        User::whereIn('id', $this->getSelected())
            ->where('id', '!=', auth()->id())
            ->where('role', '!=', 'admin')
            ->update(['block' => 'no']);

        $this->clearSelected();
    }

    public function deactivate()
    {
        User::whereIn('id', $this->getSelected())
            ->where('id', '!=', auth()->id())
            ->where('role', '!=', 'admin')
            ->update(['block' => 'yes']);

        $this->clearSelected();
    }

    public function delete()
    {
        User::whereIn('id', $this->getSelected())
            ->where('id', '!=', auth()->id())
            ->where('role', '!=', 'admin')
            ->delete();

        $this->clearSelected();
    }

}