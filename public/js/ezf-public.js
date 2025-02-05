(function ($) {
  "use strict";

  console.log("Ready!");

  $(function () {
    $(".save-collection").on("click", function (e) {
      e.preventDefault();

      let x = $(".ezf-collection-form").serializeArray();
      // Prepare data to send
      var data = {
        action: "ezf_add_new_collection", // WordPress AJAX action
        nonce: ezf_ajax_object.nonce, // Nonce for security
        data: x, // Data to send
      };

      // Send AJAX request
      // $.post(ezf_ajax_object.ajax_url, data, function (response) {
      //   console.log('response: ',response);
      //   if (response.success) {
      //     $(".ezf-collection-form")[0].reset(); // Clear the form
      //     $('.save-success').text(response.data);
      //     $(".save-success").show().delay(5000).fadeOut();
      //   } else {
      //     $('.save-danger').text(response.data);
      //     $(".save-danger").show().delay(5000).fadeOut();
      //   }
      //   return response;
      // })
      let posting = $.post(ezf_ajax_object.ajax_url, data);
      posting.done(function (response) {
        if (response.success) {
          $(".ezf-collection-form")[0].reset(); // Clear the form
          $(".save-success").text(response.data);
          $(".save-success").show().delay(5000).fadeOut();
          $("#staticBackdrop").modal('hide').delay(5000).fadeOut();
        } else {
          $(".save-danger").text(response.data);
          $(".save-danger").show().delay(5000).fadeOut();
        }
      });
    });
  });
})(jQuery);
