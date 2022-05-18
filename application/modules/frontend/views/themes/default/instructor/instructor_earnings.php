<style>
#apexMixedChart .apexcharts-toolbar {
    display: none;
}

.pmt-radio-type [type="radio"]:checked+label:after,
.pmt-radio-type [type="radio"]:not(:checked)+label:after,
.pmt-radio-type [type="radio"]:checked+label:before,
.pmt-radio-type [type="radio"]:not(:checked)+label:before {
    transform: translateY(-50%);
    top: 50%;
}

.apexcharts-toolbar {
    display: none;
}

.cursor-add {
    cursor: pointer;
}

.btn_req {
    background: rgba(58, 122, 209, 0.1);
    border: 1px solid rgba(58, 122, 209, 0.13);
    box-sizing: border-box;
    border-radius: 3px;
    color: #3A7AD1;
    line-height: 34px;
    min-width: 187px;
}

.pending_place {
    background: rgba(255, 92, 0, 0.1);
    border: 1px solid rgba(255, 92, 0, 0.13);
    box-sizing: border-box;
    border-radius: 3px;
    max-width: 190px;
    line-height: 39px;
    color: #FF5C00;
    margin: 15px auto;
}
</style>
<div class="pt-5 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <h4>Earning</h4>
                        <div class="mt-2 mb-1">You have full control to manage your account settings</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="counter-content py-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-2 g-xl-3">
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <h5>Course</h5>
                        <h4 class="fw-semi-bold h3 my-2">BDT <span
                                class="counter d-inline-block"><?php echo number_format($course_earning,3);?></span>
                        </h4>
                        <div class="my-2">Earning this month</div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <h5>Referral</h5>
                        <h4 class="fw-semi-bold h2 my-2">comming soon</h4>
                        <div class="my-2">Earning this month</div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 75%"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4 align-items-center">
                        <h5>Account</h5>
                        <h4 class="fw-semi-bold h2 my-2">BDT <span
                                class="counter d-inline-block"><?php echo number_format($current_balance,3)?></span>
                        </h4>
                        <div class="my-2">Current Balance</div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4 align-items-center">
                        <h5>Earned</h5>
                        <h4 class="fw-semi-bold h2 my-2">BDT <span
                                class="counter d-inline-block"><?php echo number_format($life_time_earn,3); ?></span>
                        </h4>
                        <div class="my-2">Lifetime</div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-3 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <div class="border-bottom pb-3">
                            <h4>Payment Method</h4>
                            <div class="mt-2 mb-1">You have full control to manage your account settings</div>
                        </div>
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="text-center">
                                        <div id="apexMixedChart-earning"></div>
                                        <h4>Your earning this month</h4>
                                        <h2><?php echo number_format($course_earning,2);?></h2>
                                    </div>
                                </div>
                                <!-- <div class="col-xl-6 offset-xl-1">



                                     <div class="border rounded p-4 mb-3">
                                        <div class="">
                                            <div class="form-check d-flex align-items-center ps-0 pmt-radio-type">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault01"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/nagad.png'); ?>"
                                                        class="img-fluid" alt="">
                                                </label>
                                            </div>
                                            <button class="btn mt-3 mt-sm-4 px-4 py-2 btn-outline-primary">Remove
                                                Account</button>
                                        </div>
                                    </div>
                                    <div class="border rounded p-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check d-flex align-items-center ps-0">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault01"
                                                    id="flexRadioDefault1258963">
                                                <label class="form-check-label" for="flexRadioDefault1258963"
                                                    data-bs-toggle="modal" data-bs-target="#examplepaymentmethodModal">Bank
                                                    Transfer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-dark-cerulean mt-4">Add a
                                        payment method</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="earnings_monthlabel" value="<?php echo $chart_alldays?>">
    <input type="hidden" name="" id="monthly_chartdata" value="<?php echo $earns_chartdata?>">
 
    <!-- ============ its for withdraw month ================= -->
    <input type="hidden" name="" id="withdrawearnings_months" value="<?php echo $withdrawearnings_months?>">
