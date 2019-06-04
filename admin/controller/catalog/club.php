<?php

class ControllerCatalogClub extends PT_Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('catalog/club');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/club');

        $this->getList();
    }

    public function add()
    {
        $this->load->language('catalog/club');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/club');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_catalog_club->addClub($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('catalog/club', 'user_token=' . $this->session->data['user_token']));
        }

        $this->getForm();
    }

    public function edit()
    {
        $this->load->language('catalog/club');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/club');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_catalog_club->editClub($this->request->get['club_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('catalog/club', 'user_token=' . $this->session->data['user_token']));
        }

        $this->getForm();
    }

    public function delete()
    {
        $this->load->language('catalog/club');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/club');

        if (isset($this->request->post['selected'])) {
            foreach ($this->request->post['selected'] as $club_id) {
                $this->model_catalog_club->deleteClub($club_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('catalog/club', 'user_token=' . $this->session->data['user_token']));
        }

        $this->getList();
    }

    protected function getList()
    {
        $this->document->addStyle("view/dist/plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css");
        $this->document->addStyle("view/dist/plugins/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css");
        $this->document->addStyle("view/dist/plugins/DataTables/FixedHeader-3.1.4/css/fixedHeader.bootstrap4.min.css");
        $this->document->addStyle("view/dist/plugins/DataTables/Responsive-2.2.2/css/responsive.bootstrap4.min.css");
        $this->document->addScript("view/dist/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/JSZip-2.5.0/jszip.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/pdfmake-0.1.36/pdfmake.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/pdfmake-0.1.36/vfs_fonts.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.html5.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.print.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/FixedHeader-3.1.4/js/fixedHeader.bootstrap4.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js");
        $this->document->addScript("view/dist/plugins/DataTables/Responsive-2.2.2/js/responsive.bootstrap4.min.js");

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('catalog/club', 'user_token=' . $this->session->data['user_token'])
        );

        $data['add'] = $this->url->link('catalog/club/add', 'user_token=' . $this->session->data['user_token']);
        $data['delete'] = $this->url->link('catalog/club/delete', 'user_token=' . $this->session->data['user_token']);

        $data['clubs'] = array();

        $results = $this->model_catalog_club->getClubs();

        foreach ($results as $result) {
            $data['clubs'][] = array(
                'club_id'       => $result['club_id'],
                'date'          => $result['date'],
                'name'          => $result['club_name'],
                'president'     => $result['president'],
                'secretory'     => $result['district_secretory'],
                'governor'      => $result['assistant_governor'],
                'password'      => $result['password'],
                'website'       => $result['website'],
                'mobile'        => $result['mobile'],
                'email'         => $result['email'],
                'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'edit'          => $this->url->link('catalog/club/edit', 'user_token=' . $this->session->data['user_token'] . '&club_id=' . $result['club_id'])
            );
        }

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/club_list', $data));
    }

    protected function getForm()
    {
        $this->document->addStyle("view/dist/plugins/iCheck/all.css");
        $this->document->addScript("view/dist/plugins/ckeditor/ckeditor.js");
        $this->document->addScript("view/dist/plugins/ckeditor/adapters/jquery.js");
        $this->document->addScript("view/dist/plugins/iCheck/icheck.min.js");
        
        $data['text_form'] = !isset($this->request->get['club_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['president'])) {
            $data['president_err'] = $this->error['president'];
        } else {
            $data['president_err'] = '';
        }

        if (isset($this->error['name'])) {
            $data['name_err'] = $this->error['name'];
        } else {
            $data['name_err'] = '';
        }

        if (isset($this->error['email'])) {
            $data['email_err'] = $this->error['email'];
        } else {
            $data['email_err'] = '';
        }

        if (isset($this->error['date'])) {
            $data['date_err'] = $this->error['date'];
        } else {
            $data['date_err'] = '';
        }

        if (isset($this->error['secretory'])) {
            $data['secretory_err'] = $this->error['secretory'];
        } else {
            $data['secretory_err'] = '';
        }

        if (isset($this->error['name'])) {
            $data['name_err'] = $this->error['name'];
        } else {
            $data['name_err'] = '';
        }

        if (isset($this->error['governor'])) {
            $data['governor_err'] = $this->error['governor'];
        } else {
            $data['governor_err'] = '';
        }

        if (isset($this->error['password'])) {
            $data['password_err'] = $this->error['password'];
        } else {
            $data['password_err'] = '';
        }

        if (isset($this->error['mobile'])) {
            $data['mobile_err'] = $this->error['mobile'];
        } else {
            $data['mobile_err'] = '';
        }

        if (isset($this->error['website'])) {
            $data['website_err'] = $this->error['website'];
        } else {
            $data['website_err'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('catalog/club', 'user_token=' . $this->session->data['user_token'])
        );

        if (!isset($this->request->get['club_id'])) {
            $data['action'] = $this->url->link('catalog/club/add', 'user_token=' . $this->session->data['user_token']);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('catalog/club/add', 'user_token=' . $this->session->data['user_token'])
            );
        } else {
            $data['action'] = $this->url->link('catalog/club/edit', 'user_token=' . $this->session->data['user_token'] . '&club_id=' . $this->request->get['club_id']);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('catalog/club/edit', 'user_token=' . $this->session->data['user_token'])
            );
        }

        $data['cancel'] = $this->url->link('catalog/club', 'user_token=' . $this->session->data['user_token']);

        if (isset($this->request->get['club_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $club_info = $this->model_catalog_club->getClub($this->request->get['club_id']);
        }
        
        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($club_info)) {
            $data['name'] = $club_info['club_name'];
        } else {
            $data['name'] = '';
        }
        
        if (isset($this->request->post['secretory'])) {
            $data['secretory'] = $this->request->post['secretory'];
        } elseif (!empty($club_info)) {
            $data['secretory'] = $club_info['district_secretory'];
        } else {
            $data['secretory'] = '';
        }
        
        if (isset($this->request->post['governor'])) {
            $data['governor'] = $this->request->post['governor'];
        } elseif (!empty($club_info)) {
            $data['governor'] = $club_info['assistant_governor'];
        } else {
            $data['governor'] = '';
        }
        
        if (isset($this->request->post['date'])) {
            $data['date'] = $this->request->post['date'];
        } elseif (!empty($club_info)) {
            $data['date'] = $club_info['date'];
        } else {
            $data['date'] = '';
        }
        
        if (isset($this->request->post['president'])) {
            $data['president'] = $this->request->post['president'];
        } elseif (!empty($club_info)) {
            $data['president'] = $club_info['president'];
        } else {
            $data['president'] = '';
        }
        
        if (isset($this->request->post['president'])) {
            $data['president'] = $this->request->post['president'];
        } elseif (!empty($club_info)) {
            $data['president'] = $club_info['president'];
        } else {
            $data['president'] = '';
        }
        
        if (isset($this->request->post['mobile'])) {
            $data['mobile'] = $this->request->post['mobile'];
        } elseif (!empty($club_info)) {
            $data['mobile'] = $club_info['mobile'];
        } else {
            $data['mobile'] = '';
        }
        
        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($club_info)) {
            $data['email'] = $club_info['email'];
        } else {
            $data['email'] = '';
        }
        
        if (isset($this->request->post['website'])) {
            $data['website'] = $this->request->post['website'];
        } elseif (!empty($club_info)) {
            $data['website'] = $club_info['website'];
        } else {
            $data['website'] = '';
        }
        
        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }

        $this->load->model('tool/image');
             
        if (isset($this->request->post['image'])) {
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($club_info)) {
            $data['image'] = $club_info['image'];
        } else {
            $data['image'] = '';
        }
        
        $data['placeholder'] = $this->model_tool_image->resize('no-image.png', 100, 100);

        if (is_file(DIR_IMAGE . html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8'))) {
            $data['thumb'] = $this->model_tool_image->resize(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8'), 100, 100);
        } else {
            $data['thumb'] = $data['placeholder'];
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($club_info)) {
            $data['status'] = $club_info['status'];
        } else {
            $data['status'] = 0;
        }

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/club_form', $data));
    }

    protected function validateForm()
    {
        if (!$this->user->hasPermission('modify', 'catalog/club')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = $this->language->get('error_email');
        }

        $club_info = $this->model_catalog_club->getClubByEmail($this->request->post['email']);

        if (!isset($this->request->get['club_id'])) {
            if ($club_info) {
                $this->error['warning'] = $this->language->get('error_exists_email');
            }
        } else {
            if ($club_info && ($this->request->get['club_id'] != $club_info['club_id'])) {
                $this->error['warning'] = $this->language->get('error_exists_email');
            }
        }

        if ((utf8_strlen(trim($this->request->post['name'])) < 1) || (utf8_strlen(trim($this->request->post['name'])) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if ($this->request->post['password'] || (!isset($this->request->get['club_id']))) {
            if ((utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) < 4) || (utf8_strlen(html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8')) > 40)) {
                $this->error['password'] = $this->language->get('error_password');
            }

            if ($this->request->post['password'] != $this->request->post['confirm']) {
                $this->error['confirm'] = $this->language->get('error_confirm');
            }
        }

        return !$this->error;
    }

    protected function validateDelete()
    {
        if (!$this->user->hasPermission('delete', 'catalog/club')) {
            $this->error['warning'] = $this->language->get('error_delete');
        }

        foreach ($this->request->post['selected'] as $club_id) {
            if ($this->user->getId() == $club_id) {
                $this->error['warning'] = $this->language->get('error_account');
            }
        }

        return !$this->error;
    }
}
