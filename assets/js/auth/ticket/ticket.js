$(() => {
  $(document).on("click", ".edt-tckt", function (elem) {
    var info = $(this).data("info");
    $.ajax({
      url: _base_url + "tickets/editTicket",
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
      .attr("href", _base_url + "tickets/delete/" + info);
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

  $.get(_base_url+"tickets/userList", function(data) {
    let users = data;
    
    let block = $("#add-assignee, #edit-assignee");
    let option = `<option value="">--Select User--<option>`;
    block.append(option);
    for(let user of users) {
        let option = `<option value="${user.id}">
        <div class="avatar">
        <img alt="" src="${_base_url}${user.profile_picture}">
        ${user.first_name} ${user.last_name}
        </div>
        </option>
        `;
        block.append(option);
    }
  }).fail(err => {
    console.log(err);
  });
});
