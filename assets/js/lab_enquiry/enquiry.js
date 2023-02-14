$(() => {
  $(document).on("click", ".edt-tckt", function (elem) {
    var info = $(this).data("info");
    $.ajax({
      url: _base_url + "labEnquiries/editTicket",
      type: "POST",
      global: false,
      data: {
        info: info,
        [csrf_name]: csrf_hash,
      },
      success: function (data) {
        $("#edt_modal_bdy").html(data);
        $("#edt_modal_bdy .select").select2({
          minimumResultsForSearch: -1,
          width: "100%",
        });
      },
    });
  });
  $(document).on("click", ".del-tckt", function (elem) {
    var info = $(this).data("info");
    $(document)
      .find(".tckt-del-btn")
      .attr("href", _base_url + "labEnquiries/delete/" + info);
  });

  $(document).on("click", ".tck-swtchrs", function (elem) {
    btn = $(elem.target);
    type = btn.data("target");
    if (btn.hasClass("btn-primary")) {
      btn.removeClass("btn-primary");
      btn.addClass("btn-success");
      if (type == "#attachments") {
        btn.html("<i class='la la-paperclip'></i>  Hide Attachments");
      } else {
        btn.html("<i class='la la-bell'></i>   Notification Settings");
      }
    } else {
      btn.addClass("btn-primary");
      btn.removeClass("btn-success");
      if (type == "#attachments") {
        btn.html("<i class='la la-paperclip'></i>  Show Attachments");
      } else {
        btn.html("<i class='la la-bell'></i>   Notification Settings");
      }
    }
  });

  if (typeof dialogType !== typeof undefined) {
    if (dialogType == "addDiag") {
      $("#add_ticket").modal("show");
    }
    if (dialogType == "editDiag") {
      $("#" + attachmentID).trigger("click");
    }
  }
  $('#admin_users_activities').DataTable({
    dom: 'Bfrtip',
    buttons: [
      // 'excel', 'csv'
      {
        extend: 'excel',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
    ],
    ordering: true,
    "processing": true,
    stateSave: true,
    "lengthMenu": [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"]
    ]
  });
  $('#further_work_datatable').DataTable({
    dom: 'Bfrtip',
    buttons: [
      // 'excel', 'csv'
      {
        extend: 'excel',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'csv',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      },
    ],
    ordering: true,
    "processing": true,
    stateSave: true,
    "lengthMenu": [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"]
    ]
  });
  $('.range2Picker').daterangepicker({
    showDropdowns: true,
    autoUpdateInput: false,
    locale: {
      format: 'DD-MM-YYYY'
    }
  });
  $('.range2Picker').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
  });

  $('.range2Picker').on('cancel.daterangepicker', function (ev, picker) {
    $(this).val('');
  });
});
