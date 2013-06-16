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
    const APPLE_LOOKUP_WEBSITE = 'https://itunes.apple.com';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('http_call_manager');
//        $this->load->library('http_call_manager', array(true), 'http_call_manager_clear');
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
                        $this->load->model('Spool_crawl_android_applications_model');
                        foreach($matches[1] as $package)
                        {
                            if(!$this->Spool_crawl_android_applications_model->exists_packages($package))
                            {
                                $this->Spool_crawl_android_applications_model->insert_package($package);
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

    private function _feed_android_from_search()
    {
        $allAppsDetailed = array();
        $this->load->model('Spool_crawl_android_applications_model');
        $crawls = $this->Spool_crawl_android_applications_model->get_unadded_packages();
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

    public function android()
    {
        $allAppsFromCrawl = $this->_feed_android_from_search();
        $this->load->library('android_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, Devices_model::APPLICATION_DEVICE_ANDROID));
        try
        {
            $this->android_feeder->setItems($allAppsFromCrawl);
            $oks = $this->android_feeder->feed('en', '');
            log_message('debug', 'oks = '.var_export($oks, true));
            foreach($oks as $packageOk)
            {
                $this->Spool_crawl_android_applications_model->set_package_added($packageOk);
            }
        }
        catch(Exception $e)
        {
            echo 'ERREUR : '.$e->getMessage();
        }
    }

    public function searchAndroid()
    {
        $types = array('popular', 'trending', 'paid', 'country', 'installed', 'updated');
        $countries = array('worldwide', 'FR');
        $categories = array(12, 9);
        $calls = array('top', 'justin', 'price_reduced');
        foreach($types as $type)
        {
            foreach($countries as $country)
            {
                foreach($calls as $call)
                {
                    foreach($categories as $categorie)
                    {
                        $page = 1;
                        do
                        {
                            try
                            {
                                $data = $this->http_call_manager->call('GET',
                                    $call.'.json',
                                    '?d=month&t='.$type.'&c='.$categorie.'&cc='.$country.'&num=100&page='.$page.'&client_token='.self::ANDROID_TOKEN_API,
                                    self::ANDROID_APPAWARE_WEBSITE);

                                if(!empty($data["results"]))
                                {
    //                                echo "nb res = ".count($data["results"]).'<br/>';
                                    $this->load->model('Spool_crawl_android_applications_model');
                                    foreach($data["results"] as $app)
                                    {
                                        if(!$this->Spool_crawl_android_applications_model->exists_packages($app['package_name']))
                                        {
                                            log_message('debug', 'adding '.$app['package_name']);
                                            $this->Spool_crawl_android_applications_model->insert_package($app['package_name']);
                                        }
    //                                    echo $app['package_name'];
                                    }
                                }
                                $page++;
                            }
                            catch(Exception $e)
                            {
                                log_message('error', $e->getMessage());
                            }
                        }
                        while($data['number_results'] > 0 && $page < 10);
                    }
                }
            }
        }
    }

    public function updateApple()
    {
//        https://itunes.apple.com/lookup?id=
        $this->load->model('Spool_crawl_apple_applications_model');
        $this->load->model('Application_screenshots_model');
        $crawls = $this->Spool_crawl_apple_applications_model->get_unadded_packages();
        foreach ($crawls as $crawlPackage)
        {
            echo $crawlPackage->package."<br/>";
            try
            {
                $resultWs = $this->http_call_manager->call('GET',
                    'lookup',
                    '?id='.$crawlPackage->package,
                    self::APPLE_LOOKUP_WEBSITE);
                if(isset($resultWs["resultCount"]) && $resultWs["resultCount"] == 1 && isset($resultWs["results"][0]))
                {
                    $appDetailed = $resultWs["results"][0];
                    $updates = array();
                    if(!empty($appDetailed['version']))
                    {
                        $updates['version'] = $appDetailed['version'];
                    }
//                    var_dump($updates);
                    if(!$this->Applications_model->update_application($updates, array('package' => $appDetailed['bundleId'], 'device_id' => Devices_model::APPLICATION_DEVICE_APPLE)))
                    {
                        log_message('debug', "fail to update version for =".$crawlPackage->package);
                        continue;
                    }
                    else
                    {
                        log_message('debug', "version updated for =".var_export($appDetailed['bundleId'], true));
                    }
                    if(!empty($appDetailed['screenshotUrls']))
                    {
                        foreach($appDetailed['screenshotUrls'] as $screen)
                        {
//                            echo "screen = $screen <br/>";

                            if(!$this->Application_screenshots_model->exists_application_screenshots($screen, $crawlPackage->application_id))
                            {
                                $this->Application_screenshots_model->insert_application_screenshots($screen, $crawlPackage->application_id);
                                log_message('debug', "insert $screen  for ".$crawlPackage->package);
                            }
                        }
                    }
                    $this->Spool_crawl_apple_applications_model->set_package_added($crawlPackage->package);
                }
            }
            catch(Exception $e)
            {
                echo 'erreur '.$e->getCode().' : '.$e->getMessage();
            }
        }

    }

    public function apple()
    {
        $langues = array('en', 'fr');
        $types = array('topfreeapplications', 'toppaidapplications', 'topgrossingapplications');
        $categories = array(6020, 6013);
        $this->load->model('Spool_crawl_apple_applications_model');
        foreach($langues as $langue)
        {
            foreach ($types as $type)
            {
                foreach ($categories as $categorie)
                {
                    try
                    {
                        $data = $this->http_call_manager->call('GET',
                                                                $type.'/limit=300/genre='.$categorie,
                                                                'json',
                                                                'https://itunes.apple.com/'.$langue.'/rss');
                        if(!empty($data['feed']['entry']))
                        {
                            $this->load->library('apple_feeder', array($this->Applications_model, $this->Editeurs_model, $this->Application_screenshots_model, Devices_model::APPLICATION_DEVICE_APPLE, $this->Spool_crawl_apple_applications_model));
                            try
                            {
                                $this->apple_feeder->setItems($data['feed']['entry']);
                                $this->apple_feeder->feed($langue, '');
                            }
                            catch(Exception $e)
                            {
                                log_message('error', $e->getMessage());
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        log_message('error', $e->getMessage());
                    }
                }
            }
        }
    }

    public function detect()
    {
        require_once 'Text/LanguageDetect.php';
        require_once 'PEAR.php';
        $l = new Text_LanguageDetect();
        $languages = array();
        for($i = 0; $i<20; $i++)
        {
            $results = $this->db->select('device_id, id, langue_store, titre, description')->limit(100, $i * 100)->get('application')->result();
            foreach($results as $result)
            {
//                $resultTitre = $l->detect($result->titre, 4);
//                if (PEAR::isError($resultTitre)) {
//                    echo "erreur ".$result->id." : ".$resultTitre->getMessage()."<br/>";
//                    log_message('debug', "erreur ".$result->id." : ".$resultTitre->getMessage());
//                } else {
                    $resultDescription = $l->detect($result->description, 4);
                    if (PEAR::isError($resultDescription)) {
//                        echo "erreur ".$result->id." : ".$resultDescription->getMessage()."<br/>";
                        log_message('debug', "erreur ".$result->id." : ".$resultDescription->getMessage());
                    } else {
//                        echo "ok ".$result->id."<br/>";
                        log_message('debug', "ok ".$result->id);
//                        foreach($resultTitre as $lang => $proba){
//                            $resultTitre = $lang; break;
//                        }
                        foreach($resultDescription as $lang => $proba){
                            $resultDescription = $lang; break;
                        }
                        log_message('debug', "language=".var_export($resultDescription, true)."");
//                        var_dump($resultTitre);
//                        var_dump($resultDescription);
                        $device = $result->device_id == 1 ? 'apple' : 'android';
                        if(!isset($languages[$device]['store_'.$result->langue_store][$resultDescription]))
                        {
                            $languages[$device]['store_'.$result->langue_store][$resultDescription] = 1;
                        }
                        else
                        {
                            $languages[$device]['store_'.$result->langue_store][$resultDescription]++;
                        }
                    }
//                }
            }
            log_message('debug', "languages=".var_export($languages, true)."");
        }
        var_dump($languages);
    }
}

