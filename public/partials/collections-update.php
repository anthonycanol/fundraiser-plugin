<form enctype="multipart/form-data" method="POST" class="ezf-update-collection-form" action="">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateCollection">Update Collection</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="alert alert-success save-success" role="alert">
            A simple success alert—check it out!
        </div>
        <div class="alert alert-danger save-danger" role="alert">
            A simple danger alert—check it out!
        </div>
        <div class="mb-3">
            <p class="mb-0">Amount <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <label for="amount" class="form-label visually-hidden">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount">
        </div>
        <div class="mb-3">
            <p class="mb-0">Date <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <label for="date_collected" class="form-label visually-hidden">Date</label>
            <input type="date" class="form-control" id="date_collected" name="date_collected">
        </div>
        <div class="mb-3">
            <p class="mb-0">Payment Method <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <input type="radio" class="btn-check select-payment-method" name="collection_update_payment_method" value="Voucher" id="pm_update_voucher" autocomplete="off" checked="">
            <label class="btn btn-sm" for="pm_update_voucher">Voucher</label>
            <input type="radio" class="btn-check select-payment-method" name="collection_update_payment_method" value="Credit Card" id="pm_update_credit_card" autocomplete="off">
            <label class="btn btn-sm" for="pm_update_credit_card">Credit Card</label>
            <input type="radio" class="btn-check select-payment-method" name="collection_update_payment_method" value="Check" id="pm_update_check" autocomplete="off">
            <label class="btn btn-sm" for="pm_update_check">Check</label>
        </div>
        <div class="mb-3 voucher-type">
            <p class="mb-0">Voucher/Type of Voucher</p>
            <label for="voucher_type" class="form-label visually-hidden">Voucher/Type of Voucher</label>
            <input type="text" class="form-control" id="voucher_type" name="voucher_type">
        </div>
        <div class="mb-3 card-holder-name">
            <p class="mb-0">Card Holder Name</p>
            <label for="card_holder_name" class="form-label visually-hidden">Card Holder Name</label>
            <input type="text" class="form-control" id="card_holder_name" name="card_holder_name">
        </div>
        <div class="mb-3 card-number">
            <p class="mb-0">Card Number</p>
            <label for="card_number" class="form-label visually-hidden">Card Number</label>
            <input type="text" class="form-control" id="card_number" name="card_number">
        </div>
        <div class="mb-3 check-number">
            <p class="mb-0">Check Number</p>
            <label for="check_number" class="form-label visually-hidden">Check Number</label>
            <input type="text" class="form-control" id="check_number" name="check_number">
        </div>
        <div class="mb-3 check-memo">
            <p class="mb-0">Check Memo</p>
            <label for="check_memo" class="form-label visually-hidden">Check Memo</label>
            <input type="text" class="form-control" id="check_memo" name="check_memo">
        </div>
        <div class="mb-3">

            <p class="mb-0">Status <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <input type="radio" class="btn-check" name="collection_update_status" value="Pending" id="collection_update_status_pending" autocomplete="off" checked="">
            <label class="btn btn-sm" for="collection_update_status_pending">Pending</label>
            <input type="radio" class="btn-check" name="collection_update_status" value="Accepted" id="collection_update_status_accepted" autocomplete="off">
            <label class="btn btn-sm" for="collection_update_status_accepted">Accepted</label>
            <input type="radio" class="btn-check" name="collection_update_status" value="Declined" id="collection_update_status_declined" autocomplete="off">
            <label class="btn btn-sm" for="collection_update_status_declined">Declined</label>
            <input type="radio" class="btn-check" name="collection_update_status" value="Refund" id="collection_update_status_refund" autocomplete="off">
            <label class="btn btn-sm" for="collection_update_status_refund">Refund</label>

        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="uid">
        <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>" hidden>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary update-collection">Update</button>
    </div>
</form>