<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Instructor_model extends CI_Model {


public function daily_earnings($id,$status,$day)
{
        $this->db->select('sum(a.credit) as total_earnings');
        $this->db->from('instructor_ledger_tbl a');
        $this->db->where('a.user_id', $id);
        if($day){
        $this->db->where('DATE(a.date)', $day);
         }
         $this->db->where('a.is_subscription', $status);
         
        $query = $this->db->get()->row();
        // echo $this->db->last_query();die();
        return ($query?$query->total_earnings:0);
}
public function monthly_earnings($id,$status,$month){
        $this->db->select('sum(a.credit) as total_earnings');
        $this->db->from('instructor_ledger_tbl a');
        $this->db->where('a.user_id', $id);
        if($month){
            $this->db->where('MONTH(a.date)', $month);
        }
       
        
        $this->db->where('a.is_subscription', $status);
        $this->db->where('a.status', 1);
         
        
        $query = $this->db->get()->row();

        return ($query?$query->total_earnings:0);
}

public function total_student($instructor_id, $month){
        $this->db->select('count(a.customer_id) as total_students');
        $this->db->from('invoice_details a');
        $this->db->join('course_tbl b','b.course_id = a.product_id');
        if($month){
            $this->db->where('MONTH(a.invoice_date)', $month);
         }

        $this->db->where('b.faculty_id', $instructor_id);
        $this->db->where('a.is_subscription !=', 4);
        $this->db->group_by('a.customer_id');
        $query = $this->db->get()->num_rows();
        // echo $this->db->last_query();

        // return ($query?$query->total_students:0);
        return $query;
}

public function total_courses($instructor_id,$month)
{
    $this->db->select('count(*) as total_courses');
        $this->db->from('course_tbl');
        $this->db->where('faculty_id',$instructor_id);
        $this->db->where('is_livecourse',0);
        if($month){
        $this->db->where('MONTH(created_date)', $month);
         }
        $this->db->where('status', 1);
        $query = $this->db->get()->row();

        return ($query?$query->total_courses:0);
}

public function course_list($instructor_id=null)
{
        $this->db->select('a.*,c.name as category_name,p.picture,(select count(id) from section_tbl where course_id= `a`.`course_id`) as total_chapter,(select count(id) from lesson_tbl where course_id= `a`.`course_id`) as total_lession,(select SEC_TO_TIME(SUM(TIME_TO_SEC(duration))) from lesson_tbl where course_id= `a`.`course_id` AND lesson_provider = 2) as total_duration,u.name as updatedby');
        $this->db->from('course_tbl a');
        $this->db->join('category_tbl c','a.category_id =  c.category_id','left');
        $this->db->join('section_tbl s','a.course_id = s.course_id ','left');
        $this->db->join('lesson_tbl l','a.course_id = l.course_id','left');
        $this->db->join('picture_tbl p','a.course_id = p.from_id','left');
        $this->db->join('user u','u.log_id = a.updated_by','left');
        $this->db->where('a.faculty_id',$instructor_id);
        $this->db->where('a.is_livecourse', 0);
        // $this->db->where('a.status', 1);
        $this->db->where("a.status !=", 3);
        $this->db->order_by('a.id', 'desc');
        $this->db->group_by('a.course_id');
        $query = $this->db->get()->result_array();
        return $query;
}
public function get_reviewproject($instructor_id, $enterprise_id){
    $this->db->select('a.*');
    $this->db->from('project_tbl a');
    $this->db->join('course_tbl b', 'b.course_id = a.course_id');
    $this->db->where('b.faculty_id', $instructor_id);
    $this->db->where('a.enterprise_id', $enterprise_id);
    // $this->db->where('a.publish_status', 1);
    $this->db->where('submit_status', 1);
    $this->db->where('a.type', 1);
    $this->db->order_by('a.id', 'desc');
    $query = $this->db->get();
    return $query->result();
}
public function reviewpending_projectcount($course_id){
    $this->db->where('course_id', $course_id);
    $this->db->where('project_type', 1);
    $this->db->where('project_status', 0);
    $query = $this->db->get('project_tbl');
    return $query->num_rows();
}
public function get_reviewpendingproject($course_id){
    $this->db->select('a.*, b.section_name, c.lesson_name');
    $this->db->from('project_tbl a');
    $this->db->join('section_tbl b', 'b.section_id = a.section_id', 'left');
    $this->db->join('lesson_tbl c', 'c.lesson_id = a.lesson_id', 'left');
    $this->db->where('a.course_id', $course_id);
    $this->db->where('a.project_type', 1);
    $this->db->where('a.project_status', 0);
    $query = $this->db->get();
    return $query->result();
}

public function get_courseinfo($course_id){
    $this->db->select('a.*, b.picture, c.name category_name, d.name instructor_name');
    $this->db->from('course_tbl a');
    $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
    $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
    $this->db->join('faculty_tbl d', 'd.faculty_id = a.faculty_id', 'left');
    $this->db->where('a.course_id', $course_id);
    $query = $this->db->get();
    return $query->row();
}

public function allcourse_list($instructor_id=null)
{
        $this->db->select('a.*,c.name as category_name,p.picture,(select count(id) from section_tbl where course_id= `a`.`course_id`) as total_chapter,(select count(id) from lesson_tbl where course_id= `a`.`course_id`) as total_lession,(select SEC_TO_TIME(SUM(TIME_TO_SEC(duration))) from lesson_tbl where course_id= `a`.`course_id`) as total_duration,u.name as updatedby,a.course_type as course_type,(select count(id) from coursesave_tbl where course_id= `a`.`course_id`) as total_student, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('category_tbl c','a.category_id =  c.category_id','left');
        $this->db->join('section_tbl s','a.course_id = s.course_id ','left');
        $this->db->join('lesson_tbl l','a.course_id = l.course_id','left');
        $this->db->join('picture_tbl p','a.course_id = p.from_id','left');
        $this->db->join('user u','u.log_id = a.updated_by','left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        $this->db->where('a.faculty_id',$instructor_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $this->db->group_by('a.course_id');
        $query = $this->db->get()->result();

        // $this->db->select('*');
        // $this->db->from('course_tbl a');
        // $this->db->where('a.faculty_id',$instructor_id);
        // $this->db->where('a.status', 1);
        // $this->db->group_by('a.course_id');
        // $query = $this->db->get()->result_array();
        return $query;
}

public function total_instructor_course($instructor_id,$status){
        $this->db->select('count(*) as total_courses');
        $this->db->from('course_tbl');
        $this->db->where('faculty_id',$instructor_id);
        if($status){
            $this->db->where('status', $status);
        }
         $this->db->where('is_livecourse', 0);
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        return ($query?$query->total_courses:0);
}
public function total_instructor_pendingcourse($instructor_id,$status=2){
        $this->db->select('count(*) as total_courses');
        $this->db->from('course_tbl');
        $this->db->where('faculty_id',$instructor_id);
        if($status){
            $this->db->where('status', $status);
        }
         $this->db->where('is_livecourse', 0);
         $this->db->where('is_draft', 0);
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        return ($query?$query->total_courses:0);
}

public function total_instructor_draftcourse($instructor_id)
{
        $this->db->select('count(*) as total_courses');
        $this->db->from('course_tbl');
        $this->db->where('faculty_id',$instructor_id);
        $this->db->where('is_draft', 1);
        $query = $this->db->get()->row();

        return ($query?$query->total_courses:0);
}

public function check_current_password($user_id,$current_password)
{
        $this->db->select('*');
        $this->db->from('loginfo_tbl');
        $this->db->where('log_id',$user_id);
        $this->db->where('password', md5($current_password));
        $query = $this->db->get()->num_rows();

        return $query;   
}

public function update_instructor($data=[])
{
    return  $this->db->where('log_id', $data['log_id'])
                     ->update('loginfo_tbl', $data);
}

public function change_language($instructor_id=null,$language = null)
{
        $data = array(
        'faculty_id' => $instructor_id,
        'language'   => $language
        );
       return  $this->db->where('faculty_id', $instructor_id)
                     ->update('faculty_tbl', $data);
}

public function instructor_info()
{
        $instructor_id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('faculty_tbl');
        $this->db->where('faculty_id',$instructor_id);
        $query = $this->db->get()->row();

        return $query;      
}

// public function dashboardcourse_list($instructor_id=null){
//         $this->db->select('a.*,c.name as category_name,p.picture,
//         (select count(customer_id) from invoice_details where product_id= `a`.`course_id` and status = 1) as total_student,
//         (select sum(total_price) from invoice_details where product_id= `a`.`course_id` and status = 1) as total_purchase_amount,
//         (select avg(price) from invoice_details where product_id= `a`.`course_id` and status = 1) as course_price');
//         $this->db->from('course_tbl a');
//         $this->db->join('category_tbl c','c.category_id =  a.category_id','left');
//         $this->db->join('picture_tbl p','p.from_id = a.course_id','left');
//         $this->db->where('a.faculty_id',$instructor_id);
//         // $this->db->where('a.status', 1);
//         $this->db->where("a.status !=", 3);
//         $this->db->where('a.is_livecourse', 0);
//         $this->db->group_by('a.course_id');
//         $query = $this->db->get()->result_array();
//         // echo $this->db->last_query();
//         return $query;
// }
public function dashboardcourse_list($instructor_id=null){
        $this->db->select('a.*,c.name as category_name,p.picture,
        (select count(customer_id) from invoice_details where product_id= `a`.`course_id` and status = 1) as total_student,
        (select sum(credit) from instructor_ledger_tbl where course_id= `a`.`course_id` and status = 1) as total_purchase_amount,
        (select avg(price) from invoice_details where product_id= `a`.`course_id` and status = 1) as course_price');
        $this->db->from('course_tbl a');
        $this->db->join('category_tbl c','c.category_id =  a.category_id','left');
        $this->db->join('picture_tbl p','p.from_id = a.course_id','left');
        $this->db->where('a.faculty_id',$instructor_id);
        // $this->db->where('a.status', 1);
        $this->db->where("a.status !=", 3);
        $this->db->where('a.is_livecourse', 0);
        $this->db->group_by('a.course_id');
        $query = $this->db->get()->result_array();
        // echo $this->db->last_query();
        return $query;
}


public function live_event($instructor_id=null)
{
        $this->db->select('a.*,c.meeting_date,c.start_date,c.end_date,c.start_time,c.end_time,(select count(customer_id) from invoice_details where product_id= `a`.`course_id`) as total_enroll');
        $this->db->from('course_tbl a');
        $this->db->join('meeting_tbl c','a.course_id =  c.course_id');
        $this->db->where('a.faculty_id',$instructor_id);
        $this->db->where('a.is_livecourse', 2);
        $this->db->where('a.status', 1);
        $this->db->group_by('a.course_id');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get()->result_array();
        return $query;
}

public function instructor_earnings_chartdata($instructor_id,$month=null){
        $this->db->select('sum(a.credit) as total_purchase');
        $this->db->from('instructor_ledger_tbl a');
        if($month){
        $this->db->where('MONTH(a.date)', $month);
         }
        $this->db->where('a.user_id', $instructor_id);
        $query = $this->db->get()->row();
        //  echo $this->db->last_query();
        return ($query?number_format($query->total_purchase,2):0);
}

public function yearmontinstructor_earnings_chartdata($instructor_id, $year = null, $month=null){
        $this->db->select('sum(a.credit) as total_purchase');
        $this->db->from('instructor_ledger_tbl a');
        if($year){
            $this->db->where('YEAR(a.date)', $year);
        }
        if($month){
            $this->db->where('MONTH(a.date)', $month);
        }
        $this->db->where('a.user_id', $instructor_id);
        $query = $this->db->get()->row();
        //  echo $this->db->last_query();
        return ($query?number_format($query->total_purchase,2):0);
}

public function instructor_rating($instructor_id=null)
{
       $this->db->select('a.*,(select avg(rating) from rating_tbl where course_id= `a`.`course_id`) as instructor_raring');
        $this->db->from('course_tbl a');
        $this->db->where('a.faculty_id',$instructor_id);
        $query = $this->db->get()->row();
        return ($query?$query->instructor_raring:0);
}

public function instructor_sticky_notes($instructor_id=null)
{
        $this->db->select('*');
        $this->db->from('notes_tbl');
        $this->db->where('student_id',$instructor_id);
        $this->db->order_by('created_date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
}

        public function get_offerscourses($instructor_id,$enterprise_id){
        $this->db->select('a.course_id, a.name, b.picture, c.name category_name');
        $this->db->from('course_tbl a');
        $this->db->join("picture_tbl b", 'b.from_id = a.course_id');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id');
        $this->db->where('a.faculty_id', $instructor_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_offer', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

       public function get_instructorproficiency($instructor_id){
        $this->db->select('a.*, b.logo');
        $this->db->from('user_proficiency_tbl a');
        $this->db->join('proficiency_tbl b', 'b.title = a.proficiency', 'left');
        $this->db->where('a.user_id', $instructor_id);
        $this->db->group_by('a.proficiency');
        $query = $this->db->get();
        return $query->result();
    }

        // =============== its for get_userexperience =================
    public function get_userexperience($instructor_id){
        $this->db->select('*');
        $this->db->from('experience_tbl a');
        $this->db->where('a.user_id', $instructor_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

        public function get_usereducation($instructor_id){
        $this->db->select('*');
        $this->db->from('education_tbl a');
        $this->db->where('a.log_id', $instructor_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function social_links($user_id)
    {
        $this->db->select('*');
        $this->db->from('social_links');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_featuredproject($enterprise_id, $user_id){
        $this->db->select('*');
        $this->db->from('project_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_featuredprojectportfolio($enterprise_id, $user_id){
        $this->db->select('*');
        $this->db->from('project_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.is_visibility', 1);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }
    public function get_typewisproject($type, $enterprise_id, $user_id){
        $this->db->select('*');
        $this->db->from('project_tbl a');
        if($type != 0){
            $this->db->where('a.project_type', $type);
        }
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }
    public function get_projectsingledata($project_id){
        // $this->db->select('a.*, b.name course_name, b.course_level, b.course_type, b.price, b.oldprice, b.is_discount, b.discount, b.is_offer, b.offer_courseprice, b.url,b.is_new, c.name faculty_name, d.name category_name');
        // $this->db->from('project_tbl a');
        // $this->db->join('course_tbl b', 'b.course_id = a.course_id', 'left');
        // $this->db->join('faculty_tbl c', 'c.faculty_id = b.faculty_id', 'left');
        // $this->db->join('category_tbl d', 'd.category_id = b.category_id', 'left');
        // $this->db->where('a.project_id', $project_id);
        $this->db->select('a.*,b.tagstatus,b.id,b.course_id, b.faculty_id, b.name, b.price, b.oldprice, b.summary, b.slug, '
        . 'b.course_level,b.hover_thumbnail,b.url,b.is_new,b.course_type,b.is_offer,b.offer_courseprice,b.is_discount,b.discount_type,b.discount,b.is_free, b.is_livecourse, c.picture, d.category_id, d.name as category_name, e.name instructor_name, f.name enterprise_name');
        $this->db->from('project_tbl a');
        $this->db->join('course_tbl b', 'b.course_id = a.course_id', 'left');
        $this->db->join('picture_tbl c', 'c.from_id = b.course_id', 'left');
        $this->db->join('category_tbl d', 'd.category_id = b.category_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = b.faculty_id', 'left');
        $this->db->join('loginfo_tbl f', 'f.log_id = b.enterprise_id', 'left');
        $this->db->where('a.project_id', $project_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_singleprojectdetails($project_id){
        $this->db->select('*');
        $this->db->from('project_details_tbl a');
        $this->db->where('a.project_id', $project_id);
        $this->db->order_by('a.content_sl', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_forumlist($enterprise_id = null, $instructor_id = null){
            $this->db->select('a.*, b.picture');
            $this->db->from('forum_tbl a');
            $this->db->join('picture_tbl b', 'b.from_id = a.forum_id', 'left');
            $this->db->where('a.enterprise_id', $enterprise_id);
            // $this->db->where('a.instructor_id', $instructor_id);
            $this->db->limit(100);
            $query = $this->db->get();
            return $query->result();
    }

    public function check_settingnotification($user_id){
        $query = $this->db->where('user_id', $user_id)->where('type', 2)->get('notification_config_tbl')->row();
        return $query;
    }

  public function category_list($enterprise_id = null)
{     
    //    $enterprise_id = $this->session->userdata('enterprise_id');
        $this->db->select('*');
        $this->db->from('category_tbl');
        $this->db->where('enterprise_id',$enterprise_id);
        // $this->db->where('status',1); 
        $this->db->where("status !=", 2);  
        $this->db->where('parent_id', '');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data=$query->result();
        
       $list = array('' => 'Select Category');
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->category_id]=$value->name;
            }
        }
        return $list;  
}

public function get_subcategory($category_id)
{
        $this->db->select('*');
        $this->db->from('category_tbl');
        $this->db->where('parent_id', $category_id);
        $this->db->where('status',1);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        return $query->result();
}

public function get_parentgory($category_id)
{
        $this->db->select('*');
        $this->db->from('category_tbl');
        $this->db->where('category_id', $category_id);
        $this->db->where('status',1);
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
            $result =  $query->row();
            return $result->parent_id;
        }
        return false;
}

public function related_courselist($enterprise_id)
{
        // $enterprize_id = $this->session->userdata('enterprise_id');
        $instructor_id = $this->session->userdata('user_id');

        $this->db->select('*');
        $this->db->from('course_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('faculty_id', $instructor_id);
        $this->db->where("status", 1); 
        $this->db->where('is_livecourse', 0);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data=$query->result();
        // echo $this->db->last_query();dd();
        // $list = array('' => 'Select Course');
        $list = array();
        if(!empty($data)){
            foreach ($data as $value){
                $list[$value->course_id]=$value->name;
            }
        }
        return $list;  
}

public function get_course_chapters($course_id=null)
{
        $enterprize_id = $this->session->userdata('enterprise_id');
        $this->db->select('*');
        $this->db->from('section_tbl');
        $this->db->where('enterprise_id',$enterprize_id);
        $this->db->where('course_id',$course_id);
        $this->db->order_by('section_name', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
}

public function course_info($course_id)
{
        $this->db->select('a.*,b.name as category_name,c.name as sub_category');
        $this->db->from('course_tbl a');
        $this->db->join('category_tbl b','a.category_id = b.category_id','left');
        $this->db->join('category_tbl c','a.subcategory_id = c.category_id','left');
        $this->db->where('course_id',$course_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
}

public function course_image($course_id)
{
        $this->db->select('*');
        $this->db->from('picture_tbl');
        $this->db->where('from_id',$course_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
}

public function course_chapter_list($course_id)
{
        $this->db->select('*');
        $this->db->from('section_tbl');
        $this->db->where('course_id',$course_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
}


 public function chapter_lessonLIst($course_id,$chapter_id)
 {
        $this->db->select('*');
        $this->db->from('lesson_tbl');
        $this->db->where('course_id',$course_id);
        $this->db->where('section_id',$chapter_id);
        $this->db->order_by('lesson_order',"asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function course_quizes($course_id = null, $chapter_id = null)
 {
        $this->db->select('b.*,a.*');
        $this->db->from('exam_tbl a');
        $this->db->join('assign_courseexam_tbl b','b.exam_id = a.exam_id','left');
        $this->db->where('b.course_id',$course_id);
        $this->db->where('b.section_id',$chapter_id);
        $this->db->order_by('b.quiz_order','asc');
        $this->db->group_by('a.name');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function quiz_questions($exam_id)
 {
        $this->db->select('*');
        $this->db->from('question_tbl');
        $this->db->where('exam_id',$exam_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function get_question_options($question_id=null)
 {
        $this->db->select('*');
        $this->db->from('question_option_tbl');
        $this->db->where('question_id',$question_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function chapter_assign_projects($course_id,$chapter_id)
 {
        $this->db->select('*');
        $this->db->from('project_assingment');
        $this->db->where('course_id',$course_id);
        $this->db->where('chapter_id',$chapter_id);
        $this->db->order_by('project_order',"asc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function project_distributed_marks($assing_id)
 {
        $this->db->select('*');
        $this->db->from('project_mark_details');
        $this->db->where('assignment_id',$assing_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function offer_course_list($course_id)
 {
        $this->db->select('*');
        $this->db->from('course_offers_tbl');
        $this->db->where('course_id',$course_id);
        $query = $this->db->get();
      
            $result =  $query->result_array();
        
        $offers = [];
        if($result){
        foreach($result as $row){
        
         array_push($offers,$row['course_offerid']);
        }
    }
        return $offers;
 }

 public function student_records($enterprise_id = null)
 {

        // $enterprise_id= $this->session->userdata('enterprise_id');

        $this->db->select('a.*,b.name');
        $this->db->from('daily_watch_time_tbl a');
        $this->db->join('students_tbl b','a.student_id = b.student_id');
        $this->db->where('a.date',date('Y-m-d'));
        // $this->db->where('a.date', '2022-02-28');
        $this->db->where('a.enterprise_id',$enterprise_id);
        $this->db->group_by('a.student_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function instructor_paymentdata($student_id,$date, $enterprise_id = null)
 {
        // $enterprise_id= $this->session->userdata('enterprise_id');
        $course_type = "JSON_CONTAINS(b.course_type, '[\"2\"]')";
        $run_time = '';
        $this->db->select('a.*,b.faculty_id,LEFT(SEC_TO_TIME(a.real_time),8) as seen_time,sum(a.real_time) as total_time');
        $this->db->from('daily_watch_time_tbl a');
        $this->db->join('course_tbl b','a.course_id = b.course_id','left');
        $this->db->where('a.student_id',$student_id);
        $this->db->where('a.date',$date);
        $this->db->where('a.enterprise_id',$enterprise_id);
        $this->db->where($course_type);
        $this->db->group_by('a.course_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }

 public function subscribtion_setting($enterprise_id = null)
 {
        // $enterprise_id= $this->session->userdata('enterprise_id');
        $this->db->select('*');
        $this->db->from('subscription_pricing_tbl');
        $this->db->where('enterprise_id',$enterprise_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
 }

  public function student_total_seentime($student_id,$date, $enterprise_id = null)
 {
        // $enterprise_id= $this->session->userdata('enterprise_id');
        $this->db->select('sum(real_time) as total_time');
        $this->db->from('daily_watch_time_tbl');
        $this->db->where('student_id',$student_id);
        $this->db->where('date',$date);
        $this->db->where('enterprise_id',$enterprise_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->total_time;
        }


        return false;
 }

 public function instructor_course_earnings($id,$month){
        $this->db->select('sum(a.credit) as total_earnings');
        $this->db->from('instructor_ledger_tbl a');
        $this->db->where('a.user_id', $id);
        $this->db->where('a.status', 1);
        if($month){
            $this->db->where('MONTH(a.date)', $month);
        }
        $query = $this->db->get()->row();

        return ($query?$query->total_earnings:0);
}
 public function instructor_payment($id,$month){

        $this->db->select('sum(a.debit) as total_paid');
        $this->db->from('instructor_ledger_tbl a');
        $this->db->where('a.user_id', $id);
        $this->db->where('a.status', 1);
        if($month){
        $this->db->where('MONTH(a.date)', $month);
         }
        $query = $this->db->get()->row();

        return ($query?$query->total_paid:0);
}

public function instructor_current_balance($id)
{
       $this->db->select('sum(a.credit) as total_credit,sum(a.debit) as total_debit');
        $this->db->from('instructor_ledger_tbl a');
        $this->db->where('a.user_id', $id);
        $this->db->where('a.status', 1);
        $query = $this->db->get()->row();
        
        $balance = ($query?$query->total_credit:0) - ($query?$query->total_debit:0);
        return ($balance?$balance:0);
}

public function chart_current_monthall_days(){
      $last_day =  date('t');
      $all_days = '';
        for ($i=1; $i <= $last_day; $i++) {

            if($i < 10){
                $i = '0'.$i;
            }
            $all_days.=date("Y-m-").$i.",";
            // $one_day = date("Y-m-").$i;
            // $all_days.= date("M d", strtotime($one_day)).",";
                 
            } 
            return $all_days;
}

public function earnings_chartdata($instructor_id){
       $last_day =  date('t');
       $all_data = '';
        for ($i=1; $i <= $last_day; $i++) {

            if($i < 10){
                $i = '0'.$i;
            }
            $date = date("Y-m-").$i;
            $earnings  = $this->instructor_course_earnings_daywise($instructor_id,$date);
            $all_data.=($earnings?number_format($earnings,2):0).",";
                 
            } 
            return $all_data;
}

 public function instructor_course_earnings_daywise($id,$day)
{

        $this->db->select('sum(a.credit) as total_earnings');
        $this->db->from('instructor_ledger_tbl a');
        $this->db->where('a.user_id', $id);
        $this->db->where('a.date', $day);
        $this->db->where('a.status', 1);
         
        $query = $this->db->get()->row();

        return ($query?$query->total_earnings:0);
}

public function withdrawearnings_months($instructor_id){
    $all_data = '';
    for($i=1; $i<=12; $i++){
        $month = date('M', mktime(0, 0, 0, $i, 10));
        // echo $month . ",";
        $earnings  = $this->instructor_withdrawearnings_monthwise($instructor_id,$month);
        $all_data.=($earnings?number_format($earnings,2):0).",";
    }
    return $all_data;
}

public function instructor_withdrawearnings_monthwise($id,$month){
    $year = date('Y');
     $this->db->select('sum(a.debit) as total_earnings');
     $this->db->from('instructor_ledger_tbl a');
     $this->db->where('a.user_id', $id);
     $this->db->where('MONTH(a.date)', $month);
     $this->db->where('YEAR(a.date)', $year);
     $this->db->where('a.status', 1);
      
     $query = $this->db->get()->row();

     return ($query?$query->total_earnings:0);
}

public function docusin_link($enterprise_id)
{
        $this->db->select('docusign_sample');
        $this->db->from('setting');
        $this->db->where('enterprise_id',$enterprise_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
}

public function pending_docusin($instructor_id){
        $this->db->select('*');
        $this->db->from('course_tbl a');
        // $this->db->where('a.agreement_status !=', 2);
        $this->db->where('faculty_id',$instructor_id);
        $this->db->where("a.agreement_status", 1);
        $this->db->or_where("a.agreement_status", 4);
        $this->db->or_where("a.agreement_status", 3);
        $query = $this->db->get();
        return $query->num_rows();
}

public function get_pendingagreements($instructor_id){
        $this->db->select('a.course_id, a.name, a.docusign, a.submit_agreement, a.agreement_status, a.agreement_reason, a.docusign, a.status, b.picture');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        // $this->db->where("a.status !=", 3);
        // $this->db->where("a.status !=", 1);
        // $this->db->where('a.agreement_status !=', 2); 
        $this->db->where('faculty_id',$instructor_id);       
        $this->db->where("a.agreement_status", 1);
        $this->db->or_where("a.agreement_status", 4);
        $this->db->or_where("a.agreement_status", 3);
        $query = $this->db->get();
        return $query->result();
}

public function pending_projects($instructor_id,$enterprise_id)
{
    $this->db->select('a.*');
    $this->db->from('project_tbl a');
    $this->db->join('course_tbl b', 'b.course_id = a.course_id');
    $this->db->where('b.faculty_id', $instructor_id);
    $this->db->where('a.enterprise_id', $enterprise_id);
    $this->db->where('a.project_status', 0);
    $query = $this->db->get();
    return $query->num_rows();
}

public function allcertificates($instructor_id)
{
        $this->db->select('*');
        $this->db->from('faculty_certificate_tbl');
        $this->db->where('user_id',$instructor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
}

// =========== its for get_faqlist =================
public function get_faqlist($instructor_id){
    $this->db->select('a.*, b.name');
    $this->db->from('faq_tbl a');
    $this->db->join('course_tbl b', 'b.course_id = a.course_id');
    $this->db->where('a.created_by', $instructor_id);
    $this->db->where('a.type', 1);
    $query = $this->db->get();
    return $query->result();
}

public function get_courselist($instructor_id){
       $this->db->select('a.*');
        $this->db->from('course_tbl a');
        $this->db->where('a.faculty_id', $instructor_id);
        $this->db->where('a.is_livecourse', 0);
        $this->db->where('a.is_draft', 0);
        $this->db->where("a.status !=", 3);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
}

public function downloadablefiles($course_id)
{
        $this->db->select('*');
        $this->db->from('course_resource_tbl');
        $this->db->where('course_id',$course_id);
        $this->db->where('lesson_id',null);
        $this->db->where('chapter_id',null);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
}
public function lesson_resoursefile($course_id,$lesson_id)
{
        $this->db->select('*');
        $this->db->from('course_resource_tbl');
        $this->db->where('course_id',$course_id);
        $this->db->where('lesson_id',$lesson_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
}

public function check_userpaymentmethod($user_id, $bkash = null, $nagad = null){
    $this->db->select('*');
    $this->db->from('instructor_paymentmethods_tbl');
    $this->db->where('user_id',$user_id);
    if($bkash && $nagad){
        $this->db->where('payment_type',$bkash);
        $this->db->where('payment_type',$nagad);
    }
    if($bkash){
        $this->db->where('payment_type',$bkash);
    }
    if($nagad){
        $this->db->where('payment_type',$nagad);
    }
    $query = $this->db->get();
    return $query->row();
}

public function get_usermobilebankinginfo($user_id, $paymenttype = null){
    $this->db->select('*');
    $this->db->from('instructor_paymentmethods_tbl');
    $this->db->where('user_id',$user_id);
    $this->db->where('payment_type',$paymenttype);
    $query = $this->db->get();
    return $query->row();
}

public function get_userbankinginfo($user_id, $paymenttype = null){
    $this->db->select('*');
    $this->db->from('instructor_paymentmethods_tbl');
    $this->db->where('user_id',$user_id);
    $this->db->where('payment_type',$paymenttype);
    $query = $this->db->get();
    return $query->result();
}
public function get_userpaymentinfo($user_id){
    $this->db->select('*');
    $this->db->from('instructor_paymentmethods_tbl');
    $this->db->where('user_id',$user_id);
    $query = $this->db->get();
    return $query->result();
}

public function get_userThismonthwithdrawamount($user_id, $current_month){
    $this->db->select('*');
    $this->db->from('payment_withdrawrequst_tbl');
    $this->db->where('user_id',$user_id);
    $this->db->where('MONTH(date)', $current_month);
    $query = $this->db->get();
    return $query->row();
}

public function get_withdrawrequest($user_id){
    $this->db->select('a.*, b.bank_name, b.payment_type');
    $this->db->from('payment_withdrawrequst_tbl a');
    $this->db->join('instructor_paymentmethods_tbl b', 'b.id = a.payment_id', 'left');
    $this->db->where('a.user_id',$user_id);
    $query = $this->db->get();
    return $query->result();
}


public function get_paymentmethodin_withdrawrequest($id){
    $this->db->select('*');
    $this->db->from('payment_withdrawrequst_tbl');
    $this->db->where('payment_id',$id);
    $query = $this->db->get();
    return $query->row();
}

public function get_withdrawfilterdata($data){
    // d($data);
    $this->db->select('a.*, b.bank_name');
    $this->db->from('payment_withdrawrequst_tbl a');
    $this->db->join('instructor_paymentmethods_tbl b', 'b.id = a.payment_id', 'left');
    if($data['days']){
        $today = date('Y-m-d');
        $todaystrtotime = strtotime($today);
        $targetdays = "-".$data['days'] ."day";
        // $days = strtotime("-7 day", $todaystrtotime);
        $days = strtotime("$targetdays", $todaystrtotime);
        $day = date('Y-m-d', $days);
        $this->db->where('a.date >=', $day);
    }
    if($data['monthyear']){
        $this->db->where('MONTH(a.date)', $data['monthyear']);
    }
    if($data['type']){
        $this->db->where('b.payment_type',$data['type']);
    }
    $query = $this->db->get();
    // echo $this->db->last_query();
    return $query->result();
}

}