<?php

class ControllerClubDashboard extends PT_Controller
{
    public function index()
    {
        $this->load->language('club/dashboard');

        $this->document->setTitle($this->language->get('heading_title'));

        if (!$this->customer->isLogged()) {
            $this->response->redirect($this->url->link('club/login'));
        }

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
            'text' => $this->language->get('text_dashboard'),
            'href' => $this->url->link('club/dashboard')
        );


        $data['continue'] = $this->url->link('common/home');

        $data['dashboard'] = $this->url->link('club/dashboard');
        $data['project'] = $this->url->link('club/project');
        $data['trf'] = $this->url->link('club/trf');
        $data['member'] = $this->url->link('club/member');
        $data['profile'] = $this->url->link('club/profile');
        $data['logout'] = $this->url->link('club/logout');

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('club/dashboard', $data));
    }
}
