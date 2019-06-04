<?php

class ControllerClubLogin extends PT_Controller
{
    public function index()
    {
        $this->load->language('club/login');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('club/login')
        );

      

        if ($this->user->isLogged() && isset($this->request->get['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {
            $this->response->redirect($this->url->link('club/dashboard', 'user_token=' . $this->session->data['user_token']));
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->session->data['user_token'] = token(32);

            if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) === 0)) {
                $this->response->redirect($this->request->post['redirect'] . '&user_token=' . $this->session->data['user_token']);
            } else {
                $this->response->redirect($this->url->link('club/dashboard', 'user_token=' . $this->session->data['user_token']));
            }
        }

        if ((isset($this->session->data['user_token']) && !isset($this->request->get['user_token'])) || ((isset($this->request->get['user_token']) && (isset($this->session->data['user_token']) && ($this->request->get['user_token'] != $this->session->data['user_token']))))) {
            $this->error['warning'] = $this->language->get('error_token');
        } elseif (isset($this->error['warning'])) {
            $data['warning_err'] = $this->error['warning'];
        } elseif (isset($this->session->data['error'])) {
            $data['warning_err'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $data['warning_err'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['action'] = $this->url->link('club/login');

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } else {
            $data['email'] = '';
        }

        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }

        if (isset($this->request->get['url'])) {
            $route = $this->request->get['url'];

            unset($this->request->get['url']);
            unset($this->request->get['user_token']);

            $url = '';

            if ($this->request->get) {
                $url .= http_build_query($this->request->get);
            }

            $data['redirect'] = $this->url->link($route, $url);
        } else {
            $data['redirect'] = '';
        }

        if ($this->config->get('config_password')) {
            $data['forgotten'] = $this->url->link('user/forgotten');
        } else {
            $data['forgotten'] = '';
        }

        // $data['action'] = $this->url->link('club/login');

        $data['continue'] = $this->url->link('common/home');

        $data['header'] = $this->load->controller('common/header');
        $data['nav'] = $this->load->controller('common/nav');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('club/login', $data));
    }
     protected function validate()
    {
        if (!isset($this->request->post['email']) || !isset($this->request->post['password']) || !$this->user->login($this->request->post['email'], html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8'))) {
            $this->error['warning'] = $this->language->get('error_login');
        }

        return !$this->error;
    }
}
