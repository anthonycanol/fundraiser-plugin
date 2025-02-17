<form enctype="multipart/form-data" method="POST" class="ezf-update-redeem-form" action="">
  <div class="modal-header">
    <h1 class="modal-title fs-5" id="updateRedeem">Update Redeem</h1>
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
      <label for="redeem_update_amount" class="form-label visually-hidden">Amount</label>
      <input type="text" class="form-control" id="redeem_update_amount" name="redeem_update_amount">
    </div>
    <div class="mb-3 check-name">
      <p class="mb-0">Check Name</p>
      <label for="redeem_update_check_name" class="form-label visually-hidden">Check Name</label>
      <input type="text" class="form-control" id="redeem_update_check_name" name="redeem_update_check_name">
    </div>
    <div class="mb-3 check-number">
      <p class="mb-0">Check Number</p>
      <label for="redeem_update_check_number" class="form-label visually-hidden">Check Number</label>
      <input type="text" class="form-control" id="redeem_update_check_number" name="redeem_update_check_number">
    </div>
    <div class="mb-3 check-memo">
      <p class="mb-0">Check Memo</p>
      <label for="redeem_update_check_memo" class="form-label visually-hidden">Check Memo/Notes</label>
      <input type="text" class="form-control" id="redeem_update_check_memo" name="redeem_update_check_memo">
    </div>
    <div class="mb-3">
      <p class="mb-0">Status <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
      <input type="radio" class="btn-check" name="redeem_update_status" value="Pending" id="redeem_update_status_pending" autocomplete="off" checked="">
      <label class="btn btn-sm" for="redeem_update_status_pending">Pending</label>
      <input type="radio" class="btn-check" name="redeem_update_status" value="Approved" id="redeem_update_status_approved" autocomplete="off">
      <label class="btn btn-sm" for="redeem_update_status_approved">Approved</label>
    </div>
  </div>
  <div class="modal-footer">
    <input type="hidden" name="uid">
    <input type="hidden" name="user_id" hidden>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-primary update-redeem">Update</button>
  </div>
</form>