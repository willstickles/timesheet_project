<h1>Daily Timesheet</h1>

<table cellspacing="0" cellpadding="10" border="0">
    <tr>
        <td>
            <table cellspacing="0" cellpadding="10" border="0">
                <tr>
                    <th align="left" cellpadding="2">Employee Name</th>
                    <th align="left" cellpadding="2">Email address</th>
                    <th align="left" cellpadding="2">Lunch Hours</th>
                    <th align="left" cellpadding="2">Start Time</th>
                    <th align="left" cellpadding="2">End Time</th>
                    <th align="left" cellpadding="2">Total Hours</th>
                    <th align="left" cellpadding="2">Start Location</th>
                    <th align="left" cellpadding="2">Report Date</th>
                </tr>
                <tr>
                    <td align="left" cellpadding="2">{{ $user->name }}</td>
                    <td align="left" cellpadding="2">{{ $user->email }}</td>
                    <td align="left" cellpadding="2">{{ $hours->lunch_hours }}</td>
                    <td align="left" cellpadding="2">{{ $hours->start_time }}</td>
                    <td align="left" cellpadding="2">{{ $hours->end_time }}</td>
                    <td align="left" cellpadding="2">{{ $hours->total_hours }}</td>
                    <td align="left" cellpadding="2">{{ $hours->start_location }}</td>
                    <td align="left" cellpadding="2">{{ $hours->report_date }}</td>
                </tr>
            </table>
            @foreach ( $projects as $project )
                <table cellspacing="0" cellpadding="10" border="0">
                    <tr>
                        <th align="left" cellpadding="2">Project id</th>
                        <th align="left" cellpadding="2">Project name</th>
                        <th align="left" cellpadding="2">Client name</th>
                        <th align="left" cellpadding="2">Time arrived</th>
                        <th align="left" cellpadding="2">Time departed</th>
                        <th align="left" cellpadding="2">Densities</th>
                        <th align="left" cellpadding="2">Concrete</th>
                        <th align="left" cellpadding="2">Samples</th>
                        <th align="left" cellpadding="2">Remarks</th>
                    </tr>
                    <tr>
                        <td align="left" cellpadding="2">{{ $project->project_id }}</td>
                        <td align="left" cellpadding="2">{{ $project->project_name }}</td>
                        <td align="left" cellpadding="2">{{ $project->client_name }}</td>
                        <td align="left" cellpadding="2">{{ $project->time_arrived }}</td>
                        <td align="left" cellpadding="2">{{ $project->time_departed }}</td>
                        <td align="left" cellpadding="2">{{ $project->densities }}</td>
                        <td align="left" cellpadding="2">{{ $project->concrete }}</td>
                        <td align="left" cellpadding="2">{{ $project->samples }}</td>
                        <td align="left" cellpadding="2">{{ $project->remarks }}</td>
                    </tr>
                </table>
            @endforeach
        </td>
    </tr>
</table>

