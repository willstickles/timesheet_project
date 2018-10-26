@extends( 'master' )

@section( 'title', 'Daily Timesheet')

@section( 'css' )
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="/css/styles.css">
@stop

@section( 'content' )

    <h1>New Timesheet</h1>

    @if ( ! empty( $project->errors ) )
        <p>Errors:</p>
        <ul>
            @foreach( $project->errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="/timesheet/create" class="formTimesheet">

        <div class="form-group row">
            <div class="input-group">

                <div class="form-group">
                    <div class="col-xs-4 col-md-4">
                        <label for="employeeName">Employee name</label>
                        <input type="text" name="employeeName" id="inlineEmployeeName" class="form-control" placeholder="Employee Name" value="{{ $project->employeeName or $current_user->name }}" autofocus required>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="luncHours">Lunch hours</label>
                        <input type="text" name="luncHours" id="inlineLunchHours" class="form-control" placeholder="Lunch Hours" value="{{ $project->luncHours or '' }}" >
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="totalDailyHours">Total hours of time for the day</label>
                        <input type="text" name="totalDailyHours" id="inlineTotalDailyHours" class="form-control " placeholder="Total Daily Hours" value="{{ $project->totalDailyHours or '' }}" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-4 col-md-4">
                        <label for="email">Email address</label>
                        <input type="text" name="email" id="inlineEmail" class="form-control" placeholder="Email address" value="{{ $project->email or $current_user->email }}" required>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="dailyStartTime">Enter time your day started</label>
                        <input type="text" name="dailyStartTime" id="inlineDailyStartTime" class="form-control timepicker-with-dropdown" placeholder="Daily Start Time" value="{{ $project->dailyStartTime or '' }}" >
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="dailyEndTime">Enter time your day ended (back from last job)</label>
                        <input type="text" name="dailyEndTime" id="inlineDailyEndTime" class="form-control timepicker-with-dropdown" placeholder="Daily End Time" value="{{ $project->dailyEndTime or '' }}" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-4 col-md-4">
                        <label for="billableTime">Where were you at the start of your billable time?</label>
                        <input type="text" name="startLocation" id="inlineBillableTime" class="form-control" placeholder="Where were you at the start of your billable time?" value="{{ $project->startLocation or '' }}" >
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="reportDate">Report Date</label>
                        <input type="text" name="reportDate" id="inlineReportDate" class="form-control" placeholder="Report Date format: (MM/DD/YYYY)" value="{{ $project->reportDate or '' }}" >
                    </div>
                </div>

            </div>
        </div>

        <div class="field-group fieldGroup row">
            <div class="input-group">
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <label for="projectId">Project <span class="progNum">1</span> </label>
                        <input type="text" name="projectId[]" id="inlineProject1" class="form-control" placeholder="Project " value="{{ $project->projectId or '' }}" >
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="projectName">Project name </label>
                        <input type="text" name="projectName[]" id="inlineProjectName1" class="form-control" placeholder="Project name " value="{{ $project->projectName or '' }}" >
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="arrivalTime">Time arrived at Job 1</label>
                        <input type="text" name="arrivalTime[]" id="inlineJob1ArrivalTime" class="form-control timepicker-with-dropdown" placeholder="Time arrived at Job 1" value="{{ $project->projectArrivalTime or '' }}" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <label for=clientName">Client </label>
                        <input type="text" name="clientName[]" id="inlineClientNo1" class="form-control" placeholder="Client " value="{{ $project->clientName or '' }}">
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="densities">Densities Job </label>
                        <input type="text" name="densities[]" id="inlineDensitiesJob1" class="form-control" placeholder="Densities Job " value="{{ $project->densities or '' }}">
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="concrete">Concrete Job </label>
                        <input type="text" name="concrete[]" id="inlineConcreteJob1" class="form-control" placeholder="Concrete Job " value="{{ $project->concrete or '' }}">
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="samples">Samples picked up Job </label>
                        <input type="text" name="samples[]" id="inlineSamplesJob1" class="form-control" placeholder="Samples picked up Job " value="{{ $project->samples or '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <label for="remarks">Remarks </label>
                        <input type="text" name="remarks[]" id="inlineRemarksNo1" class="form-control" placeholder="Remarks " value="{{ $project->remarks or '' }}">
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <label for="timeDeparted">Time Departed from Job </label>
                        <input type="text" name="timeDeparted[]" id="inlineTimeDepartedJob1" class="form-control timepicker-with-dropdown" placeholder="Time Departed from Job" value="{{ $project->timeDeparted or '' }}" >
                    </div>
                </div>
                <div class="input-group-addon">
                    <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"> Add</span></a>
                </div>
            </div>
        </div>

        <div class="form-group formButtons row">
            <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"> Add</span></a>
        </div>

        <div class="form-group formButtons row">
            <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT"/>
        </div>

    </form>

@stop

@section( 'js' )

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="/js/timesheet.js"></script>


    <script>
        $(function(){
            /**
             * Validate the form
             */
            console.log('Works');
            $('.formTimesheet').validate({
                rules: {
                    employeeName: 'required',
                    email: {
                        required: true,
                        email: true
                    }
                },
                errorPlacement: function(error, element) {
                    element.attr("placeholder",error.text());
                }
            });

        });
    </script>
@stop