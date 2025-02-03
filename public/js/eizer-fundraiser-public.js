(function ($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  $(function () {
    $(
      ".save-success, .save-danger, .card-holder-name, .card-number, .check-number, .check-memo"
    ).hide();
    $(".select-payment-method").on("click", function (e) {
      let val = $('input[name="payment_method"]:checked').val();

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
  });
})(jQuery);
