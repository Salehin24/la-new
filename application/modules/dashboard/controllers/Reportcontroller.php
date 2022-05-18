<?php defined('BASEPATH') or exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Reportcontroller extends MX_Controller
{

    private $user_id = "";
    private $user_type = "";

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->user_type = $this->session->userdata('user_type');
        $this->load->model('setting_model');
        // $this->load->model('Faculty_model');
        $this->load->library('generators');

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname . '/login');
    }

    public function watchtime_list(){
        $data['title'] = display('watchtime_list');
        $data['user'] = $this->db->select('*')->from('students_tbl')->get()->result();

        $data['module'] = "dashboard";
        $data['page'] = "reports/watchtime_list";
        echo modules::run('template/layout', $data);
    }

    public function watchtime_reportdata(){
        $postData = $_POST;
        $search = (object) array();
        
        // Get data
        $data = $this->getwatchtimeinstructorlist($postData, $search);
        echo json_encode($data);
    }

    public function total_watchtimecount($search = null, $searchQuery = null)
    {

        $this->db->select('a.*');
        $this->db->from('faculty_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        // $this->db->join('instructor_ledger_tbl b', 'b.user_id = a.faculty_id', 'left');
        // $this->db->join('course_tbl b', 'b.faculty_id = a.faculty_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        // $this->db->where('b.is_subscription',1);
        // $this->db->group_by('a.faculty_id');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function getwatchtimeinstructorlist($postData = null, $searchs = null)
    {
        $response = array();
        ## Read value
        $draw = @$postData['draw'];
        $start = @$postData['start'];
        $rowperpage = @$postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = "(a.name like '%" . $searchValue . "%')
            ";
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_watchtimecount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;


        // (select count(id) from section_tbl where course_id= `a`.`course_id`) as total_chapter
        // $this->db->select('a.*,sum(b.credit) as total_earnings,sum(b.duration) as total_duration');
        $coursetype = "JSON_CONTAINS(course_type, '[\"2\"]')";
        $this->db->select('a.*, (SELECT COUNT(id) FROM course_tbl WHERE faculty_id = a.faculty_id AND '.$coursetype.') as number_ofcourse,
                        (SELECT sum(credit) FROM instructor_ledger_tbl WHERE user_id = a.faculty_id AND is_subscription = 1 AND status = 1) as lifetime_earning
        ');
        $this->db->from('faculty_tbl a');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        // $this->db->join('instructor_ledger_tbl b', 'b.user_id = a.faculty_id', 'left');
        // $this->db->join('course_tbl b', 'b.faculty_id = a.faculty_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        $this->db->where('a.status',1);
        // $this->db->group_by('a.faculty_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        // echo $this->db->last_query();
        $records = $this->db->get()->result();
        $data = array();

        $sl = $start + 1;
        $action = $editbtn = $deletebtn = $statusbtn = $image = $facultynamebtn = '';

        foreach ($records as $record) {
            $i = 1;

            $course_type = "JSON_CONTAINS(course_type, '[\"2\"]')";
            $get_subscribecourse = $this->db->select('course_id')->from('course_tbl a')->where('faculty_id', $record->faculty_id)->where($course_type)->get()->result();
            $singlecourseid = array();
            foreach ($get_subscribecourse as $course) {
                $singlecourseid[] = $course->course_id;
            }

            if($singlecourseid){
                $get_subscribercount = $this->db->select('id')->from('invoice_details')->where_in('product_id', $singlecourseid)->where('is_subscription', 1)->group_by('customer_id')->get()->num_rows();

                $get_subscriptiontransaction = $this->db->select('invoice_id')->from('invoice_details')->where_in('product_id', $singlecourseid)->where('is_subscription', 1)->group_by('customer_id')->get()->result();
                $singletransactionid = array();
                foreach ($get_subscriptiontransaction as $transaction) {
                    $singletransactionid[] = $transaction->invoice_id;
                }
                
                $get_lifetimeleadearning = array();
                if($singletransactionid){
                    $get_lifetimeleadearning = $this->db->select_sum('debit')->from('academic_ledger_tbl')->where_in('transaction_id', $singletransactionid)->where('is_subscription', 1)->where('status', 1)->get()->row();
                    // echo $this->db->last_query();
                }
                // d($get_lifetimeleadearning);
                
            }else{
                $get_subscribercount = 0;
            }


            $data[] = array(
                "sl" => $sl++,
                "name" => $record->name, 
                "joiningdate" => date('d F Y', strtotime($record->created_date)),
                "number_ofcourse" => $record->number_ofcourse,
                "number_ofsubscriber" => $get_subscribercount,
                "lifetime_earning" => (!empty($record->lifetime_earning) ? number_format($record->lifetime_earning, 3) : 0),
                // "lifetime_leadearning" => (!empty($get_lifetimeleadearning->debit) ? number_format($get_lifetimeleadearning->debit, 2) : 0),
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        return $response;
    }
    public function payment_disbursement(){
        $data['title'] = display('payment_disbursement');
        // $data['user'] = $this->db->select('*')->from('students_tbl')->get()->result();

        $data['module'] = "dashboard";
        $data['page'] = "reports/payment_disbursement";
        echo modules::run('template/layout', $data);
    }

    public function paymentdisbursement_datalist(){
        $postData = $_POST;
        $search = (object) array(
            'disbursement_status' => $this->input->post('disbursement_status'),
        );
        // d($search);
        // Get data
        $data = $this->get_paymentdisbursement_datalist($postData, $search);
        echo json_encode($data);
    }

    public function total_pmtdisbursementcount($search = null, $searchQuery = null)
    {

        $this->db->select('a.*, b.name, c.bank_name, c.branch_name, c.account_name, c.account_number, c.mobile_no');
        $this->db->from('payment_withdrawrequst_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('loginfo_tbl b', 'b.log_id = a.user_id', 'left');
        $this->db->join('instructor_paymentmethods_tbl c', 'c.id = a.payment_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        if ($search->disbursement_status) {
            if($search->disbursement_status != 'all'){
                $this->db->where('a.status', $search->disbursement_status);
            }
        }
        
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        $record = $query->num_rows();
        return $record;
    }

    public function get_paymentdisbursement_datalist($postData = null, $searchs = null)
    {
        $response = array();
        ## Read value
        $draw = @$postData['draw'];
        $start = @$postData['start'];
        $rowperpage = @$postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = "(b.name like '%" . $searchValue . "%'
                            or a.request_id like '%" . $searchValue . "%'
            )"; 
        }
        ## Total number of records without filtering
        $totalRecords = $this->total_pmtdisbursementcount($searchs, $searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter = $totalRecords;


        $this->db->select('a.*, b.name, c.payment_type, c.bank_name, c.branch_name, c.account_name, c.account_number, c.mobile_no');
        $this->db->from('payment_withdrawrequst_tbl a');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('loginfo_tbl b', 'b.log_id = a.user_id', 'left');
        $this->db->join('instructor_paymentmethods_tbl c', 'c.id = a.payment_id', 'left');
        $this->db->where('a.enterprise_id', get_enterpriseid());
        
        $disbursement_status = $searchs->disbursement_status;

        if ($disbursement_status) {
            if($disbursement_status != 'all'){
                $this->db->where('a.status', $disbursement_status);
            }
        }

        $this->db->order_by('a.id', 'desc');
        $this->db->limit($rowperpage, $start);
        // echo $this->db->last_query();
        $records = $this->db->get()->result();
        $data = array();

        $sl = $start + 1;
        $action = $editbtn = $deletebtn = $statusbtn = $statusfield  = $payment_details = '';

        foreach ($records as $record) {
            $pending_status =  ($record->status == 4) ? 'selected' : '';
            $paid_status =  ($record->status == 1) ? 'selected' : '';
            $onhold_status =  ($record->status == 2) ? 'selected' : '';
            $cancelled_status =  ($record->status == 3) ? 'selected' : '';
            $i = 1;
            if($record->payment_type == 4){
                $payment_details = "Bank Name : ". $record->bank_name. ", Account Number : ". $record->account_number. ", Branch Name : ".$record->branch_name . ", Mobile No : " . $record->mobile_no;
            }else{
                $payment_details =  (!empty($record->bank_name) ? "Mobile Banking : .$record->bank_name" : ''). ' '. (!empty($record->account_number) ? "Account Number : .$record->account_number" : '');
                // $payment_details = "Mobile Banking : ". $record->bank_name. ", Account Number : ". $record->account_number;
            }

            if($record->status != 1){
            $statusfield = '<select name="lesson_type" class="form-control placeholder-single" id="lesson_type"
                                onchange="withdrawRequestStatus(this.value, '.$record->id. ",'" . $record->user_id . "'" .')" data-placeholder="select status">
                                <option value="">select status</option>
                                <option value="4" '. $pending_status .'>Pending</option>
                                <option value="1" '. $paid_status .'>Paid</option>
                                <option value="2" '. $onhold_status .'>On Hold</option>
                                <option value="3" '. $cancelled_status . '>Cancelled</option>
                            </select>';
            }else{
                $statusfield = 'Paid';
            }

            $data[] = array(
                "sl" => $sl++,
                "requestedby" => $record->name, 
                "request_id" => $record->request_id, 
                "month" => date('F', strtotime($record->date)),
                "amount" => $record->amount,
                "payment_details" => $payment_details,
                "status" => $statusfield,
                "paidby" => (!empty($record->paid_by) ? get_userinfo($record->paid_by)->name : ''),
                "payment_date" => (($record->payment_date == '0000-00-00 00:00:00') ? '' : (date('d/m/Y', strtotime($record->payment_date)))),
                "remarks" => $record->remarks,
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
        return $response;
    }

    public function withdraw_request_status(){
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
        // d($id);
        // d($user_id);
        // dd($status);
       

        if($status == 1){
            $requestdata = array(
                'status' => $status,
                'remarks' => '',
                'paid_by' => $this->user_id,
                'payment_date' => date('Y-m-d H:i:s'),
                'updated_by' => $this->user_id,
                'updated_date' => date('Y-m-d H:i:s'),
            );
            $this->db->where('id', $id)->update('payment_withdrawrequst_tbl', $requestdata);

            $get_paymentinfo = $this->db->from('payment_withdrawrequst_tbl')->where('id', $id)->get()->row();
            $amount = $get_paymentinfo->amount; 
            $transaction_id = $get_paymentinfo->request_id;;
            $instructor_ledger = array(
                'transaction_id' => $transaction_id,
                'user_id'        => $user_id,
                'course_id'      => '',
                'date'           => date('Y-m-d'),
                'description'    => 'Instructor Payment',
                'is_subscription'=> '3',
                'subscription_id'=> '',
                'duration'       => '',
                'share_percent'  => '',
                'credit'         => '',
                'debit'          => $amount,
                'status'         => 1,
                'enterprise_id ' => get_enterpriseid(),
                'created_by' => $this->user_id,
                'created_date' => date('Y-m-d H:i:s'),
               );
               $this->db->insert('instructor_ledger_tbl',$instructor_ledger);

               $academic_ledger = array(
                'transaction_id' => $transaction_id,
                // 'user_id'        => $user_id,
                'course_id'      => '',
                // 'date'           => date('Y-m-d'),
                'description'    => 'Instructor Payment',
                'is_subscription'=> '3',
                'subscription_id'=> '',
                'payment_type'       => '',
                'credit'         => $amount,
                'debit'          => '',
                'status'         => 1,
                'enterprise_id ' => get_enterpriseid(),
                'created_by' => $this->user_id,
                'created_date' => date('Y-m-d H:i:s'),
               );
               $this->db->insert('academic_ledger_tbl',$academic_ledger);
        }
        echo 1;
    }

    public function withdraw_remarks_submit(){
        $withdraw_id = $this->input->post('withdraw_id');
        $remarks = $this->input->post('remarks');
        $withdraw_status = $this->input->post('withdraw_status');
        $remarksdata = array(
            'status' => $withdraw_status,
            'remarks' => $remarks,
            'updated_by' => $this->user_id,
            'updated_date' => date('Y-m-d H:i:s'),
           );
           $this->db->where('id', $withdraw_id)->update('payment_withdrawrequst_tbl',$remarksdata);
           echo 1;
    }
  
}