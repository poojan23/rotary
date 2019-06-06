<?php

class ControllerClubProject extends PT_Controller
{
    public function index()
    {
        $this->load->language('club/project');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('club/project');

        if (!$this->customer->isLogged()) {
            $this->response->redirect($this->url->link('club/login'));
        }
       
        $this->getList();
    }
    public function add()
    {
        $this->load->language('club/project');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('club/project');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->model_club_project->addProject($this->request->post);

            $this->response->redirect($this->url->link('club/project'));
        }

        $this->getForm();
    }

protected function getList()
    {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('common/dashboard')
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('club/project')
        );

        $data['add'] = $this->url->link('club/project/add');

        $data['projects'] = array();

        $results = $this->model_club_project->getProjectById($this->customer->getId());
        
        foreach ($results as $result) {
            $data['projects'][] = array(
                'project_id'    => $result['project_id'],
                'date'         => $result['date'],
                'title'    => $result['title'],
                'description'    => $result['description'],
                'amount'    => $result['amount'],
                'no_of_beneficiary'    => $result['no_of_beneficiary'],
                'points'    => $result['points'],
                'view'          => $this->url->link('club/project/view', 'project_id=' . $result['project_id'])
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


        $data['club_id'] = $this->customer->getId();
        $data['club_name'] = $this->customer->getFirstName();
        $data['date'] = $this->customer->getDate();
        $data['mobile'] = $this->customer->getMobile();
        $data['email'] = $this->customer->getEmail();
        $data['president'] = $this->customer->getPresident();
        $data['assistant_governor'] = $this->customer->getAssistant();
        $data['district_secretary'] = $this->customer->getDistrict();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

         $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('club/project')
        );


        $data['continue'] = $this->url->link('common/home');
        $data['add_project'] = $this->url->link('club/project/add');
        $data['dashboard'] = $this->url->link('club/dashboard');
        $data['project'] = $this->url->link('club/project');
        $data['trf'] = $this->url->link('club/project');
        $data['member'] = $this->url->link('club/member');
        $data['profile'] = $this->url->link('club/profile');
        $data['logout'] = $this->url->link('club/logout');

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('club/project', $data));
    }

    protected function getForm()
    {
        $this->load->model('club/project');

        $data['text_form'] = !isset($this->request->get['project_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

        $club_id = $this->customer->getId();
        
        #category 
        $data['categoires'] = array();

        $results = $this->model_club_project->getCategories();

        foreach ($results as $result) {
            $data['categoires'][] = array(
                'category_id'    => $result['category_id'],
                'name'         => $result['name']
            );
        }
        
        #form 
        if (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->error['month'])) {
            $data['month_err'] = $this->error['month'];
        } else {
            $data['month_err'] = '';
        }

        if (isset($this->error['year'])) {
            $data['year_err'] = $this->error['year'];
        } else {
            $data['year_err'] = '';
        }


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('text_home'),
            'href'  => $this->url->link('common/dashboard')
        );

        $data['breadcrumbs'][] = array(
            'text'  => $this->language->get('heading_title'),
            'href'  => $this->url->link('club/project')
        );

        if (!isset($this->request->get['project_id'])) {
            $data['action'] = $this->url->link('club/project/add');
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_add'),
                'href'  => $this->url->link('club/project/add')
            );
        } else {
            $data['action'] = $this->url->link('club/project/edit' . '&project_id=' . $this->request->get['project_id']);
            $data['breadcrumbs'][] = array(
                'text'  => $this->language->get('text_edit'),
                'href'  => $this->url->link('club/project/edit')
            );
        }

        $data['cancel'] = $this->url->link('club/project');

        if (isset($this->request->get['project_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $project_info = $this->model_club_project->getMember($this->request->get['project_id']);
        }
        
        if (isset($this->request->post['month'])) {
            $data['month'] = $this->request->post['month'];
        } elseif (!empty($project_info)) {
            $data['month'] = $project_info['month'];
        } else {
            $data['month'] = '';
        }

        if (isset($this->request->post['year'])) {
            $data['year'] = $this->request->post['year'];
        } elseif (!empty($project_info)) {
            $data['year'] = $project_info['year'];
        } else {
            $data['year'] = '';
        }

        if (!$this->customer->isLogged()) {
            $this->response->redirect($this->url->link('club/login'));
        }

        $data['club_id'] = $this->customer->getId();
        $data['club_name'] = $this->customer->getFirstName();
        $data['date'] = $this->customer->getDate();
        $data['mobile'] = $this->customer->getMobile();
        $data['email'] = $this->customer->getEmail();
        $data['president'] = $this->customer->getPresident();
        $data['assistant_governor'] = $this->customer->getAssistant();
        $data['district_secretary'] = $this->customer->getDistrict();

        $data['continue'] = $this->url->link('common/home');
        $data['add_project'] = $this->url->link('club/project/add');
        $data['dashboard'] = $this->url->link('club/dashboard');
        $data['project'] = $this->url->link('club/project');
        $data['trf'] = $this->url->link('club/project');
        $data['member'] = $this->url->link('club/member');
        $data['profile'] = $this->url->link('club/profile');
        $data['logout'] = $this->url->link('club/logout');


        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('club/project_form', $data));
    }
}
