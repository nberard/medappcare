<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 26/03/13
 * Time: 18:21
 * @property http_call_manager $http_call_manager
 */
class Robot extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
//        $this->load->database();
//        $this->load->helper('url');
//        $this->load->helper('country');
        $this->load->library('log');
        $this->load->library('http_call_manager');
//        $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $this->load->view('robot.php');
    }

    public function android()
    {
//        $this->http_call_manager->call('GET', '')
    }

    public function apple()
    {
        $result = '';
        try
        {
            $result = $this->http_call_manager->call('GET', 'newapplications/limit=300/genre=6020', 'json', 'https://itunes.apple.com/fr/rss');
        }
        catch(Exception $e)
        {
            $this->log->write_log('ERROR', $e->getMessage());
        }
        if(!empty($result['feed']['entry']))
        {
            $this->load->library('')
        }
    }
}

