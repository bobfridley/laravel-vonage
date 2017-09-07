<?php

namespace BobFridley\Vonage;

use Carbon\Carbon;
use DateTime;
use App\Components\Vonage\Exceptions\BadResponse;
use App\Components\Freshdesk\Freshdesk;

class Vonage
{
    /**
     * [$base_uri description]
     * 
     * @var string
     */
    public $base_uri = 'https://my.vonagebusiness.com';

    /**
     * [$cookie description]
     * 
     * @var [type]
     */
    private $cookie;

    /**
     * [$client description]
     * 
     * @var [type]
     */
    private $client;

    /**
     * [$auth description]
     * 
     * @var array
     */
    public $auth = array();

    /**
     * [$connection description]
     * @var string
     */
    public $connection;

    /**
     * [__construct description]
     *
     * @param string $connection
     *
     * @return \Vonage\Client
     *
     * @throws App\Components\Vonage\Exceptions\BadResponse
     */
    public function __construct($connection = 'main')
    {
        $this->connection = $connection;

        $this->client = \Vonage::connection($connection);
        $this->auth = \Vonage::getConnectionConfig($connection);
    }
    
    /**
     * [makeRequest description]
     * @param  [type] $uri [description]
     * @return [type]      [description]
     */
    public function makeRequest($uri)
    {
        $request = $this->client->get($uri, [
            // 'cookies' => $this->cookie,
            'query' => [
                'htmlLogin' => $this->auth['username'],
                'htmlPassword' => $this->auth['password']
            ],
            'headers' => ['X-Vonage' => 'vonage']
        ]);

        if (!isset($request)) {
            throw BadResponse::create($request);
        }

        $response = json_decode($request->getBody()->getContents(), true);

        return $response;
    }

    /**
     * [getExtensions description]
     * @return [type] [description]
     */
    public function getExtensions()
    {
        $uri = $this->base_uri . '/presence/rest/directory';

        $extensions = $this->makeRequest($uri);

        if (!isset($extensions['extensions'])) {
            throw BadResponse::create($vonage);
        }

        if (!count($extensions['extensions'])) {
            return false;
        };

        foreach ($extensions['extensions'] as $extension => $value) {
            if (strlen(trim($value['name'])) > 0) {
                switch ($value['status']) {
                    case 'available':
                        $callIcon = 'fa-phone';
                        break;
                    case 'busy':
                        $callIcon = 'fa-volume-control-phone';
                        break;
                    default:
                        $callIcon = 'fa-times';
                        break;
                }

                $callDirection = '';
                $onCallWith = '';
                $onCallWithName = '';
                $onCallWithNumber = '';
                $directionIcon = '';

                if ($value['status'] == 'busy') {
                    $extentionDetails = $this->getExtension($extension);
                    $extentionDetails = $extentionDetails['details']['presence'];

                    if (count($extentionDetails) > 0) {
                        $callDirection = $extentionDetails['direction'];

                        switch ($callDirection) {
                            case 'inbound':
                                $directionIcon = 'fa-long-arrow-left';
                                break;
                            case 'outbound':
                                $directionIcon = 'fa-long-arrow-right';
                                break;
                            default:
                                $directionIcon = '';
                                break;
                        }
                        
                        $onCallWithName = $extentionDetails['onCallWithName'];

                        // remove 1st digit = 1
                        $onCallWithNumber = substr($extentionDetails['onCallWith'], 1, 10);
// dd($onCallWith, $onCallWithNumber, $onCallWithName);
                        // get Freshdesk company
                        $company = Freshdesk::getCompanyByPhone($onCallWithNumber);
// dd($onCallWithName, $onCallWithNumber);
                        $onCallWith = (count($company) === 0)
                            // ? (!empty($onCallWithName) ? $onCallWithName : $onCallWithNumber)
                            ? ($onCallWithName == 'null' ? $onCallWithNumber : $onCallWithName)
                            : $company[0]['company'];
                    }
                }

                $extensionInfo[$extension] = array(
                    'extension'     => $extension,
                    'name'          => $value['name'],
                    'status'        => $value['status'],
                    'loginName'     => $value['loginName'],
                    'callIcon'      => $callIcon,
                    'directionIcon' => $directionIcon,
                    'company'       => $onCallWith,
                    'callerId'      => $onCallWithName
                );
            }
        }

        return $extensionInfo;
    }

    /**
     * [getExtension description]
     * @param  [type] $extension [description]
     * @return [type]            [description]
     */
    public function getExtension($extension)
    {
        $uri = $this->base_uri . "/presence/rest/extension/{$extension}";

        $extentionDetails = $this->makeRequest($uri);

        return $extentionDetails;
    }

    /**
     * [getCallHistory description]
     * @param  string      $extension    [description]
     * @param  Carbon|null $start        [description]
     * @param  Carbon|null $end          [description]
     * @param  string      $result       [description]
     * @return array                     [description]
     */
    public function getCallHistory(
        string $extension = null,
        Carbon $start = null,
        Carbon $end = null,
        string $result = null)
    {
        if (is_null($start)) {
            $start = Carbon::now('America/New_York')->startOfDay()->format(DateTime::RFC3339);
            $start = substr($start, 0, -6);
        }

        if (is_null($end)) {
            $end = Carbon::now('America/New_York')->format(DateTime::RFC3339);
        }

        if (is_null($result)) {
            $result = 'answered,unanswered,voicemail';
        }

        $uri = $this->base_uri . "/presence/rest/callhistory/{$extension}?start={$start}&end={$end}&result={$result}";

        $callHistory = $this->makeRequest($uri);

        return $callHistory;
    }
}
