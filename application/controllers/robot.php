<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 26/03/13
 * Time: 18:21
 * @property http_call_manager $http_call_manager
 * @property apple_feeder $apple_feeder
 * @property android_feeder $android_feeder
 */
class Robot extends CI_Controller
{

    const ANDROID_TOKEN_API = '121bc1910a119f65f19910356ca8faaaf9bb9dd3';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('log');
        $this->load->library('http_call_manager');
        $this->load->model('Applications_model');
        $this->load->model('Application_screenshots_model');
        $this->load->model('Editeurs_model');
    }

    public function index()
    {
        $this->load->view('robot.php');
    }

    public function android()
    {
        $website = 'http://dev.appaware.com/1/app/';
        try
        {
            $result = $this->http_call_manager->call('GET',
                'top.json',
                '?d=month&t=popular&c=12&cc=worldwide&num=200&page=1&client_token='.self::ANDROID_TOKEN_API,
                $website);

            if(!empty($result["results"]))
            {
                $allAppsDetailed = array();
                foreach($result["results"] as $app)
                {
                    $appDetailed = $this->http_call_manager->call('GET',
                        'show.json',
                        '?p='.$app['package_name'].'&client_token='.self::ANDROID_TOKEN_API,
                        $website);
                    $allAppsDetailed[] = $appDetailed;
                }
                $this->load->library('android_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, $allAppsDetailed));
                try
                {
                    $this->android_feeder->feed('en', 'en');
                }
                catch(Exception $e)
                {
                    echo 'ERREUR : '.$e->getMessage();
                }
            }
        }
        catch(Exception $e)
        {
            $this->log->write_log('ERROR', $e->getMessage());
        }

    }

    public function apple()
    {
        $langues = array('en', 'fr');
        $types = array('topfreeapplications', 'toppaidapplications', 'topgrossingapplications');
        foreach($langues as $langue)
        {
            foreach ($types as $type)
            {
                try
                {
                    $result = $this->http_call_manager->call('GET',
                                                            $type.'/limit=300/genre=6020',
                                                            'json',
                                                            'https://itunes.apple.com/'.$langue.'/rss');
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
                catch(Exception $e)
                {
                    $this->log->write_log('ERROR', $e->getMessage());
                    continue;
                }
            }
        }
    }
}

