<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 26/03/13
 * Time: 18:21
 * @property http_call_manager $http_call_manager
 * @property http_call_manager_clear $http_call_manager_clear
 * @property apple_feeder $apple_feeder
 * @property android_feeder $android_feeder
 * @property Spool_crawl_applications_model $Spool_crawl_applications_model
 * @property Devices_model $Devices_model
 */
class Robot extends CI_Controller
{

    const ANDROID_TOKEN_API = '121bc1910a119f65f19910356ca8faaaf9bb9dd3';
    const ANDROID_APPAWARE_WEBSITE = 'http://dev.appaware.com/1/app/';

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
        $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $this->load->view('robot.php');
    }

    public function crawlAndroid()
    {
        $sizePage = 24;
        $collections = array('topselling_paid', 'topselling_free');
        $website = 'https://play.google.com';
        $target = 'store/apps/category/MEDICAL/collection';
//        var_dump(file_get_contents('https://play.google.com//store/apps/category/MEDICAL/collection/topselling_paid?start=0'));
        foreach($collections as $collection)
        {
            $start = 0;
            $end = false;
            do
            {
                try
                {
                    $data = $this->http_call_manager_clear->call('GET',
                        $target,
                        $collection.'?start='.$start,
                        $website);
                    $matches = array();
                    preg_match_all('/data-docid="([A-Za-z0-9\.]+)"/', $data, $matches);
                    if(!empty($matches[1]))
                    {
                        $this->load->model('Spool_crawl_applications_model');
                        foreach($matches[1] as $package)
                        {
                            if(!$this->Spool_crawl_applications_model->exists_packages($package, Devices_model::APPLICATION_DEVICE_ANDROID))
                            {
                                $this->Spool_crawl_applications_model->insert_package($package, Devices_model::APPLICATION_DEVICE_ANDROID);
                            }
                        }
                    }
                    $start+=$sizePage;
                }
                catch(Exception $e)
                {
                    echo 'erreur '.$e->getCode().' : '.$e->getMessage();
                    $end = true;
                    continue;
                }
            }
            while(!$end);
        }
    }

    private function _feed_android_from_crawl()
    {
        $allAppsDetailed = array();
        $this->load->model('Spool_crawl_applications_model');
        $crawls = $this->Spool_crawl_applications_model->get_unadded_packages(Devices_model::APPLICATION_DEVICE_ANDROID);
        foreach ($crawls as $crawlPackage)
        {
            try
            {
                $appDetailed = $this->http_call_manager->call('GET',
                    'show.json',
                    '?p='.$crawlPackage->package.'&client_token='.self::ANDROID_TOKEN_API,
                    self::ANDROID_APPAWARE_WEBSITE);
                $allAppsDetailed[] = $appDetailed;
            }
            catch(Exception $e)
            {
                echo 'erreur '.$e->getCode().' : '.$e->getMessage();
            }
        }
        return $allAppsDetailed;
    }

    public function androidFromCrawl()
    {
        $allAppsFromCrawl = $this->_feed_android_from_crawl();
        $this->load->library('android_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, Devices_model::APPLICATION_DEVICE_ANDROID, $allAppsFromCrawl));
        try
        {
            $this->android_feeder->feed('fr', 'fr');
        }
        catch(Exception $e)
        {
            echo 'ERREUR : '.$e->getMessage();
        }
    }

    public function android()
    {
        try
        {
            $data = $this->http_call_manager->call('GET',
                'top.json',
                '?d=month&t=popular&c=12&cc=worldwide&num=200&page=1&client_token='.self::ANDROID_TOKEN_API,
                self::ANDROID_APPAWARE_WEBSITE);

            if(!empty($result["results"]))
            {
                $allAppsDetailed = array();
                foreach($data["results"] as $app)
                {
                    $appDetailed = $this->http_call_manager->call('GET',
                        'show.json',
                        '?p='.$app['package_name'].'&client_token='.self::ANDROID_TOKEN_API,
                        self::ANDROID_APPAWARE_WEBSITE);
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
                    $data = $this->http_call_manager->call('GET',
                                                            $type.'/limit=300/genre=6020',
                                                            'json',
                                                            'https://itunes.apple.com/'.$langue.'/rss');
                    if(!empty($data['feed']['entry']))
                    {
                        $this->load->library('apple_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, Devices_model::APPLICATION_DEVICE_ANDROID, $data['feed']['entry']));
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

