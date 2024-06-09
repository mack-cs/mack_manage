<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();
        $totalPendingTasks = Task::query()
            ->where('status','pending')
            ->count();
        $myPendingTasks = Task::query()
            ->where('status','pending')
            ->where('assigned_user_id', $user->id)
            ->count();

        $myProgressTasks = Task::query()
            ->where('status','in_progress')
            ->where('assigned_user_id', $user->id)
            ->count();
        $totalProgressTasks = Task::query()
            ->where('status','in_progress')
            ->count();
        $myCompletedTasks = Task::query()
            ->where('status','completed')
            ->where('assigned_user_id', $user->id)
            ->count();
        $totalCompletedTasks = Task::query()
            ->where('status','completed')
            ->count();

        $activeTasksRaw = Task::query()
            ->whereIn('status',['pending','in_progress'])
            ->where('assigned_user_id', $user->id)
            ->limit(10)->get();
        $activeTasks = TaskResource::collection($activeTasksRaw);

        return inertia('Dashboard', compact('totalPendingTasks','myPendingTasks','myProgressTasks', 'totalProgressTasks', 'myCompletedTasks', 'totalCompletedTasks', 'activeTasks'));
    }
}
