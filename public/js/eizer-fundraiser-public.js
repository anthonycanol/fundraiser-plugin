(function ($) {
  "use strict";

  $(function () {
    $(
      ".ezf-collection-form .save-success, .ezf-collection-form .save-danger, .ezf-collection-form .card-holder-name, .ezf-collection-form .card-number, .ezf-collection-form .check-number, .ezf-collection-form .check-memo"
    ).hide();

    $(
      ".ezf-update-collection-form .save-success, .ezf-update-collection-form .save-danger, .ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number, .ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
    ).hide();

    $(
      ".ezf-ra-form .save-success, .ezf-ra-form .save-danger"
    ).hide();

    $(
      ".ezf-update-redeem-form .save-success, .ezf-update-redeem-form .save-danger"
    ).hide();

    $(
      ".ezf-delete-redeem-form .save-success, .ezf-delete-redeem-form .save-danger"
    ).hide();

    $(
      ".ezf-ccm-form .save-success, .ezf-ccm-form .save-danger"
    ).hide();

    $(
      ".ezf-update-ccm-form .save-success, .ezf-update-ccm-form .save-danger"
    ).hide();

    $(".ezf-collection-form .select-payment-method").on("click", function (e) {
      let val = $(this).val();
      console.log("val: ", val);
      if (val === "Voucher") {
        $(
          ".ezf-collection-form .voucher-type, .ezf-collection-form .card-holder-name, .ezf-collection-form .card-number, .ezf-collection-form .check-number, .check-memo"
        ).fadeOut();
        $(".ezf-collection-form .voucher-type").fadeIn();
      }
      if (val === "Credit Card") {
        $(
          ".ezf-collection-form .voucher-type, .ezf-collection-form .card-holder-name, .ezf-collection-form .card-number, .ezf-collection-form .check-number, .check-memo"
        ).fadeOut();
        $(
          ".ezf-collection-form .card-holder-name, .ezf-collection-form .card-number"
        ).fadeIn();
      }
      if (val === "Check") {
        $(
          ".ezf-collection-form .voucher-type, .ezf-collection-form .card-holder-name, .ezf-collection-form .card-number, .check-number, .ezf-collection-form .check-memo"
        ).fadeOut();
        $(
          ".ezf-collection-form .check-number, .ezf-collection-form .check-memo"
        ).fadeIn();
      }
    });

    $(".ezf-update-collection-form .select-payment-method").on(
      "click",
      function (e) {
        let val = $(this).val();
        console.log("val: ", val);
        if (val === "Voucher") {
          $(
            ".ezf-update-collection-form .voucher-type, .ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number, .ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
          ).fadeOut();
          $(".ezf-update-collection-form .voucher-type").fadeIn();
        }
        if (val === "Credit Card") {
          $(
            ".ezf-update-collection-form .voucher-type, .ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number, .ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
          ).fadeOut();
          $(
            ".ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number"
          ).fadeIn();
        }
        if (val === "Check") {
          $(
            ".ezf-update-collection-form .voucher-type, .ezf-update-collection-form .card-holder-name, .ezf-update-collection-form .card-number, .ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
          ).fadeOut();
          $(
            ".ezf-update-collection-form .check-number, .ezf-update-collection-form .check-memo"
          ).fadeIn();
        }
      }
    );
  });
})(jQuery);
