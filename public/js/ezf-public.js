(function ($) {
  "use strict";

  console.log("Ready!");

  $(function () {
    // Init Data
    const initData = () => {
      let USDollar = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
      });
      let id = $("input[id='usrId']").val();

      var data = {
        action: "ezf_get_all_collection", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: { user_id: id }, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        let collections = response.data;
        let html = "";
        html += '<div class="row align-items-center">';
        console.log("collections: ", collections);
        if (collections.length > 0) {
          for (const a of collections) {
            const d = new Date(a.date_collected);
            let css = "text-secondary";
            switch (a.status) {
              case "Accepted":
                css = "text-success";
                break;
              case "Declined":
                css = "text-danger";
                break;
              case "Refund":
                css = "text-warning";
                break;
              default:
                css = "text-secondary";
            }
            html += '<div class="row align-items-center">';
            html += '<div class="col-sm-2">';
            html += '<p class="mb-0">' + d.toLocaleDateString("en-US") + "</p>";
            html += "</div>";
            html += '<div class="col-sm-3">';
            html += '<p class="text-muted mb-0">' + a.payment_method + "</p>";
            html += "</div>";
            html += '<div class="col-sm-3">';
            html +=
              '<p class="text-muted text-end mb-0 d-flex justify-content-between">' +
              USDollar.format(a.amount) +
              "</p>";
            html += "</div>";
            html += '<div class="col-sm-3">';
            html += '<p class="mb-0 ' + css + '">' + a.status + "</p>";
            html += '</div>'
            html += '<div class="col-sm-1">';

            html += '<div class="dropdown">';
            html +=
              '    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
            html +=
              '    <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">';
            html +=
              '    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />';
            html += '</svg>';
            html += '</button>';
            html += '<ul class="dropdown-menu dropdown-menu-dark">';
            html +=
              '    <li><a class="dropdown-item text-uppercase update-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#updateCollection" data-id="' +
              a.id +
              '">edit</a></li>';
            html +=
              '    <li><a class="dropdown-item text-danger text-uppercase delete-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#deleteCollection" data-id="' +
              a.id +
              '">delete</a></li>';
            html += '</ul>';
            html += '</div>';

            html += '</div>';
            html += '</div>';
            html += '<hr class="m-0"></hr>';
          }
        } else {
          html +=
            '<div class="row"><div class="text-center">No collections to display.</div></div>';
        }
        html += "</div>";
        $(".collections-list").html(html);
      });
    };

    // Create Collection
    $(".ezf-collection-form .save-collection").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-collection-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_add_new_collection", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        if (response.success) {
          $(".ezf-collection-form")[0].reset(); // Clear the form
          $(".save-success").text(response.data);
          $(".save-success").show().delay(5000).fadeOut();
          $("#staticBackdrop").modal("hide").delay(5000).fadeOut();
        } else {
          $(".save-danger").text(response.data);
          $(".save-danger").show().delay(5000).fadeOut();
        }
      });
    });

    // Retrieve Collection
    $(document).on("click", ".collectionDisplay .update-link",function (e) {
      e.preventDefault();
      console.log('prepare data for update')
      let id = $(this).data("id");

      var data = {
        action: "ezf_get_collection", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };
      console.log("data: ", data);
      let getdata = $.post(ezf_ajax_object.ajax_url, data);
      getdata.done(function (response) {
        if (response.success) {
          let a = response.data;
          let d;
          if (a.date_collected == "0000-00-00 00:00:00") {
            d = new Date();
          } else {
            d = new Date(a.date_collected);
          }
          let dd = d.getDate();
          let mm = (d.getMonth() + 1).toString().padStart(2, "0");
          let yyyy = d.getFullYear();
          let dater = yyyy + "-" + mm + "-" + dd;

          $(".ezf-update-collection-form")[0].reset(); // Clear the form
          $(".ezf-update-collection-form input[name='amount']").val(a.amount);
          $(".ezf-update-collection-form input[name='date_collected']").val(
            dater
          );
          $(
            ".ezf-update-collection-form input[name='collection_update_payment_method'][value='" +
              a.payment_method +
              "']"
          ).prop("checked", true);
          $(".ezf-update-collection-form input[name='voucher_type']").val(
            a.voucher_type
          );
          $(".ezf-update-collection-form input[name='card_holder_name']").val(
            a.card_holder_name
          );
          $(".ezf-update-collection-form input[name='card_number']").val(
            a.card_number
          );
          $(".ezf-update-collection-form input[name='check_number']").val(
            a.check_number
          );
          $(".ezf-update-collection-form input[name='check_memo']").val(
            a.check_memo
          );

          if (a.payment_method === "Voucher") {
            $(
              ".ezf-update-collection-form .voucher-type, .ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number, .ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
            ).fadeOut();
            $(".ezf-update-collection-form .voucher-type").fadeIn();
          }
          if (a.payment_method === "Credit Card") {
            $(
              ".ezf-update-collection-form .voucher-type, .ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number, .ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
            ).fadeOut();
            $(
              ".ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number"
            ).fadeIn();
          }
          if (a.payment_method === "Check") {
            $(
              ".ezf-update-collection-form .voucher-type, .ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number, .ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
            ).fadeOut();
            $(
              ".ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
            ).fadeIn();
          }

          $(
            ".ezf-update-collection-form input:radio[value='" + a.status + "']"
          ).attr("checked", "checked");
          $(".ezf-update-collection-form input[name='uid']").val(a.id);
        }
      });
    });

    // Update Collection
    $(".ezf-update-collection-form .update-collection").on(
      "click",
      function (e) {
        e.preventDefault();

        let x = $(".ezf-update-collection-form").serializeArray();
        // Prepare data to send
        var data = {
          action: "ezf_update_collection", // WordPress AJAX action
          nonce: ezf_ajax_object.nonce, // Nonce for security
          data: x, // Data to send
        };
        console.log("data: ", data);
        let posting = $.post(ezf_ajax_object.ajax_url, data);
        posting.done(function (response) {
          console.log("response: ", response);

          if (response.success) {
            $(".ezf-update-collection-form")[0].reset(); // Clear the form
            $(".ezf-update-collection-form .save-success").text(response.data);
            $(".ezf-update-collection-form .save-success")
              .show()
              .delay(1500)
              .queue(function (n) {
                $("#updateCollection").modal("hide").fadeOut();
                window.location.reload();
              });
          } else {
            $(".ezf-update-collection-form .save-danger").text(response.data);
            $(".ezf-update-collection-form .save-danger")
              .show()
              .delay(1500)
              .fadeOut();
          }
        });
      }
    );

    // Retrieve For Delete Collection Form
    $(".collectionDisplay .delete-link").on("click", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      var data = {
        action: "ezf_get_collection", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };

      let getdata = $.post(ezf_ajax_object.ajax_url, data);
      getdata.done(function (response) {
        if (response.success) {
          let a = response.data;
          let d = new Date(a.date_collected);
          var dd = d.getDate();
          var mm = (d.getMonth() + 1).toString().padStart(2, "0");
          var yyyy = d.getFullYear();
          let dater = yyyy + "-" + mm + "-" + dd;

          $(".ezf-delete-collection-form input[name='uid']").val(a.id);
        }
      });
    });

    // Delete Collection
    $(".ezf-delete-collection-form .delete-collection").on(
      "click",
      function (e) {
        e.preventDefault();

        let x = $(".ezf-delete-collection-form").serializeArray();
        // Prepare data to send
        var data = {
          action: "ezf_delete_collection", // WordPress AJAX action
          nonce: ezf_ajax_object.nonce, // Nonce for security
          data: x, // Data to send
        };

        let posting = $.post(ezf_ajax_object.ajax_url, data);
        posting.done(function (response) {
          console.log("response: ", response);

          if (response.success) {
            $(".ezf-delete-collection-form")[0].reset(); // Clear the form
            $(".ezf-delete-collection-form .save-success").text(response.data);
            $(".ezf-delete-collection-form .save-success")
              .show()
              .delay(5000)
              .fadeOut();
            $("#deleteCollection").modal("hide").delay(5000).fadeOut();
          } else {
            $(".ezf-delete-collection-form .save-danger").text(response.data);
            $(".ezf-delete-collection-form .save-danger")
              .show()
              .delay(5000)
              .fadeOut();
          }
        });
      }
    );

    // Create Redeem
    $(".ezf-ra-form .save-redeem").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-ra-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_add_new_redeem", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        if (response.success) {
          $(".ezf-ra-form")[0].reset(); // Clear the form
          $(".ezf-ra-form .save-success").text(response.data);
          $(".ezf-ra-form .save-success")
            .show()
            .delay(3000)
            .queue(function (n) {
              $("#redeemModal").modal("hide").fadeOut();
              window.location.reload();
            });
        } else {
          $(".ezf-ra-form .save-danger").text(response.data);
          $(".ezf-ra-form .save-danger").show().delay(5000).fadeOut();
        }
      });
    });

    // Retrieve Redeem
    $(".redeemDisplay .update-link").on("click", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      var data = {
        action: "ezf_get_redeem", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };

      let getdata = $.post(ezf_ajax_object.ajax_url, data);
      getdata.done(function (response) {
        if (response.success) {
          let a = response.data;

          $(".ezf-update-redeem-form")[0].reset(); // Clear the form
          $(".ezf-update-redeem-form input[name='redeem_update_amount']").val(
            a.amount
          );
          $(
            ".ezf-update-redeem-form input[name='redeem_update_check_name']"
          ).val(a.check_name);
          $(
            ".ezf-update-redeem-form input[name='redeem_update_check_number']"
          ).val(a.check_number);
          $(
            ".ezf-update-redeem-form input[name='redeem_update_check_memo']"
          ).val(a.check_memo);
          $(
            ".ezf-update-redeem-form input:radio[value='" + a.status + "']"
          ).attr("checked", "checked");
          $(".ezf-update-redeem-form input[name='uid']").val(a.id);
        }
      });
    });

    // Update Redeem
    $(".ezf-update-redeem-form .update-redeem").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-update-redeem-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_update_redeem", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        console.log("response: ", response);

        if (response.success) {
          $(".ezf-update-redeem-form")[0].reset(); // Clear the form
          $(".ezf-update-redeem-form .save-success").text(response.data);
          $(".ezf-update-redeem-form .save-success")
            .show()
            .delay(5000)
            .queue(function (n) {
              $("#updateRedeem").modal("hide").fadeOut();
            });
        } else {
          $(".ezf-update-redeem-form .save-danger").text(response.data);
          $(".ezf-update-redeem-form .save-danger")
            .show()
            .delay(5000)
            .fadeOut();
        }
      });
    });

    // Retrieve For Delete Redeem Form
    $(".redeemDisplay .delete-link").on("click", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      var data = {
        action: "ezf_get_redeem", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };

      let getdata = $.post(ezf_ajax_object.ajax_url, data);
      getdata.done(function (response) {
        if (response.success) {
          let a = response.data;

          $(".ezf-delete-redeem-form input[name='uid']").val(a.id);
        }
      });
    });

    // Delete Redeem
    $(".ezf-delete-redeem-form .delete-redeem").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-delete-redeem-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_delete_redeem", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        if (response.success) {
          $(".ezf-delete-redeem-form")[0].reset(); // Clear the form
          $(".ezf-delete-redeem-form .save-success").text(response.data);
          $(".ezf-delete-redeem-form .save-success")
            .show()
            .delay(5000)
            .queue(function (n) {
              $("#deleteRedeem").modal("hide").fadeOut();
            });
        } else {
          $(".ezf-delete-redeem-form .save-danger").text(response.data);
          $(".ezf-delete-redeem-form .save-danger")
            .show()
            .delay(5000)
            .fadeOut();
        }
      });
    });

    // Create CCM
    $(".ezf-ccm-form .save-ccm").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-ccm-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_add_new_ccm", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        if (response.success) {
          $(".ezf-ccm-form")[0].reset(); // Clear the form
          $(".ezf-ccm-form .save-success").text(response.data);
          $(".ezf-ccm-form .save-success")
            .show()
            .delay(5000)
            .queue(function (n) {
              $("#ccmModal").modal("hide").fadeOut();
            });
        } else {
          $(".ezf-ccm-form .save-danger").text(response.data);
          $(".ezf-ccm-form .save-danger").show().delay(5000).fadeOut();
        }
      });
    });

    // Retrieve CCM
    $(".ccmDisplay .update-link").on("click", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      var data = {
        action: "ezf_get_ccm", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };

      let getdata = $.post(ezf_ajax_object.ajax_url, data);
      getdata.done(function (response) {
        if (response.success) {
          let a = response.data;

          $(".ezf-update-ccm-form")[0].reset(); // Clear the form
          $(".ezf-update-ccm-form input[name='update_ccm_name']").val(
            a.cc_machine_name
          );
          $(".ezf-update-ccm-form input[name='update_ccm_number']").val(
            a.cc_machine_number
          );
          $(".ezf-update-ccm-form input:radio[value='" + a.status + "']").attr(
            "checked",
            "checked"
          );
          $(".ezf-update-ccm-form input[name='uid']").val(a.id);
        }
      });
    });

    // Update CCM
    $(".ezf-update-ccm-form .update-ccm").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-update-ccm-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_update_ccm", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        console.log("response: ", response);

        if (response.success) {
          $(".ezf-update-ccm-form")[0].reset(); // Clear the form
          $(".ezf-update-ccm-form .save-success").text(response.data);
          $(".ezf-update-ccm-form .save-success")
            .show()
            .delay(5000)
            .queue(function (n) {
              $("#updateCcm").modal("hide").fadeOut();
            });
        } else {
          $(".ezf-update-ccm-form .save-danger").text(response.data);
          $(".ezf-update-ccm-form .save-danger").show().delay(5000).fadeOut();
        }
      });
    });

    // Retrieve For Delete CCM Form
    $(".ccmDisplay .delete-link").on("click", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      var data = {
        action: "ezf_get_ccm", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: { id: id }, // Data to send
      };

      let getdata = $.post(ezf_ajax_object.ajax_url, data);
      getdata.done(function (response) {
        if (response.success) {
          let a = response.data;

          $(".ezf-delete-redeem-form input[name='uid']").val(a.id);
        }
      });
    });

    // Delete Redeem
    $(".ezf-delete-redeem-form .delete-redeem").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-delete-redeem-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_delete_redeem", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        if (response.success) {
          $(".ezf-delete-redeem-form")[0].reset(); // Clear the form
          $(".ezf-delete-redeem-form .save-success").text(response.data);
          $(".ezf-delete-redeem-form .save-success")
            .show()
            .delay(5000)
            .queue(function (n) {
              $("#deleteRedeem").modal("hide").fadeOut();
            });
        } else {
          $(".ezf-delete-redeem-form .save-danger").text(response.data);
          $(".ezf-delete-redeem-form .save-danger")
            .show()
            .delay(5000)
            .fadeOut();
        }
      });
    });

    initData();
  });
})(jQuery);
