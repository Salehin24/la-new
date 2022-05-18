<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Home extends MX_Controller {

    private $user_id = '';
    private $user_type = '';

    public function __construct() {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->load->model(array(
            'home_model', 'Course_model', 'Faculty_model', 'setting_model'
        ));

        if (!$this->session->userdata('isLogIn')) {
            redirect('login');
        } else {
            if ($this->user_type == 4 || $this->user_type == 5 ) {
                redirect(base_url());
            }
        }
    }

//    ========== its for revenuestatus_monthyear =============
    public function revenuestatus_monthyear() {
        $yearmonth = $this->input->post('yearmonth', TRUE);
        $yearmonth = explode('-', $yearmonth);
        $revenueyear = $yearmonth[0];
        $revenuemonth = $yearmonth[1];
        // $get_facultyCourse = $this->Course_model->get_course();
        $totalFacultyearning = $totalEarning = 0;
        // foreach ($get_facultyCourse as $course) {
        //     $this->db->select('count(quantity) as quantity, product_id, price');
        //     $this->db->from('invoice_details');
        //     $this->db->where('status', 1);
        //     $this->db->where('product_id', $course->course_id);
        //     $monthyear = '';
        //     if ($revenuemonth && $revenueyear) {
        //         $monthyear = "month(created_date) = '$revenuemonth' AND year(created_date) = '$revenueyear'";
        //     } elseif ($revenueyear) {
        //         $monthyear = "year(created_date) = '$revenueyear'";
        //     } elseif ($revenuemonth) {
        //         $monthyear = "month(created_date) = '$revenuemonth'";
        //     }
        //     $this->db->where($monthyear);
        //     $invoiceDetails = $this->db->get()->row();

        //     $commissions = $this->db->select('category_id, commission')->from('commission_setup_tbl')
        //                     ->where('category_id', $course->category_id)
        //                     ->get()->row();
        //     $commission_rate = ($invoiceDetails->price * $commissions->commission) / 100;
        //     $totalFacultyearning += $invoiceDetails->quantity * $commission_rate;
        // }
        $this->db->select('sum(debit) as totalearning');
        $this->db->from('academic_ledger_tbl');
        $monthyear = '';
        if ($revenuemonth && $revenueyear) {
            $monthyear = "month(created_date) = '$revenuemonth' AND year(created_date) = '$revenueyear'";
        } elseif ($revenueyear) {
            $monthyear = "year(created_date) = '$revenueyear'";
        } elseif ($revenuemonth) {
            $monthyear = "month(created_date) = '$revenuemonth'";
        }
        // $this->db->where('status', 1);
        $this->db->where($monthyear);
        $this->db->where('status', 1);
        $totalearningInfo = $this->db->get()->row();

        $this->db->select('sum(credit) as instructorearning');
        $this->db->from('instructor_ledger_tbl');
        $monthyear = '';
        if ($revenuemonth && $revenueyear) {
            $monthyear = "month(created_date) = '$revenuemonth' AND year(created_date) = '$revenueyear'";
        } elseif ($revenueyear) {
            $monthyear = "year(created_date) = '$revenueyear'";
        } elseif ($revenuemonth) {
            $monthyear = "month(created_date) = '$revenuemonth'";
        }
        // $this->db->where('status', 1);
        $this->db->where($monthyear);
        $this->db->where('status', 1);
        $totalFacultyearning = $this->db->get()->row();


        $revenue = $totalearningInfo->totalearning - $totalFacultyearning->instructorearning;
        if (!empty($totalearningInfo->totalearning)) {
            $data['all_quickview'] = array(
                'totalEarning' => (!empty($totalearningInfo->totalearning) ? $totalearningInfo->totalearning : "0"),
                'totalFacultyearning' => $totalFacultyearning->instructorearning,
                'revenue' => $revenue,
            );
            $this->load->view('dashboard/home/revenuestatus_results', $data);
        } else {
            echo "<p class='text-center text-danger'>" . display('record_not_found') . "</p>";
        }
    }

//    ============== its for yearmonthly_salesamount ===========================
    public function yearmonthly_salesamount() {
        $yearmonth_picker_sales = $this->input->post('yearmonth_picker_sales', TRUE);
        $yearmonth_strtotime = strtotime($yearmonth_picker_sales);
        $yearmonth_explode = explode("-", $yearmonth_picker_sales);

        $salesamountyear = $yearmonth_explode[0];
        $salesamountmonth = $yearmonth_explode[1];
        $year_months = '';
        $salesamount = '';
        $salesamount = $this->yearmonthlysalesubscriptionamount($salesamountyear, $salesamountmonth, $type = 0);
        $subscriptionamount = $this->yearmonthlysalesubscriptionamount($salesamountyear, $salesamountmonth, $type = 1);
        $year_months = date('M', $yearmonth_strtotime) . "-" . date('y', $yearmonth_strtotime);

        $data['all_quickview'] = array(
            'lastYearMonths' => "'" . $year_months . "'",
            'monthly_sales_amount' => trim($salesamount, ','),
            'monthly_subscription_amount' => trim($subscriptionamount, ','),
        );
        $this->load->view('dashboard/home/yearmonthly_salesamount', $data);
    }

    public function yearmonthlysalesubscriptionamount($year, $month, $type) {
        $amount = '';
        $wherequery = "YEAR(created_date)='$year' AND month(created_date)='$month' AND is_subscription = '$type' GROUP BY YEAR(created_date), MONTH(created_date)";
        $this->db->select('round(SUM(debit),2) as amount');
        $this->db->from('academic_ledger_tbl');
        $this->db->where($wherequery, NULL, FALSE);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            foreach ($result as $row) {
                $amount .= $row->amount . ", ";
            }
            return trim($amount, ', ');
        }
        return 0;
    }

