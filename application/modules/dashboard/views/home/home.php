<?php
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$position = (!empty($setting->currency_position) ? $setting->currency_position : '1');
$currency = (!empty($setting->currency) ? $setting->currency : 'BDT');
$quickview = $this->Course_model->quick_view($user_id, $user_type);
?>
<style>
.barras {
    width: 320px;
    margin: 10px auto;
}

.barra {
    width: 300px;
    height: 30px;
    background: #CCC;
    margin: 10px;
}

.barra-nivel {
    height: 30px;
    background: #444;
    width: 1px;
    -webkit-transition: width 1s ease;
    -moz-transition: width 1s ease;
    transition: width 1s ease;
}

.valor-nivel {
    line-height: 30px;
    color: #fff;
    margin-left: 10px;
    font-family: "Montserrat";
    font-size: 12px;
}

.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    color: #fff;
    background-color: #4189c8;
    box-shadow: 0 0 10px 1px rgb(255 255 255);
}

.nav-pills .nav-link {
    color: #545454;
}

.upper_icon {
    background: #762bbb;
    color: #fff;
    width: 40px;
    line-height: 40px;
    font-size: 22px;
    text-align: center;
}






.circle_percent {
    font-size: 200px;
    width: 50px;
    height: 50px;
    position: relative;
    background: #eee;
    border-radius: 50%;
    overflow: hidden;
    display: inline-block;
    margin: 0;
}

.circle_inner {
    position: absolute;
    left: 0;
    top: 0;
    width: 50px;
    height: 50px;
    clip: rect(0 50px 50px 25px);
}

.round_per {
    position: absolute;
    left: 0;
    top: 0;
    width: 50px;
    height: 50px;
    background: #4189c8;
    clip: rect(0 50px 50px 25px);
    transform: rotate(180deg);
    transition: 1.05s;
}

.percent_more .circle_inner {
    clip: rect(0 .5em 1em 0em);
}

.percent_more:after {
    position: absolute;
    left: 35px;
    top: 0em;
    right: 0;
    bottom: 0;
    background: #4189c8;
    content: '';
}

.circle_inbox {
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    background: #fff;
    z-index: 3;
    border-radius: 50%;
}

