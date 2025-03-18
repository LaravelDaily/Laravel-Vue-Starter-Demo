<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'completedVsPendingTaskChart' => $this->getCompletedVsPendingTaskChart(),
            'pendingTasksToday' => Task::query()
                ->where('is_completed', false)
                ->whereDate('due_date', now())
                ->count(),
            'tasksCreatedByDay' => $this->getTasksCreatedByDay(),
        ]);
    }

    private function getCompletedVsPendingTaskChart(): array
    {
        return [
            [
                'name' => 'Completed',
                'total' => Task::query()->where('is_completed', true)->count(),
            ],
            [
                'name' => 'In Progress',
                'total' => Task::query()->where('is_completed', false)->count(),
            ],
        ];
    }

    private function getTasksCreatedByDay(): array
    {
        return collect(range(0, 6))
            ->map(function ($day) {
                $date = now()->startOfWeek()->addDays($day);

                return [
                    'name' => $date->format('D'),
                    'Tasks Created' => Task::query()
                        ->whereDate('created_at', $date)
                        ->count()
                ];
            })
            ->toArray();
    }
}