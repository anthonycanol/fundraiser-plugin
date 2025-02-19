<input type="hidden" id="usrId" value="<?php echo $user_id; ?>">
<div class="collections-list">
    <?php /*
    if ($collections):
        foreach ($collections as $collection):
            $total_collections += $collection->amount;
    ?>
            <div class="row align-items-center">
                <div class="col-sm-2">
                    <p class="mb-0"><?php echo  date("m/d/y", strtotime($collection->date_collected)); ?></p>
                </div>
                <div class="col-sm-3">
                    <p class="text-muted mb-0"><?php echo $collection->payment_method; ?></p>
                </div>
                <div class="col-sm-3">
                    <p class="text-muted text-end mb-0 d-flex justify-content-between"><span class="text-start d-inline">$</span> <?php echo number_format_i18n($collection->amount, 2); ?></p>
                </div>
                <div class="col-sm-3">
                    <?php
                    switch ($collection->status) {
                        case 'Accepted':
                            $css = "text-success";
                            break;
                        case 'Declined':
                            $css = "text-danger";
                            break;
                        case 'Refund':
                            $css = "text-warning";
                            break;
                        default:
                            $css = "text-secondary";
                    }
                    ?>
                    <p class="mb-0 <?php echo $css; ?>">
                        <?php echo $collection->status; ?>
                    </p>
                </div>
                <div class="col-sm-1">

                    <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item text-uppercase update-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#updateCollection" data-id="<?php echo $collection->id; ?>">edit</a></li>
                            <li><a class="dropdown-item text-danger text-uppercase delete-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#deleteCollection" data-id="<?php echo $collection->id; ?>">delete</a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <hr class="m-0">
        <?php
        endforeach;
    else:
        ?>
        <div class="row">
            <div class="text-center">No collections to display.</div>
        </div>
    <?php
    endif;
    */ ?>
</div>