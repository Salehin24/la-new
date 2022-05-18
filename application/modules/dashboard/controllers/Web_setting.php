<?php defined('BASEPATH') OR exit('No direct script access allowed');
#------------------------------------
  # Author: Bdtask Ltd
  # Author link: https://www.bdtask.com/
  # Leadacademy Project
  # Developed by : Md. Shahab uddin & Al-amin
  #------------------------------------
class Web_setting extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(array(
            'websetting_model'
        ));

        if (!$this->session->userdata('isAdmin'))
            redirect('login');
    }

    // Common Setting
    public function index() {
        $data['title'] = display('web_setting');
        #-------------------------------#
        //check setting table row if not exists then insert a row
        #-------------------------------#
        $data['websetting'] = $this->websetting_model->read();

        $data['module'] = "dashboard";
        $data['page'] = "web/web_setting";
        echo Modules::run('template/layout', $data);
    }

    public function common_create() {
        $data['title'] = display('web_setting');
        #-------------------------------#
        $this->form_validation->set_rules('email', display('email'), 'max_length[100]|valid_email');
        $this->form_validation->set_rules('phone', display('phone'), 'max_length[20]');
        $this->form_validation->set_rules('footer_text', display('footer_text'), 'max_length[255]');
        #-------------------------------#
        //logo upload
        $logo = $this->fileupload->do_upload(
                'assets/img/', 'logo'
        );
        // if logo is uploaded then resize the logo
        if ($logo !== false && $logo != null) {
            $this->fileupload->do_resize(
                    $logo, 168, 65
            );
        }
        //if logo is not uploaded
        if ($logo === false) {
            $this->session->set_flashdata('exception', display('invalid_logo'));
        }


        $data['setting'] = (object) $postData = array(
            'id' => $this->input->post('id', TRUE),
            'email' => $this->input->post('email', TRUE),
            'phone' => $this->input->post('phone', TRUE),
            'logo' => (!empty($logo) ? $logo : $this->input->post('old_logo', TRUE)),
            'powerbytxt' => $this->input->post('power_text', TRUE)
        );
        #-------------------------------#
        if ($this->form_validation->run() === true) {

            #if empty $id then insert data
            if (empty($postData['id'])) {
                if ($this->websetting_model->create_setting($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            } else {
                if ($this->websetting_model->update_setting($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }

            redirect('dashboard/web_setting');
        } else {
            $data['module'] = "dashboard";
            $data['page'] = "web/web_setting";
            echo Modules::run('template/layout', $data);
        }
    }

    //Banner setting



    public function bannersetting() {
        $data['title'] = display('banner_setting');
        $data['module'] = "dashboard";
        $data['baller_list'] = $this->db->select('*')->from('tbl_slider')->get()->result();
        $data['type'] = $this->websetting_model->type_dropdown();
        $data['page'] = "web/banner_list";
        echo Modules::run('template/layout', $data);
    }

    public function bannertype() {
        $data['title'] = display('bannertype');
        $data['module'] = "dashboard";
        $data['ballertype_list'] = $this->db->select('*')->from('tbl_slider_type')->get()->result();
        $data['page'] = "web/bannertype_list";
        echo Modules::run('template/layout', $data);
    }

    public function createtype() {
        $data['title'] = display('bannertype');
        $this->form_validation->set_rules('bannertype', display('bannertype'), 'required');
        $postData = array(
            'STypeName' => $this->input->post('bannertype', TRUE)
        );
        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->createtype($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect('dashboard/web_setting/bannertype');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/bannertype');
        }
    }

    public function edittype($id) {
        $this->form_validation->set_rules('bannertype', display('bannertype'), 'required');
        $postData = array(
            'stype_id' => $id,
            'STypeName' => $this->input->post('bannertype', TRUE),
        );
        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->updatetype($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect('dashboard/web_setting/bannertype');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/bannertype');
        }
    }

    public function create() {
        $data['title'] = display('banner_setting');
        #-------------------------------#
        $this->form_validation->set_rules('banner_type', display('banner_type'), 'required');
        $this->form_validation->set_rules('width', display('width'), 'required');
        $this->form_validation->set_rules('height', display('height'), 'required');
        $this->form_validation->set_rules('title', display('title'), 'required');
        $this->form_validation->set_rules('subtitle', display('subtitle'), 'required');
        $this->form_validation->set_rules('status', display('status'), 'required');

        $width = $this->input->post('width', TRUE);
        $height = $this->input->post('height', TRUE);
        //Banner upload
        $banner = $this->fileupload->do_upload(
                'assets/img/banner/', 'picture'
        );
        // if Banner is uploaded then resize the Banner
        if ($banner !== false && $banner != null) {
            $this->fileupload->do_resize(
                    $banner, $width, $height
            );
        }
        //if Banner is not uploaded
        if ($banner === false) {
            $this->session->set_flashdata('exception', display('invalid_logo'));
        }

        $postData = array(
            'Sltypeid' => $this->input->post('banner_type', TRUE),
            'title' => $this->input->post('title', TRUE),
            'subtitle' => $this->input->post('subtitle', TRUE),
            'image' => $banner,
            'width' => $width,
            'height' => $height,
            'slink' => $this->input->post('url', TRUE),
            'status' => $this->input->post('status', TRUE)
        );
        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->create($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect('dashboard/web_setting/bannersetting');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/bannersetting');
        }
    }

    public function updatebanner() {
        $data['title'] = display('banner_setting');
        #-------------------------------#
        $this->form_validation->set_rules('banner_type', display('banner_type'), 'required');
        $this->form_validation->set_rules('width', display('width'), 'required');
        $this->form_validation->set_rules('height', display('height'), 'required');
        $this->form_validation->set_rules('title', display('title'), 'required');
        $this->form_validation->set_rules('subtitle', display('subtitle'), 'required');
        $this->form_validation->set_rules('status', display('status'), 'required');
        $width = $this->input->post('width', TRUE);
        $height = $this->input->post('height', TRUE);

        //logo upload
        $banner = $this->fileupload->do_upload(
                'assets/img/banner/', 'picture'
        );
        // if logo is uploaded then resize the logo
        if ($banner !== false && $banner != null) {
            $this->fileupload->do_resize(
                    $banner, $width, $height
            );
        }
        //if logo is not uploaded
        if ($banner === false) {
            $this->session->set_flashdata('exception', display('invalid_logo'));
        }
        $sliderinfo = $this->db->select('*')->from('tbl_slider')->where('slid', $this->input->post('slid', TRUE))->get()->row();
        if (!empty($banner)) {
            unlink($sliderinfo->image);
        }
        $postData = array(
            'slid' => $this->input->post('slid', TRUE),
            'Sltypeid' => $this->input->post('banner_type', TRUE),
            'title' => $this->input->post('title', TRUE),
            'subtitle' => $this->input->post('subtitle', TRUE),
            'image' => (!empty($banner) ? $banner : $this->input->post('sliderimage', TRUE)),
            'width' => $width,
            'height' => $height,
            'slink' => $this->input->post('url', TRUE),
            'status' => $this->input->post('status', TRUE)
        );
        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->update($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
            redirect('dashboard/web_setting/bannersetting');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/bannersetting');
        }
    }

    public function updateintfrm($id) {
        $data['title'] = display('banner_edit');
        $data['intinfo'] = $this->websetting_model->findById($id);
        $data['type'] = $this->websetting_model->type_dropdown();
        $data['module'] = "dashboard";
        $data['page'] = "web/banneredit";
        $this->load->view('dashboard/web/banneredit', $data);
    }

    public function delete($bannerid = null) {
        $sliderinfo = $this->db->select('*')->from('tbl_slider')->where('slid', $bannerid)->get()->row();
        unlink($sliderinfo->image);
        if ($this->websetting_model->delete($bannerid)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('dashboard/web_setting/bannersetting');
    }

//****************Menu Section***************/
    public function menusetting() {
        $data['title'] = display('menu_setting');
        $data['module'] = "dashboard";
        $data['menu_list'] = $this->db->select('*')->from('top_menu')->get()->result();
        $data['allmenu'] = $this->websetting_model->allmenu_dropdown();

        $data['page'] = "web/menu_list";
        echo Modules::run('template/layout', $data);
    }

    public function createmenu() {
        $data['title'] = display('add_menu');
        $this->form_validation->set_rules('menuname', display('menu_name'), 'required');
        $this->form_validation->set_rules('Menuurl', display('menu_url'), 'required');
        $this->form_validation->set_rules('status', display('status'), 'required');
        if (empty($this->input->post('menuid', TRUE))) {
            $parent = 0;
        } else {
            $parent = $this->input->post('menuid', TRUE);
        }
        $postData = array(
            'menu_name' => $this->input->post('menuname', TRUE),
            'menu_slug' => $this->input->post('Menuurl', TRUE),
            'parentid' => $parent,
            'entrydate' => date('Y-m-d'),
            'isactive' => $this->input->post('status', TRUE)
        );

        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->createmenu($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect('dashboard/web_setting/menusetting');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/menusetting');
        }
    }

    public function editmenu($id) {
        $data['title'] = display('add_menu');
        $this->form_validation->set_rules('menuname', display('menu_name'), 'required');
        $this->form_validation->set_rules('Menuurl', display('menu_url'), 'required');
        $this->form_validation->set_rules('status', display('status'), 'required');
        if (empty($this->input->post('menuid', TRUE))) {
            $parent = 0;
        } else {
            $parent = $this->input->post('menuid', TRUE);
        }
        $postData = array(
            'menuid' => $id,
            'menu_name' => $this->input->post('menuname', TRUE),
            'menu_slug' => $this->input->post('Menuurl', TRUE),
            'parentid' => $parent,
            'entrydate' => date('Y-m-d'),
            'isactive' => $this->input->post('status', TRUE)
        );

        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->updatemenu($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect('dashboard/web_setting/menusetting');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/menusetting');
        }
    }

    public function deletemenu($menuid = null) {
        if ($this->websetting_model->deletemenu($menuid)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('dashboard/web_setting/menusetting');
    }

    //widget setting
    public function widgetsetting() {
        $data['title'] = display('widget_setting');
        $data['module'] = "dashboard";
        $data['widget_list'] = $this->db->select('*')->from('tbl_widget')->get()->result();
        $data['page'] = "web/widget_list";
        echo Modules::run('template/layout', $data);
    }

    public function createwidget() {
        $data['title'] = display('add_widget');
        $this->form_validation->set_rules('widgetname', display('widget_name'), 'required');
        $postData = array(
            'widget_name' => $this->input->post('widgetname', TRUE),
            'widget_title' => $this->input->post('widgettitle', TRUE),
            'widget_desc' => $this->input->post('widgetdesc', TRUE)
        );

        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->createwidget($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect('dashboard/web_setting/widgetsetting');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/widgetsetting');
        }
    }

    public function updatewidget($id) {
        $data['widget_info'] = $this->db->select('*')->from('tbl_widget')->where('widgetid', $id)->get()->row();
        $data['module'] = "dashboard";
        $data['page'] = "web/widget_list";
        $this->load->view('dashboard/web/widget', $data);
    }

    public function editwidget($id) {
        $data['title'] = display('add_widget');
        $this->form_validation->set_rules('widgetname', display('widget_name'), 'required');
        $postData = array(
            'widgetid' => $id,
            'widget_name' => $this->input->post('widgetname', TRUE),
            'widget_title' => $this->input->post('widgettitle', TRUE),
            'widget_desc' => $this->input->post('widgetdesc', TRUE)
        );

        if ($this->form_validation->run() === true) {
            if ($this->websetting_model->updatewidget($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }

            redirect('dashboard/web_setting/widgetsetting');
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect('dashboard/web_setting/widgetsetting');
        }
    }

    public function deletewidget($menuid = null) {
        if ($this->websetting_model->deletewidget($menuid)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('dashboard/web_setting/widgetsetting');
    }

    public function email_config_setup() {
        $data['title'] = display('email_setting');
        $data['module'] = "dashboard";
        $data['config'] = $this->db->select('*')->from('email_config')->where('email_config_id', 1)->get()->row();
        $data['page'] = "web/email_setting";
        echo Modules::run('template/layout', $data);
    }

    public function email_config_save() {
        $data = array(
            'smtp_port' => $this->input->post('smtp_port', TRUE),
            'smtp_host' => $this->input->post('smtp_host', TRUE),
            'smtp_password' => $this->input->post('smtp_password', TRUE),
            'protocol' => $this->input->post('protocol', TRUE),
            'mailpath' => $this->input->post('mailpath', TRUE),
            'mailtype' => $this->input->post('mailtype', TRUE),
            'sender' => $this->input->post('sender', TRUE),
            'api_key' => trim($this->input->post('api_key', TRUE))
        );

        $check = $this->db->select('*')
                        ->from('email_config')
                        ->where('email_config_id', 1)
                        ->get()->row();

        if ($check) {
            $this->db->where('email_config_id', 1)->update('email_config', $data);
        } else {
            $this->db->insert('email_config', $data);
        }

        $this->session->set_flashdata('message', display('update_successfully'));
        redirect("dashboard/web_setting/email_config_setup");
    }

    public function subscribeList() {
        $data['title'] = display('subscribelist');
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/web_setting/subscribeList');
        $config["total_rows"] = $this->websetting_model->countlist();
        $config["per_page"] = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last";
        $config["first_link"] = "First";
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["subscribe"] = $this->websetting_model->emailread($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        #pagination ends        #   
        $data['module'] = "dashboard";
        $data['page'] = "web/subscribeList";
        echo Modules::run('template/layout', $data);
    }

}
