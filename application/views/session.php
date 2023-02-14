<div id="session_time_out" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-center mb-3" style="font-size: 60px; color: #666">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i><br />
                    <h4 class="modal-title">Your Session is about to expire</h4>

                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-8 offset-md-2 text-center">
                    <p>
                        For your security, this will expire in <strong id="expire_time"></strong> due to inactivity. To
                        extend your session please select "Continue". If you select 'Log Out' or do not respond your
                        session will automatically close.
                    </p>
                    <div class="col-md-6 offset-md-3 text-center">
                        <button class="btn btn-primary session-continue" data-status="continue"> Continue</button>
                        <button class="btn btn-primary session-logout" data-status="logout"> Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    $default_function_reset = 1000;
    // Defined in dashboard_function_helper
    if (function_exists('get_session_reset_time')) {
        $default_function_reset = get_session_reset_time();
    }

    if (empty($default_function_reset) || !is_numeric($default_function_reset)) {
        $default_function_reset = 1000;
    }
    
?>

<script>

    const reset_time = parseInt("<?php echo $default_function_reset; ?>");
    var baseMin = <?php echo $_SESSION['inactivity_min']*60 ?>;
    var  inactivityCounter = baseMin;
    $(document).ready(function() {
        var timer = setInterval(function() {
            // console.log(inactivityCounter);
            if(inactivityCounter <= 60){
                if (!$('#session_time_out').is(':visible')) {
                    $("#session_time_out").modal("show");
                }
                if (inactivityCounter > 0) {
                    document.getElementById("expire_time").innerHTML = inactivityCounter;
                } else {
                    // clearInterval(x);
                    document.getElementById("expire_time").innerHTML = "EXPIRED";
                    check_logout('logout');
                }
            }
            inactivityCounter--;
            // check_logout()
        }, reset_time);

        $('.session-logout,.session-continue').on('click', function(e) {
            inactivityCounter = baseMin;
            $("#session_time_out").modal("hide");
        });

        function check_logout(status = true) {
            $.ajax({
                type: "POST",
                url: _base_url + '/auth/check_session_time',
                data: {
                    [csrf_name]: csrf_hash,
                    status: status
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == "error") {
                        if (!$('#session_time_out').is(':visible')) {
                            // show_timer(response.timer - 2, callback);
                            $("#session_time_out").modal("show");
                        }
                        //show error popup
                    } else if (response.status == "logout") {
                        location.reload();
                    }
                }
            });
        }

        function reset_interval() {
            if (count == 0) {
                console.log("hello i am in");
                //first step: clear the existing timer
                clearInterval(timer);
                //second step: implement the timer again
                timer = setInterval(function() {
                    check_logout()
                }, reset_time);
                //..completed the reset of the timer
                count++;
                setInterval(function() {
                    count = 0;
                }, 8000);
            }
        }

        function show_timer(seconds, cb) {
            var remaningTime = seconds;
            window.setTimeout(function() {
                cb();
                console.log(remaningTime);
                if (remaningTime > 0) {
                    document.getElementById("expire_time").innerHTML = remaningTime;
                    show_timer(remaningTime - 1, cb);
                } else {
                    // clearInterval(x);
                    document.getElementById("expire_time").innerHTML = "EXPIRED";
                }
            }, 980);

        }

        var callback = function() {
            console.log('callback');
        };


    });
</script>
<script>
    // Set the date we're counting down to
    // var countDownDate = new Date("Jan 5, 2022 00:00:59").getTime();

    // Update the count down every 1 second
</script>