//    ================its for faculty total students =================
    public function faculty_totalstudents_count($user_id) {
        $this->db->select('a.name, a.course_id')
                ->from('course_tbl a')
                ->where('a.faculty_id', $user_id);
        $get_facultyCourse = $this->db->get()->result();
        
        $courseids = '';
        foreach ($get_facultyCourse as $facultycourse) {
            $courseids .= "'" . $facultycourse->course_id . "',";
        }
        $course_ids = rtrim($courseids, ",");
        if ($course_ids) {
            $where_in = "a.product_id IN ($course_ids)";
            $this->db->select('count(a.id) as ttlrow');
            $this->db->from('invoice_details a');
            $this->db->join('students_tbl b', 'b.student_id = a.customer_id');
            $this->db->where($where_in);
            $this->db->where('a.status', 1);
            $this->db->group_by('a.customer_id');
            $query = $this->db->count_all_results();
            return $query;
        }
    }

    public function index() {
        $data['title'] = display('home');
        $data['setting'] = $this->setting_model->read(get_enterpriseid());
        $data['quick_view'] = $this->home_model->quick_view($this->user_id, $this->user_type);
        $data['faculty_students_count'] = $this->faculty_totalstudents_count($this->user_id);
        // $get_facultyCourse = $this->Course_model->get_course();
        $data['get_activitylog'] = $this->home_model->get_activitylog(get_enterpriseid());
        $data['toppurchasescourse'] = $this->home_model->topcourse(get_enterpriseid(), $type = 0);
        $data['topsubscriptioncourse'] = $this->home_model->topcourse(get_enterpriseid(), $type = 1);
        $data['toplearnersfrompurchase'] = $this->home_model->toplearners(get_enterpriseid(), $type = 0);
        $data['toplearnersfromsubscription'] = $this->home_model->toplearners(get_enterpriseid(), $type = 1);
        // dd($data['toplearnersfrompurchase']);
        $totalFacultyearning = $totalEarning = 0;
      
        // foreach ($get_facultyCourse as $course) {
        //     $invoiceDetails = $this->db->select('count(quantity) as quantity, product_id, price')->from('invoice_details')->where('product_id', $course->course_id)->where('status', 1)->get()->row();
        //     $commissions = $this->db->select('category_id, commission')->from('commission_setup_tbl')->where('category_id', $course->category_id)->get()->row();
        //     $commission_rate = ($invoiceDetails->price * @$commissions->commission) / 100;
        //     $totalFacultyearning += $invoiceDetails->quantity * $commission_rate;
        // }
        $this->db->select('sum(debit) as totalearning');
        $this->db->from('academic_ledger_tbl');
        $this->db->where('status', 1);
        $totalearningInfo = $this->db->get()->row();

        $this->db->select('sum(credit) as instructorearning');
        $this->db->from('instructor_ledger_tbl');
        $this->db->where('status', 1);
        $totalFacultyearning = $this->db->get()->row();


        $revenue = $totalearningInfo->totalearning - $totalFacultyearning->instructorearning;

        $data['quickview_facultycourse_list'] = $this->Faculty_model->quickview_facultycourse_list($this->user_type, $this->user_id);
        
        $year = $month = '';
        $data['todays_salesreport'] = $this->home_model->todays_salesreport($this->user_id, $this->user_type, $year, $month);

        $months = '';
        $salesamount = '';
        $subscriptionamount = '';
        $salesorder = '';
        $year = date('Y');
        $numbery = date('y');
        $prevyear = $numbery - 1;
        $prevyearformat = $year - 1;
        $syear = '';
        $syearformat = '';
        for ($k = 1; $k < 13; $k++) {
            $month = date('m', strtotime("+$k month"));
            $gety = date('y', strtotime("+$k month"));
            if ($gety == $numbery) {
                $syear = $prevyear;
                $syearformat = $prevyearformat;
            } else {
                $syear = $numbery;
                $syearformat = $year;
            }

            $monthlysalesamount = $this->monthlysalesubscriptionamount($syearformat, $month, $type = 0);
            $monthlysubscriptionamount = $this->monthlysalesubscriptionamount($syearformat, $month, $type = 1);

            $salesamount .= $monthlysalesamount . ', ';
            $subscriptionamount .= $monthlysubscriptionamount . ', ';

            $months .= "" . date('M-' . $syear, strtotime("+$k month")) . ",";
        }

        $data['all_quickview'] = array(
            'totalEarning' => ($totalearningInfo->totalearning),
            'totalFacultyearning' => ($totalFacultyearning->instructorearning),
            'revenue' => ($revenue),
            'lastYearMonths' => $months,
            'monthly_sales_amount' => trim($salesamount, ','),
            'monthly_subscription_amount' => trim($subscriptionamount, ','),
        );
        $enterpriseid = get_enterpriseid();
        $data['chartlabel'] = $this->home_model->chartlabel();
        $data['today_created_course'] = $this->home_model->days_create_course($enterpriseid,1);
        $data['today_published_course'] = $this->home_model->days_create_course($enterpriseid,2);
        $data['today_purchased_course'] = $this->home_model->days_create_course($enterpriseid,3);
        $data['today_nsubscribed_course'] = $this->home_model->days_create_course($enterpriseid,4);
        $data['today_canceled_subscribed'] = $this->home_model->days_create_course($enterpriseid,5);
        $data['today_liveclass']         = $this->home_model->days_create_course($enterpriseid,6);
        $data['total_courses']           = $this->home_model->total_courses($enterpriseid);
        $data['total_active_courses']    = $this->home_model->total_active_courses($enterpriseid);

        $data['total_livevent']           = $this->home_model->total_live_event($enterpriseid);
        $data['total_livevent_finished']        = $this->home_model->total_live_event_finished($enterpriseid);

        $data['total_projects']           = $this->home_model->project_created($enterpriseid);
        $data['total_projects_approved']  = $this->home_model->project_approved($enterpriseid);

        $data['total_blogs']           = $this->home_model->total_blogs($enterpriseid);
        $data['total_blog_approved']  = $this->home_model->total_blogs_approved($enterpriseid);

        $data['live_eventlist']       = $this->home_model->live_eventlist($enterpriseid,1);
        $data['upcoming_eventlist']   = $this->home_model->live_eventlist($enterpriseid,2);
        $data['past_eventlist']   = $this->home_model->live_eventlist($enterpriseid,3);

        $data['live_classlist']       = $this->home_model->live_classlist($enterpriseid,1);
        $data['upcominglive_classlist']       = $this->home_model->live_classlist($enterpriseid,2);
        $data['plive_classlist']       = $this->home_model->live_classlist($enterpriseid,3);
        $data['today_joined_student'] = $this->home_model->days_create_course($enterpriseid,7);
        $data['today_joined_instructor'] = $this->home_model->days_create_course($enterpriseid,8);
        $data['module'] = "dashboard";
        $data['page'] = "home/home";
        echo Modules::run('template/layout', $data);
    }

    public function monthlysalesubscriptionamount($year, $month, $type) {
        $amount = '';
        $wherequery = "YEAR(a.created_date)='$year' AND month(a.created_date)='$month' AND is_subscription = '$type' AND status = 1 GROUP BY YEAR(a.created_date), MONTH(a.created_date)";
        $this->db->select('round(SUM(a.debit),2) as amount');
        $this->db->from('academic_ledger_tbl a');
        $this->db->where($wherequery, NULL, FALSE);
        // $this->db->where('a.status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            foreach ($result as $row) {
                $amount .= $row->amount . ", ";
            }
            return trim($amount, ', ');
        }
        return 0;
    }
   

    public function yearmonth_todays_sales() {
        $data['setting'] = $this->setting_model->read();
        $yearmonth_todays_sales = $this->input->post('yearmonth_todays_sales', TRUE);
        $yearmonth_todaysales_explode = explode("-", $yearmonth_todays_sales);

        $salesamountyear = $yearmonth_todaysales_explode[0];
        $salesamountmonth = $yearmonth_todaysales_explode[1];
        $data['todays_salesreport'] = $this->home_model->todays_salesreport($this->user_id, $this->user_type, $salesamountyear, $salesamountmonth);

        $this->load->view('dashboard/home/yearmonth_todays_sales', $data);
    }

    public function lastYearMonth() {
        $months = '';
        $year = date('Y');
        $numbery = date('y');
        $prevyear = $numbery - 1;
        $prevyearformat = $year - 1;
        $syear = '';
        $syearformat = '';
        for ($k = 1; $k < 13; $k++) {
            $month = date('m', strtotime("+$k month"));
            $gety = date('y', strtotime("+$k month"));
            if ($gety == $numbery) {
                $syear = $prevyear;
                $syearformat = $prevyearformat;
            } else {
                $syear = $numbery;
                $syearformat = $year;
            }
            $months .= "'" . date('M-' . $syear, strtotime("+$k month")) . "',";
        }
        return $months;
    }

    public function checkmonth() {
        $monyhyear = $this->input->post('monthyear', TRUE);
        $getmonth = date('m', strtotime($monyhyear));
        $totalmonth = $getmonth + 1;
        $year = date('Y', strtotime($monyhyear));
        $months = '';
        $salesamount = '';
        $totalorder = '';
        $numbery = date('y', strtotime($monyhyear));
        $yformat = date('Y', strtotime($monyhyear));
        $prevyear = $numbery - 1;
        $prevyearformat = $year - 1;
        $syear = '';
        $syearformat = '';
        for ($d = $totalmonth; $d < 13; $d++) {
            $month = date('m', strtotime("+$d month"));
            $gety = date('y', strtotime("+$d month"));
            if ($gety == $numbery) {
                $syear = $prevyear;
                $syearformat = $prevyearformat;
            } else {
                $syear = $prevyear;
                $syearformat = $prevyearformat;
            }
            $monthly = $this->home_model->monthlysaleamount($year, $month);
            $odernum = $this->home_model->monthlysaleorder($year, $month);
            $salesamount .= $monthly . ', ';
            $totalorder .= $odernum . ', ';
            $months .= '"' . date('F-' . $syear, strtotime("+$d month")) . '", ';
        }
        for ($k = 1; $k < $totalmonth; $k++) {
            $month = date('m', strtotime("+$k month"));
            $gety = date('y', strtotime("+$k month"));
            if ($gety == $numbery) {
                $syear = $prevyear;
                $syearformat = $prevyearformat;
            } else {
                $syear = $numbery;
                $syearformat = $yformat;
            }
            $monthly = $this->home_model->monthlysaleamount($syearformat, $month);
            $odernum = $this->home_model->monthlysaleorder($syearformat, $month);
            $salesamount .= $monthly . ', ';
            $totalorder .= $odernum . ', ';
            $months .= '"' . date('F-' . $syear, strtotime("+$k month")) . '", ';
        }
        $data["monthlysaleamount"] = trim($salesamount, ',');
        $data["monthlysaleorder"] = trim($totalorder, ',');
        $data["monthname"] = trim($months, ',');

        $data['module'] = "dashboard";
        $data['page'] = "home/searchchart";
        $this->load->view('dashboard/home/searchchart', $data);
    }

    public function profile() {
        $data['title'] = "Profile";
        $id = $this->session->userdata('user_id');
        $data['user'] = $this->home_model->profile($id);
        $data['module'] = "dashboard";
        $data['page'] = "home/profile";
        echo Modules::run('template/layout', $data);
    }

    public function setting() {
        $data['title'] = "Profile Setting";
        $id = $this->session->userdata('log_id');
        // $name = $this->input->post('firstname', TRUE) . " " . $this->input->post('lastname', TRUE);
        $name = $this->input->post('name', TRUE);
        $password = md5($this->input->post('password', TRUE));
        $oldpass = $this->input->post('oldpass', TRUE);
        if (!empty($id)) {
            $data['user'] = $this->home_model->profile($id);
        }
        $data['module'] = "dashboard";
        $data['page'] = "home/profile_setting";
        echo Modules::run('template/layout', $data);
    }

//    ============== its for profile update ==============
    public function profile_update() {
        $id = $this->session->userdata('log_id');
        $name = $this->input->post('name', TRUE);
        $mobile = $this->input->post('mobile', TRUE);
        $email = $this->input->post('email', TRUE);
        $old_image = $this->input->post('old_image', TRUE);

        $image = $this->fileupload->update_doupload(
                $id, 'assets/uploads/users/', 'image','gif|jpg|png|jpeg'
        );

        $users_info = array(
            'name' => $name,
            'email' => $email,
            'image' => (($image) ? "$image" : "$old_image"),
        );
        $this->db->where('log_id', $id)->update('user', $users_info);

        $log_info = array(
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
        );
        $this->db->where('log_id', $id)->update('loginfo_tbl', $log_info);

        $this->session->set_flashdata('message', display('update_successfully'));
        redirect('dashboard/home/setting');
    }

}
