<form enctype="multipart/form-data" method="POST" class="ezf-update-ccm-form" action="">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateCcm">Update Credit Card Machine</h1>
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
            <p class="mb-0">User <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <label for="user_name" class="form-label visually-hidden">User</label>
            <select class="form-select form-control" name="user_id" aria-label="User" id="user_name">
                <option selected>Choose a Fundraiser</option>
                <?php if($users): ?>
                    <?php foreach($users as $user): ?>
                <option value="<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="mb-3 check-name">
            <p class="mb-0">Credit Card Machine Name <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <label for="update_ccm_name" class="form-label visually-hidden">Credit Card Machine Name</label>
            <input type="text" class="form-control" id="update_ccm_name" name="update_ccm_name">
        </div>
        <div class="mb-3 check-number">
            <p class="mb-0">Credit Card Machine Number <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
            <label for="update_ccm_number" class="form-label visually-hidden">Credit Card Machine Number</label>
            <input type="text" class="form-control" id="update_ccm_number" name="update_ccm_number">
        </div>
        <div class="mb-3">

            <input type="radio" class="btn-check" name="ccm_update_status" value="Available" id="ccm_update_status_available" autocomplete="off" checked="">
            <label class="btn btn-sm" for="ccm_update_status_available">Available</label>
            <input type="radio" class="btn-check" name="ccm_update_status" value="Reserved" id="ccm_update_status_reserved" autocomplete="off">
            <label class="btn btn-sm" for="ccm_update_status_reserved">Reserved</label>
            
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="uid">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary update-ccm">Update</button>
    </div>
</form>