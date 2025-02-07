(function ($) {
  "use strict";

  $(function () {
    $(
      ".save-success, .save-danger, .card-holder-name, .card-number, .check-number, .check-memo"
    ).hide();

    $(".ezf-collection-form .select-payment-method").on("click", function (e) {
      let val = $(this).val();
      console.log("val: ", val);
      if (val === "Voucher") {
        $(
          ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
        ).fadeOut();
        $(".voucher-type").fadeIn();
        
      }
      if (val === "Credit Card") {
        $(
          ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
        ).fadeOut();
        $(".card-holder-name, .card-number").fadeIn();
      }
      if (val === "Check") {
        $(
          ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
        ).fadeOut();
        $(".check-number, .check-memo").fadeIn();
      }
    });

    $(".ezf-update-collection-form .select-payment-method").on("click", function (e) {
        let val = $(this).val();
        console.log("val: ", val);
        if (val === "Voucher") {
          $(
            ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
          ).fadeOut();
          $(".voucher-type").fadeIn();
        }
        if (val === "Credit Card") {
          $(
            ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
          ).fadeOut();
          $(".card-holder-name, .card-number").fadeIn();
        }
        if (val === "Check") {
          $(
            ".voucher-type, .card-holder-name, .card-number, .check-number, .check-memo"
          ).fadeOut();
          $(".check-number, .check-memo").fadeIn();
        }
      }
    );
  });
})(jQuery);
