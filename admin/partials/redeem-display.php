<?php if ($redeems): ?>
    <?php foreach ($redeems as $redeem): ?>
        <div class="card col-md-3">
            <div class="card-body">
                <h6 class="card-text mb-0">Foundraiser: <p><?php echo $redeem->display_name; ?></p></h6>
                <h6 class="card-text mb-0">Amount: <p><?php echo $redeem->amount; ?></p></h6>
                <h6 class="card-text mb-0">Check Number: <p><?php echo $redeem->check_number; ?></p></h6>
                <h6 class="card-text mb-0">Check Name: <p><?php echo $redeem->check_name; ?></p></h6>
                <h6 class="card-text mb-0">Check Memo/Notes: <p><?php echo $redeem->check_memo; ?></p></h6>
                <h6 class="card-text mb-0">Status: <?php echo $redeem->status; ?></h6>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a class="text-danger text-uppercase delete-link" style="font-size: 12px; letter-spacing: 1px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteRedeem" data-id="<?php echo $redeem->id; ?>">delete</a>
                    <a class="text-uppercase update-link" style="font-size: 12px; letter-spacing: 1px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#updateRedeem" data-id="<?php echo $redeem->id; ?>">edit</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div>No Records to display.</div>
<?php endif; ?>