</div>
<div class="py-3 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded shadow-sm w-100 flex-fill mb-4 mb-xl-0 h-100">
                    <div class="card-body p-4">
                        <div class="border-bottom pb-3">
                            <h4>Payment Method</h4>
                            <div class="fs-15 mb-1 mt-2 text-muted">You have full control to manage your account
                                settings</div>
                        </div>
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-xl-5 text-center">
                                    <div class="text-center mb-4 mb-xl-0">
                                        <div id="apexMixedChart-withdraw"></div>
                                        <h4 class="fs-6">Your earning this month</h4>
                                        <h2 class="fs-1 mb-0 mt-4">
                                            <?php 
                                            $life_time_earn =  number_format($life_time_earn,3); 
                                            $instructor_totalpaid = number_format($instructor_totalpayment,3);
                                            $withdraw_balance = ($life_time_earn-$instructor_totalpaid);
                                            echo $withdraw_balance;
                                            // d($instructor_totalpaid);
                                            ?>
                                        </h2>
                                    </div>
                                    <!-- Button trigger modal -->
                                    <?php
                                    // d($life_time_earn. " L T E");
                                    // d($instructor_totalpayment. " T P ");
                                    // d($withdraw_balance);
                                    // d($get_userThismonthwithdrawamount);
                                    if(empty($get_userThismonthwithdrawamount)){
                                    if($withdraw_balance > 0  ){ ?>
                                    <button type="button" class="btn_req mt-3" data-bs-toggle="modal"
                                        data-bs-target="#withdrawReq">
                                        Withdraw Request
                                    </button>
                                    <div class="pending_place text-center">Your Payment Pending </div>
                                    <?php
                                     }
                                    }
                                     ?>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" data-bs-backdrop="static" id="withdrawReq" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Withdraw Request</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <input type='hidden' value='<?php echo $withdraw_balance; ?>'
                                                    id='pay_amount'>
                                            </div>
                                            <div class="modal-body">
                                                <?php 
                                                if($get_userpaymentinfo){
                                                $i=0;
                                                foreach($get_userpaymentinfo as $paymentmenthod){
                                                    $i++;
                                                    ?>
                                                <div class="border rounded p-3 mb-2">
                                                    <div class="">
                                                        <div class="form-check ps-0 d-flex align-items-center">
                                                            <input class="form-check-input" type="radio"
                                                                name="payment-id" id="payment-id-<?php echo $i; ?>"
                                                                value="<?php echo $paymentmenthod->id; ?>" required>
                                                            <label class="form-check-label"
                                                                for="payment-id-<?php echo $i; ?>">
                                                                <?php echo $paymentmenthod->bank_name; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }
                                                }else{ ?>
                                                <p class="text-center text-danger">Bank information not found!</p>
                                                <?php } ?>
                                            </div>
                                            <div class="justify-content-between modal-footer">
                                                <div>Earning Amount:
                                                    <strong>
                                                        <?php 
                                                            echo $life_time_earn;
                                                        ?>
                                                    </strong>
                                                </div>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-secondary me-2"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="withdrawSubmit()">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 offset-xl-1">
                                    <div class="bg-alice-blue border mb-3 p-5 rounded text-center cursor-add <?php echo (($paymentmethodstatus == 1) ? 'd-none' : ''); ?>"
                                        id="openBox">
                                        <svg width="23" height="17" viewBox="0 0 23 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.6797 3.67969V2H2.32031V3.67969H15.6797ZM15.6797 12V7H2.32031V12H15.6797ZM15.6797 0.320312C16.1484 0.320312 16.5391 0.489583 16.8516 0.828125C17.1641 1.14062 17.3203 1.53125 17.3203 2V12C17.3203 12.4688 17.1641 12.8724 16.8516 13.2109C16.5391 13.5234 16.1484 13.6797 15.6797 13.6797H2.32031C1.85156 13.6797 1.46094 13.5234 1.14844 13.2109C0.835938 12.8724 0.679688 12.4688 0.679688 12V2C0.679688 1.53125 0.835938 1.14062 1.14844 0.828125C1.46094 0.489583 1.85156 0.320312 2.32031 0.320312H15.6797Z"
                                                fill="#3A7AD1" />
                                            <rect x="11.5" y="5.5" width="11" height="11" rx="5.5" fill="white"
                                                stroke="#3A7AD1" />
                                            <path
                                                d="M19.9102 11.4102H17.4102V13.9102H16.5898V11.4102H14.0898V10.5898H16.5898V8.08984H17.4102V10.5898H19.9102V11.4102Z"
                                                fill="#3A7AD1" />
                                            <path
                                                d="M19.9102 11.4102V11.5102H20.0102V11.4102H19.9102ZM17.4102 11.4102V11.3102H17.3102V11.4102H17.4102ZM17.4102 13.9102V14.0102H17.5102V13.9102H17.4102ZM16.5898 13.9102H16.4898V14.0102H16.5898V13.9102ZM16.5898 11.4102H16.6898V11.3102H16.5898V11.4102ZM14.0898 11.4102H13.9898V11.5102H14.0898V11.4102ZM14.0898 10.5898V10.4898H13.9898V10.5898H14.0898ZM16.5898 10.5898V10.6898H16.6898V10.5898H16.5898ZM16.5898 8.08984V7.98984H16.4898V8.08984H16.5898ZM17.4102 8.08984H17.5102V7.98984H17.4102V8.08984ZM17.4102 10.5898H17.3102V10.6898H17.4102V10.5898ZM19.9102 10.5898H20.0102V10.4898H19.9102V10.5898ZM19.9102 11.3102H17.4102V11.5102H19.9102V11.3102ZM17.3102 11.4102V13.9102H17.5102V11.4102H17.3102ZM17.4102 13.8102H16.5898V14.0102H17.4102V13.8102ZM16.6898 13.9102V11.4102H16.4898V13.9102H16.6898ZM16.5898 11.3102H14.0898V11.5102H16.5898V11.3102ZM14.1898 11.4102V10.5898H13.9898V11.4102H14.1898ZM14.0898 10.6898H16.5898V10.4898H14.0898V10.6898ZM16.6898 10.5898V8.08984H16.4898V10.5898H16.6898ZM16.5898 8.18984H17.4102V7.98984H16.5898V8.18984ZM17.3102 8.08984V10.5898H17.5102V8.08984H17.3102ZM17.4102 10.6898H19.9102V10.4898H17.4102V10.6898ZM19.8102 10.5898V11.4102H20.0102V10.5898H19.8102Z"
                                                fill="#4582D4" />
                                        </svg><span class="fs-6 ms-4 text-primary">Add payment Method</span>
                                    </div>

                                    <div class="mb-4 <?php echo (($paymentmethodstatus == 1) ? 'd-block' : 'd-none'); ?>"
                                        id="selectMethod">
                                        <div class="border rounded p-3 mb-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center cursor-add" id="addMobileBanking">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/bangking.png'); ?>"
                                                        class="img-fluid" alt=""><span class="ms-4">Add Mobile
                                                        Banking</span>
                                                </div>
                                                <?php if($get_userbkashinfo || $get_usernagadinfo){ ?>
                                                <button class="btn btn-outline-danger px-4 py-2"
                                                    id="removeMobile2">Remove Account</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="border rounded p-3 mb-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center cursor-add" id="addBankDetails">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/add-bank.png'); ?>"
                                                        class="img-fluid" alt=""><span class="ms-4">Add Bank
                                                        Details</span>
                                                </div>
                                                <?php if($get_userbankinginfo){ ?>
                                                <button class="btn btn-outline-danger px-4 py-2"
                                                    id="bankRemover2">Remove Account</button>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <button
                                            class="btn btn-transparent px-0 text-primary gotoPayout <?php echo (($paymentmethodstatus == 1) ? 'd-none' : ''); ?>">Add
                                            a payment method</button>
                                    </div>

                                    <div class="d-none mb-4 border p-5" id="bankDetails">
                                        <form>
                                            <div class="mb-3">
                                                <label for="bank_name" class="form-label">Bank Name <i
                                                        class="text-danger"> * </i></label>
                                                <input type="text" class="form-control" id="bank_name"
                                                    placeholder="Bank Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="branch_name" class="form-label">Branch Name <i
                                                        class="text-danger"> * </i></label>
                                                <input type="text" class="form-control" id="branch_name"
                                                    placeholder="Branch Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="account_name" class="form-label">Account Name <i
                                                        class="text-danger"> * </i></label>
                                                <input type="text" class="form-control" id="account_name"
                                                    placeholder="Account Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Account Number <i
                                                        class="text-danger"> * </i></label>
                                                <input type="number" class="form-control" id="account_number"
                                                    placeholder="Account Number">
                                            </div>
                                            <div class="mb-3">
                                                <label for="mobile_no" class="form-label">Mobile Number <i
                                                        class="text-danger"> * </i></label>
                                                <input type="number" class="form-control" id="mobile_no"
                                                    placeholder="Mobile Number">
                                            </div>
                                        </form>
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-dark-cerulean acc_active"
                                                onclick="user_bankpaymentmethodsave(4)">Save</button>
                                            <button
                                                class="btn btn-transparent px-0 text-primary ms-3 bank-to-payment-method">Payment
                                                Method</button>
                                        </div>
                                    </div>

                                    <div class="d-none mb-4" id="selectMB">
                                        <div class="border rounded p-4 mb-3">
                                            <div class="">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio" name="mobile-banking"
                                                        id="adding-bkash003" value='1'
                                                        <?php echo ((@$get_userbkashinfo->payment_type == 1) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="adding-bkash003">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/bkash.png'); ?>"
                                                            class="img-fluid" alt="">
                                                    </label>
                                                </div>
                                                <input type="number" class="form-control mt-4 open-bkash-no"
                                                    id="bkashnumber"
                                                    value="<?php echo (!empty($get_userbkashinfo->account_number) ? $get_userbkashinfo->account_number : ''); ?>"
                                                    placeholder="Add Personal Number">
                                            </div>
                                        </div>
                                        <div class="border rounded p-4 mb-3">
                                            <div class="">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio" name="mobile-banking"
                                                        id="adding-nagad002" value='2'
                                                        <?php echo (($get_usernagadinfo->payment_type == 2) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="adding-nagad002">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/nagad.png'); ?>"
                                                            class="img-fluid" alt="">
                                                    </label>
                                                </div>
                                                <input type="number" class="form-control mt-4  open-nagad-no"
                                                    id="nagadNumber"
                                                    value="<?php echo (!empty($get_usernagadinfo->account_number) ? $get_usernagadinfo->account_number : ''); ?>"
                                                    placeholder="Add Personal Number">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-dark-cerulean acc_active"
                                                onclick="mobilebanking_save()">Save</button>
                                            <button
                                                class="btn btn-transparent px-0 text-primary ms-3 bank-to-payment-method">Payment
                                                Method</button>
                                        </div>
                                    </div>

                                    <div class="d-none mb-4" id="ra_wrapper">
                                        <div class="border rounded p-4 mb-3 d-block">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="flexRadioDefault01" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/bangking.png'); ?>"
                                                            class="img-fluid" alt="">
                                                        <span class="ms-3">Add Online Bank Details</span>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-danger px-4 py-2"
                                                    id="removeMobile">Remove Account</button>
                                            </div>
                                        </div>
                                        <div class="border rounded p-4 d-block">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="flexRadioDefault01" id="flexRadioDefault1258963">
                                                    <label class="form-check-label" for="flexRadioDefault1258963">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/add-bank.png'); ?>"
                                                            class="img-fluid" alt="">
                                                        <span class="ms-3">Bank Transfer</span>
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-danger px-4 py-2" id="bankRemover">Remove
                                                    Account</button>
                                            </div>
                                        </div>
                                        <button
                                            class="btn btn-transparent px-0 text-primary ms-3 bank-to-payment-method">Payment
                                            Method</button>
                                    </div>

                                    <div class="d-none mb-4" id="removeMB">
                                        <?php if($get_userbkashinfo){ 
                                             ?>
                                        <div class="border rounded p-4 mb-3" id="remove-bkashdiv">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio" name="removeBkash"
                                                        id="removeNagad02" checked>
                                                    <label class="form-check-label" for="removeNagad02">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/bkash.png'); ?>"
                                                            class="img-fluid" alt="">
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-danger px-4 py-2"
                                                    onclick="removemobilebanking('<?php echo $get_userbkashinfo->id; ?>', 'remove-bkashdiv')">Remove</button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($get_usernagadinfo){ ?>
                                        <div class="border rounded p-4 mb-3" id="remove-nagaddiv">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio" name="removeNagad"
                                                        id="removeNagad01" checked>
                                                    <label class="form-check-label" for="removeNagad01">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/nagad.png'); ?>"
                                                            class="img-fluid" alt="">
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-danger px-4 py-2"
                                                    onclick="removemobilebanking('<?php echo $get_usernagadinfo->id; ?>', 'remove-nagaddiv')">Remove</button>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <button
                                            class="btn btn-transparent px-0 text-primary ms-3 bank-to-payment-method">Payment
                                            Method</button>
                                    </div>

                                    <div class="d-none mb-4" id="removeBank">
                                        <?php if($get_userbankinginfo){ 
                                            $sl=0;
                                            foreach($get_userbankinginfo as $bank){
                                                $sl++;
                                                ?>
                                        <div class="border rounded p-4 mb-3" id="bank-div-<?php echo $sl; ?>">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="removebankac<?php echo $sl; ?>"
                                                        id="removebank<?php echo $sl; ?>" checked>
                                                    <label class="form-check-label" for="removebank<?php echo $sl; ?>">
                                                        <?php echo $bank->bank_name; ?>
                                                        <!-- <img src="<?php //echo base_url('application/modules/frontend/views/themes/default/assets/img/Islami-Bank.jpg'); ?>"
                                                                style="max-width: 200px" class="img-fluid" alt=""> -->
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-danger px-4 py-2"
                                                    onclick="removeBanking('<?php echo $bank->id; ?>', 'bank-div-<?php echo $sl; ?>')">Remove</button>
                                            </div>
                                        </div>
                                        <?php }
                                    }
                                     ?>

                                        <!-- <div class="border rounded p-4 mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check d-flex align-items-center pmt-radio-type ps-0">
                                                    <input class="form-check-input" type="radio" name="removebankac"
                                                        id="removebank02">
                                                    <label class="form-check-label" for="removebank02">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/Islami-Bank.jpg'); ?>"
                                                            style="max-width: 200px" class="img-fluid" alt="">
                                                    </label>
                                                </div>
                                                <button class="btn btn-outline-danger px-4 py-2">Remove</button>
                                            </div>
                                        </div> -->

                                        <button
                                            class="btn btn-transparent px-0 text-primary ms-3 bank-to-payment-method">Payment
                                            Method</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<!-- <div class="modal fade" id="examplepaymentmethodModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payout Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name">
                    </div>
                    <div class="mb-3">
                        <label for="branch_name" class="form-label">Branch Name</label>
                        <input type="text" class="form-control" id="branch_name">
                    </div>
                    <div class="mb-3">
                        <label for="account_name" class="form-label">Account Name</label>
                        <input type="text" class="form-control" id="account_name">
                    </div>
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number">
                    </div>
                    <div class="mb-3">
                        <label for="mobile_no" class="form-label">Mobile Number</label>
                        <input type="number" class="form-control" id="mobile_no">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="user_paymentmethodsave()">Save</button>
            </div>
        </div>
    </div>
</div> -->

<div class="py-4 bg-alice-blue">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                    <div class="card-body p-4 mb-3 mb-xl-0 table-responsive">
                        <h4 class="mb-4">Withdraw History</h4>
                        <div class="d-flex justify-content-between flex-wrap-sm">
                            <div class="mb-4 me-2 w-100">
                                <select class="form-select form-select-lg" aria-label="Default select example"
                                    id="proficiencySelect1" onchange="withdrawfilter(this.value, '', '')">
                                    <option value="">Select Day</option>
                                    <option value="30">30 Days</option>
                                    <option value="25">25 Days</option>
                                    <option value="30">20 Days</option>
                                    <option value="15">15 Days</option>
                                </select>
                            </div>
                            <div class="mb-4 me-2 w-100">
                                <select class="form-select form-select-lg" aria-label="Default select example"
                                    id="proficiencySelect2" onchange="withdrawfilter('', this.value, '')">
                                    <option value="">Select Month</option>
                                    <!-- <option value="1">Oct 2020</option> -->
                                    <?php 
                                     for($i=1; $i<=12; $i++){
                                        $month_no = date('m', mktime(0, 0, 0, $i, 10));
                                        $month = date('M', mktime(0, 0, 0, $i, 10)); 
                                        // echo $month_no. ' ' .$month . ",";
                                        ?>
                                    <option value="<?php echo $month_no; ?>"><?php echo $month.', '. date('Y'); ?>
                                    </option>
                                    <?php }                                    ?>
                                </select>
                            </div>
                            <div class="mb-4 me-2 w-100">
                                <select class="form-select form-select-lg" aria-label="Default select example"
                                    id="proficiencySelect3" onchange="withdrawfilter('', '', this.value)">
                                    <option value>Transaction Type</option>
                                    <option value="1">Bkash</option>
                                    <option value="2">Nagad</option>
                                    <option value="3">Rocket</option>
                                    <option value="4">Bank</option>
                                </select>
                            </div>
                            <!-- <div class="mb-4 border">
                                <button class="btn py-2 px-3">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div> -->
                        </div>
                        <div class="load-withdran-data">
                            <table class="table align-middle table-bordered">
                                <thead class="">
                                    <tr class="">
                                        <th scope="col">ID</th>
                                        <th scope="col">Method</th>
                                        <th class='text-center' scope="col">Status</th>
                                        <th class='text-center' scope="col">Amount</th>
                                        <th class='text-center' scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($get_withdrawrequest){ 
                                    foreach($get_withdrawrequest as $request){
                                    ?>
                                    <tr>
                                        <td>#<?php echo $request->request_id; ?></td>
                                        <td>
                                            <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/bkash.png'); ?>"
                                            alt=""> -->
                                            <?php echo $request->bank_name; ?>
                                        </td>
                                        <td class='text-center'>
                                            <?php if($request->status == 4){ ?>
                                            <span class="custom-btn p-1 w-100 me-2"
                                                style="background-color:#ffca2c;border:1px solid #ffca2c;color:#fff">Pending</span>
                                            <div class='text-center text-danger mt-2'>
                                                <?php echo (!empty($request->remarks) ? $request->remarks : ''); ?>
                                            </div>
                                            <?php }elseif($request->status == 1){ ?>
                                            <span class="custom-btn p-1 w-100 me-2"
                                                style="background-color:#198754;border:1px solid #198754;color:#fff">Paid</span>
                                            <?php }elseif($request->status == 2){ ?>
                                            <span class="custom-btn p-1 w-100 me-2"
                                                style="background-color:#ffca2c;border:1px solid #ffca2c;color:#fff">On
                                                Hold</span>
                                            <div class='text-center text-danger mt-2'>
                                                <?php echo (!empty($request->remarks) ? $request->remarks : ''); ?>
                                            </div>
                                            <?php }elseif($request->status == 3){ ?>
                                            <span class="custom-btn p-1 w-100 me-2"
                                                style="background-color:#bb2d3b;border:1px solid #bb2d3b;color:#fff">Cancelled</span><br>
                                            <div class='text-center text-danger mt-2'>
                                                <?php echo (!empty($request->remarks) ? $request->remarks : ''); ?>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td class='text-center'>
                                            <?php echo $request->amount;  ?>
                                        </td>
                                        <td class='text-center'>
                                            <?php echo date('M d, Y', strtotime($request->date)); ?>
                                        </td>
                                    </tr>
                                    <?php
                               } 
                            }else{ ?>
                                    <tr>
                                        <th colspan="5" class='text-center text-danger'>Record not found!</th>
                                    </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });


    $("#openBox").click(function() {
        $(this).addClass("d-none");
        $("#selectMethod").removeClass("d-none").addClass("d-block");
    });

    $(".bank-to-payment-method").click(function() {
        $("#selectMethod").removeClass("d-none").addClass("d-block");
        $("#bankDetails").addClass("d-none");
        $("#selectMB").addClass("d-none");
        $("#removeMB").addClass("d-none");
        $("#ra_wrapper").addClass("d-none");
        $("#removeBank").addClass("d-none");
    });
    $("#addMobileBanking").click(function() {
        $("#selectMB").removeClass("d-none").addClass("d-block");
        $("#selectMethod").removeClass("d-block").addClass("d-none");
    });
    $("#addBankDetails").click(function() {
        $("#bankDetails").removeClass("d-none").addClass("d-block");
        $("#selectMethod").removeClass("d-block").addClass("d-none");
    });
    $(".gotoPayout").click(function() {
        $("#openBox").removeClass("d-none").addClass("d-block");
        $("#selectMethod").removeClass("d-block").addClass("d-none");
        $("#selectMB").removeClass("d-block").addClass("d-none");
        $("#bankDetails").removeClass("d-block").addClass("d-none");
        $("#ra_wrapper").removeClass("d-block").addClass("d-none");
        $("#removeMB").removeClass("d-block").addClass("d-none");
        $("#removeBank").removeClass("d-block").addClass("d-none");
    });
    // $(".acc_active").click(function() {
    //     $("#ra_wrapper").removeClass("d-none").addClass("d-block");
    //     $("#selectMB").removeClass("d-block").addClass("d-none");
    //     $("#bankDetails").removeClass("d-block").addClass("d-none");
    // });
    $("#removeMobile").click(function() {
        alert('d');
        $("#removeMB").removeClass("d-none").addClass("d-block");
        $("#ra_wrapper").removeClass("d-block").addClass("d-none");

        $("#removeMB").removeClass("d-none").addClass("d-block");
        $("#selectMethod").removeClass("d-block").addClass("d-none");
    });
    $("#removeMobile2").click(function() {
        $("#removeMB").removeClass("d-none").addClass("d-block");
        $("#selectMethod").removeClass("d-block").addClass("d-none");
    });
    $("#bankRemover").click(function() {
        // $("#removeBank").removeClass("d-none").addClass("d-block");
        // $("#ra_wrapper").removeClass("d-block").addClass("d-none");
        $("#removeBank").removeClass("d-none").addClass("d-block");
        $("#selectMethod").removeClass("d-block").addClass("d-none");
        $("#bankDetails").removeClass("d-block").addClass("d-none");
        $("#ra_wrapper").removeClass("d-block").addClass("d-none");
    });
    $("#bankRemover2").click(function() {
        $("#removeBank").removeClass("d-none").addClass("d-block");
        $("#selectMethod").removeClass("d-block").addClass("d-none");
        $("#bankDetails").removeClass("d-block").addClass("d-none");
        $("#ra_wrapper").removeClass("d-block").addClass("d-none");
    });
    $("#nagadNumber01").click(function() {
        $("#adding-nagad002").trigger('click');
    });
    $("#nagadNumber02").click(function() {
        $("#adding-bkash003").trigger('click');
    });


    $("#adding-bkash003").click(function() {
        $(".open-bkash-no").show();
    });
    $("#adding-nagad002").click(function() {
        $(".open-nagad-no").show();
    });


});


<?php if(empty($get_userbkashinfo)){ ?>
$(".open-bkash-no").hide();
<?php } ?>
<?php if(empty($get_usernagadinfo)){ ?>
$(".open-nagad-no").hide();
<?php } ?>

function mobilebanking_save() {
    var fd = new FormData();
    var user_id = $("#user_id").val();
    var enterprise_id = $("#enterprise_id").val();

    var bkash = nagad = '';
    if ($("#adding-bkash003").is(":checked")) {
        var bkash = 1;
        $(".open-bkash-no").show();
        var bkashnumber = $("#bkashnumber").val();
        if (bkashnumber == '') {
            toastr["error"]("Bkash number must be required!");
            $("#bkashnumber").focus();
            return false;
        }
    }

    if ($("#adding-nagad002").is(":checked")) {
        var nagad = 1;
        var nagadNumber = $("#nagadNumber").val();
        if (nagadNumber == '') {
            toastr["error"]("Nagad number must be required!");
            $("#nagadNumber").focus();
            return false;
        }
    }
    if (bkash == '' && nagad == '') {
        toastr["error"]("Bkash or Nagad must be required!");
        return false;
    }

    fd.append("bkash", bkash);
    fd.append("nagad", nagad);
    fd.append("bkashnumber", bkashnumber);
    fd.append("nagadNumber", nagadNumber);
    fd.append("user_id", user_id);
    fd.append("enterprise_id", enterprise_id);
    //   fd.append("sel", sel);
    fd.append("csrf_test_name", CSRF_TOKEN);
    $.ajax({
        url: base_url + enterprise_shortname + "/user-paymentmethodsave",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            //   console.log(r);return false;
            if (r == '12') {
                toastr["error"]("Bkash or Nagad already exists!");
                return false;
            } else if (r == 1) {
                toastr["error"]("Bkash already exists!");
                return false;
            } else if (r == 2) {
                toastr["error"]("Nagad already exists!");
                return false;
            } else {
                toastr["success"]("Mobile banking added successfully!");
                // $("#ra_wrapper").removeClass("d-none").addClass("d-block");
                // $("#selectMB").removeClass("d-block").addClass("d-none");
                // $("#bankDetails").removeClass("d-block").addClass("d-none");
                setTimeout(function() {
                    location.reload();
                }, 600);
            }

        },
    });
}

function user_bankpaymentmethodsave(payment_type) {
    var user_id = $("#user_id").val();
    var enterprise_id = $("#enterprise_id").val();
    // var payment_type = $("#payment_type").val();
    var bank_name = $("#bank_name").val();
    var branch_name = $("#branch_name").val();
    var account_name = $("#account_name").val();
    var account_number = $("#account_number").val();
    var mobile_no = $("#mobile_no").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    // alert(payment_type);
    if (payment_type == "") {
        toastr["error"]("Payment type must be required");
        $("#payment_type").focus();
        return false;
    }
    if (payment_type == 4) {
        if (bank_name == "") {
            toastr["error"]("Bank name must be required");
            $("#bank_name").focus();
            return false;
        }
        if (branch_name == "") {
            toastr["error"]("Branch name must be required");
            $("#branch_name").focus();
            return false;
        }
        if (account_name == "") {
            toastr["error"]("Account name must be required");
            $("#account_name").focus();
            return false;
        }
        if (account_number == "") {
            toastr["error"]("Account number must be required");
            $("#account_number").focus();
            return false;
        }
        if (mobile_no == "") {
            toastr["error"]("Mobile number must be required");
            $("#mobile_no").focus();
            return false;
        }
    }

    $.ajax({
        url: base_url + enterprise_shortname + "/user-bankpaymentmethodsave",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            user_id: user_id,
            enterprise_id: enterprise_id,
            payment_type: payment_type,
            bank_name: bank_name,
            branch_name: branch_name,
            account_name: account_name,
            account_number: account_number,
            mobile_no: mobile_no,
        },
        success: function(r) {
            $("#bank_name").val('');
            $("#branch_name").val('');
            $("#account_name").val('');
            $("#account_number").val('');
            $("#mobile_no").val('');
            if (r == 1) {
                toastr["success"]("Bank information saved successfully!");
                // $("#ra_wrapper").removeClass("d-none").addClass("d-block");
                // $("#selectMB").removeClass("d-block").addClass("d-none");
                // $("#bankDetails").removeClass("d-block").addClass("d-none");
                setTimeout(function() {
                    location.reload();
                }, 600);
            }
        },
    });
}

function removemobilebanking(id, removediv) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var r = confirm("Are you sure");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/remove-mobilebanking",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                id: id,
            },
            success: function(r) {
                if (r == 0) {
                    toastr["error"]("Already used the payment method!");
                    return false;
                } else {
                    toastr["success"]("Removed successfully!");
                    // var div = document.getElementById("lessonresourse_" + sl + "_" + lesson + "_" + re_id);
                    var div = document.getElementById(removediv);
                    div.parentNode.removeChild(div);
                    setTimeout(function() {
                        location.reload();
                    }, 600);
                }
            },
        });
    }
}