.percent_text {
    position: absolute;
    font-size: 16px;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 3;
}
</style>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats statistic-box mb-4">
            <div
                class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3 py-0">
                <div class="card-icon d-flex align-items-center justify-content-center">
                    <i class="typcn typcn-home-outline"></i>
                </div>
                <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                    <?php echo display('total_course'); ?></p>
                <h3 class="card-title fs-21 font-weight-bold"><?php echo html_escape($quick_view['total_course']); ?>
                </h3>
            </div>
            <div class="card-footer p-3">
                <div class="stats">
                    <i class="typcn typcn-calendar-outline mr-2"></i>
                    <a href="<?php echo base_url(enterpriseinfo()->shortname.'/course-list'); ?>"
                        class="warning-link"><?php echo display('get_more'); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php if ($user_type == 1 || $user_type == 2) { ?>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats statistic-box mb-4">
            <div class="card-header card-header-info card-header-icon position-relative border-0 text-right px-3 py-0">
                <div class="card-icon d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-friends"></i>
                </div>
                <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                    <?php
                        echo display('total_instructor');
                        ?>
                </p>
                <h3 class="card-title fs-21 font-weight-bold">
                    <?php
                        echo html_escape($quick_view['total_faculty']);
                        ?>
                </h3>
            </div>
            <div class="card-footer p-3">
                <div class="stats">
                    <i class="typcn typcn-upload mr-2"></i>
                    <a href="<?php echo base_url(enterpriseinfo()->shortname.'/faculty-list'); ?>" class="warning-link">
                        <?php echo display('get_more'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
        ?>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats statistic-box mb-4">
            <div
                class="card-header card-header-warning card-header-icon position-relative border-0 text-right px-3 py-0">
                <div class="card-icon d-flex align-items-center justify-content-center">
                    <i class="fas fa-book-open"></i>
                </div>
                <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                    <?php echo display('total_student'); ?></p>
                <h3 class="card-title fs-18 font-weight-bold">
                    <?php
                    if ($user_type == 1 || $user_type == 2) {
                        $ttlstudents = $quick_view['total_students'];
                        echo html_escape(($ttlstudents) ? "$ttlstudents" : "0");
                    } else {
                        echo html_escape($faculty_students_count);
                    }
                    ?>
                </h3>
            </div>
            <div class="card-footer p-3">
                <div class="stats">
                    <i class="typcn typcn-warning text-primary mr-2"></i>
                    <a href="<?php
                    if ($user_type == 1) {
                        echo base_url(enterpriseinfo()->shortname .'/student-list');
                    } else {
                        echo base_url(enterpriseinfo()->shortname .'/student-list');
                    }
                    ?>" class="warning-link"><?php echo display('get_more'); ?> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats statistic-box mb-4">
            <div
                class="card-header card-header-danger card-header-icon position-relative border-0 text-right px-3 py-0">
                <div class="card-icon d-flex align-items-center justify-content-center">
                    <i class="typcn typcn-device-tablet"></i>
                </div>
                <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">
                    <?php echo display('total_event'); ?></p>
                <h3 class="card-title fs-21 font-weight-bold"><?php echo html_escape($quick_view['total_liveevent']); ?>
                </h3>
            </div>
            <div class="card-footer p-3">
                <div class="stats">
                    <i class="typcn typcn-warning text-warning mr-2"></i>
                    <a href="<?php echo base_url(enterpriseinfo()->shortname .'/event-list'); ?>"
                        class="warning-link"><?php echo display('get_more'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($user_type == 1) { ?>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h2 class="fs-18 font-weight-bold mb-0 w-100">
                    <?php echo display('revenue_report'); ?>
                </h2>
                <div class="input-group">
                    <input type="text" id="yearmonth_picker" class="form-control" value="<?php echo date('Y-m'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="revenuestatus_monthyear()"><i
                                class="fa fa-search"> </i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="flotChart" id="revenueStatusResults">
                    <div id="flotChart8" class="flotChart-demo"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <h2 class="fs-18 font-weight-bold mb-0 w-100"><?php echo display('sales_amount'); ?></h2>
                <div class="input-group">
                    <input type="text" id="yearmonth_picker_sales" class="form-control"
                        value="<?php echo date('Y-m'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="yearmonthly_salesamount()"><i
                                class="fa fa-search"> </i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="barchart" id="salesAmountResults">
                    <canvas id="singelBarChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0"><?php echo display('course_overview'); ?></h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="flotChart">
                    <div id="courseOverview" class="flotChart-demo"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="fs-18 font-weight-bold mb-0"><?php echo display('instructor_unpaid_revenue'); ?></h2>
            </div>
            <div class="card-body  unpaid-y-scroll-h-313">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo display('instructor_name'); ?></th>
                            <th class="text-right"><?php echo display('total_revenue'); ?></th>
                            <th class="text-right"><?php echo display('due_payment'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($quickview_facultycourse_list as $faculty) {
                                $totalamounts = 0;
                                ?>
                        <tr>
                            <td><?php echo html_escape($faculty->name); ?></td>
                            <td class="text-right">
                                <?php
                                        $totalamounts = (!empty($faculty->instructor_revenue) ? number_format($faculty->instructor_revenue, 3) : 0);
                                        $paidamount = (!empty($faculty->instructor_paidamount) ? $faculty->instructor_paidamount : 0);
                                        echo html_escape(($position == 1) ? "$currency $totalamounts" : "$totalamounts $currency");
                                        ?>
                            </td>
                            <td class="text-right">
                                <?php
                                        $balance = $totalamounts - $paidamount;
                                        echo html_escape(($position == 1) ? "$currency $balance" : "$balance $currency");
                                        ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Quick Stats</h6>
                    </div>
                    <div class="text-right">
                        <div class="actions">
                            <a href="#" class="action-item"><i class="ti-reload"></i></a>
                            <div class="dropdown action-item" data-toggle="dropdown">
                                <a href="#" class="action-item"><i class="ti-more-alt"></i></a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">Refresh</a>
                                    <a href="#" class="dropdown-item">Manage Widgets</a>
                                    <a href="#" class="dropdown-item">Settings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8">
                        <div id="morris-line-chart"></div>
                        <canvas id="lineChart" height="140"></canvas>
                    </div>
                    <div class="col-xl-4 mt-5 mt-xl-0">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="d-flex w-75">
                                <h6 class="mb-0 mr-4 w-50">Courses</h6>
                                <h6 class="mb-0">Active/Created</h6>
                            </div>
                            <div>
                                <?php echo $total_active_courses;?>/<?php echo $total_courses;
                                $percentage = ($total_active_courses*100)/($total_courses != 0?$total_courses:1);
                                ?>
                            </div>
                        </div>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-primary rounded" role="progressbar" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage;?>%">
                                <span class="sr-only"><?php echo $percentage;?>% Complete (primary)</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="d-flex w-75">
                                <h6 class="mb-0 mr-4 w-50">Live Events</h6>
                                <h6 class="mb-0">Finished/Created</h6>
                            </div>
                            <div>
                                <?php echo $total_livevent_finished?>/<?php echo $total_livevent;
                               $event_percentage = ($total_livevent_finished*100)/($total_livevent != 0?$total_livevent:1); 
                                ?>
                            </div>
                        </div>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-primary rounded" role="progressbar" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $event_percentage;?>%">
                                <span class="sr-only"><?php echo $event_percentage;?>% Complete (primary)</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="d-flex w-75">
                                <h6 class="mb-0 mr-4 w-50">Projects</h6>
                                <h6 class="mb-0">Approved/Created</h6>
                            </div>
                            <div>
                                <?php echo $total_projects_approved;?>/<?php echo $total_projects;
                           $project_percentage = ($total_projects_approved*100)/($total_projects != 0?$total_projects:1); 
                               ?>
                            </div>
                        </div>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-primary rounded" role="progressbar" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $project_percentage?>%">
                                <span class="sr-only"><?php echo $project_percentage?>% Complete (primary)</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div class="d-flex w-75">
                                <h6 class="mb-0 mr-4 w-50">Blogs</h6>
                                <h6 class="mb-0">Approved/Created</h6>
                            </div>
                            <div>
                                <?php echo $total_blog_approved;?>/<?php echo $total_blogs;
                                $blog_percentage = ($total_blog_approved*100)/($total_blogs != 0?$total_blogs:1); 
                                ?>
                            </div>
                        </div>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-primary rounded" role="progressbar" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $blog_percentage;?>%">
                                <span class="sr-only"><?php echo $blog_percentage;?>% Complete (primary)</span>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-xl-4 col-sm-6">
        <div class="p-2 bg-white rounded p-3 shadow-sm mb-3 mb-sm-0">
            <div class="align-items-center d-flex">
                <div class="circle_percent mr-5"
                    data-percent="<?php echo ($quick_view['totaltodaylogin'] ? $quick_view['totaltodaylogin'] : '0'); ?>">
                    <div class="circle_inner">
                        <div class="round_per"></div>
                    </div>
                </div>
                <div>Total Logins Today</div>
            </div>
        </div>
    </div>
    <!-- <div class="col-xl-3 col-sm-6">
        <div class="p-2 bg-white rounded p-3 mb-3 shadow-sm">
            <div class="align-items-center d-flex">
                <i class="fa fa-long-arrow-alt-up fas rounded-circle upper_icon"></i>
                <span class="text-primary text-size-3 text-monospace ml-3 mr-4">
                    4%
                </span> Site Traffic - 30days
            </div>
        </div>
    </div> -->
    <div class="col-xl-4 col-sm-6">
        <div class="p-2 bg-white rounded p-3 shadow-sm mb-3 mb-sm-0">
            <div class="align-items-center d-flex">
                <div class="circle_percent mr-5" data-percent="<?php echo ($quick_view['totalthirtydayslogin'] ? $quick_view['totalthirtydayslogin'] : '0'); ?>">
                    <div class="circle_inner">
                        <div class="round_per"></div>
                    </div>
                </div>
                <div>Total Logins -30 days</div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6">
        <div class="p-2 bg-white rounded p-3 shadow-sm">
            <div class="align-items-center d-flex">
                <div class="circle_percent mr-5"
                    data-percent="<?php echo ($quick_view['total_course'] ? $quick_view['total_course'] : '0'); ?>">
                    <div class="circle_inner">
                        <div class="round_per"></div>
                    </div>
                </div>
                <div>Total Users</div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="fs-18 font-weight-bold mb-0">Activity Stream</h2>
            </div>
            <div class="card-body  unpaid-y-scroll-h-313">
                <table class="table">
                    <!-- <thead>
                            <tr>
                                <th><?php echo display('instructor_name'); ?></th>
                                <th class="text-right"><?php echo display('due_payment'); ?></th>
                            </tr>
                        </thead> -->
                    <tbody>
                        <?php
                            $sl=0;
                            foreach ($get_activitylog as $log) {
                                $sl++;
                                ?>
                        <tr>
                            <td><?php //echo $sl; ?></td>
                            <td>
                                <strong><i class="fas fa-headphones-alt"> </i> </strong>
                                <?php echo html_escape($log->title); ?>
                            </td>

                            <td class="text-right">
                                <?php 
                                    echo datetimeagoformate($log->created_date); 
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Reports</h6>
                    </div>
                    <!-- <div class="text-right">
                        <div class="actions">
                            <a href="#" class="action-item"><i class="ti-reload"></i></a>
                            <div class="dropdown action-item" data-toggle="dropdown">
                                <a href="#" class="action-item"><i class="ti-more-alt"></i></a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">Refresh</a>
                                    <a href="#" class="dropdown-item">Manage Widgets</a>
                                    <a href="#" class="dropdown-item">Settings</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="card-body  unpaid-y-scroll-h-313">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-course-tab" data-toggle="pill" href="#pills-course"
                                role="tab" aria-controls="pills-course" aria-selected="true">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-test-tab" data-toggle="pill" href="#pills-test" role="tab"
                                aria-controls="pills-test" aria-selected="false">Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-class-tab" data-toggle="pill" href="#pills-class" role="tab"
                                aria-controls="pills-contact" aria-selected="false">Classes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-content-tab" data-toggle="pill" href="#pills-content"
                                role="tab" aria-controls="pills-content" aria-selected="false">Contents</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-course" role="tabpanel"
                            aria-labelledby="pills-course-tab">
                            Consequat occaecat ullamco amet non eiusmod nostrud dolore irure incididunt est duis anim
                            sunt
                            officia. Fugiat velit proident aliquip nisi incididunt nostrud exercitation proident est
                            nisi.
                            Irure magna elit commodo anim ex veniam culpa eiusmod id nostrud sit cupidatat in veniam ad.
                            Eiusmod consequat eu adipisicing minim anim aliquip cupidatat culpa excepteur quis. Occaecat
                            sit
                            eu exercitation irure Lorem incididunt nostrud.
                        </div>
                        <div class="tab-pane fade" id="pills-test" role="tabpanel" aria-labelledby="pills-test-tab">
                            Ad pariatur nostrud pariatur exercitation ipsum ipsum culpa mollit commodo mollit ex. Aute
                            sunt
                            incididunt amet commodo est sint nisi deserunt pariatur do. Aliquip ex eiusmod voluptate
                            exercitation cillum id incididunt elit sunt. Qui minim sit magna Lorem id et dolore velit
                            Lorem
                            amet exercitation duis deserunt. Anim id labore elit adipisicing ut in id occaecat pariatur
                            ut
                            ullamco ea tempor duis.
                        </div>
                        <div class="tab-pane fade" id="pills-class" role="tabpanel" aria-labelledby="pills-class-tab">
                            Est quis nulla laborum officia ad nisi ex nostrud culpa Lorem excepteur aliquip dolor aliqua
                            irure ex. Nulla ut duis ipsum nisi elit fugiat commodo sunt reprehenderit laborum veniam eu
                            veniam. Eiusmod minim exercitation fugiat irure ex labore incididunt do fugiat commodo
                            aliquip
                            sit id deserunt reprehenderit aliquip nostrud. Amet ex cupidatat excepteur aute veniam
                            incididunt mollit cupidatat esse irure officia elit do ipsum ullamco Lorem.
                        </div>
                        <div class="tab-pane fade" id="pills-content" role="tabpanel"
                            aria-labelledby="pills-content-tab">
                            Est quis nulla laborum officia ad nisi ex nostrud culpa Lorem excepteur aliquip dolor aliqua
                            irure ex. Nulla ut duis ipsum nisi elit fugiat commodo sunt reprehenderit laborum veniam eu
                            veniam. Eiusmod minim exercitation fugiat irure ex labore incididunt do fugiat commodo
                            aliquip
                            sit id deserunt reprehenderit aliquip nostrud. Amet ex cupidatat excepteur aute veniam
                            incididunt mollit cupidatat esse irure officia elit do ipsum ullamco Lorem.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="fs-18 font-weight-bold mb-0">Top Purchased Course By Enrollments & Completions</h2>
            </div>
            <div class="card-body  unpaid-y-scroll-h-313">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th class="">Students Enrolled</th>
                            <th class="">Students Purchasing</th>
                            <th class="">Students Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($toppurchasescourse){
                            foreach($toppurchasescourse as $topcourse){
                        ?>
                        <tr>
                            <td>
                                <?php echo html_escape($topcourse->name); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($topcourse->totalenrolled) ? $topcourse->totalenrolled : '0'); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($topcourse->pursuing) ? $topcourse->pursuing : '0'); ?></td>
                            <td class="text-center">
                                <?php echo (!empty($topcourse->completed) ? $topcourse->completed : '0'); ?></td>
                        </tr>
                        <?php } 
                        }else{ ?>
                        <tr>
                            <th class="text-center text-danger" colspan="5"><?php echo 'No record found!'; ?></th>
                        </tr>
                        <?php }                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="fs-18 font-weight-bold mb-0">Top Subscribed Course By Enrollments & Completions</h2>
            </div>
            <div class="card-body  unpaid-y-scroll-h-313">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th class="">Students Enrolled</th>
                            <th class="">Students Purchasing</th>
                            <th class="">Students Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($topsubscriptioncourse){
                            foreach($topsubscriptioncourse as $subscriptioncourse){
                        ?>
                        <tr>
                            <td>
                                <?php echo html_escape($subscriptioncourse->name); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($subscriptioncourse->totalenrolled) ? $subscriptioncourse->totalenrolled : '0'); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($subscriptioncourse->pursuing) ? $subscriptioncourse->pursuing : '0'); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($subscriptioncourse->completed) ? $subscriptioncourse->completed : '0'); ?>
                            </td>
                        </tr>
                        <?php } 
                        }else{ ?>
                        <tr>
                            <th class="text-center text-danger" colspan="5"><?php echo 'No record found!'; ?></th>
                        </tr>
                        <?php }                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="fs-18 font-weight-bold mb-0">Top learners-Purchased Courses By Month</h2>
            </div>
            <div class="card-body  unpaid-y-scroll-h-313">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Students Name</th>
                            <th class="">Course Enrolled</th>
                            <th class="">Course Purchasing</th>
                            <th class="">Course Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($toplearnersfrompurchase){
                            foreach($toplearnersfrompurchase as $toplearner){
                        ?>
                        <tr>
                            <td>
                                <?php echo html_escape($toplearner->studentname); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($toplearner->studentenrolled) ? $toplearner->studentenrolled : '0'); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($toplearner->studentpursuing) ? $toplearner->studentpursuing : '0'); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($toplearner->studentcompleted) ? $toplearner->studentcompleted : '0'); ?>
                            </td>
                        </tr>
                        <?php } 
                        }else{ ?>
                        <tr>
                            <th class="text-center text-danger" colspan="5"><?php echo 'No record found!'; ?></th>
                        </tr>
                        <?php }                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="fs-18 font-weight-bold mb-0">Top learners-Subscribed Courses By Month</h2>
            </div>
            <div class="card-body  unpaid-y-scroll-h-313">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Students Name</th>
                            <th class="">Course Enrolled</th>
                            <th class="">Course Purchasing</th>
                            <th class="">Course Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($toplearnersfromsubscription){
                            foreach($toplearnersfromsubscription as $subscriptionlearner){
                        ?>
                        <tr>
                            <td>
                                <?php echo html_escape($subscriptionlearner->studentname); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($subscriptionlearner->studentenrolled) ? $subscriptionlearner->studentenrolled : '0'); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($subscriptionlearner->studentpursuing) ? $subscriptionlearner->studentpursuing : '0'); ?>
                            </td>
                            <td class="text-center">
                                <?php echo (!empty($subscriptionlearner->studentcompleted) ? $subscriptionlearner->studentcompleted : '0'); ?>
                            </td>
                        </tr>
                        <?php } 
                        }else{ ?>
                        <tr>
                            <th class="text-center text-danger" colspan="5"><?php echo 'No record found!'; ?></th>
                        </tr>
                        <?php }                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
     <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Top Events - This Month</h6>
                    </div>
              
                </div>
            </div>
          
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tabe" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-event-tab" data-toggle="pill" href="#pills-live-events"
                                role="tab" aria-controls="pills-live-events" aria-selected="true">Live</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-upcoming-event-tab" data-toggle="pill" href="#pills-upcoming-event" role="tab"
                                aria-controls="pills-upcoming-event" aria-selected="false">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-past-event-tab" data-toggle="pill" href="#pills-past-event" role="tab"
                                aria-controls="pills-contact" aria-selected="false">Past</a>
                        </li>
                       
                    </ul>
                    <div class="tab-content" id="pills-tabeContent">
                        <div class="tab-pane fade show active" id="pills-live-events" role="tabpanel"
                            aria-labelledby="pills-event-tab">
                           <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Organizer</th>
                                    <th>Enrolled</th>
                                    <th>Present</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cur_time = date('H:i:s');
                                if($live_eventlist){
                                    foreach($live_eventlist as $liveevents){
                                     $leventend = $liveevents->end_time; 
                                     // if($leventend > $cur_time){  
                                    ?>
                                <tr>
                                    <td><?php echo $liveevents->name?></td>
                                    <td><?php echo 'Lms'?></td>
                                    <td><?php echo $liveevents->total_event?></td>
                                    <td><?php echo $liveevents->total_participant?></td>

                                </tr>
                            <?php }}else{?>
                                 <tr>
                                    <td colspan="4" class="text-center">No Event Found</td>
                                   

                                </tr>
                            <?php }?>
                            </tbody>
                               
                           </table>
                        </div>
                        <div class="tab-pane fade" id="pills-upcoming-event" role="tabpanel" aria-labelledby="pills-upcoming-event-tab">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Organizer</th>
                                    <th>Enrolled</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cur_time = date('H:i:s');
                                if($upcoming_eventlist){
                                    foreach($upcoming_eventlist as $upcomingevents){
                                     $upcming = $upcomingevents->end_time; 
                                     
                                    ?>
                                <tr>
                                    <td><?php echo $upcomingevents->name?></td>
                                    <td><?php echo 'Lms'?></td>
                                    <td><?php echo $upcomingevents->total_event?></td>
                                   

                                </tr>
                            <?php }}else{?>
                                 <tr>
                                    <td colspan="3" class="text-center">No Event Found</td>
                                   

                                </tr>
                            <?php }?>
                            </tbody>
                               
                           </table>

                          
                        </div>
                        <div class="tab-pane fade" id="pills-past-event" role="tabpanel" aria-labelledby="pills-past-event-tab">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Organizer</th>
                                    <th>Enrolled</th>
                                     <th>Present</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cur_time = date('H:i:s');
                                if($past_eventlist){
                                    foreach($past_eventlist as $pastevents){
                                      
                                    ?>
                                <tr>
                                    <td><?php echo $pastevents->name?></td>
                                    <td><?php echo 'LMS'?></td>
                                    <td><?php echo $pastevents->total_event?></td>
                                    <td><?php echo $pastevents->total_participant?></td>

                                </tr>
                            <?php }}else{?>
                                 <tr>
                                    <td colspan="4" class="text-center">No Event Found</td>
                                   

                                </tr>
                            <?php }?>
                            </tbody>
                               
                           </table>
                        </div>
                        
                    </div>
                </div>
           
        </div>
    </div>

    <!-- live classes -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fs-17 font-weight-600 mb-0">Top Live Classes - This Month</h6>
                    </div>
              
                </div>
            </div>
          
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tabe" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-liveclasses-tab" data-toggle="pill" href="#pills-live-classes"
                                role="tab" aria-controls="pills-live-classes" aria-selected="true">Live</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-upcoming-classes-tab" data-toggle="pill" href="#pills-upcoming-classes" role="tab"
                                aria-controls="pills-upcoming-classes" aria-selected="false">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-past-liveclasses-tab" data-toggle="pill" href="#pills-past-liveclasses" role="tab"
                                aria-controls="pills-contact" aria-selected="false">Past</a>
                        </li>
                       
                    </ul>
                    <div class="tab-content" id="pills-tabeContent">
                        <div class="tab-pane fade show active" id="pills-live-classes" role="tabpanel"
                            aria-labelledby="pills-liveclasses-tab">
                           <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Instructor</th>
                                    <th>Enrolled</th>
                                    <th>Present</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cur_time = date('H:i:s');
                                if($live_classlist){
                                    foreach($live_classlist as $liveclasses){
                                   
                                    ?>
                                <tr>
                                    <td><?php echo $liveclasses->name?></td>
                                    <td><?php echo $plclasses->instructor_name?></td>
                                    <td><?php echo $liveclasses->total_liveclass?></td>
                                    <td><?php echo $liveclasses->total_participant?></td>

                                </tr>
                            <?php }}else{?>
                                 <tr>
                                    <td colspan="4" class="text-center">No Event Found</td>
                                   

                                </tr>
                            <?php }?>
                            </tbody>
                               
                           </table>
                        </div>
                        <div class="tab-pane fade" id="pills-upcoming-classes" role="tabpanel" aria-labelledby="pills-upcoming-classes-tab">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Instructor</th>
                                    <th>Enrolled</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cur_time = date('H:i:s');
                                if($upcominglive_classlist){
                                    foreach($upcominglive_classlist as $upcomingliveclass){
                                    
                                    ?>
                                <tr>
                                    <td><?php echo $upcomingliveclass->name?></td>
                                    <td><?php echo $plclasses->instructor_name?></td>
                                    <td><?php echo $upcomingliveclass->total_liveclass?></td>
                                   

                                </tr>
                            <?php }}else{?>
                                 <tr>
                                    <td colspan="3" class="text-center">No Event Found</td>
                                   

                                </tr>
                            <?php }?>
                            </tbody>
                               
                           </table>

                          
                        </div>
                        <div class="tab-pane fade" id="pills-past-liveclasses" role="tabpanel" aria-labelledby="pills-past-liveclasses-tab">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th>Event Name</th>
                                    <th>Instructor</th>
                                    <th>Enrolled</th>
                                     <th>Present</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cur_time = date('H:i:s');
                                if($plive_classlist){
                            
                                    foreach($plive_classlist as $plclasses){
                                  
                                    
                                    ?>
                                <tr>
                                    <td><?php echo $plclasses->name?></td>
                                    <td><?php echo $plclasses->instructor_name?></td>
                                    <td><?php echo $plclasses->total_liveclass?></td>
                                    <td><?php echo $plclasses->total_participant?></td>

                                </tr>
                            <?php }}else{?>
                                 <tr>
                                    <td colspan="4" class="text-center">No Event Found</td>
                                   

                                </tr>
                            <?php }?>
                            </tbody>
                               
                           </table>
                        </div>
                        
                    </div>
                </div>
           
        </div>
    </div>
    </div>
