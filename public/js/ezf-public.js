(function ($) {
  "use strict";

  console.log("Ready!");

  $(function () {
    // Create Collection
    $(".save-collection").on("click", function (e) {
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
    $(".update-link").on("click", function (e) {
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
          var mm = (d.getMonth() + 1).toString().padStart(2, "0")
          var yyyy = d.getFullYear();
          let dater = yyyy + "-" + mm + "-" + dd;
          
          // if (a.payment_method === "Voucher") {
          //   $(
          //     ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
          //   ).fadeOut();
          //   $(".voucher-type").fadeIn();
          // }
          // if (a.payment_method === "Credit Card") {
          //   $(
          //     ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
          //   ).fadeOut();
          //   $(".card-holder-name, .card-number").fadeIn();
          // }
          // if (a.payment_method === "Check") {
          //   $(
          //     ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
          //   ).fadeOut();
          //   $(".check-number, .check-memo").fadeIn();
          // }

          $(".ezf-update-collection-form")[0].reset(); // Clear the form
          $(".ezf-update-collection-form input[name='amount']").val(a.amount);
          $(".ezf-update-collection-form input[name='date_collected']").val(dater);
          $(".ezf-update-collection-form input:radio[value='"+a.payment_method+"']").prop("checked", true); 
          $(".ezf-update-collection-form input[name='voucher_type']").val(a.voucher_type);
          $(".ezf-update-collection-form input[name='card_holder_name']").val(a.card_holder_name);
          $(".ezf-update-collection-form input[name='card_number']").val(a.card_number);
          $(".ezf-update-collection-form input[name='check_number']").val(a.check_number);
          $(".ezf-update-collection-form input[name='check_memo']").val(a.check_memo);
          $(".ezf-update-collection-form input:radio[value='"+a.status+"']").attr('checked', 'checked');
          $(".ezf-update-collection-form input[name='uid']").val(a.id);
        }
      });
    });

    // Update Collection
    $(".update-collection").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-update-collection-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_update_collection", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      let posting = $.post(ezf_ajax_object.ajax_url, data);
        posting.done(function (response) {
        console.log('response: ',response)

        if (response.success) {
          $(".ezf-update-collection-form")[0].reset(); // Clear the form
          $(".ezf-update-collection-form .save-success").text(response.data);
          $(".ezf-update-collection-form .save-success").show().delay(5000).fadeOut();
          $("#updateCollection").modal("hide").delay(5000).fadeOut();
        } else {
          $(".ezf-update-collection-form .save-danger").text(response.data);
          $(".ezf-update-collection-form .save-danger").show().delay(5000).fadeOut();
        }
      });
    });

    // Retrieve For Delete Collection Form
    $(".delete-link").on("click", function (e) {
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
          var mm = (d.getMonth() + 1).toString().padStart(2, "0")
          var yyyy = d.getFullYear();
          let dater = yyyy + "-" + mm + "-" + dd;
          
          $(".ezf-delete-collection-form input[name='uid']").val(a.id);
        }
      });
    });

    // Update Collection
    $(".delete-collection").on("click", function (e) {
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
        console.log('response: ',response)

        if (response.success) {
          $(".ezf-delete-collection-form")[0].reset(); // Clear the form
          $(".ezf-delete-collection-form .save-success").text(response.data);
          $(".ezf-delete-collection-form .save-success").show().delay(5000).fadeOut();
          $("#deleteCollection").modal("hide").delay(5000).fadeOut();
        } else {
          $(".ezf-delete-collection-form .save-danger").text(response.data);
          $(".ezf-delete-collection-form .save-danger").show().delay(5000).fadeOut();
        }
      });
    });
  });
})(jQuery);