function removeBanking(id, removediv) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var r = confirm("Are you sure");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/remove-mobilebanking",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                id: id,
            },
            success: function(r) {
                if (r == 0) {
                    toastr["error"]("Already used the payment method!");
                    return false;
                } else {
                    toastr["success"]("Removed successfully!");
                    var div = document.getElementById(removediv);
                    div.parentNode.removeChild(div);
                    setTimeout(function() {
                        location.reload();
                    }, 600);
                }
            },
        });
    }
}


function withdrawSubmit(payment_type) {
    var user_id = $("#user_id").val();
    var enterprise_id = $("#enterprise_id").val();
    // var payment_type = $("#payment_type").val();
    var amount = $("#pay_amount").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    // alert(amount);return false;
    if (!$('[name="payment-id"]').is(":checked")) {
        toastr["error"]("Please select payment method!");
        return false;
    }
    var payment_id = $('input[name="payment-id"]:checked').val()


    $.ajax({
        url: base_url + enterprise_shortname + "/withdraw-submit",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            user_id: user_id,
            enterprise_id: enterprise_id,
            payment_id: payment_id,
            amount: amount,
        },
        success: function(r) {
            toastr["success"]("Withdraw submited successfully!");
            setTimeout(function() {
                location.reload();
            }, 600);
        },
    });
}

function withdrawfilter(days, monthyear, type) {
    // alert(days);    alert(year);    alert(type);
    var user_id = $("#user_id").val();
    var enterprise_id = $("#enterprise_id").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    // alert(amount);return false;


    $.ajax({
        url: base_url + enterprise_shortname + "/withdraw-filter",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            user_id: user_id,
            enterprise_id: enterprise_id,
            days: days,
            monthyear: monthyear,
            type: type,
        },
        success: function(r) {
            // toastr["success"]("Withdraw submited successfully!");
            // setTimeout(function() {
            //     location.reload();
            // }, 600);
            $(".load-withdran-data").html(r);
        },
    });
}
</script>