<form enctype="multipart/form-data" method="POST" class="ezf-ra-form" action="">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Redeem</h1>
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
        <div class="mb-3 check-name">
            <p class="mb-0">Check Name</p>
            <label for="check_name" class="form-label visually-hidden">Check Name</label>
            <input type="text" class="form-control" id="check_name" name="check_name">
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
            <input type="radio" class="btn-check" name="redeem_add_status" value="Pending" id="redeem_add_status_pending" autocomplete="off" checked="">
            <label class="btn btn-sm" for="redeem_add_status_pending">Pending</label>
            <input type="radio" class="btn-check" name="redeem_add_status" value="Accepted" id="redeem_add_status_accepted" autocomplete="off">
            <label class="btn btn-sm" for="redeem_add_status_accepted">Accepted</label>
            <input type="radio" class="btn-check" name="redeem_add_status" value="Declined" id="redeem_add_status_decline" autocomplete="off">
            <label class="btn btn-sm" for="redeem_add_status_decline">Declined</label>
            <input type="radio" class="btn-check" name="redeem_add_status" value="Refund" id="redeem_add_status_refund" autocomplete="off">
            <label class="btn btn-sm" for="redeem_add_status_refund">Refund</label>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>" hidden>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary save-redeem">Submit</button>
    </div>
</form>