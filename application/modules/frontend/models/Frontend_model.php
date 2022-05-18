<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Frontend_model extends CI_Model {

//============= its for check active theme ===========
    public function active_theme() {
        $query = $this->db->select('*')->from('themes_tbl')->where('status', 1)->get()->row();
        return $query;
    }

    // =============== its for get slider data ==============
    public function get_sliderdata($enterprise_id) {
        $this->db->select('a.slider_logo,a.subtitle_image,a.id, a.slider_id, a.title, a.subtitle, a.background_video_url, a.short_video_url, a.slider_point_one, a.slider_point_two, a.slider_point_three, b.picture');
        $this->db->from('slide_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.slider_id', 'left');
        $this->db->where('enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();
    }

//============= its for popular category ===========
    public function popular_category($enterprise_id) {
        $this->db->select('id, category_id, parent_id, name, is_popular');
        $this->db->from('category_tbl');
        $this->db->where('is_popular', 1);
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('status', 1);
        $this->db->order_by('ordering', 'asc');
        $this->db->limit(20);
        $query = $this->db->get()->result();
        return $query;
    }

    // ============= its for get category ===============
    public function get_category($enterprise_id) {
        $this->db->select('*');
        $this->db->from('category_tbl');
        $this->db->where('status', 1);
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('parent_id','');
        $this->db->order_by('ordering', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // =============== its for get explorecourse ============== alamin change here 16/7/21
    public function get_explorecourse($type = null, $id = null, $enterprise_id = null) {
        $this->db->select('a.toexplore,a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.hover_thumbnail,is_new,a.url,a.course_type,a.offer_courseprice,a.is_offer,a.is_discount,a.discount, a.discount_type, a.is_free, a.is_livecourse, a.enterprise_id, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        if ($type == 'popular') {
            // $this->db->where('a.is_popular',4);
            $this->db->where('a.tagstatus',4);
        } elseif ($type == 'newest') {
            // $this->db->where('a.is_new', 1);
            $this->db->where('a.tagstatus',3);
        }elseif ($type == 'recomended') {
            $this->db->where('a.tagstatus',1);
        }elseif ($type == 'bestseller') {
            $this->db->where('a.tagstatus',2);
        }elseif ($type == 'free') {
            // $this->db->where('a.is_free', 1);
            $course_type = "JSON_CONTAINS(a.course_type, '[\"3\"]')";
            $this->db->where($course_type);
        } elseif ($type == 'govt') {
            // $this->db->where('a.is_free', 1);
            $course_type = "JSON_CONTAINS(a.course_type, '[\"4\"]')";
            $this->db->where($course_type);
        }
        if ($type == 'dynamic') {
            $this->db->where('a.category_id', $id);
            $this->db->where('a.toexplore', 1);
            $this->db->or_group_start();
            $this->db->where('c.parent_id', $id);
            $this->db->where('a.status', 1);
            $this->db->where('a.toexplore', 1);
            $this->db->where('a.is_livecourse', 0);
            $this->db->group_end();
        }
        $this->db->where('a.toexplore', 1);
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit('12');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    // // =============== its for get explorecourse ==============
    // public function get_explorecourse($type = null, $id, $enterprise_id){
    //     $this->db->select('a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
    //     . 'a.course_level, a.url, a.is_free, a.is_livecourse, a.enterprise_id, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
    //     $this->db->from('course_tbl a');
    //     $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
    //     $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
    //     $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
    //     $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
    //     if($type == 'popular'){
    //         $this->db->where('a.is_popular', 1);
    //     }elseif($type == 'newest'){
    //         $this->db->where('a.is_new', 1);
    //     }elseif($type == 'free'){
    //         // $this->db->where('a.is_free', 1);
    //     $course_type="JSON_CONTAINS(a.course_type, '[\"3\"]')";
    //     $this->db->where($course_type);
    //     }elseif($type == 'govt'){
    //         // $this->db->where('a.is_free', 1);
    //     $course_type="JSON_CONTAINS(a.course_type, '[\"4\"]')";
    //     $this->db->where($course_type);
    //     }
    //     if($type == 'dynamic'){
    //         $this->db->where('a.category_id', $id);
    //     }
    //     $this->db->where('a.status', 1);
    //     $this->db->where('a.enterprise_id', $enterprise_id);
    //     $query = $this->db->get();
    //     // echo $this->db->last_query();
    //     return $query->result();
    // }
    public function excourse_count($type = null, $id = null, $enterprise_id = null) {
         $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name,'
         . 'a.course_type,a.category_id,a.is_popular,a.enterprise_id');
        $this->db->from('course_tbl a');
        if ($type == 'popular') {
            // $this->db->where('a.is_popular',4);
            $this->db->where('a.tagstatus',4);
        } elseif ($type == 'newest') {
            // $this->db->where('a.is_new', 1);
            $this->db->where('a.tagstatus',3);
        }elseif ($type == 'recomended') {
            $this->db->where('a.tagstatus',1);
        }elseif ($type == 'bestseller') {
            $this->db->where('a.tagstatus',2);
        }elseif ($type == 'free') {
            // $this->db->where('a.is_free', 1);
            $course_type = "JSON_CONTAINS(a.course_type, '[\"3\"]')";
            $this->db->where($course_type);
        } elseif ($type == 'govt') {
            // $this->db->where('a.is_free', 1);
            $course_type = "JSON_CONTAINS(a.course_type, '[\"4\"]')";
            $this->db->where($course_type);
        }
        $this->db->where('a.status', 1);
        if ($type == 'dynamic') {
            $this->db->where('a.category_id', $id);
            
            
        }
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_livecourse', 0);
        $query = $this->db->get()->num_rows();
        return $query;
    }
// =============== its for get explorecourse load more ==============alamin====16/7/21
    public function get_explorecourse_load_more($id, $lastid, $type = null, $enterprise_id = null) {
        $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.hover_thumbnail,is_new,a.course_type,a.offer_courseprice,a.is_offer,a.is_discount,a.discount, a.discount_type, a.category_id,a.is_popular,a.url,a.course_type,a.is_discount,a.discount, a.is_free, a.is_livecourse, a.enterprise_id, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        if ($type == 'popular') {
            // $this->db->where('a.is_popular', 1);
            $this->db->where('a.tagstatus', 4);
        } elseif ($type == 'newest') {
            // $this->db->where('a.is_new', 1);
            $this->db->where('a.tagstatus',3);
        }elseif ($type == 'recomended') {
            $this->db->where('a.tagstatus',1);
        }elseif ($type == 'bestseller') {
            $this->db->where('a.tagstatus',2);
        }elseif ($type == 'free') {
            $course_type = "JSON_CONTAINS(a.course_type, '[\"3\"]')";
            $this->db->where($course_type);
        } elseif ($type == 'govt') {
            $course_type = "JSON_CONTAINS(a.course_type, '[\"4\"]')";
            $this->db->where($course_type);
        }
        if ($type == 'dynamic') {
            $this->db->where('a.category_id', $id);
            $this->db->or_group_start();
            $this->db->where('c.parent_id', $id);
            $this->db->where('a.status', 1);
            $this->db->where('a.is_livecourse', 0);
            $this->db->group_end();
        }
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.id <', $lastid);
        $this->db->where('a.is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit('4');
        $query = $this->db->get();
        return $query->result();
    }

    // //============= its for popular course 
//  =========== alamin change this method 16-7-21
    public function popular_course($offset, $limit, $enterprise_id) {
        $this->db->select('a.toexplore,a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug,'
                . 'a.course_level,a.hover_thumbnail,a.is_new,a.url,a.course_type,a.offer_courseprice,a.oldprice,a.is_offer,a.is_discount,a.discount, a.discount_type, a.is_free, a.is_livecourse, a.enterprise_id, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        // $this->db->where('a.is_popular', 1);
        $this->db->where('a.tagstatus',4);
        $this->db->where('a.toexplore', 1);
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get();
        return $query->result();
    }

    // ================ its for get_coursedetails =================
    public function get_coursedetails($course_id, $enterprise_id) {
        $this->db->select('a.passing_grade,a.language,a.is_discount,a.created_date, a.syllabus,a.course_provider,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.is_offer, a.offer_courseprice, a.summary, a.slug, '
                . 'a.course_level, a.url, a.is_free, a.course_type, a.summary, a.description, a.skillsgain, '
                . 'a.requirements, a.benifits, a.is_livecourse, a.enterprise_id, a.related_courseid,a.career_outcomes,a.related_resource,a.course_result,'
                . 'b.picture,a.cover_thumbnail,c.category_id, c.name as category_name,d.name as instructor_name,d.designation,d.biography,(select count(faculty_id) from course_tbl where faculty_id= `a`.`faculty_id`) as course_count');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('faculty_tbl d', 'd.faculty_id = a.faculty_id', 'left');
        $this->db->where('a.course_id', $course_id);
        // $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }

    public function total_student_courseDetails($enterprise_id,$instructor_id=''){
	$this->db->select('count(a.customer_id) as total_students');
        $this->db->from('invoice_details a');
        $this->db->join('course_tbl b','b.course_id = a.product_id');
        $this->db->where('b.faculty_id', $instructor_id);
        $this->db->where('a.enterprise_id',$enterprise_id);
        $query = $this->db->get()->row();

        return ($query?$query->total_students:0);
    }
    public function instructor_rating_courseDetails($enterprise_id,$instructor_id=''){
        $this->db->select('a.*,(select avg(rating) from rating_tbl where course_id= `a`.`course_id`) as instructor_rating');
        $this->db->from('course_tbl a');
        $this->db->where('a.faculty_id',$instructor_id);
        $this->db->where('a.enterprise_id',$enterprise_id);
       
        $query = $this->db->get()->result();
        $rating = 0;
        foreach($query as $row){
            if($row->instructor_rating){
                $rating = $row->instructor_rating;
            }
        }
         return ($rating?$rating:0);
      }
    public function coursesaved_checked($student_id = null, $course_id = null) {
        $query = $this->db->where('student_id', $student_id)
                        ->where('course_id', $course_id)
                        ->get('coursesave_tbl')->row();
        return $query;
    }
    public function check_followinginstructor($student_id, $faculty_id, $enterprise_id){
        $this->db->select('*');
        $this->db->from('following_tbl');
        $this->db->where('student_id', $student_id);
        $this->db->where('follower_id', $faculty_id);
        $this->db->where('enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();
    }

    //  =========== its faculty courses =============
    public function get_facultycourse($offset, $limit, $enterprise_id, $faculty_id, $course_id = null) {
        $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.hover_thumbnail, a.url, a.is_free,a.is_new,a.course_type,a.offer_courseprice,a.oldprice,a.is_offer,a.discount_type,a.is_discount,a.discount, a.is_livecourse, a.enterprise_id, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');

        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.faculty_id', $faculty_id);
        $this->db->where('a.course_id !=', $course_id);
        $this->db->where('is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        // $this->db->limit($offset, $limit);
        $query = $this->db->get();

        return $query->result();


        // $this->db->select('a.*,c.name as category_name,p.picture,(select count(id) from section_tbl where course_id= `a`.`course_id`) as total_chapter,(select count(id) from lesson_tbl where course_id= `a`.`course_id`) as total_lession,(select SEC_TO_TIME(SUM(TIME_TO_SEC(duration))) from lesson_tbl where course_id= `a`.`course_id` AND lesson_provider = 2) as total_duration,u.name as updatedby');
        // $this->db->from('course_tbl a');
        // $this->db->join('category_tbl c','a.category_id =  c.category_id','left');
        // $this->db->join('section_tbl s','a.course_id = s.course_id ','left');
        // $this->db->join('lesson_tbl l','a.course_id = l.course_id','left');
        // $this->db->join('picture_tbl p','a.course_id = p.from_id','left');
        // $this->db->join('user u','u.log_id = a.updated_by','left');
        // $this->db->where('a.faculty_id',$faculty_id);
        // $this->db->where('a.is_livecourse', 0);
        // $this->db->where('a.enterprise_id', $enterprise_id);
        // $this->db->where('a.course_id !=', $course_id);
        // $this->db->where('a.status', 1);
        // $this->db->group_by('a.course_id');
        // $query = $this->db->get()->result();
        // return $query;









    }

    // ================== its for app setting ==================
    public function get_appseeting($enterpriseid) {
        $this->db->select('*');
        $this->db->from('setting');
        $this->db->where('enterprise_id', $enterpriseid);
        $query = $this->db->get();
        return $query->row();
    }

    //    ============ its for free  courses ============
    public function gov_courses($offset, $limit, $enterprise_id) {
        $this->db->select('a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.course_type,b.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id', 'left');
        $course_type = "JSON_CONTAINS(a.course_type, '[\"4\"]')";
        $this->db->where($course_type);
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function free_courses($offset, $limit, $enterprise_id) {
        $this->db->select('a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.course_type,b.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('loginfo_tbl b', 'b.log_id = a.enterprise_id', 'left');
        $course_type = "JSON_CONTAINS(a.course_type, '[\"3\"]')";
        $this->db->where($course_type);
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function category_course($category_id, $enterprise_id) {
        $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.hover_thumbnail,a.url,a.is_new,a.course_type,a.is_offer,a.offer_courseprice,a.discount_type,a.is_discount,a.discount,a.is_free, a.is_livecourse, b.picture, c.category_id, c.name as category_name, d.name instructor_name ,e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $this->db->where('a.category_id', $category_id);
        $this->db->or_group_start();
        $this->db->where('c.parent_id', $category_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $this->db->group_end();
        $this->db->limit('9');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        // exit;
        return $query;
    }

    public function load_more_course($lastid, $category_id, $enterprise_id) {
        $query = $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                                . 'a.course_level,a.hover_thumbnail,a.is_new,a.url,a.course_type,a.offer_courseprice,a.is_offer,a.is_discount,a.discount, a.is_free, a.is_livecourse, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name')
                        ->from('course_tbl a')
                        ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                        ->join('category_tbl c', 'c.category_id = a.category_id', 'left')
                        ->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left')
                        ->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left')
                        ->where('a.category_id', $category_id)
                        ->where('a.enterprise_id', $enterprise_id)
                        ->where('a.status', 1)
                        ->where('a.id <', $lastid)
                        ->where('a.is_livecourse', 0)
                        ->or_group_start()
                        ->where('c.parent_id', $category_id)
                        ->where('a.status', 1)
                        ->where('a.id <', $lastid)
                        ->where('a.is_livecourse', 0)
                        ->group_end()
                        ->limit('3')
                        ->order_by('a.id', 'desc')
                        ->get()->result();
        //    $query = $this->db->get()->result();
        return $query;
    }


    // all course 
    public function all_course($enterprise_id) {
        $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.hover_thumbnail,a.url,a.is_new,a.course_type,a.is_offer,a.offer_courseprice,a.is_discount,a.discount_type,a.discount,a.is_free, a.is_livecourse, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $this->db->limit('9');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get()->result();
        return $query;
    }

    public function load_more_allcourse($lastid,$enterprise_id){
        $query = $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
        . 'a.course_level,a.hover_thumbnail,a.url,a.is_new,a.course_type,a.is_offer,a.offer_courseprice,a.is_discount,a.discount_type,a.discount,a.is_free, a.is_livecourse, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name')
        ->from('course_tbl a')
        ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
        ->join('category_tbl c', 'c.category_id = a.category_id', 'left')
        ->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left')
        ->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left')
        ->where('a.id <', $lastid)
        ->where('a.enterprise_id', $enterprise_id)
        ->where('a.status', 1)
        ->where('a.is_livecourse', 0)
        ->limit('3')
        ->order_by('a.id', 'desc')
        ->get()->result();
        //    $query = $this->db->get()->result();
        return $query;
    }
    // course details project load more 
    public function project_load_more($lastid, $course_id, $enterprise_id) {
        $query = $this->db->select('*')
                        ->from('project_tbl a')
                        ->where('a.course_id', $course_id)
                        ->where('a.enterprise_id', $enterprise_id)
                        ->where('a.project_status', 1)
                        ->where('type',1)
                        ->where('a.id <', $lastid)
                        ->limit('4')
                        ->order_by('a.id', 'desc')
                        ->get()->result_array();
        return $query;
    }

    public function categorycourse_count($category_id, $enterprise_id) {
        // $this->db->select('a.id,a.course_id');
        $this->db->from('course_tbl a');
        $this->db->where('a.category_id', $category_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function allcourse_count($enterprise_id) {
        // $this->db->select('a.id,a.course_id');
        $this->db->from('course_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $query = $this->db->get()->num_rows();
        return $query;
    }

    // ================ its for get_testimonials =============== 
    public function get_testimonials($enterprise_id) {
        $this->db->select('*');
        $this->db->from('testimonials_tbl a');
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->result();
    }

// alamin 25/7/21
// ================ its for featuredin_list =============== 
    public function featuredin_list($enterprise_id) {
        $this->db->select('a.featuredin_id, a.name, a.link, b.picture');
        $this->db->from('featuredin_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.featuredin_id', 'left');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.type',2);
        $this->db->order_by('a.ordering', 'asc');
        // $this->db->limit(6);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_faqs($offset, $limit, $enterprise_id) {
        $this->db->select('a.*');
        $this->db->from('faq_tbl a');
        $this->db->where('a.type', 2);
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get();
        return $query->result();
    }
    public function course_get_faqs($offset, $limit, $enterprise_id,$course_id) {
        $this->db->select('a.*');
        $this->db->from('faq_tbl a');
        $this->db->where('a.type', 1);
        $this->db->where('a.course_id',$course_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get();
        return $query->result();
    }

    public function checkexistsnote($student_id = null, $course_id = null, $notes = null) {
        $this->db->select('a.*');
        $this->db->from('notes_tbl a');
        $this->db->where('a.student_id', $student_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.notes', $notes);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_coursenotes($student_id = null, $course_id = null, $lesson_id = null) {
        $this->db->select('*');
        $this->db->from('notes_tbl a');
        $this->db->where('a.student_id', $student_id);
        $this->db->where('a.type',1);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.lesson_id', $lesson_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_allnoteslist($student_id = null, $course_id = null) {
        $this->db->select('*');
        $this->db->from('notes_tbl a');
        $this->db->where('a.student_id', $student_id);
        $this->db->where('a.type',1);
        $this->db->where('a.course_id', $course_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function noteeditdata($id) {
        $this->db->select('*');
        $this->db->from('notes_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

// //    ============ its for single courseinfo ======
//     public function single_courseinfo($course_id) {
//         $this->db->select('a.*, b.picture, c.name as username, c.log_id, c.user_types, d.name as category_name, e.picture as creator_picture');
//         $this->db->from('course_tbl a');
//         $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
//         $this->db->join('loginfo_tbl c', 'c.log_id = a.faculty_id', 'left');
//         $this->db->join('category_tbl d', 'd.category_id = a.category_id', 'left');
//         $this->db->join('picture_tbl e', 'e.from_id = c.log_id', 'left');
//         $this->db->where('a.course_id', $course_id);
//         $query = $this->db->get()->row();
//         return $query;
//     }
// //    ============= its for get_customer_info ============ 
    public function get_student_info($student_id) {
        $query = $this->db->select('*')
                        ->from('students_tbl a')
                        ->where('a.student_id', $student_id)
                        ->get()->row();
        return $query;
    }

// //    ================== its for get countries ===========
    public function get_countries() {
        $this->db->select('*');
        $this->db->from('tbl_countries');
        $this->db->order_by('CountryName', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // ============== its for check_lastcourseactivity =============
    public function check_lastcourseactivity($student_id,$course_id){
        $lasactivedata = array(
            'last_activity' => $course_id,
        );
       return  $this->db->where('student_id', $student_id)->update('students_tbl', $lasactivedata);
    }
    // ============= its for lastactivitycourse =============
    public function lastactivitycourse($user_id){
        $this->db->select('a.*,b.course_id, b.name, c.name instructor_name, d.picture');
        $this->db->from('students_tbl a');
        $this->db->join('course_tbl b', 'b.course_id = a.last_activity');
        $this->db->join('faculty_tbl c', 'c.faculty_id = b.faculty_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = b.course_id', 'left');
        $this->db->where('a.student_id', $user_id);
        $query = $this->db->get();
         return $query->row();
    }

    // ============= its for check stickynote ==============
    public function check_stickynote($user_id = null, $title = null){
        $this->db->where('student_id', $user_id);
        $this->db->where('title', $title);
        $this->db->where('type', 2);
        $query = $this->db->get('notes_tbl');
        return $query->row();
    }

    // ============= its for get_studentstickynots ==============
    public function get_studentstickynotes($user_id){
        $this->db->select('*');
        $this->db->from('notes_tbl a');
        $this->db->where('a.student_id', $user_id);
        $this->db->where('a.type', 2);
        $this->db->order_by('a.id','desc');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }
    public function stickynoteenoteeditdata($id) {
        $this->db->select('*');
        $this->db->from('notes_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_templates($type){
        $this->db->select('*');
        $this->db->from('template_tbl a');
        $this->db->where('a.template_type', $type);
        $query = $this->db->get();
        return $query->result();
    }
    // =============== its for check_existscertificate_assign ==============
    public function check_existscertificate_assign($user_id, $course_id, $certificate_id){
        $this->db->select('*');
        $this->db->from('certificate_mapping_tbl a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.certificate_id', $certificate_id);
        $query = $this->db->get();
        return $query->row();
    }

    // ============= its for get_usermappingcertificate ===============
    public function get_usermappingcertificate($user_id){
        $get_usermappingcertificates =$this->db->select('a.id,a.course_id,a.created_date,a.ordering, b.title, c.name course_name')
        ->from('certificate_mapping_tbl a')
        ->join('template_tbl b', 'b.id = a.certificate_id')
        ->join('course_tbl c', 'c.course_id = a.course_id')
        ->where('a.user_id', $user_id)
        ->order_by('ordering', 'asc')
        ->get()
        ->result(); 
        return $get_usermappingcertificates;
        // $this->db->select('a.id, a.created_date, b.title, c.name course_name');
        // $this->db->from('certificate_mapping_tbl a');
        // $this->db->join('template_tbl b', 'b.id = a.certificate_id');
        // $this->db->join('course_tbl c', 'c.course_id = a.course_id');
        // $this->db->where('a.user_id', $user_id);
        // $query = $this->db->get();
        // return $query->result(); 
    }

    // ============= its for get_usermappingcertificate ===============
    public function templatesInfo($id){
        $this->db->select('a.id, a.created_date, b.*');
        $this->db->from('certificate_mapping_tbl a');
        $this->db->join('template_tbl b', 'b.id = a.certificate_id');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row(); 
    }


// //    =============== its for category_course ============
//     public function category_course($category_id) {
//         $this->db->select('a.*, b.picture, c.category_id, c.name as category_name');
//         $this->db->from('course_tbl a');
//         $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
//         $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
//         $this->db->where('a.category_id', $category_id);
//         $this->db->where('a.status', 1);
//         $this->db->limit('24');
//         $this->db->order_by('a.id', 'desc');
//         $query = $this->db->get()->result();
//         return $query;
//     }
// //    =============== its for get relatedcourse ============
//     public function get_relatedcourse($category_id, $course_id) {
//         $this->db->select('a.*, b.picture, c.name as category_name');
//         $this->db->from('course_tbl a');
//         $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
//         $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
//         $this->db->where('a.category_id', $category_id);
//         $this->db->where('a.course_id !=', $course_id);
//         $this->db->where('a.status', 1);
//         $this->db->limit('4');
//         $this->db->order_by('a.id', 'desc');
//         $query = $this->db->get()->result();
//         return $query;
//     }
// //    ============ its for courses ============
//     public function courses($offset, $limit) {
//         $this->db->select('a.course_id, a.faculty_id, a.name, a.summary, a.category_id, a.course_level, a.price,'
//                 . 'a.slug, a.is_free, a.is_livecourse, b.picture, c.name as category_name');
//         $this->db->from('course_tbl a');
//         $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
//         $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
//         $this->db->where('a.status', 1);
//         $this->db->limit($offset, $limit);
//         $this->db->order_by('a.id', 'desc');
//         $query = $this->db->get()->result();
//         return $query;
//     }
// //    ============ its for popular courses ============
//     public function popular_courses($offset, $limit) {
//         $this->db->select('a.course_id, a.faculty_id, a.name, a.summary, a.category_id, a.course_level, '
//                 . 'a.price, a.slug, a.is_free, b.picture, c.name as category_name');
//         $this->db->from('course_tbl a');
//         $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
//         $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
//         $this->db->where('a.is_popular', 1);
//         $this->db->where('a.status', 1);
//         $this->db->limit($offset, $limit);
//         $this->db->order_by('a.id', 'desc');
//         $query = $this->db->get()->result();
//         return $query;
//     }
// //    ============ its for free courses ============
//     public function free_courses($offset, $limit) {
//         $this->db->select('a.course_id, a.faculty_id, a.name, a.summary, a.category_id, a.course_level, a.is_livecourse,'
//                 . 'b.picture, a.price, a.slug, a.is_free, c.name as category_name');
//         $this->db->from('course_tbl a');
//         $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
//         $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
//         $this->db->where('a.is_free', 1);
//         $this->db->where('a.status', 1);
//         $this->db->order_by('a.id', 'desc');
//         $this->db->limit($offset, $limit);
//         $query = $this->db->get()->result();
//         return $query;
//     }
// //    ========== its for rating feedback ===============
//     public function rating_feedback($course_id) {
//         $sql = "SELECT (SELECT COUNT(id) FROM customer_review_tbl WHERE rating = 5 AND product_id = '$course_id') as 'star5', 
// 	(SELECT COUNT(id) FROM customer_review_tbl WHERE rating = 4 AND product_id = '$course_id') as 'star4', 
// 	(SELECT COUNT(id) FROM customer_review_tbl WHERE rating = 3 AND product_id = '$course_id') as 'star3', 
// 	(SELECT COUNT(id) FROM customer_review_tbl WHERE rating = 2 AND product_id = '$course_id') as 'star2',
// 	(SELECT COUNT(id) FROM customer_review_tbl WHERE rating = 1 AND product_id = '$course_id') as 'star1',
//         (SELECT COUNT(id) FROM customer_review_tbl WHERE product_id = '$course_id' AND is_rating = 1) as totalrating_count,
//         (SELECT COUNT(review) FROM customer_review_tbl WHERE product_id = '$course_id' AND is_review = 1) as totalreview_count,
//         (SELECT sum(rating) FROM customer_review_tbl WHERE product_id = '$course_id') as 'totalrating_sum' ";
//         $query = $this->db->query($sql);
//         return $query->row();
//     }
// //    =========== its for rating review =============
    public function rating_review($couse_id,$enterprise_id) {
        $this->db->select('a.*, b.*,c.*,a.created_date as review_date');
        $this->db->from('rating_tbl a');
        $this->db->join('students_tbl b', 'b.student_id = a.user_id', 'left');
        $this->db->join('picture_tbl c', 'c.from_id = a.user_id','left');
        $this->db->where('a.course_id', $couse_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->order_by('a.id', 'desc');
        $this->db->where('a.status',1);
        $this->db->limit(5);
        $query = $this->db->get();
      return  $query->result();

    }
    public function rating_review_byId($couse_id,$enterprise_id,$student_id) {
        $this->db->select('a.*, b.*,c.*,a.created_date as review_date');
        $this->db->from('rating_tbl a');
        $this->db->join('students_tbl b', 'b.student_id = a.user_id', 'left');
        $this->db->join('picture_tbl c', 'c.from_id = a.user_id','left');
        $this->db->where('a.course_id', $couse_id);
        $this->db->where('a.user_id', $student_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->order_by('a.id', 'desc');
        $this->db->where('a.status',1);
        $this->db->limit(5);
        $query = $this->db->get();
      return  $query->row();

    }
//     //    ============ its for getproduct_rating ========
//     public function getcourse_rating($product_id) {
//         $query = $this->db->select('a.name, count(b.id) as total_person, sum(b.rating) as total_rating')
//                         ->from('course_tbl a')
//                         ->join('customer_review_tbl b', 'b.product_id = a.course_id', 'left')
//                         ->where('a.course_id', $product_id)
//                         ->get()->row();
//         return $query;
//     }
// //    ========== its for register login mobile check ==============
    public function get_mobilenocheck($mobile = null, $utype = null, $enterprise_id = null) {
        $this->db->select('mobile');
        $this->db->from('loginfo_tbl');
        $this->db->where('mobile', $mobile);
        $this->db->where('user_types', $utype);
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('status', 1);
        $query = $this->db->get()->row();
        // echo $this->db->last_query();
        return $query;
    }
// //    ========== its for register login mail check ==============
    public function get_mailcheck($email = null) {
        $this->db->select('email');
        $this->db->from('loginfo_tbl');
        $this->db->where('email', $email);
        $this->db->where('status', 1);
        $query = $this->db->get()->row();
        return $query;
    }

    public function get_usernamecheck($username = null) {
        $this->db->select('*');
        $this->db->from('loginfo_tbl');
        $this->db->where('username', $username);
        $this->db->where('status', 1);
        $query = $this->db->get()->row();
        return $query;
    }

//     //    ============ its for my course list ===============
    public function mycourse($user_id = null) {
        $query = $this->db->select("b.name, b.course_id, b.summary, b.slug, a.price, c.picture")
                        ->from('invoice_details a')
                        ->join('course_tbl b', 'b.course_id = a.product_id', 'left')
                        ->join('picture_tbl c', 'c.from_id = a.product_id', 'left')
                        // ->join('invoice_tbl d', 'd.invoice_id = a.invoice_id', 'left') //new line add
                        ->order_by('a.id', 'desc')
                        ->group_by('a.product_id')
                        ->where('b.is_livecourse', 0)
                       ->where('b.is_draft', 0)
                        ->where('a.status', 1)
                        ->where('a.customer_id', $user_id)
                        ->get()->result();
                        // echo $this->db->last_query();
        return $query;
    }
// =====StudentCourse Overview=========================
    public function studentCourseOverview($user_id,$enterprise_id){
              return   $this->db->select('a.is_subscription,a.invoice_id,a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id, d.picture,e.name instructor_name')
                      ->from('invoice_details a')
                      ->join('course_tbl c','c.course_id=a.product_id')
                      ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
                      ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
                      ->where('a.customer_id',$user_id)
                      ->where('a.enterprise_id',$enterprise_id)
                      ->where('a.is_subscription !=',4)
                      ->where('a.status',1)
                      ->group_by('a.product_id')
                      ->order_by('a.id', 'desc')
                      ->limit(3)
                      ->get()->result();

              
        // $query=$this->db->select('a.customer_id,a.invoice_id,a.subscription_id,b.product_id,c.course_id,d.name as course_name,d.faculty_id,f.name as course,f.faculty_id as instructor_id')
        // ->from('invoice_tbl a')
        // ->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left')
        // ->join('course_tbl f', 'f.course_id = b.product_id', 'left') // just draw this query get facaltiy name
        // ->join('subscription_course_tbl c', 'c.subscription_id = a.subscription_id', 'left')
        // ->join('course_tbl d', 'd.course_id = c.course_id', 'left')  // just draw this query get facaltiy name
        // ->where('a.customer_id',$user_id)
        // ->where('a.enterprise_id',$enterprise_id)
        // ->group_by('c.course_id')
        // ->group_by('b.product_id')
        // ->where('a.status',1)
        // ->order_by('a.id','desc')
        // ->limit(3)
        // ->get()->result();
        // // echo $this->db->last_query();
        // // exit;
        // return $query;
    }

    // =================== its for get_offerscourses ================
    public function get_offerscourses($enterprise_id){
        $this->db->select('a.course_id, a.name, b.picture, c.name category_name');
        $this->db->from('course_tbl a');
        $this->db->join("picture_tbl b", 'b.from_id = a.course_id');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_offer', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    // ================= its for get_liveevents ===============
    public function upcoming_liveevents($enterprise_id){
        $student_id =  $this->session->userdata('user_id');
        $now = date('Y-m-d');
        $this->db->select('a.course_id, a.name, a.event_date, c.name category_name, 
        (select count(id) from invoice_details where customer_id = "'.$student_id.'" AND product_id = a.course_id) as countevent
        ');
        $this->db->from('course_tbl a');
        // $this->db->join('meeting_tbl b', 'a.course_id = b.course_id');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.event_date >=', $now);
        $this->db->where('a.status',1);
        // $this->db->where('a.is_livecourse', 1);
        // $this->db->or_where('a.is_livecourse', 2);
        // $this->db->group_by('b.course_id');
        $this->db->order_by('a.id', 'desc');
        $this->db->limit('10');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    // =============== its for get_followereinstructor ==================
    public function get_followereinstructor($user_id, $enterprise_id){
        $this->db->select('a.*, b.name, b.designation, c.picture');
        $this->db->from('following_tbl a');
        $this->db->join('faculty_tbl b', 'b.faculty_id = a.follower_id');
        $this->db->join('picture_tbl c', 'c.from_id = a.follower_id', 'left');
        $this->db->where('a.student_id', $user_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->result();
    }
    // =============== its for follower new course count =====================
    public function get_newcoursecount($instructor_id, $enterprise_id){
        $currentdate = date('Y-m-d');
        $fromdate =  date("Y-m-d", strtotime("-1 month"));
        $this->db->select('count(a.id) as newcourse');
        $this->db->from('course_tbl a');
        $this->db->where('DATE(a.created_date) >=', $fromdate);
        $this->db->where('DATE(a.created_date) <=', $currentdate);
        $this->db->where('a.enterprise_id',$enterprise_id);
        $this->db->where('a.faculty_id',$instructor_id);
        $this->db->where('a.status',1);
        $query = $this->db->get();
        return $query->row();
    }
    // =============== its for follower get_newoffercoursecount =====================
    public function get_newoffercoursecount($instructor_id, $enterprise_id){
        $currentdate = date('Y-m-d');
        $fromdate =  date("Y-m-d", strtotime("-1 month"));
        $this->db->select('count(a.id) as offercourse');
        $this->db->from('course_tbl a');
        $this->db->where('DATE(a.created_date) >=', $fromdate);
        $this->db->where('DATE(a.created_date) <=', $currentdate);
        $this->db->where('a.enterprise_id',$enterprise_id);
        $this->db->where('a.faculty_id',$instructor_id);
        $this->db->where('a.is_offer',1);
        $this->db->where('a.status',1);
        $query = $this->db->get();
        return $query->row();
    }
  
    // =============== its for follower get_newforumcount =====================
    public function get_newforumcount($enterprise_id){
        $currentdate = date('Y-m-d');
        $fromdate =  date("Y-m-d", strtotime("-1 month"));
        $this->db->select('count(a.id) as newforumcount');
        $this->db->from('forum_tbl a');
        $this->db->where('DATE(a.created_date) >=', $fromdate);
        $this->db->where('DATE(a.created_date) <=', $currentdate);
        $this->db->where('a.enterprise_id',$enterprise_id);
        $this->db->where('a.status',1);
        $query = $this->db->get();
        return $query->row();
    }
      // =============== its for follower get_newlivecoursecount =====================
      public function get_newlivecoursecount($instructor_id, $enterprise_id){
        $currentdate = date('Y-m-d');
        $fromdate =  date("Y-m-d", strtotime("-1 month"));
        $this->db->select('count(a.id) as livecoursecount');
        $this->db->from('course_tbl a');
        $this->db->where('DATE(a.created_date) >=', $fromdate);
        $this->db->where('DATE(a.created_date) <=', $currentdate);
        $this->db->where('a.enterprise_id',$enterprise_id);
        $this->db->where('a.faculty_id',$instructor_id);
        $this->db->where('a.is_livecourse',1);
        $this->db->where('a.status',1);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_courses($enterprise_id = null, $user_id = null){
        $this->db->select('a.id, a.course_id, a.name');
        $this->db->from('course_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        if($user_id){
            $this->db->where('a.faculty_id', $user_id);
        }
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    public function CourseOverviewPagination($user_id,$enterprise_id,$offset=null, $limit=null){
        return $this->db->select('a.is_subscription,a.invoice_id,a.product_id,a.customer_id,a.enterprise_id,c.name as course_name,c.faculty_id, d.picture,e.name instructor_name')
        ->from('invoice_details a')
        ->join('course_tbl c','c.course_id=a.product_id')
        ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
        ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
        ->where('a.customer_id',$user_id)
        ->where('a.enterprise_id',$enterprise_id)
        ->where('a.is_subscription !=',4)
        ->where('a.status',1)
        ->group_by('a.product_id')
        ->limit($offset,$limit)
        ->get()->result();
    }
    
// =====all enrolled course here======[Subscription,Purchase,Free,Gov]===================
    public function studentCompleteCourseOverview($user_id,$enterprise_id){
        // $query=$this->db->select('a.customer_id,a.invoice_id,a.subscription_id,b.product_id,c.course_id,d.name as course_name,d.faculty_id,f.name as course,f.faculty_id as instructor_id')
        // ->from('invoice_tbl a')
        // ->join('invoice_details b', 'b.invoice_id = a.invoice_id', 'left')
        // ->join('course_tbl f', 'f.course_id = b.product_id', 'left') // just draw this query get facaltiy name
        // ->join('subscription_course_tbl c', 'c.subscription_id = a.subscription_id', 'left')
        // ->join('course_tbl d', 'd.course_id = c.course_id', 'left')  // just draw this query get facaltiy name
        // ->where('a.customer_id',$user_id)
        // ->where('a.enterprise_id',$enterprise_id)
        // ->group_by('c.course_id')
        // ->group_by('b.product_id')
        // ->where('a.status',1)
        // ->order_by('a.id','desc')
        // ->get()->result();
        $query=$this->db->select('a.product_id,a.customer_id,a.enterprise_id,c.is_free,c.discount_type,c.offer_courseprice,c.tagstatus,c.hover_thumbnail,c.discount,c.is_offer,c.oldprice,c.is_discount,c.url,c.price,c.name as course_name,c.faculty_id,c.course_level,c.course_type,d.picture,e.name instructor_name,f.name as category_name,c.is_new,g.name enterprise_name')
        ->from('invoice_details a')                       
        ->join('course_tbl c','c.course_id=a.product_id')
        ->join('category_tbl f','f.category_id=c.category_id')
        ->join('picture_tbl d', 'd.from_id = a.product_id', 'left')
        ->join('loginfo_tbl e', 'e.log_id = c.faculty_id', 'left')
        ->join('loginfo_tbl g', 'g.log_id = c.enterprise_id', 'left')
        ->where('a.customer_id',$user_id)
        ->where('a.enterprise_id',$enterprise_id)
        ->where('a.status',1)
        ->where('a.complete_status',1)
        ->group_by('a.product_id')
        ->get()->result();

        return $query;
    }
   public function studentSkillProgress($user_id,$enterprise_id){
       return $this->db->select('b.category_id,c.name as category_name,count(b.category_id) as totalSale,b.course_id,a.customer_id')
        ->from('invoice_details a')
        ->join('course_tbl b','b.course_id=a.product_id')
        ->join('category_tbl c','c.category_id=b.category_id')
        ->where('a.customer_id',$user_id)
        ->where('a.enterprise_id',$enterprise_id)
        ->where('a.status',1)
        ->group_by('b.category_id')
        ->get()->result();
   }
   public function studentSkill_category_wise_course($category_id,$user_id,$enterprise_id){
       return $this->db->select('b.category_id,b.course_id,a.customer_id')
        ->from('invoice_details a')
        ->join('course_tbl b','b.course_id=a.product_id')
        // ->join('category_tbl c','c.category_id=b.category_id')
        ->where('b.category_id',$category_id)
        ->where('a.customer_id',$user_id)
        ->where('a.enterprise_id',$enterprise_id)
        ->where('a.status',1)
        ->where('b.is_livecourse', 0)
        // ->group_by('b.category_id')
        ->get()->result();
   }
    //======= its for count saved course =============
    public function countsavedcourse($user_id = null) {
        $this->db->select('*');
        $this->db->from('coursesave_tbl a');
        $this->db->where('a.student_id', $user_id);
        $this->db->where('a.status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    // ============== its for get saved course by student ==========================
    public function get_savedcousebystudent($user_id = null){
        $this->db->select('a.*, b.name,b.tagstatus,b.id,b.course_id,b.created_date, b.faculty_id, b.name, b.price, b.oldprice, b.summary, b.slug, '
        . 'b.course_level,b.hover_thumbnail,b.is_new,b.url,b.is_offer,b.offer_courseprice,b.course_type,b.is_discount,b.discount_type,b.discount, b.is_free, b.is_livecourse, b.enterprise_id, c.picture');
        $this->db->from('coursesave_tbl a');
        $this->db->join('course_tbl b', 'b.course_id = a.course_id', 'left');
        $this->db->join('picture_tbl c', 'c.from_id = a.course_id', 'left');
        $this->db->where('a.student_id', $user_id);
        $this->db->where('a.status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_interestedcourse($offset, $limit, $enterprise_id, $course_id = null) {
        $this->db->select('b.id, b.course_id, b.faculty_id, b.name, b.price, b.oldprice, b.summary, b.slug, '
                . 'b.course_level, b.url, b.is_free, b.is_livecourse, b.enterprise_id, c.picture, d.category_id, d.name as category_name, e.name enterprise_name');
        $this->db->from('coursesave_tbl a');
        $this->db->join('course_tbl b', 'b.course_id = a.course_id', 'left');
        $this->db->join('picture_tbl c', 'c.from_id = a.course_id', 'left');
        $this->db->join('category_tbl d', 'd.category_id = b.category_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = b.enterprise_id', 'left');
        $this->db->where('b.status', 1);
        $this->db->where('b.enterprise_id', $enterprise_id);
        $this->db->where('a.course_id !=', $course_id);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit($offset, $limit);
        $query = $this->db->get();
        return $query->result();
    }

    // ============ its for get_courseexam =================
    public function get_courseexam($course_id, $enterprise_id){
        $this->db->select('a.*, b.name');
        $this->db->from('assign_courseexam_tbl a');
        $this->db->join('exam_tbl b', 'b.exam_id = a.exam_id', 'left');
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();
    }

    // ============= its for get_subscriptioninfo ===================
    public function get_subscriptioninfo($enterprise_id){
        $this->db->select("*");
        $this->db->from('subscription_tbl');
        // $this->db->where('subscription_id', $subscription_id);
        $this->db->where('enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->result();

    }
    public function get_subscriptioncheckoutinfo($subscription_id,$enterprise_id){
        $this->db->select("*");
        $this->db->from('subscription_tbl');
        $this->db->where('subscription_id', $subscription_id);
        $this->db->where('enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->row();

    }


    // ============= its for get_coursequiz ================
    public function get_coursequiz($course_id){
        $this->db->select('*');
        $this->db->from('assign_courseexam_tbl a');
        $this->db->join('exam_tbl b', 'b.exam_id = a.exam_id');
        $this->db->where('a.course_id', $course_id);
        $query = $this->db->get();
        return $query->result();
    }

    // =============== its for check coursequiz ============
    public function check_coursequiz($student_id, $course_id, $exam_id){
        $this->db->select('a.*');
        $this->db->from('question_exam_tbl a');
        $this->db->where('a.student_id', $student_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.exam_id', $exam_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_examinfo($questionexam_id) {
        $this->db->select('a.*, b.name studentName, b.mobile');
        $this->db->from('question_exam_tbl a');
        $this->db->join('students_tbl b', 'b.student_id = a.student_id', 'left');
        $this->db->where('a.questionexam_id', $questionexam_id);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row();
    }
    public function get_questionedit($question_id) {
        $this->db->select('a.id, a.question_id, a.name, a.question_type, a.shortanswer, a.question_mark, a.status, a.enterprise_id');
        $this->db->from('question_tbl a');
        $this->db->where('a.question_id', $question_id);
        $query = $this->db->get();
        return $query->row();
    }

    // ============ its for get get_examresultinfo ==============
    public function get_examresultinfo($questionexam_id){
        $this->db->select('a.*, b.name, b.pass_mark');
        $this->db->from('question_exam_tbl a');
        $this->db->join('exam_tbl b', 'b.exam_id = a.exam_id');
        $this->db->where('a.questionexam_id', $questionexam_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row(); 
    }
    // ============ its for get allcourseexams ==============
    public function get_allcourseexams($user_id){
        $this->db->select('a.customer_id, c.course_id, c.name course_name, d.exam_id, d.name exam_name, d.pass_mark');
        $this->db->from('invoice_details a');
        $this->db->join('assign_courseexam_tbl b', 'b.course_id = a.product_id');
        $this->db->join('course_tbl c', 'c.course_id = a.product_id');
        $this->db->join('exam_tbl d', 'd.exam_id = b.exam_id');
        $this->db->where('a.customer_id', $user_id);
        $this->db->group_by('b.exam_id');
        $this->db->group_by('b.course_id');
        $this->db->order_by('b.id', 'desc');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result(); 
    }
    // ============ its for get_courseexams ==============
    public function get_courseexams($course_id){
        $this->db->select('b.exam_id, b.name exam_name, b.pass_mark');
        $this->db->from('assign_courseexam_tbl a');
        $this->db->join('exam_tbl b', 'b.exam_id = a.exam_id');
        $this->db->where('a.course_id', $course_id);
        // $this->db->group_by('b.exam_id');
        // $this->db->group_by('b.course_id');
        $this->db->order_by('b.id', 'desc');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result(); 
    }

    // ========= its for get allincomplete exam =============
//     public function get_allincompleteexam($user_id){
       
//         $exams = $this->db->select('*')->from('question_exam_tbl')->where('student_id',$user_id)->get()->result();

//         $exam_id = [];
//         if($exams){
//         foreach($exams as $getexams){            
//             array_push($exam_id,$getexams->exam_id);
//             }
//         }

//         $result1  = $this->db->select('*')
//         ->from('exam_tbl')
//         ->get()
//         ->result();
// echo "<br>";
//         $result  = $this->db->select('c.course_id, c.name course_name, d.exam_id, d.name exam_name, d.pass_mark')
//         ->from('invoice_details a')
//         ->join('assign_courseexam_tbl b','b.course_id = a.product_id')
//         ->join('exam_tbl d','d.exam_id = b.exam_id')
//         ->join('course_tbl c','c.course_id = a.product_id')
//         ->where('a.customer_id', $user_id)
//         ->where_not_in("b.exam_id",$exam_id)
//         ->group_by('b.exam_id')
//         // ->group_by('b.course_id')
//         ->get()
//         ->result();
//         // dd($result);
//         echo $this->db->last_query();
//         return $result;
//     }

    // public function get_allincompleteexam($user_id){
    //     $sqlquery = "SELECT c.course_id, c.name course_name, d.exam_id, d.name exam_name, d.pass_mark, e.questionexam_id, e.student_id, e.duration, e.total_question,
    //                         e.total_answered, e.mcq_answered, e.shortqst_answered, e.marks, e.exam_set, e.correctans_count, e.questionmarks, e.totalmark, e.is_done,
    //                         e.examstarttime, e.examendtime, e.is_result, e.is_published, e.status, e.enterprise_id, e.created_date
    //                         FROM invoice_details a
    //                         JOIN assign_courseexam_tbl b ON b.course_id = a.product_id
    //                         JOIN course_tbl c ON c.course_id = a.product_id
    //                         JOIN exam_tbl d ON d.exam_id = b.exam_id
    //                         LEFT JOIN question_exam_tbl e ON e.exam_id = b.exam_id
    //                         WHERE
    //                         b.exam_id NOT IN 
    //                         (
    //                         SELECT e.exam_id FROM question_exam_tbl e
    //                         )
    //                         AND a.customer_id = '$user_id'";
    //     $query = $this->db->query($sqlquery);
    //     // echo $this->db->last_query();
    //     return $query->result();                   
    // }

    // =================== its for get_allcourseexamstypewise ===========
    public function get_allcourseexamstypewise($user_id, $type){
        $this->db->select('a.*, b.name course_name, c.name exam_name, c.pass_mark');
        $this->db->from('question_exam_tbl a');
        $this->db->join('course_tbl b', 'b.course_id = a.course_id', 'left');
        $this->db->join('exam_tbl c', 'c.exam_id = a.exam_id', 'left');
        $this->db->where('a.student_id', $user_id);
        $this->db->where('a.is_done', $type);
        $query = $this->db->get();
        return $query->result();
    }



    // =============== its for get examresults ===================
    public function get_examresults($customer_id, $course_id, $exam_id){
        $this->db->select('*');
        $this->db->from('question_exam_tbl a');
        $this->db->where('a.student_id', $customer_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.exam_id', $exam_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }
    // ============ its for get_studentproficiency ==============
    public function get_studentproficiency($user_id){
        $this->db->select('a.*, b.logo');
        $this->db->from('user_proficiency_tbl a');
        $this->db->join('proficiency_tbl b', 'b.title = a.proficiency', 'left');
        $this->db->where('a.user_id', $user_id);
        $this->db->group_by('a.proficiency');
        $query = $this->db->get();
        return $query->result();
    }

    // =============== its for get_userexperience =================
    public function get_userexperience($user_id){
        $this->db->select('*');
        $this->db->from('experience_tbl a');
        $this->db->where('a.user_id', $user_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // ================ its for get_experienceedit =================
    public function get_experienceedit($id){
        $this->db->select('*');
        $this->db->from('experience_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // =============== its for get_usereducation =================
    public function get_usereducation($user_id){
        $this->db->select('*');
        $this->db->from('education_tbl a');
        $this->db->where('a.log_id', $user_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
      // ================ its for get_educationedit =================
      public function get_educationedit($id){
        $this->db->select('*');
        $this->db->from('education_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_sectionbycourse($course_id, $enterprise_id){
        $this->db->select('*');
        $this->db->from('section_tbl a');
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->result();
    }
  
    public function get_lessonbycoursesection($course_id, $section_id, $enterprise_id){
        $this->db->select('*');
        $this->db->from('lesson_tbl a');
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.section_id', $section_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_featuredproject($enterprise_id, $user_id){
        $this->db->select('*');
        $this->db->from('project_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.user_id', $user_id);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_featuredprojectportfolio($enterprise_id, $user_id){
        $this->db->select('*');
        $this->db->from('project_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.project_status', 1);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_projecteditdata($project_id){
        $this->db->select('*');
        $this->db->from('project_tbl a');
        $this->db->where('a.project_id', $project_id);
        $query = $this->db->get();
        return $query->row();
    }
    // ============= its for get_projectdetails ==============
    public function get_projectdetails($project_id){
        $this->db->select('*');
        $this->db->from('project_details_tbl a');
        $this->db->where('a.project_id', $project_id);
        $this->db->order_by('a.type', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_projectdetailsmax_sl($project_id){
        $this->db->select('max(content_sl) as max_sl');
        $this->db->from('project_details_tbl a');
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
    
    public function get_typewisproject($type, $enterprise_id, $user_id, $mode){
        $this->db->select('*');
        $this->db->from('project_tbl a');
        if($type != 0){
            $this->db->where('a.project_type', $type);
        }
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.user_id', $user_id);
        if($mode == 'view'){
            // $this->db->where('a.submit_status', 1);
            $this->db->where('a.project_status', 1);
            // $this->db->where('a.is_visibility', 1);
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function get_projectsingledata($project_id){
        $this->db->select('a.*,b.tagstatus,b.id,b.course_id, b.faculty_id, b.name, b.price, b.oldprice, b.summary, b.slug, b.course_level,b.hover_thumbnail,
        b.url,b.is_new,b.course_type,b.is_offer,b.offer_courseprice,b.is_discount,b.discount_type,b.discount,b.is_free, b.is_livecourse, c.picture, d.category_id, 
        d.name as category_name, e.name instructor_name, f.name enterprise_name');
        $this->db->from('project_tbl a');
        $this->db->join('course_tbl b', 'b.course_id = a.course_id', 'left');
        $this->db->join('picture_tbl c', 'c.from_id = b.course_id', 'left');
        $this->db->join('category_tbl d', 'd.category_id = b.category_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = b.faculty_id', 'left');
        $this->db->join('loginfo_tbl f', 'f.log_id = b.enterprise_id', 'left');
        $this->db->where('a.project_id', $project_id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
        // $this->db->select('a.*, b.name course_name, b.course_level, b.course_type, b.price, b.oldprice, b.is_discount, b.discount, b.is_offer, b.offer_courseprice, b.url,b.is_new, c.name faculty_name, d.name category_name');
        // $this->db->from('project_tbl a');
        // $this->db->join('course_tbl b', 'b.course_id = a.course_id', 'left');
        // $this->db->join('faculty_tbl c', 'c.faculty_id = b.faculty_id', 'left');
        // $this->db->join('category_tbl d', 'd.category_id = b.category_id', 'left');
        // $this->db->where('a.project_id', $project_id);
        // $query = $this->db->get();
        // return $query->row();
    }



    public function typeahead_search($item, $enterprise_id) {
        $this->db->select('a.tagstatus,a.id,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.hover_thumbnail,a.url,a.offer_courseprice,a.is_new,a.is_offer,a.course_type,a.is_discount,a.discount_type,a.discount,a.is_free, a.is_livecourse, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        
        $this->db->group_start();
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.status', 1);
        $this->db->where('a.is_livecourse', 0);
        $this->db->like('a.name', $item,'match', 'both');
        $this->db->or_like('d.name', $item,'match', 'both');
        $this->db->group_end();

        $this->db->limit('32');
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
    }

    public function category_course_filtering($type, $category_id, $enterprise_id) {
        $this->db->select('a.tagstatus,a.id,a.course_id,a.created_date, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
                . 'a.course_level,a.hover_thumbnail,a.is_new,a.url,a.is_offer,a.offer_courseprice,a.course_type,a.is_discount,a.discount_type,a.discount, a.is_free, a.is_livecourse, a.enterprise_id, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        if ($type == 1) {
            // $this->db->where('a.is_popular', 1);
            $this->db->where('a.tagstatus',4);
        } elseif ($type == 2) {
            $course_type = "JSON_CONTAINS(a.course_type, '[\"3\"]')";
            $this->db->where($course_type);
        } elseif ($type == 3) {
            $course_type = "JSON_CONTAINS(a.course_type, '[\"4\"]')";
            $this->db->where($course_type);
        } else {
            if($type==7){
                $start_date = date("Y-m-d", strtotime("-7 days"));
                $current_date = date("Y-m-d");
                $this->db->where("a.created_date BETWEEN '$start_date' AND '$current_date'");
            }else{
                $start_date = date("Y-m-d", strtotime("-30 days"));
                $current_date = date("Y-m-d");
                $this->db->where("a.created_date BETWEEN '$start_date' AND '$current_date'"); 
            }
        }
        if($category_id){
        $this->db->where('a.category_id', $category_id);
        }
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit('9');
        $query = $this->db->get()->result();
        //    dd($this->db->last_query($query));
        return $query;
    }
    public function course_filtering_loadmore($lastid,$type, $category_id, $enterprise_id) {
     
        $this->db->select('a.tagstatus,a.id,a.course_id,a.created_date, a.faculty_id, a.name, a.price, a.oldprice, a.summary, a.slug, '
        . 'a.course_level,a.hover_thumbnail,a.is_new,a.url,a.is_offer,a.offer_courseprice,a.course_type,a.discount_type,a.is_discount,a.discount, a.is_free, a.is_livecourse, a.enterprise_id, b.picture, c.category_id, c.name as category_name, d.name instructor_name, e.name enterprise_name');
        $this->db->from('course_tbl a');
        $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
        $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
        $this->db->join('loginfo_tbl d', 'd.log_id = a.faculty_id', 'left');
        $this->db->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left');
        if ($type == 1) {
            // $this->db->where('a.is_popular', 1);
            $this->db->where('a.tagstatus',4);
        } elseif ($type == 2) {
            $course_type = "JSON_CONTAINS(a.course_type, '[\"3\"]')";
            $this->db->where($course_type);
        } elseif ($type == 3) {
            $course_type = "JSON_CONTAINS(a.course_type, '[\"4\"]')";
            $this->db->where($course_type);
        } else {
            // $start_date = date("Y-m-d", strtotime("-7 days"));
            // $current_date = date("Y-m-d");
            // $this->db->where("a.created_date BETWEEN '$start_date' AND '$current_date'");
            if($type==7){
                $start_date = date("Y-m-d", strtotime("-7 days"));
                $current_date = date("Y-m-d");
                $this->db->where("a.created_date BETWEEN '$start_date' AND '$current_date'");
            }else{
                $start_date = date("Y-m-d", strtotime("-30 days"));
                $current_date = date("Y-m-d");
                $this->db->where("a.created_date BETWEEN '$start_date' AND '$current_date'"); 
            }
        }
        if($category_id){
        $this->db->where('a.category_id', $category_id);
        }
        $this->db->where('a.status', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->where('a.is_livecourse', 0);
        $this->db->where('a.id <', $lastid);
        $this->db->where('a.is_livecourse', 0);
        $this->db->order_by('a.id', 'desc');
        $this->db->limit('3');
        $query = $this->db->get()->result();
        return $query;
    }

//    ============ its for user password check ============
    public function user_password_check($user_id, $current_password) {
        $this->db->select('*')->from('loginfo_tbl');
        $this->db->where('log_id', $user_id);
        $this->db->where('password', md5($current_password));
        $query = $this->db->get()->row();
        return $query;
    }
    //============== its for get_paymentgateway =============
    public function get_paymentgateway() {
        $this->db->select('*');
        $this->db->from('payment_method_tbl');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function check_settingnotification($user_id){
        $query = $this->db->where('user_id', $user_id)->where('type', 1)->get('notification_config_tbl')->row();
        return $query;
    }


    public function TodayTotalTimeSpent($user_id,$enterprise_id){
        $date=date('Y-m-d');
        $query=$this->db->select('sum(a.studentwatchTime) as todaywatchtime')
                          ->from('daily_watch_time_tbl a')
                          ->join('course_tbl  b', 'b.course_id = a.course_id', 'left')
                          ->where('a.date',$date)
                          ->where('a.student_id',$user_id)
                          ->where('a.enterprise_id',$enterprise_id)
                          ->get()
                          ->result();
        return $query;
    }
   //--=============today indivisual course  time Spent==================--      
    public function todayTimeSpent($user_id,$enterprise_id){
        $date=date('Y-m-d');
        $query=$this->db->select('sum(a.studentwatchTime) as todaywatchtime,b.name,c.name as instructor_name')
                            ->from('daily_watch_time_tbl a')
                            ->join('course_tbl  b', 'b.course_id = a.course_id', 'left')
                            ->join('faculty_tbl  c', 'c.faculty_id = b.faculty_id', 'left')
                            ->where('a.date',$date)
                            ->where('a.student_id',$user_id)
                            ->where('a.enterprise_id',$enterprise_id)
                            ->group_by('a.course_id')
                            ->order_by('a.course_id','DESC')
                            ->limit('5')
                            ->get()
                            ->result();
        return $query;
            
    }

    function Is_already_register($email)    {
     $this->db->where('username', $email);
     $this->db->where('user_types', 4);
     $query = $this->db->get('loginfo_tbl');
     if($query->num_rows() > 0) {
      return $query->row();
         }else{
      return false;
     }
    }
    public function get_socialauthconfigdata($enterprise_id = null, $type = null) {
        $this->db->select('*');
        $this->db->from('socialauth_config_tbl');
        $this->db->where('enterprise_id', $enterprise_id);
        $this->db->where('type', $type);
        $query = $this->db->get();
        return $query->row();
    }


    public function forum_list($offset, $limit, $enterprise_id){
        $this->db->select('a.*,a.title, b.picture,c.title as cat_name')
        ->from('forum_tbl a')
        ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
        ->join('forum_category_tbl c', 'c.forum_category_id = a.category_id', 'left')
        ->where('a.enterprise_id', $enterprise_id)
        ->where('a.status', 1)
        ->limit($offset, $limit);
       $query = $this->db->get();
    //    echo $this->db->last_query();
       return $query->result();
    }
    public function forum_category_wise_post($offset, $limit, $enterprise_id,$category_id){
            $this->db->select('a.*,a.title, b.picture,c.title as cat_name')
            ->from('forum_tbl a')
            ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
            ->join('forum_category_tbl c', 'c.forum_category_id = a.category_id', 'left')
            ->where('a.category_id', $category_id)
            ->where('a.enterprise_id', $enterprise_id)
            ->order_by('id','desc')
            ->limit($offset, $limit);
            $query = $this->db->get();
            return $query->result();
    }

        // ================ its for get_eventdetails =================
        public function get_eventdetails($event_id, $enterprise_id) {
            $this->db->select('a.language,a.created_date, a.syllabus,a.course_provider,a.course_id, a.faculty_id, a.name, a.price, a.oldprice, a.is_offer, 
                    a.offer_courseprice, a.summary, a.slug, a.course_level, a.url, a.is_free, a.course_type, a.summary, a.description, a.requirements, 
                    a.benifits, a.is_livecourse, a.enterprise_id, a.related_courseid,a.career_outcomes,a.related_resource,a.course_result, a.event_date, b.picture, 
                    a.cover_thumbnail,c.category_id, c.name as category_name,d.name as instructor_name,d.designation,d.biography,
                    (select count(faculty_id) from course_tbl where faculty_id= `a`.`faculty_id`) as course_count');
            $this->db->from('course_tbl a');
            $this->db->join('picture_tbl b', 'b.from_id = a.course_id', 'left');
            $this->db->join('category_tbl c', 'c.category_id = a.category_id', 'left');
            $this->db->join('faculty_tbl d', 'd.faculty_id = a.faculty_id', 'left');
            $this->db->where('a.course_id', $event_id);
            $this->db->where('a.status', 1);
            $this->db->where('a.enterprise_id', $enterprise_id);
            $query = $this->db->get();
            // echo $this->db->last_query();
            return $query->row();
        }

        // ============== its for get_meetingdetails ================
        public function get_meetingdetails($offset, $limit, $event_id, $enterprise_id){
            // $this->db->select('a.*');
            // $this->db->from('meeting_tbl a');
            // $this->db->where('a.course_id', $event_id);
            // $this->db->where('a.enterprise_id', $enterprise_id);
            // $query = $this->db->get();
            // return $query->result();
            // , (select count(id) from meeting_participant_tbl where live_id= a.faculty_id) as course_count)
            $this->db->select('a.*');
            $this->db->from('meeting_tbl a');
            $this->db->where('a.course_id', $event_id);
            $this->db->where('a.enterprise_id', $enterprise_id);
            // $this->db->order_by('a.id', 'desc');
            $this->db->limit($offset, $limit);
            $query = $this->db->get()->result();
            return $query;
        }

        public function get_asseignmenteditdata($assignment_id){
            $this->db->select('a.*');
            $this->db->from('project_assingment a');
            $this->db->where('a.assignment_id', $assignment_id);
            $query = $this->db->get();
            return $query->row();
        }

        public function get_projectlist($offset, $limit, $enterprise_id) {
            $this->db->select('a.*');
            $this->db->from('project_tbl a');
            // $this->db->join('category_tbl b', 'b.category_id = a.category_id');
            $this->db->where('a.enterprise_id', $enterprise_id);
            $this->db->where('a.is_visibility', 1);
            $this->db->where('a.type', 1);
            $this->db->order_by('a.id', 'desc');
            $this->db->limit($offset, $limit);
            $query = $this->db->get();
    //        echo $this->db->last_query();
            return $query->result();
        }

        public function get_allprojectbytype($type, $enterprise_id){
            $this->db->select('*');
            $this->db->from('project_tbl a');
            if($type != 0){
                $this->db->where('a.project_type', $type);
            }
            $this->db->where('a.enterprise_id', $enterprise_id);
            $this->db->where('a.is_visibility', 1);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_totalcoursetime($course_id = null)
        {
            
            $sql_query = "SELECT (SELECT SUM(TIME_TO_SEC(duration)) FROM `lesson_tbl` WHERE course_id = '$course_id' AND lesson_type = 1) as coursetime, 
            (SELECT count(id) FROM `lesson_tbl` WHERE course_id = '$course_id') as totallesson"; 
            $query = $this->db->query($sql_query);
            // echo $sql_query;
            return $query->row();
        }

        
        public function get_eventlist($offset, $limit, $enterprise_id) {
            $this->db->select('a.*, b.name category_name, c.picture');
            $this->db->from('course_tbl a');
            $this->db->join('category_tbl b', 'b.category_id = a.category_id', 'left');
            $this->db->join('picture_tbl c', 'c.from_id = a.course_id', 'left');
            $this->db->where('a.enterprise_id', $enterprise_id);
            // $this->db->where('a.event_date >=', date('Y-m-d'));
            $this->db->where('a.is_livecourse', 2);
            $this->db->where('a.status', 1);
            $this->db->order_by('a.id', 'desc');
            $this->db->limit($offset, $limit);
            $query = $this->db->get();
        //    echo $this->db->last_query();
            return $query->result();
        }

        public function get_projectcomments($project_id = null){
            $this->db->select('a.*');
            $this->db->from('comments_tbl a');
            $this->db->where('a.project_id', $project_id);
            $this->db->order_by('a.id', 'desc');
            $this->db->limit(3);
            $query = $this->db->get();
            return $query->result();
        }

        public function get_likeunlikestatus($project_id = null, $user_id = null, $enterprise_id = null){
            $this->db->select('a.*');
            $this->db->from('likes_tbl a');
            $this->db->where('user_id', $user_id);
            $this->db->where('project_id', $project_id);
            $this->db->where('enterprise_id', $enterprise_id);
            $query = $this->db->get();
            // echo $this->db->last_query();
            return $query->row();
        }

        public function check_lessonwatch($user_id = null, $course_id = null, $lesson_id = null){
           $this->db->select('*');
           $this->db->from('watch_time_tbl a');
           $this->db->where('a.student_id', $user_id);
           $this->db->where('a.course_id', $course_id);
           $this->db->where('a.lesson_id', $lesson_id);
           $query = $this->db->get();
           return $query->row();
        }

        //    ================ its for get_aboutinfo ===============
    public function get_aboutinfo($enterprise_id = null) {
        $this->db->select('a.*');
        $this->db->from('aboutinfo_tbl a');
        $this->db->where('a.enterprise_id', $enterprise_id);
        $query = $this->db->get()->row();
        return $query;
    }
    // ============= its for get_aboutchoosedata ===============
    public function get_aboutchoosedata($about_id){
        $this->db->select('a.*');
        $this->db->from('aboutchoose_tbl a');
        $this->db->where('a.about_id', $about_id);
        $query = $this->db->get()->result();
        return $query;
    }
    // ============= its for get_aboutservicedata ===============
    public function get_aboutservicedata($about_id){
        $this->db->select('a.*');
        $this->db->from('about_service_tbl a');
        $this->db->where('a.about_id', $about_id);
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
    }

    public function get_assignmentprojectlist($course_id, $enterprise_id){
        $this->db->select('a.*');
        $this->db->from('project_assingment a');
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->order_by('a.project_order', 'asc');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }
    public function get_projectmarks($assignment_id){
        $this->db->select('a.*');
        $this->db->from('project_mark_details a');
        $this->db->where('a.assignment_id', $assignment_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }
    public function get_studentassignmentproject($user_id, $assignment_id){
        $this->db->select('a.*');
        $this->db->from('project_tbl a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.assignment_id', $assignment_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->row();
    }

    public function get_assignmentchapterbycourse($course_id, $enterprise_id){
        $this->db->select('*');
        $this->db->from('project_assingment a');
        $this->db->join('section_tbl b', 'b.section_id = a.chapter_id');
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.category', 1);
        $this->db->where('a.enterprise_id', $enterprise_id);
        $this->db->group_by('a.chapter_id');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_assignmentbychapter($chapter_id = null, $category = null, $course_id = null, $enterprise_id = null){
        $this->db->select('*');
        $this->db->from('project_assingment a');
        if($chapter_id){
            $this->db->where('a.chapter_id', $chapter_id);
        }else{
            $this->db->where('a.course_id', $course_id);
        }
        $this->db->where('a.category', $category);
        $this->db->where('a.enterprise_id', $enterprise_id);
        // $this->db->group_by('a.chapter_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    
    public function get_assignmentdetails($assignment_id){
        $this->db->select('a.*, b.section_name');
        $this->db->from('project_assingment a');
        $this->db->join('section_tbl b', 'b.section_id = a.chapter_id', 'left');
        $this->db->where('a.assignment_id', $assignment_id);
        $query = $this->db->get();
        return $query->row();
    }
}