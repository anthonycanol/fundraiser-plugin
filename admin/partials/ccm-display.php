<?php if ($ccms): ?>
    <?php foreach ($ccms as $ccm): ?>
        <div class="card col-md-3">
            <div class="card-body">
                <h6 class="card-text mb-0">Foundraiser: <p><?php echo $ccm->display_name; ?></p>
                </h6>
                <h6 class="card-text mb-0">Credit Card Machine Name: <p><?php echo $ccm->cc_machine_name; ?></p>
                </h6>
                <h6 class="card-text mb-0">Credit Card Machine Number: <p><?php echo $ccm->cc_machine_number; ?></p>
                </h6>
                <h6 class="card-text mb-0">Status: <?php echo $ccm->status; ?></h6>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a class="text-danger text-uppercase delete-link" style="font-size: 12px; letter-spacing: 1px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteCCM" data-id="<?php echo $ccm->id; ?>">delete</a>
                    <a class="text-uppercase update-link" style="font-size: 12px; letter-spacing: 1px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateCcm" data-id="<?php echo $ccm->id; ?>">edit</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div>No Records to display.</div>
<?php endif; ?>