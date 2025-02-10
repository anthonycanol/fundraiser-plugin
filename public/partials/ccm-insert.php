<form enctype="multipart/form-data" method="POST" class="ezf-ccm-form" action="">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Credit Card Machine Record</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="alert alert-success save-success" role="alert">
            A simple success alert—check it out!
        </div>
        <div class="alert alert-danger save-danger" role="alert">
            A simple danger alert—check it out!
        </div>
        <div class="mb-3 check-name">
            <p class="mb-0">Credit Card Machine  Name <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <label for="ccm_name" class="form-label visually-hidden">Credit Card Machine Name</label>
            <input type="text" class="form-control" id="ccm_name" name="ccm_name">
        </div>
        <div class="mb-3 check-number">
            <p class="mb-0">Credit Card Machine  Number <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <label for="ccm_number" class="form-label visually-hidden">Credit Card Machine Number</label>
            <input type="text" class="form-control" id="ccm_number" name="ccm_number">
        </div>
        <div class="mb-3">
            <p class="mb-0">Status <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <input type="radio" class="btn-check" name="ccm_add_status" value="Pending" id="ccm_add_status_pending" autocomplete="off" checked="">
            <label class="btn btn-sm" for="ccm_add_status_pending">Pending</label>
            <input type="radio" class="btn-check" name="ccm_add_status" value="Accepted" id="ccm_add_status_accepted" autocomplete="off">
            <label class="btn btn-sm" for="ccm_add_status_accepted">Accepted</label>
            <input type="radio" class="btn-check" name="ccm_add_status" value="Declined" id="ccm_add_status_decline" autocomplete="off">
            <label class="btn btn-sm" for="ccm_add_status_decline">Declined</label>
            <input type="radio" class="btn-check" name="ccm_add_status" value="Refund" id="ccm_add_status_refund" autocomplete="off">
            <label class="btn btn-sm" for="ccm_add_status_refund">Refund</label>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>" hidden>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary save-ccm">Submit</button>
    </div>
</form>