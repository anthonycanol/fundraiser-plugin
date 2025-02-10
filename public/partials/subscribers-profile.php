<?php
global $wpdb;
$tbl_collections = $wpdb->prefix . 'ezf_collections';
$tbl_redeem = $wpdb->prefix . 'ezf_redeem';
$tbl_cc_machine = $wpdb->prefix . 'ezf_cc_machine';

$user = get_user_by('id', $atts['fundraiserId']);
$collections = $wpdb->get_results($wpdb->prepare("select * from $tbl_collections where user_id=%s ORDER BY id DESC", $atts['fundraiserId']));
$redeems = $wpdb->get_results($wpdb->prepare("select * from $tbl_redeem where user_id=%s ORDER BY id DESC", $atts['fundraiserId']));
$ccms = $wpdb->get_results($wpdb->prepare("select * from $tbl_cc_machine where user_id=%s ORDER BY id DESC", $atts['fundraiserId']));

$img_url = plugin_dir_url(__FILE__) . '../../public/images/';

$total_collections = 0.00;
$total_redeems = 0.00;

if ($collections):
  foreach ($collections as $collection):
    $total_collections += $collection->amount;
  endforeach;
endif;

if ($redeems):
  foreach ($redeems as $redeem):
    $total_redeems += $redeem->amount;
  endforeach;
endif;
?>

