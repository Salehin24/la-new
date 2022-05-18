<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function checkUser($data = array()) {
        return $this->db->select("
				user.id, 
				CONCAT_WS(' ', user.firstname, user.lastname) AS fullname,
				user.email, 
				user.image, 
				user.last_login,
				user.last_logout, 
				user.ip_address, 
				user.status, 
				user.is_admin, 
				IF (user.is_admin=1, 'Admin', 'User') as user_level
			")
                        ->from('user')
                        ->where('email', $data['email'])
                        ->where('password', md5($data['password']))
                        ->get();
    }

    public function userPermission($id = null) {
        return $this->db->select("
			module.controller, 
			module_permission.fk_module_id, 
			module_permission.create, 
			module_permission.read, 
			module_permission.update, 
			module_permission.delete
			")
                        ->from('module_permission')
                        ->join('module', 'module.id = module_permission.fk_module_id', 'full')
                        ->where('module_permission.fk_user_id', $id)
                        ->get()
                        ->result();
    }

    public function last_login($id = null) {
        return $this->db->set('last_login', date('Y-m-d H:i:s'))
                        ->set('ip_address', $this->input->ip_address())
                        ->where('id', $this->session->userdata('id'))
                        ->update('user');
    }

    public function last_logout($id = null) {
        return $this->db->set('last_logout', date('Y-m-d H:i:s'))
                        ->where('id', $this->session->userdata('id'))
                        ->update('user');
    }

    public function profile($id = null) {
        $this->db->select("
			a.*, 
				CONCAT_WS(' ', b.name) AS fullname,
				IF (a.is_admin=1, 'Admin', 'User') as user_level,
                a.ip_address, a.last_login, a.last_logout, a.password,b.name, b.image, d.picture
			");
        $this->db->from("loginfo_tbl a");
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('students_tbl c', 'c.student_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where("a.log_id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function setting($data = array()) {
        return $this->db->where('id', $data['id'])
                        ->update('user', $data);
    }

    public function countorder() {
        $this->db->select('*');
        $this->db->from('customer_order');
        $this->db->where('order_status!=', 5);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function countcompleteorder() {
        $this->db->select('*');
        $this->db->from('customer_order');
        $this->db->where('order_status', 4);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    //Dashboard Part Start 
    public function totalonrequisition() {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('tbl_maintenance');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $total = $query->num_rows();
        } else {
            $total = 0;
        }
        $this->db->select('*');
        $this->db->from('tbl_pickdrop_requisition');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $total = $total + $query->num_rows();
        } else {
            $total = 0 + $total;
        }
        $this->db->select('*');
        $this->db->from('tbl_refuel_requisition');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $total = $total + $query->num_rows();
        } else {
            $total = 0 + $total;
        }
        $this->db->select('*');
        $this->db->from('tbl_requisition');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $total = $total + $query->num_rows();
        } else {
            $total = 0 + $total;
        }
        return $total;
    }

    public function totalmaintenance() {
        $this->db->select('*');
        $this->db->from('tbl_maintenance');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function vrequisition() {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('tbl_requisition');
        $this->db->where('req_date', $today);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function pkdrequisition() {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('tbl_pickdrop_requisition');
        $this->db->where('effective_date', $today);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function mrequisition() {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('tbl_maintenance');
        $this->db->where('servicedate', $today);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function Frequisition() {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('tbl_refuel_requisition');
        $this->db->where('req_date', $today);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function categorywisecost() {
        $string = '';
        $totalcost = 0;
        $category = array('1' => 'Fuel', '2' => 'Maintenance', '3' => 'Other');
        foreach ($category as $catename) {
            $this->db->select('expcategory,SUM(totalcost) as amount');
            $this->db->from('tbl_expense');
            $this->db->where('expcategory', $catename);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                if (empty($row->amount)) {
                    $totalcost = 0;
                } else {
                    $totalcost = $row->amount;
                }
                if ($catename == 'Fuel') {
                    $string .= ' <div class="chart-legend-item">
                                                <div class="chart-legend-color kelly-green"></div>
                                                <p>' . $catename . ' Cost</p>
                                                <p class="percentage text-muted">' . $totalcost . '</p>
                                            </div>';
                }
                if ($catename == 'Maintenance') {
                    $string .= ' <div class="chart-legend-item">
                                                <div class="chart-legend-color kelly-green2"></div>
                                                <p>' . $catename . ' Cost</p>
                                                <p class="percentage text-muted">' . $totalcost . '</p>
                                            </div>';
                }
                if ($catename == 'Other') {
                    $string .= ' <div class="chart-legend-item">
                                                <div class="chart-legend-color whisper"></div>
                                                <p>' . $catename . ' Cost</p>
                                                <p class="percentage text-muted">' . $totalcost . '</p>
                                            </div>';
                }
            }
        }
        return $string;
    }

    public function categorywisecost2() {
        $string = '';
        $totalcost = 0;
        $category = array('1' => 'Fuel', '2' => 'Maintenance', '3' => 'Other');
        foreach ($category as $catename) {
            $this->db->select('expcategory,SUM(totalcost) as amount');
            $this->db->from('tbl_expense');
            $this->db->where('expcategory', $catename);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                if (empty($row->amount)) {
                    $totalcost = 0;
                } else {
                    $totalcost = $row->amount;
                }
                if ($catename == 'Fuel') {
                    $string .= $catename . '_' . $totalcost . ',';
                }
                if ($catename == 'Maintenance') {
                    $string .= $catename . '_' . $totalcost . ',';
                }
                if ($catename == 'Other') {
                    $string .= $catename . '_' . $totalcost;
                }
            }
        }
        return $string;
    }

    public function monthlysaleamount($year, $month) {
        $groupby = "GROUP BY YEAR(expense_date), MONTH(expense_date)";
        $amount = '';
        $wherequery = "YEAR(expense_date)='$year' AND month(expense_date)='$month' GROUP BY YEAR(expense_date), MONTH(expense_date)";
        $this->db->select('SUM(totalcost) as amount');
        $this->db->from('tbl_expense');
        $this->db->where($wherequery, NULL, FALSE);
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

//    ========== its for quick view =============
    public function quick_view($user_id, $user_type) {
        $today = date('Y-m-d');
//    ======== total course ============
        $total_course = $active_course = $popular_course = '';
        if ($user_type == 1 || $user_type == 2) {
            $total_course = $this->db->where('enterprise_id', get_enterpriseid())->where('is_livecourse', 0)->where("status !=", 3)->where('is_draft', 0)->count_all_results('course_tbl');
            $active_course = $this->db->where('status', 1)->where('is_livecourse', 0)->where('is_draft', 0)->where('enterprise_id', get_enterpriseid())->count_all_results('course_tbl');
            $popular_course = $this->db->where('is_popular', 1)->where('is_livecourse', 0)->where('is_draft', 0)->where('enterprise_id', get_enterpriseid())->count_all_results('course_tbl');
        }

        $total_faculty = $this->db->where('status', 1)->where('enterprise_id', get_enterpriseid())->count_all_results('faculty_tbl');
        $total_students = $this->db->where('status', 1)->where('enterprise_id', get_enterpriseid())->count_all_results('students_tbl');
        $total_liveevent = $this->db->where('is_livecourse', 1)->or_where('is_livecourse', 2)->where('enterprise_id', get_enterpriseid())->count_all_results('course_tbl');

        $today_lastlogin = 'date(last_login) = '."'".$today."'";
        $totaltodaylogin = $this->db->where($today_lastlogin)->where('enterprise_id', get_enterpriseid())->count_all_results('loginfo_tbl');

        $lastthirtydays = date("Y-m-d", strtotime("-30 days"));
        $tomorrow = date("Y-m-d", strtotime("+1 days"));
        $totalthirtydayslogin = $this->db
                                        // ->where('created_date >=', $lastthirtydays)
                                        // ->where('created_date <=', date("Y-m-d", strtotime("+1 days")))
                                        ->where("created_date BETWEEN '$lastthirtydays' AND '$tomorrow'")
                                        ->where('action', 'Login')
                                        ->count_all_results('activitylog_tbl');

        $totalusers = $this->db->where('status', 1)->where('enterprise_id', get_enterpriseid())->count_all_results('loginfo_tbl');
        
       
        

        $results = array(
            'total_course' => $total_course,
            'total_faculty' => $total_faculty,
            'total_students' => $total_students,
            'total_liveevent' => $total_liveevent,
            'active_course' => $active_course,
            'popular_course' => $popular_course,
            'totaltodaylogin' => (!empty($totaltodaylogin) ? $totaltodaylogin : 0),
            'totalthirtydayslogin' => (!empty($totalthirtydayslogin) ? $totalthirtydayslogin : 0),
            'totalusers' => (!empty($totalusers) ? $totalusers : 0),
        );
        return $results;
    }

//    ============= its for todays_salesreport ===========
    public function todays_salesreport($user_id, $user_type, $year, $month) {
        $where = "YEAR(a.created_date)='$year' AND month(a.created_date)='$month'";
        $todays = date('Y-m-d');
        $this->db->select('b.name, a.price');
        $this->db->from("invoice_details a");
        $this->db->join('course_tbl b', 'b.course_id = a.product_id');
        $this->db->where('a.status', 1);
        if ($year && $month) {
            $this->db->where($where);
        } else {
            $this->db->where('date(a.created_date)', $todays);
        }

        if ($user_type != 1) {
            $this->db->where('b.faculty_id', $user_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function changeformat($num) {
        if ($num > 1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            return $x_display;
        }
        return $num;
    }

    public function get_activitylog($enterprise_id){
        $this->db->select('a.*');
        $this->db->from('activitylog_tbl a');
        // $this->db->join('loginfo_tbl b', 'b.log_id = a.created_by');
        $this->db->where('a.enterprise_id', $enterprise_id);
        // $this->db->where('a.created_by', $user_id);
        $this->db->limit(200);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function topcourse($enterprise_id, $type){
        $sql_query = "SELECT a.product_id, b.name, count(a.id) AS totalenrolled, 
                        (SELECT COUNT(id) FROM coursesave_tbl WHERE course_id = a.product_id) as pursuing, 
                        (SELECT COUNT(id) FROM invoice_details WHERE product_id = a.product_id AND complete_status = 1) as completed
                        FROM invoice_details a
                        JOIN course_tbl b ON b.course_id = a.product_id
                        WHERE a.is_subscription = $type AND a.enterprise_id = '$enterprise_id'
                        GROUP BY a.product_id
                        ORDER BY count(a.id) DESC
                        limit 200";
                        // echo $sql_query;die();
        $query = $this->db->query($sql_query);
        return $query->result();
    }

    public function toplearners($enterprise_id, $type){
        $lastthirtydays = date("Y-m-d", strtotime("-30 days"));
        $today = date('Y-m-d');
        $sql_query = "SELECT a.course_id, b.name studentname, SUM(a.real_time) AS totalwatchtime, a.date,
                        (SELECT COUNT(id) FROM invoice_details WHERE customer_id = a.student_id AND is_subscription = $type) as studentenrolled,
                        (SELECT COUNT(id) FROM coursesave_tbl WHERE student_id = a.student_id) as studentpursuing,
                        (SELECT COUNT(id) FROM invoice_details WHERE customer_id = a.student_id AND is_subscription = $type AND complete_status = 1) as studentcompleted
                        FROM daily_watch_time_tbl a
                        LEFT JOIN students_tbl b ON b.student_id = a.student_id
                        LEFT JOIN invoice_details c ON c.product_id = a.course_id
                        WHERE a.date BETWEEN '$lastthirtydays' AND '$today'
                        AND c.is_subscription = $type
                        AND a.enterprise_id = '$enterprise_id'
                        GROUP BY a.student_id
                        ORDER BY SUM(a.real_time) DESC
                        limit 200";
        // $sql_query = "SELECT a.course_id, b.name studentname, SUM(a.real_time) AS totalwatchtime, a.date
        //                 FROM daily_watch_time_tbl a
        //                 LEFT JOIN students_tbl b ON b.student_id = a.student_id
        //                 LEFT JOIN invoice_details c ON c.product_id = a.course_id
        //                 WHERE date BETWEEN '$lastthirtydays' AND '$today'
        //                 AND c.is_subscription = $type
        //                 GROUP BY a.student_id
        //                 ORDER BY SUM(a.real_time) DESC";
        //                 echo $sql_query;
        $query = $this->db->query($sql_query);
        return $query->result();
    }

    public function chartlabel()
    {
         $last_day =  date('t');
         $all_days = '';
        for ($i=1; $i <= $last_day; $i++) {

            if($i < 10){
                $i = '0'.$i;
            }
            $all_days.=date("M ").$i.",";
                 
            } 
            return $all_days;
    }

    public function days_create_course($enterprise_id,$serial)
    {
        $last_day =  date('t');
        $all_data = '';
        for ($i=1; $i <= $last_day; $i++) {

            if($i < 10){
                $i = '0'.$i;
            }
            $date = date("Y-m-").$i;
            $earnings  = $this->todays_total_activecourse($enterprise_id,$date,$serial);
            $all_data.=($earnings?number_format($earnings,2):0).",";
                 
            } 
            return $all_data;
    }

    public function todays_total_activecourse($enterprise_id,$date,$serial)
    {
        if($serial == 1){
        $this->db->select('*');
        $this->db->from('course_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('DATE(created_date)', $date);
        $this->db->where('is_draft', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }
    if($serial == 2){
        $this->db->select('*');
        $this->db->from('course_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('DATE(created_date)', $date);
        $this->db->where('is_draft', 0);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
     if($serial == 3){
        $this->db->select('*');
        $this->db->from('invoice_details');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('DATE(invoice_date)', $date);
        $this->db->where('is_subscription', 0);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
     if($serial == 4){
        return 0;
    }
     if($serial == 5){
        return 0;
    }
     if($serial == 6){
        $this->db->select('*');
        $this->db->from('course_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('DATE(created_date)', $date);
        $this->db->where('status', 1);
        $this->db->where('is_livecourse', 1);
        $this->db->or_where('is_livecourse', 2);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
     if($serial == 7){
        $this->db->select('*');
        $this->db->from('loginfo_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('DATE(created_at)', $date);
        $this->db->where('user_types', 4);
        $query = $this->db->get();
        return $query->num_rows();
    }
     if($serial == 8){
        $this->db->select('*');
        $this->db->from('loginfo_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('DATE(created_at)', $date);
        $this->db->where('user_types', 5);
        $query = $this->db->get();
        return $query->num_rows();
    }

    }

    public function total_courses($enterprise_id)
    {
        $this->db->select('*');
        $this->db->from('course_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('is_draft', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function total_active_courses($enterprise_id)
    {
        $this->db->select('*');
        $this->db->from('course_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('is_draft', 0);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function total_live_event($enterprise_id)
    {
        $this->db->select('*');
        $this->db->from('course_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('status', 1);
        $this->db->where('is_livecourse', 2);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function total_live_event_finished($enterprise_id)
    {
        $cur_date = date('Y-m-d');
        $cur_time = date('H:i:s');
        $this->db->select('*');
        $this->db->from('course_tbl a');
        $this->db->join('meeting_tbl b','b.course_id = a.course_id');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 2);
        $this->db->where('b.end_date <=', $cur_date);
        $this->db->where('b.end_time <', $cur_time);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function project_created($enterprise_id)
    {
        $this->db->select('*');
        $this->db->from('project_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function project_approved($enterprise_id)
    {
        $this->db->select('*');
        $this->db->from('project_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('project_status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

     public function total_blogs($enterprise_id)
    {
        $this->db->select('*');
        $this->db->from('forum_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

     public function total_blogs_approved($enterprise_id)
    {
        $this->db->select('*');
        $this->db->from('forum_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

public function live_eventlist($enterprise_id,$type)
{
        $cur_date = date('Y-m-d');
        $cur_time = date('H:i:s');
        $cur_datetime = date('Y-m-d H:i:s');
        $this->db->select("*,CONCAT_WS(' ', b.start_date, b.start_time) AS starttime,CONCAT_WS(' ', b.end_date, b.end_time) AS endtime,(select count(id) from invoice_details where product_id= `a`.`course_id`) as total_event,(select count(id) from meeting_participant_tbl where event_id= `a`.`course_id`) as total_participant");
        $this->db->from('course_tbl a');
        $this->db->join('meeting_tbl b','b.course_id = a.course_id');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('MONTH(b.end_date)', date('m'));
        $this->db->where('a.is_livecourse', 2);
        $this->db->group_by('a.course_id');
        if($type == 1){
        $this->db->having('starttime <=', $cur_datetime); 
        $this->db->having('endtime >=', $cur_datetime); 

        }
          if($type == 2){
          
         $this->db->having('starttime >', $cur_datetime); 
          }

          if($type == 3){
         $this->db->having('endtime <', $cur_datetime);   
          }
        $this->db->having('total_event >',0);
        $this->db->order_by('total_event','desc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
}

public function live_classlist($enterprise_id,$type)
{

        $cur_date = date('Y-m-d');
        $cur_time = date('H:i:s');
        $cur_datetime = date('Y-m-d H:i:s');
        $this->db->select("a.*,b.*,CONCAT_WS(' ', b.start_date, b.start_time) AS starttime,CONCAT_WS(' ', b.end_date, b.end_time) AS endtime,(select count(id) from invoice_details where product_id= `a`.`course_id`) as total_liveclass,0 as total_participant,c.name as instructor_name");
        $this->db->from('course_tbl a');
        $this->db->join('meeting_tbl b','b.course_id = a.course_id','left');
        $this->db->join('faculty_tbl c','c.faculty_id = a.faculty_id','left');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 1);
        $this->db->where('MONTH(b.end_date)', date('m'));
        // $this->db->or_where('MONTH(b.end_date)', date('m'));
        $this->db->group_by('a.course_id');
        if($type == 1){
        $this->db->having('starttime <=', $cur_datetime); 
        $this->db->having('endtime >=', $cur_datetime); 

        }
          if($type == 2){
          
         $this->db->having('starttime >', $cur_datetime); 
          }

          if($type == 3){
         $this->db->having('endtime <', $cur_datetime);   
          }
        $this->db->having('total_liveclass >',0);
        $this->db->order_by('total_liveclass','desc');
        
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
}
    // SELECT a.course_id, a.name
    //                     FROM course_tbl a
    //                     LEFT JOIN invoice_details b ON b.product_id = a.course_id
    //                     WHERE a.is_livecourse = 2
    //                     AND a.enterprise_id = 1
    //                     ORDER BY COUNT(b.id) DESC
    //                     limit 200
}
