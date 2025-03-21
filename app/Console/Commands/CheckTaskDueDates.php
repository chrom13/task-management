<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDueDateNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckTaskDueDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:check-due-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check tasks and send notifications if due date is within 48 hours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get tasks with due dates within 48 hours
        $tasks = Task::where('due_date', '<=', now()->addHours(48))
            ->where('due_date', '>', now())
            ->whereIn('status', ['pending', 'in_progress'])
            ->get();

        // Send notifications for each task
        foreach ($tasks as $task) {
            Notification::send($task->creator, new TaskDueDateNotification($task));
            $this->info("Notification sent for task: {$task->title}");
        }

        $this->info('Task due date check completed.');
    }
}