<div class="container py-5">

  <div class="row">
    <div class="col-lg-4">
      <div class="card mb-4">
        <div class="card-body text-center">
          <img src="<?php echo $img_url; ?>person.png" alt="avatar"
            class="rounded-circle img-fluid" style="width: 150px;">
          <h5 class="my-3"><?php echo $user->display_name; ?></h5>
          <p class="text-muted mb-1">Company</p>
          <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
        </div>
      </div>
      <div class="card mb-4 mb-lg-0">
        <div class="card-body p-0">
          <ul class="list-group list-group-flush rounded-3">
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <p class="mb-0">Total Collections: </p>
              <p class="mb-0 fw-bold">$ <?php echo number_format_i18n($total_collections, 2); ?></p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <p class="mb-0">Total Redeem: </p>
              <p class="mb-0 fw-bold">$ <?php echo number_format_i18n($total_redeems, 2); ?></p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <p class="mb-0">Balance: </p>
              <p class="mb-0 fw-bold">$ <?php echo number_format_i18n($total_collections - $total_redeems, 2); ?></p>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card mb-4 collectionDisplay">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-sm-10 ">
              <div class="input-group">
                <span class="input-group-text">Search</span>
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Username">
                  <label for="floatingInputGroup1">Type searcheable words</label>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</button>
              </p>
            </div>
          </div>
          <hr>
          <div class="row mb-4">
            <div class="col-sm-2">
              <p class="text-muted mb-0 text-uppercase text-center fw-bold">Date</p>
            </div>
            <div class="col-sm-3">
              <p class="text-muted mb-0 text-uppercase text-center fw-bold">Payment</p>
            </div>
            <div class="col-sm-3">
              <p class="text-muted mb-0 text-uppercase text-center fw-bold">Amount</p>
            </div>
            <div class="col-sm-3">
              <p class="text-muted mb-0 text-uppercase text-center fw-bold">Status</p>
            </div>
            <div class="col-sm-1">
              <p class="text-muted mb-0 text-uppercase text-center fw-bold">&nbsp;</p>
            </div>
          </div>

          <?php
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
          ?>

        </div>
      </div>

      <div class="row redeemDisplay">
        <div class="col-md-6">
          <div class="card mb-4 mb-md-0">
            <div class="card-body">
              <div class="d-flex gap-3 justify-content-between align-items-center mb-1">
                <p class="mb-0">History of Redeem</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#redeemModal">Add</button>
              </div>
              <div class="row mb-1">
                <div class="col-sm-3">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">Check #</p>
                </div>
                <div class="col-sm-4">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">Amount</p>
                </div>
                <div class="col-sm-3">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">Status</p>
                </div>
                <div class="col-sm-2">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">&nbsp;</p>
                </div>
              </div>

              <?php
              if ($redeems):
                foreach ($redeems as $redeem):
                  $total_redeems += $redeem->amount;
              ?>
                  <div class="row align-items-center mb-1">
                    <div class="col-sm-3">
                      <p class="text-muted mb-0 text-uppercase" style="font-size: .77rem;"><?php echo $redeem->check_number; ?></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-muted mb-0 text-uppercase" style="font-size: .77rem;"><span class="text-start d-inline">$</span> <?php echo number_format_i18n($redeem->amount, 2); ?></p>
                    </div>
                    <div class="col-sm-3">
                      <?php
                      switch ($redeem->status) {
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
                      <p class="text-muted mb-0 text-uppercase text-center <?php echo $css; ?>" style="font-size: .77rem;"><?php echo $redeem->status; ?></p>
                    </div>
                    <div class="col-sm-2">

                      <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                          </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                          <li><a class="dropdown-item text-uppercase update-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#updateRedeem" data-id="<?php echo $redeem->id; ?>">edit</a></li>
                          <li><a class="dropdown-item text-danger text-uppercase delete-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#deleteRedeem" data-id="<?php echo $redeem->id; ?>">delete</a></li>
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
                  <div class="text-center">No redeems to display.</div>
                </div>
              <?php
              endif;
              ?>
            </div>
          </div>
        </div>

        <div class="col-md-6 ccmDisplay">
          <div class="card mb-4 mb-md-0">
            <div class="card-body">
              <div class="d-flex gap-3 justify-content-between align-items-center mb-1">
                <p class="mb-0">Credit Card Machine</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ccmModal">Add</button>
              </div>

              <div class="row mb-1">
                <div class="col-sm-3">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">CCM #</p>
                </div>
                <div class="col-sm-4">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">CCM Name</p>
                </div>
                <div class="col-sm-3">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">Status</p>
                </div>
                <div class="col-sm-2">
                  <p class="text-muted mb-0 text-uppercase text-center fw-bold" style="font-size: .77rem;">&nbsp;</p>
                </div>
              </div>
              <?php
              if ($ccms):
                foreach ($ccms as $ccm):
              ?>
                  <div class="row align-items-center mb-1">
                    <div class="col-sm-3">
                      <p class="text-muted mb-0 text-uppercase" style="font-size: .77rem;"><?php echo $ccm->cc_machine_number; ?></p>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-muted mb-0 text-uppercase" style="font-size: .77rem;"><?php echo $ccm->cc_machine_name; ?></p>
                    </div>
                    <div class="col-sm-3">
                      <?php
                      switch ($ccm->status) {
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
                      <p class="text-muted mb-0 text-uppercase text-center <?php echo $css; ?>" style="font-size: .77rem;"><?php echo $ccm->status; ?></p>
                    </div>
                    <div class="col-sm-2">

                      <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                          </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                          <li><a class="dropdown-item text-uppercase update-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#updateCcm" data-id="<?php echo $ccm->id; ?>">edit</a></li>
                          <li><a class="dropdown-item text-danger text-uppercase delete-link" style="font-size: 12px; letter-spacing: 1px;" data-bs-toggle="modal" data-bs-target="#deleteCcm" data-id="<?php echo $ccm->id; ?>">delete</a></li>
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
                  <div class="text-center">No Credit Card Machine Record to display.</div>
                </div>
              <?php
              endif;
              ?>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Insert Modal -->
  <div class="modal fade container-fluid" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form enctype="multipart/form-data" method="POST" class="ezf-collection-form" action="">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Collection</h1>
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
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Voucher" id="pm_voucher" autocomplete="off" checked="">
              <label class="btn btn-sm" for="pm_voucher">Voucher</label>
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Credit Card" id="pm_credit_card" autocomplete="off">
              <label class="btn btn-sm" for="pm_credit_card">Credit Card</label>
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Check" id="pm_check" autocomplete="off">
              <label class="btn btn-sm" for="pm_check">Check</label>
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
              <input type="radio" class="btn-check" name="status" value="Pending" id="status_pending" autocomplete="off" checked="">
              <label class="btn btn-sm" for="status_pending">Pending</label>
              <input type="radio" class="btn-check" name="status" value="Accepted" id="status_accepted" autocomplete="off">
              <label class="btn btn-sm" for="status_accepted">Accepted</label>
              <input type="radio" class="btn-check" name="status" value="Declined" id="status_decline" autocomplete="off">
              <label class="btn btn-sm" for="status_decline">Declined</label>
              <input type="radio" class="btn-check" name="status" value="Refund" id="status_refund" autocomplete="off">
              <label class="btn btn-sm" for="status_refund">Refund</label>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>" hidden>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary save-collection">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Update Modal -->
  <div class="modal fade container-fluid" id="updateCollection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateCollection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
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
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Voucher" id="pm_voucher" autocomplete="off">
              <label class="btn btn-sm" for="pm_voucher">Voucher</label>
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Credit Card" id="pm_credit_card" autocomplete="off">
              <label class="btn btn-sm" for="pm_credit_card">Credit Card</label>
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Check" id="pm_check" autocomplete="off">
              <label class="btn btn-sm" for="pm_check">Check</label>
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
              <input type="radio" class="btn-check" name="status" value="Pending" id="status_pending" autocomplete="off">
              <label class="btn btn-sm" for="status_pending">Pending</label>
              <input type="radio" class="btn-check" name="status" value="Accepted" id="status_accepted" autocomplete="off">
              <label class="btn btn-sm" for="status_accepted">Accepted</label>
              <input type="radio" class="btn-check" name="status" value="Declined" id="status_decline" autocomplete="off">
              <label class="btn btn-sm" for="status_decline">Declined</label>
              <input type="radio" class="btn-check" name="status" value="Refund" id="status_refund" autocomplete="off">
              <label class="btn btn-sm" for="status_refund">Refund</label>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="uid">
            <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>" hidden>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary update-collection">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade container-fluid" id="deleteCollection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCollection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form enctype="multipart/form-data" method="POST" class="ezf-delete-collection-form" action="">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteCollection">Delete Collection</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="alert alert-success save-success" role="alert">
              A simple success alert—check it out!
            </div>
            <div class="alert alert-danger save-danger" role="alert">
              A simple danger alert—check it out!
            </div>
            Are you sure?
          </div>
          <div class="modal-footer">
            <input type="hidden" name="uid">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary delete-collection">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Add Redeem Modal -->
  <div class="modal fade container-fluid" id="redeemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="redeemModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/redeem-insert.php'; ?>
      </div>
    </div>
  </div>

  <!-- Update Redeem Modal -->
  <div class="modal fade container-fluid" id="updateRedeem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateRedeem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/redeem-update.php'; ?>
      </div>
    </div>
  </div>

  <!-- Delete Redeem Modal -->
  <div class="modal fade container-fluid" id="deleteRedeem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteRedeem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/redeem-delete.php'; ?>
      </div>
    </div>
  </div>

  <!-- Add Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="ccmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ccmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-insert.php'; ?>
      </div>
    </div>
  </div>

  <!-- Update Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="updateCcm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateCcm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-update.php'; ?>
      </div>
    </div>
  </div>

  <!-- Delete Credit Card Machine Modal -->
  <div class="modal fade container-fluid" id="deleteCCM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCCM" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <?php include plugin_dir_path(dirname(__FILE__)) . 'partials/ccm-delete.php'; ?>
      </div>
    </div>
  </div>

</div>