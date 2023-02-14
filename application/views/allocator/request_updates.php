<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Allocator</title>
    <style>
        body {
            background: #2193b0;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #6dd5ed, #2193b0);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #6dd5ed, #2193b0);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .card {
            width: 50%;
            margin: 150px auto;
        }
        .container {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="card text-center">
        <div class="card-header">
            Uralensis Requests
        </div>
        <div class="card-body">
            <h2>Update Requests</h2>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h5>Update Request Dates</h5>
                        <p></p>
                        <?php echo form_open();?>
                            
                            <input type="hidden" id="allocator_type" name="allocator_type" value="dates">
                            <button type="submit" class="btn btn-primary">Update</button>
                        <?php echo form_close();?>
                    </div>
                    <div class="col-sm">
                        <h5>Update Request Dates for Dr Chaudhry</h5>
                        <?php echo form_open();?>
                        
                            <input type="hidden" id="allocator_type" name="allocator_type" value="ic">
                            <button type="submit" class="btn btn-primary">Update</button>
                        <?php echo form_close();?>
                    </div>
                    <div class="col-sm">
                        <h5>Unallocate Requests</h5>
                        <p>Total Unallocated cases: <?php echo $unallocated;?> </p>
                        <?php echo form_open();?>
                            <input type="hidden" id="allocator_type" name="allocator_type" value="unallocate">
                            <?php if ($unallocated < 20): ?>
                                <button type="submit" class="btn btn-primary">Unallocate</button>
                            <?php else: ?>
                                <button type="submit" disabled class="btn btn-primary">Unallocate</button>
                            <?php endif; ?>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>