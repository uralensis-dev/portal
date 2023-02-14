$(document).ready(function () {
    $('.range2Picker').daterangepicker({
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $('#admin_users_activities').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'csv', 'pdf'
        ],
        ordering: false,
        "processing": true,
        stateSave: true,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ]
    });
});
