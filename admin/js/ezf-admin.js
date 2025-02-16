(function ($) {
  "use strict";

  console.log("Ready!");

  $(function () {
    // Init Data
    const initData = () => {
      //   var data = {
      //     action: "ezf_add_new_collection", // WordPress AJAX action
      //     nonce: ezf_ajax_object.nonce, // Nonce for security
      //     data: { data:'all' }, // Data to send
      //   };

      //   let posting = $.post(ezf_ajax_object.ajax_url, data);
      //   posting.done(function (response) {
      //     console.log('response: ',response)
      //   });
      console.log("init data");
    };

    // Create CCM
    $(".ezf-ccm-admin-form .save-ccm").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-ccm-admin-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_add_new_ccm", // WordPress AJAX action
        nonce: ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      $.ajax({
        url: ajax_object.ajaxurl,
        type: "POST",
        data: data,
        dataType: "json",
        beforeSend: function () {
          //Before sending, like showing a loading animation
          console.log("before: ", data);
        },
        complete: function (response) {
          console.log("done: ", JSON.parse(response.responseText));
          let res = JSON.parse(response.responseText);
          if (res.success) {
            $(".ezf-ccm-admin-form")[0].reset(); // Clear the form
            $(".ezf-ccm-admin-form .save-success").text(res.data);
            $(".ezf-ccm-admin-form .save-success")
              .show()
              .delay(3000)
              .queue(function (n) {
                $("#ccmModal").modal("hide").fadeOut();
                window.location.reload();
              });
          } else {
            $(".ezf-ccm-admin-form .save-danger").text(res.data);
            $(".ezf-ccm-admin-form .save-danger").show().delay(5000).fadeOut();
          }
        },
      });
    });

    // Retrieve CCM
    $(".ccmDisplay .update-link").on("click", function (e) {
      e.preventDefault();

      let id = $(this).data("id");
      console.log("id: ", id);
      var data = {
        action: "ezf_get_ccm", // WordPress AJAX action
        nonce: ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };

      $.ajax({
        url: ajax_object.ajaxurl,
        type: "POST",
        data: data,
        dataType: "json",
        beforeSend: function () {
          //Before sending, like showing a loading animation
          console.log("before: ", data);
        },
        complete: function (response) {
          console.log("done: ", JSON.parse(response.responseText));
          let res = JSON.parse(response.responseText);

          if (res.success) {
            let status;
            let a = res.data;
            console.log("a: ", a);
            $(".ezf-update-ccm-form")[0].reset(); // Clear the form
            $(".ezf-update-ccm-form #user_name").val(a.user_id);
            $(".ezf-update-ccm-form input[name='update_ccm_name']").val(
              a.cc_machine_name
            );
            $(".ezf-update-ccm-form input[name='update_ccm_number']").val(
              a.cc_machine_number
            );
            if (a.status == "Available" || a.status == "Reserved") {
              status = a.status;
            } else {
              status = "Available";
            }
            $(
              ".ezf-update-ccm-form input:radio[value='" + a.status + "']"
            ).attr("checked", "checked");
            $(".ezf-update-ccm-form input[name='uid']").val(a.id);
          }
        },
      });
    });

    // Update CCM
    $(".ezf-update-ccm-form .update-ccm").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-update-ccm-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_update_ccm", // WordPress AJAX action
        nonce: ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      $.ajax({
        url: ajax_object.ajaxurl,
        type: "POST",
        data: data,
        dataType: "json",
        beforeSend: function () {
          //Before sending, like showing a loading animation
          console.log("before: ", data);
        },
        complete: function (response) {
          console.log("done: ", JSON.parse(response.responseText));
          let res = JSON.parse(response.responseText);
          if (res.success) {
            $(".ezf-update-ccm-form")[0].reset(); // Clear the form
            $(".ezf-update-ccm-form .save-success").text(res.data);
            $(".ezf-update-ccm-form .save-success")
              .show()
              .delay(3000)
              .queue(function (n) {
                $("#updateCcm").modal("hide").fadeOut();
                window.location.reload();
              });
          } else {
            $(".ezf-update-ccm-form .save-danger").text(res.data);
            $(".ezf-update-ccm-form .save-danger").show().delay(5000).fadeOut();
          }
        },
      });
    });

    // Retrieve ID For Delete CCM Form
    $(".ccmDisplay .delete-link").on("click", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      var data = {
        action: "ezf_get_ccm", // WordPress AJAX action
        nonce: ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };

      $.ajax({
        url: ajax_object.ajaxurl,
        type: "POST",
        data: data,
        dataType: "json",
        beforeSend: function () {
          //Before sending, like showing a loading animation
          console.log("before: ", data);
        },
        complete: function (response) {
          console.log("done: ", JSON.parse(response.responseText));
          let res = JSON.parse(response.responseText);

          if (res.success) {
            let status;
            let a = res.data;
            console.log("a: ", a);
            $(".ezf-delete-ccm-form input[name='uid']").val(a.id);
          }
        },
      });
    });

    // Delete Ccm
    $(".ezf-delete-ccm-form .delete-ccm").on("click", function (e) {
        e.preventDefault();
  
        let x = $(".ezf-delete-ccm-form").serializeArray();
        // Prepare data to send
        var data = {
          action: "ezf_delete_ccm", // WordPress AJAX action
          nonce: ajax_object.nonce, // Nonce for security
          data: x, // Data to send
        };

        $.ajax({
            url: ajax_object.ajaxurl,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function () {
              //Before sending, like showing a loading animation
              console.log("before: ", data);
            },
            complete: function (response) {
              console.log("done: ", JSON.parse(response.responseText));
              let res = JSON.parse(response.responseText);
              if (res.success) {
                $(".ezf-delete-ccm-form")[0].reset(); // Clear the form
                $(".ezf-delete-ccm-form .save-success").text(res.data);
                $(".ezf-delete-ccm-form .save-success")
                  .show()
                  .delay(3000)
                  .queue(function (n) {
                    $("#deleteCCM").modal("hide").fadeOut();
                    window.location.reload();
                  });
              } else {
                $(".ezf-delete-ccm-form .save-danger").text(res.data);
                $(".ezf-delete-ccm-form .save-danger").show().delay(5000).fadeOut();
              }
            },
          });
  
        // let posting = $.post(ajax_object.ajax_url, data);
        // posting.done(function (response) {
        //   if (response.success) {
        //     $(".ezf-delete-ccm-form")[0].reset(); // Clear the form
        //     $(".ezf-delete-ccm-form .save-success").text(response.data);
        //     $(".ezf-delete-ccm-form .save-success")
        //       .show()
        //       .delay(5000)
        //       .queue(function (n) {
        //         $("#deleteRedeem").modal("hide").fadeOut();
        //       });
        //   } else {
        //     $(".ezf-delete-ccm-form .save-danger").text(response.data);
        //     $(".ezf-delete-ccm-form .save-danger")
        //       .show()
        //       .delay(5000)
        //       .fadeOut();
        //   }
        // });
      });

    initData();
  });
})(jQuery);
