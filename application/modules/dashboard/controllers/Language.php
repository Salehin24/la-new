<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Language extends MX_Controller {

    private $table = "language";
    private $phrase = "phrase";

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
        $this->load->helper('language');
        $this->load->model('Language_model');

        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname .'/login');
    }

    public function index() {
        $data['title'] = "Language List";
        $data['languages'] = $this->languages();

        $this->load->view('language/main', $data);
    }

//    =========== its for add phrase =============
    public function add_phrase() {
        $data['title'] = display('phrase');

        $this->load->view('language/add_phrase', $data);
    }

//    ============= its for phrase_list ============
    public function phrase_list() {
        $list = $this->Language_model->phrases();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rowdata) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $rowdata->phrase;
            $row[] = $rowdata->english;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Language_model->count_allphrase(),
            "recordsFiltered" => $this->Language_model->count_allfilterphrase(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

//    ============ its for phrase_save ============
    public function phrase_save() {
        $phrase = $this->input->post('phrase', true);
        $check_phrase = $this->db->select('*')->from('language')->where('phrase', $phrase)->get()->row();
        if ($check_phrase) {
            echo display('already_exists');
        } else {
            $phrase_data = array(
                'phrase' => $phrase,
            );
            $this->db->insert('language', $phrase_data);
            echo display('phrase_added_successfully');
        }
    }

    public function languages() {
        if ($this->db->table_exists($this->table)) {

            $fields = $this->db->field_data($this->table);

            $i = 1;
            foreach ($fields as $field) {
                if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
            }

            if (!empty($result))
                return $result;
        } else {
            return false;
        }
    }

    public function addLanguage() {
        $language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->input->post('language', true));
        $language = strtolower($language);

        if (!empty($language)) {
            if (!$this->db->field_exists($language, $this->table)) {
                $this->dbforge->add_column($this->table, [
                    $language => [
                        'type' => 'TEXT'
                    ]
                ]);

                echo display('language_added_successfully');
            }
        } else {
            echo display('please_try_again');
        }
    }

    public function editPhrase($language = null) {
        $this->load->library('pagination');
        #------------------#
        $data['title'] = "Edit Phrase";
        $data['language'] = $language;

        #        #pagination starts        #        
        $config["base_url"] = base_url(enterpriseinfo()->shortname .'phrase-label-edit/' . $language);
        $config["total_rows"] = $this->db->count_all('language');
        $config["per_page"] = 25;
        $config["uri_segment"] = 4;
        $config["num_links"] = 3;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item"><a class="page-link active">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = '<i class="ti-angle-right"></i>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_link'] = '<i class="ti-angle-left"></i>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['last_link'] = false;
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["phrases"] = $this->phrases($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;
        #        #pagination ends        #  

        $data['module'] = "dashboard";
        $data['page'] = "language/phrase_edit";
        echo modules::run('template/layout', $data);
    }

    public function phrases($offset = null, $limit = null) {
        if ($this->db->table_exists($this->table)) {
            if ($this->db->field_exists($this->phrase, $this->table)) {
                return $this->db->order_by($this->phrase, 'asc')
                                ->limit($offset, $limit)
                                ->get($this->table)
                                ->result();
            }
        }
        return false;
    }

//    ============= its for phrase_label_search ===============
    public function phrase_label_search() {
        $data['language'] = $language = 'english';
        $phrase = $this->input->post('phrase', true);
        if ($this->db->table_exists($this->table)) {
            if ($this->db->field_exists($this->phrase, $this->table)) {
                $data['phrases'] = $this->db->order_by($this->phrase, 'asc')
                        ->like($this->phrase, $phrase)
                        ->get($this->table)
                        ->result();
            }
        }
        $this->load->view('language/phraselabel_search', $data);
    }


    public function addLebel() {
        $language = $this->input->post('language', true);
        $phrase = $this->input->post('phrase', true);
        $lang = $this->input->post('lang', true);

        if (!empty($language)) {

            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($language, $this->table)) {

                    if (sizeof($phrase) > 0)
                        for ($i = 0; $i < sizeof($phrase); $i++) {
                            $this->db->where($this->phrase, $phrase[$i])
                                    ->set($language, $lang[$i])
                                    ->update($this->table);
                        }
                    $this->session->set_flashdata('message', 'Label added successfully!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }

        $this->session->set_flashdata('exception', 'Please try again');
        redirect('dashboard/language/editPhrase/' . $language);
    }

}
