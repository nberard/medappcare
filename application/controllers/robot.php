<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 26/03/13
 * Time: 18:21
 * @property http_call_manager $http_call_manager
 * @property http_call_manager_clear $http_call_manager
 * @property apple_feeder $apple_feeder
 * @property android_feeder $android_feeder
 * @property Spool_crawl_applications_model $Spool_crawl_applications_model
 * @property Devices_model $Devices_model
 */
class Robot extends CI_Controller
{

    const ANDROID_TOKEN_API = '121bc1910a119f65f19910356ca8faaaf9bb9dd3';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('log');
        $this->load->library('http_call_manager');
        $this->load->library('http_call_manager', array(true), 'http_call_manager_clear');
        $this->load->model('Applications_model');
        $this->load->model('Application_screenshots_model');
        $this->load->model('Editeurs_model');
        $this->load->model('Devices_model');
    }

    public function index()
    {
        $this->load->view('robot.php');
    }

    public function crawlAndroid()
    {
        $sizePage = 24;
        $collections = array('topselling_paid');
        $website = 'https://play.google.com';
        $target = 'store/apps/category/MEDICAL/collection';
//        var_dump(file_get_contents('https://play.google.com//store/apps/category/MEDICAL/collection/topselling_paid?start=0'));
        foreach($collections as $collection)
        {
            $start = 0;
            do
            {
                try
                {
                    $result = $this->http_call_manager_clear->call('GET',
                        $target,
                        $collection.'?start='.$start,
                        $website);
                    echo 'result';
//                    var_dump($result);
                    $matches = array();
                    preg_match_all('/data-docid="([A-Za-z0-9\.]+)"/', $result, $matches);
                    if(!empty($matches))
                    {
                        $this->load->model('Spool_crawl_applications_model');
                        foreach($matches as $package)
                        {
                            if(!$this->Spool_crawl_applications_model->exists_packages($package, Devices_model::APPLICATION_DEVICE_ANDROID))
                            {
                                $this->Spool_crawl_applications_model->insert_package($package, Devices_model::APPLICATION_DEVICE_ANDROID);
                            }
                        }
                    }
                }
                catch(Exception $e)
                {
                    var_dump($e);
                    $this->log->write_log('ERROR', $e->getMessage());
                    continue;
                }
                $start+=$sizePage;
            }
            while(false);

        }
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
                $this->load->library('android_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, Devices_model::APPLICATION_DEVICE_ANDROID, $allAppsDetailed));
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
                        $this->load->library('apple_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, Devices_model::APPLICATION_DEVICE_ANDROID, $result['feed']['entry']));
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