<!-- <div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <h2 class="fs-18 font-weight-bold mb-0 w-100"><?php echo display('todays_sales_report'); ?></h2>
                <div class="input-group">
                    <input type="text" id="yearmonth_todays_sales" class="form-control" value="<?php echo date('Y-m'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" onclick="yearmonthly_todaysales()"><i class="fa fa-search"> </i></button>
                    </div>
                </div>
            </div>
            <div class="card-body y-scroll-h-300">
                <table class="table" id="filtering_results">
                    <thead>
                        <tr>
                            <th width="10%"><?php echo display('sl_no'); ?></th>
                            <th width="60%"><?php echo display('course_name'); ?></th>
                            <th width="30%" class="text-right"><?php echo display('price'); ?></th>
                        </tr>
                    </thead>
                    <?php if ($todays_salesreport) { ?>
                        <tbody>
                            <?php
                            $sl = $price = 0;
                            foreach ($todays_salesreport as $salesreport) {
                                $sl++
                                ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($salesreport->name); ?></td>
                                    <td class="text-right">
                                        <?php
                                        $price += $salesreport->price;
                                        echo html_escape(($position == 1) ? "$currency $salesreport->price" : "$salesreport->price $currency");
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right"><?php echo display('total'); ?></th>
                                <th class="text-right">
                                    <?php echo html_escape((($position == 1) ? "$currency $price" : "$price $currency")); ?>
                                </th>
                            </tr>
                        </tfoot>
                    <?php } else {
                        ?>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-danger text-center"><?php echo display('record_not_found'); ?></th>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div> -->
<input type="hidden" value="<?php echo html_escape($user_type); ?>" id="user_type">
<!-- <input type="text"    value="<?php //echo '6130.00'; ?>"    id="totalEarning">
<input type="text" value="<?php //echo '1000.95';  ?>" id="totalFacultyearning">
<input type="text" value="<?php //echo '6123.05'; ?>" id="revenue"> -->
<input type="hidden" name="" id="chartlabels" value="<?php echo $chartlabel?>">
<input type="hidden" name="" id="createdcourse" value="<?php echo $today_created_course?>">

<input type="hidden" name="" id="today_published_course" value="<?php echo $today_published_course?>">
<input type="hidden" name="" id="today_purchased_course" value="<?php echo $today_purchased_course?>">
<input type="hidden" name="" id="today_nsubscribed_course" value="<?php echo $today_nsubscribed_course?>">
<input type="hidden" name="" id="today_canceled_subscribed" value="<?php echo $today_canceled_subscribed?>">
<input type="hidden" name="" id="today_liveclass" value="<?php echo $today_liveclass?>">
<input type="hidden" name="" id="today_joined_student" value="<?php echo $today_joined_student?>">
<input type="hidden" name="" id="today_joined_instructor" value="<?php echo $today_joined_instructor?>">

<input type="hidden"
    value="<?php echo (!empty($all_quickview['totalEarning']) ? round($all_quickview['totalEarning']) : 0); ?>"
    id="totalEarning">
<input type="hidden" value="<?php echo  round($all_quickview['totalFacultyearning']); ?>" id="totalFacultyearning">
<input type="hidden" value="<?php echo round($all_quickview['revenue']); ?>" id="revenue">

<input type="hidden" value="<?php echo html_escape($all_quickview['lastYearMonths']); ?>" id="lastYearMonths">
<input type="hidden" value="<?php echo html_escape($all_quickview['monthly_sales_amount']); ?>"
    id="monthly_sales_amount">
<input type="hidden" value="<?php echo html_escape($all_quickview['monthly_subscription_amount']); ?>"
    id="monthly_subscription_amount">

<input type="hidden" value="<?php echo html_escape($quick_view['active_course']); ?>" id="active_course">
<input type="hidden" value="<?php echo html_escape($quick_view['popular_course']); ?>" id="popular_course">

<script>
$('.barra-nivel').each(function() {
    var valorLargura = $(this).data('nivel');
    var valorNivel = $(this).html("<span class='valor-nivel'>" + valorLargura + "</span>");
    $(this).animate({
        width: valorLargura
    });
});


$(".circle_percent").each(function() {
    var $this = $(this),
        $dataV = $this.data("percent"),
        $dataDeg = $dataV * 3.6,
        $round = $this.find(".round_per");
    $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
    $this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
    $this.prop('Counter', 0).animate({
        Counter: $dataV
    }, {
        duration: 2000,
        easing: 'swing',
        step: function(now) {
            $this.find(".percent_text").text(Math.ceil(now));
        }
    });
    if ($dataV >= 51) {
        $round.css("transform", "rotate(" + 360 + "deg)");
        setTimeout(function() {
            $this.addClass("percent_more");
        }, 1000);
        setTimeout(function() {
            $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
        }, 1000);
    }
});

$(document).ready(function() {
    "use strict"; // Start of use strict

    var mlabel = $("#chartlabels").val();
    var splitlabel = mlabel.substring(0, mlabel.length - 1);
    var labels = splitlabel.split(",");

    // createdcourse
    var crcoursed = $("#createdcourse").val();
    var spcrsdat = crcoursed.substring(0, crcoursed.length - 1);
    var createdcourse = spcrsdat.split(",");

    //published course
    var publishedcoursed = $("#today_published_course").val();
    var pubcoursedata = publishedcoursed.substring(0, publishedcoursed.length - 1);
    var published_course = pubcoursedata.split(",");

    //purchased course
    var purchasedcoursed = $("#today_purchased_course").val();
    var purchase_coursedata = purchasedcoursed.substring(0, purchasedcoursed.length - 1);
    var purched_course = purchase_coursedata.split(",");

    //subscribed course
    var subs_course = $("#today_nsubscribed_course").val();
    var subs_data = subs_course.substring(0, subs_course.length - 1);
    var subscribed_course = subs_data.split(",");

    //cancel subscribed course
    var cancel_subs = $("#today_canceled_subscribed").val();
    var cancel_data = cancel_subs.substring(0, cancel_subs.length - 1);
    var canceled_subcribed = cancel_data.split(",");

    //live classes
    var lv_classes = $("#today_liveclass").val();
    var live_classdata = lv_classes.substring(0, lv_classes.length - 1);
    var liveclasses = live_classdata.split(",");

    //joined_stucent
    var joined_std = $("#today_joined_student").val();
    var join_stu = joined_std.substring(0, joined_std.length - 1);
    var joined_student = join_stu.split(",");

    //joined instructor
    var joined_inst = $("#today_joined_instructor").val();
    var joins_instructor = joined_inst.substring(0, joined_inst.length - 1);
    var joined_instructors = joins_instructor.split(",");

    //line chart
    var ctx = document.getElementById("lineChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: "Course Created",
                    borderColor: "#847cff",
                    borderWidth: "2",
                    backgroundColor: "rgba(0,0,0,.07)",
                    fill: false,
                    data: createdcourse
                },
                {
                    label: "Published course",
                    borderColor: "#19c9f1",
                    borderWidth: "2",
                    backgroundColor: "rgba(55, 160, 0, 0.1)",
                    fill: false,
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: published_course
                },
                {
                    label: "Purchased courses",
                    borderColor: "#0704c5",
                    borderWidth: "2",
                    backgroundColor: "rgba(36, 81, 136, 0.6)",
                    pointHighlightStroke: "rgba(36, 81, 136, 0.6)",
                    fill: false,
                    data: purched_course
                },
                {
                    label: "Live class/event",
                    borderColor: "#49a",
                    borderWidth: "2",
                    backgroundColor: "rgba(26,179,148,1)",
                    fill: false,
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: liveclasses
                },
                {
                    label: "Joined Student",
                    borderColor: "#49a",
                    borderWidth: "2",
                    backgroundColor: "rgba(0,255,0, 0.4)",
                    fill: false,
                    pointHighlightStroke: "rgba(0,255,0, 0.4)",
                    data: joined_student
                },
                {
                    label: "Joined Instructor",
                    borderColor: "#49a",
                    borderWidth: "2",
                    backgroundColor: "rgba(96, 155, 109, 0.8)",
                    fill: false,
                    pointHighlightStroke: "rgba(96, 155, 109, 0.8)",
                    data: joined_instructors
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: "#e6e6e6",
                        zeroLineColor: "#e6e6e6",
                        borderDash: [2],
                        borderDashOffset: [2],
                        drawBorder: false,
                        drawTicks: false
                    },
                    ticks: {
                        padding: 20
                    }
                }],
                xAxes: [{
                    maxBarThickness: 50,
                    gridLines: {
                        lineWidth: [0]
                    },
                    ticks: {
                        padding: 20,
                        fontSize: 14,
                        fontFamily: "'Nunito Sans', sans-serif"
                    }
                }]
            }
        }
    });
});
</script>