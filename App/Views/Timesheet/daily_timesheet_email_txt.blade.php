Daily Timesheet


Employee name   {{ $user->name }}
Email address   {{ $user->email }}

Lunch hours     {{ $hours->lunch_hours }}
Start time      {{ $hours->start_time }}
End time        {{ $hours->end_time }}
Total hours     {{ $hours->total_hours }}

Start location  {{ $hours->start_location }}
Report date     {{ $hours->report_date }}


---------------------------------------------
@foreach ( $projects as $project )
Project id    {{ $project->id }}
Project name  {{ $project->project_name }}
Client name   {{ $project->client_name }}

Time arrived  {{ $project->time_arrived }}
Time departed {{ $project->time_departed }}

Densities     {{ $project->densities }}
Concrete      {{ $project->concrete }}
Samples       {{ $project->samples }}

Remarks       {{ $project->remarks }}


--------------------------------------------
@endforeach