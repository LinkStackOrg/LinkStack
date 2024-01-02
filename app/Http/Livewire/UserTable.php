<?php

namespace App\Http\Livewire;

use App\Http\Livewire;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use App\Models\Link;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'asc');
        $this->setPerPageAccepted([50, 100, 250, 500, 1000, -1]);
        $this->setColumnSelectEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ID'), "id")
                ->sortable()
                ->searchable(),
            Column::make(__('messages.Name'), "name")
                ->sortable()
                ->searchable(),
            Column::make(__('messages.E-Mail'), "email")
                ->sortable()
                ->searchable(),
            Column::make(__('messages.Page'), "littlelink_name")
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    if (!$row->littlelink_name == NULL) {
                        return "<a href='" . url('') . "/@" . htmlspecialchars($row->littlelink_name) . "' target='_blank' class='text-info'><i class='bi bi-box-arrow-up-right'></i>&nbsp; " . $row->littlelink_name . " </a>";
                    } else {
                        return 'N/A';
                    }
                })
                ->html(),
            Column::make(__('messages.Role'), "role")
                ->sortable()
                ->searchable(),
            Column::make(__('messages.Links'), "id")
                ->format(function ($value, $row) {
                    $linkCount = Link::where('user_id', $row->id)->count();
                    return $linkCount;
                }),
            Column::make(__('messages.Clicks'), "id")
                ->format(function ($value, $row) {
                    $clicksSum = Link::where('user_id', $row->id)->sum('click_number');
                    return $clicksSum;
                }),
            Column::make(__('messages.E-Mail'), "email_verified_at")
                ->sortable()
                ->format(function ($value, $row, Column $column) {
                    if (env('REGISTER_AUTH') !== 'auth') {
                        if ($row->role == 'admin' && $row->email_verified_at != '') {
                            return '<center>-</center>';
                        } else {
                            $verifyLink = route('verifyUser', [
                                'verify' => '-' . $row->email_verified_at,
                                'id' => $row->id
                            ]);
                            if ($row->email_verified_at == '') {
                                return '<a style="cursor:pointer" data-id="'.$verifyLink.'" class="user-email text-danger"><span class="badge bg-danger">' . __('messages.Pending') . '</span></a>';
                            } else {
                                return '<a style="cursor:pointer" data-id="'.$verifyLink.'" class="user-email text-danger"><span class="badge bg-success">' . __('messages.Verified') . '</span></a>';
                            }
                        }
                    } else {
                        return '<center>-</center>';
                    }
                    return '';
                })->html(),
            Column::make(__('messages.Status'), "block")
                ->sortable()
                ->format(function ($value, $row, Column $column) {
                    if ($row->role === 'admin' && $row->id === 1) {
                        return '<center>-</center>';
                    } else {
                        $route = route('blockUser', ['block' => $row->block, 'id' => $row->id]);
                        if ($row->block === 'yes') {
                            $badge = '<a style="cursor:pointer" data-id="'.$route.'" class="user-block text-danger"><span class="badge bg-danger">'.__('messages.Pending').'</span></a>';
                        } elseif ($row->block === 'no') {
                            $badge = '<a style="cursor:pointer" data-id="'.$route.'" class="user-block text-danger"><span class="badge bg-success">'.__('messages.Approved').'</span></a>';
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
}
