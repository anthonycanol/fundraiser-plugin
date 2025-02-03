<?php
global $wpdb;
// $table_name = $wpdb->prefix . 'employees';
// $fundraiser_id = get_query_var('fundraiserId');
// $employee = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $employee_id");
// var_dump($fundraiser_id);
// if ($employee) {
//     echo "<h1>{$employee->name}</h1>";
//     echo "<p><strong>Position:</strong> {$employee->position}</p>";
//     echo "<p><strong>Bio:</strong> {$employee->bio}</p>";
//     echo "<p><strong>Email:</strong> {$employee->email}</p>";
//     echo "<p><strong>Phone:</strong> {$employee->phone}</p>";
// } else {
//     echo "<p>Employee not found.</p>";
// }

$user = get_user_by('id', $atts['fundraiserId']);
print_r($user);

$img_url = plugin_dir_url(__FILE__) . '../../public/images/';
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
              <i class="fas fa-globe fa-lg text-warning"></i>
              <p class="mb-0">Total Collections: </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <i class="fab fa-github fa-lg text-body"></i>
              <p class="mb-0">Total Redeem: </p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
              <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
              <p class="mb-0">Balance: </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card mb-4">
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
              <p class="text-muted mb-0">Date</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Donated</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Status</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2">
              <p class="text-muted mb-0">Date</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Donated</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Status</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-2">
              <p class="text-muted mb-0">Date</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Donated</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Status</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-2">
              <p class="text-muted mb-0">Date</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Donated</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Status</p>
            </div>
            <div class="col-sm-2">
              <p class="text-muted mb-0">Payment</p>
            </div>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-6">
          <div class="card mb-4 mb-md-0">
            <div class="card-body">
              <p class="mb-4">History of Redeem</p>
              <p class="mb-1" style="font-size: .77rem;">Web Design</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
              <div class="progress rounded mb-2" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card mb-4 mb-md-0">
            <div class="card-body">
              <p class="mb-4">Credit Card Machine
              </p>
              <p class="mb-1" style="font-size: .77rem;">Web Design</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
              <div class="progress rounded" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
              <div class="progress rounded mb-2" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
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
              <input type="text" class="form-control" id="date_collected" name="date_collected">
            </div>
            <div class="mb-3">
              <p class="mb-0">Payment Method <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Voucher" id="option1" autocomplete="off" checked="">
              <label class="btn btn-sm" for="option1">Voucher</label>
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Credit Card" id="option2" autocomplete="off">
              <label class="btn btn-sm" for="option2">Credit Card</label>
              <input type="radio" class="btn-check select-payment-method" name="payment_method" value="Check" id="option3" autocomplete="off">
              <label class="btn btn-sm" for="option3">Check</label>
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
            <div>
              <p class="mb-0">Status <sup class="text-body-secondary" style="font-size: 10px;">Required</sup></p>
              <input type="radio" class="btn-check" name="status" value="Pending" id="option1" autocomplete="off" checked="">
              <label class="btn btn-sm" for="option1">Pending</label>
              <input type="radio" class="btn-check" name="status" value="Accepted" id="option2" autocomplete="off">
              <label class="btn btn-sm" for="option2">Accepted</label>
              <input type="radio" class="btn-check" name="status" value="Declined" id="option3" autocomplete="off">
              <label class="btn btn-sm" for="option3">Declined</label>
              <input type="radio" class="btn-check" name="status" value="Refund" id="option4" autocomplete="off">
              <label class="btn btn-sm" for="option4">Refund</label>
            </div>
          </div>
          <div class="modal-footer">
            <input type="text" name="user_id" value="<?php echo $user->ID; ?>" hidden>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary save-collection">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>