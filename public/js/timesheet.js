$(function(){

    var maxGroup = 9; // Max groups. "Subtract 1 for first group."
    var x = 1;
    $(".addMore").click(function(){
       if( $('body').find('.fieldGroupCopy').length < maxGroup ) {

           x++;

           var newFieldGroup = $('.fieldGroup').first().clone().removeClass('fieldGroup').addClass('fieldGroupCopy');

           if ( $('.fieldGroupCopy').length ) {
               newFieldGroup.insertAfter('.fieldGroupCopy:last').find("input:text").val("");
           } else {
               newFieldGroup.insertAfter('.fieldGroup').find("input:text").val("");
           }

           $('.fieldGroupCopy').find('.addMore').removeClass('addMore btn-success').addClass('remove btn-danger');
           $('.fieldGroupCopy').find('.glyphicon-plus').removeClass('glyphicon-plus').addClass('glyphicon-minus').html(' Remove');

           resetNumber();


           $( "#inlineReportDate" ).datepicker();

           $('.timepicker-with-dropdown').timepicker({
               timeFormat: 'h:mm p',
               interval: 15,
               minTime: '0',
               maxTime: '11:00pm',
               // defaultTime: '7',
               startTime: '12:00 am',
               dynamic: false,
               dropdown: true,
               scrollbar: true,
               zindex: 1000
           });

       } else {
           maxGroup = maxGroup + 1;
           alert ('Maximum ' + maxGroup + ' groups are allowed.' );
           maxGroup = maxGroup - 1;
       }
    });

    function renumber_blocks() {
        $(".clone_block").each(function(index) {
            var prefix = "items[" + index + "]";
            $(this).find("input").each(function() {
                this.name = this.name.replace(/items\[\d+\]/, prefix);
            });
        });
    }

    function resetNumber(){
        $('.fieldGroupCopy').each(function(index){
            console.log(index);
            var count = index+1;
            $(this).find('.progNum').each(function(){
                $(this).html(count + 1 );
            });

        });
    }

    $('body').on("click", ".remove", function(){
        x--;
       $(this).parents('.fieldGroupCopy').remove();
       resetNumber();
    });

    $( "#inlineReportDate" ).datepicker();

    $('.timepicker-with-dropdown').timepicker({
        timeFormat: 'h:mm p',
        interval: 15,
        minTime: '0',
        maxTime: '11:00pm',
        startTime: '12:00 am',
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        zindex: 1000
    });

    $( function() {

        $.ajax({
            url: '/timesheet/getPList',
            dataType: "json",
            success: function(data) {
                // result=data;
                console.dir(data);

                var source = $.map(data.items, function (user) {
                    console.log("User " + user);
                    return user;
                });


                $( "#inlineProject1" ).autocomplete({
                    source: source
                });
            }
        });


    } );

});