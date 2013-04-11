<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 26/03/13
 * Time: 18:21
 * @property http_call_manager $http_call_manager
 * @property apple_feeder $apple_feeder
 */
class Robot extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('log');
        $this->load->library('http_call_manager');
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
        $langues = array('en', 'fr');
        $types = array('topfreeapplications', 'toppaidapplications', 'topgrossingapplications');
        $this->load->model('Applications_model');
        $this->load->model('Application_screenshots_model');
        $this->load->model('Editeurs_model');
        foreach($langues as $langue)
        {
            foreach ($types as $type)
            {
                try
                {
                    $result = $this->http_call_manager->call('GET', $type.'/limit=300/genre=6020', 'json', 'https://itunes.apple.com/'.$langue.'/rss');
                }
                catch(Exception $e)
                {
                    $this->log->write_log('ERROR', $e->getMessage());
                    continue;
                }
                if(!empty($result['feed']['entry']))
                {
                    $this->load->library('apple_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, $result['feed']['entry']));
                    try
                    {
                        $this->apple_feeder->feed($langue, $langue);
                    }
                    catch(Exception $e)
                    {
                        echo 'ERREUR : '.$e->getMessage();
                    }
                }
            }
        }

    }
}

