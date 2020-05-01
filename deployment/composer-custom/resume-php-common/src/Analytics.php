<?php

namespace P3x;

/**
 * Simple Server Side Analytics
 *
 */

/**
 * Class Analytics
 * @package P3x
 */
class Analytics
{

    /**
     *
     */
    const GA_URL = 'https://stats.g.doubleclick.net/__utm.gif';
    /**
     * @var int
     */
    private static $RequestsForThisSession = 0; //@nczz update v5.6.4dc
    /**
     * @var array
     */
    private $data
        = array(
            'utmac' => null,
            'utmcc' => null,
            'utmcn' => null,
            'utmcr' => null,
            'utmcs' => null,
            'utmdt' => '-',
            'utmfl' => '-',
            'utme' => null,
            'utmni' => null,
            'utmhn' => null,
            'utmipc' => null,
            'utmipn' => null,
            'utmipr' => null,
            'utmiqt' => null,
            'utmiva' => null,
            'utmje' => 0,
            'utmn' => null,
            'utmp' => null,
            'utmr' => null,
            'utmsc' => '-',
            'utmvp' => '-',
            'utmsr' => '-',
            'utmt' => null,
            'utmtci' => null,
            'utmtco' => null,
            'utmtid' => null,
            'utmtrg' => null,
            'utmtsp' => null,
            'utmtst' => null,
            'utmtto' => null,
            'utmttx' => null,
            'utmul' => '-',
            'utmhid' => null,
            'utmht' => null,
            'utmwv' => '5.6.4dc'
        );
    /**
     * @var
     */
    private $tracking;

    /**
     * Analytics constructor.
     * @param null $UA
     * @param null $domain
     */
    public function __construct($UA = null, $domain = null)
    {
        $this->data['utmac'] = $UA;
        $this->data['utmhn'] = isset($domain) ? $domain : $_SERVER['SERVER_NAME'];
        $this->data['utmp'] = $_SERVER['PHP_SELF'];
        $this->data['utmn'] = mt_rand(1000000000, mt_getrandmax());
        $this->data['utmr'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $this->data['utmcc'] = $this->createCookie();
        $this->data['utmhid'] = mt_rand(1000000000, mt_getrandmax());
        $this->data['utmht'] = time() * 1000;
    }

    /**
     * Create unique cookie
     *
     * @return string
     */
    private function createCookie()
    {
        $rand_id = rand(10000000, 99999999);
        $random = rand(1000000000, 2147483647);
        $var = '-';
        $time = time();
        $cookie = '';
        $cookie .= '__utma=' . $rand_id . '.' . $random . '.' . $time . '.' . $time . '.' . $time . '.2;+';
        $cookie .= '__utmb=' . $rand_id . ';+';
        $cookie .= '__utmc=' . $rand_id . ';+';
        $cookie .= '__utmz=' . $rand_id . '.' . $time . '.2.2.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none);+';
        $cookie .= '__utmv=' . $rand_id . '.' . $var . ';';
        return $cookie;
    }

    /**
     *
     */
    static function Track()
    {
        if (!ANALYTICS) {
            return;
        }
        $ssga = new Analytics(GOOGLE_ANALYTICS_ID, HOST);
        $ssga->setPage($_SERVER['REQUEST_URI']);
        $ssga->send();
    }

    ////////////
    // Params //
    ////////////


    /////////////
    // Product //
    /////////////

    /**
     * @param null $var
     * @return null
     */
    public function setPage($var = null)
    {
        return $this->data['utmp'] = $var;
    }

    /**
     * Send tracking code/gif to GB
     * @return array|null
     */
    public function send()
    {
        if (!isset($this->tracking)) {
            $this->createGif();
        }

        return $this->remoteCall();
    }

    /**
     * Create the GA callback url, aka the gif
     *
     * @return string
     */
    public function createGif()
    {
        $data = array();
        foreach ($this->data as $key => $item) {
            if ($item !== null) {
                $data[$key] = $item;
            }
        }
        return $this->tracking = self::GA_URL . '?' . http_build_query($data);
    }

    /**
     * Use WP's HTTP class or CURL or fopen
     *
     * @return array|null|void
     */
    private function remoteCall()
    {

        if (function_exists(
            'wp_remote_head'
        )) { // Check if this is being used with WordPress, if so use it's excellent HTTP class

            $response = wp_remote_head($this->tracking);
            return $response;

        } elseif (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->tracking);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //@nczz Fixed HTTPS GET method
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_exec($ch);
            curl_close($ch);
        } else {
            $handle = fopen($this->tracking, "r");
            fclose($handle);
        }
        return;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setProductCode($var = null)
    {
        return $this->data['utmipc'] = $var;
    }

    //////////
    // Misc //
    //////////

    /**
     * @param null $var
     * @return null
     */
    public function setProductName($var = null)
    {
        return $this->data['utmipn'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setUnitPrice($var = null)
    {
        return $this->data['utmipr'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setQty($var = null)
    {
        return $this->data['utmiqt'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setVariation($var = null)
    {
        return $this->data['utmiva'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setJava($var = null)
    {
        return $this->data['utmje'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setEncodeType($var = null)
    {
        return $this->data['utmcs'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setFlashVersion($var = null)
    {
        return $this->data['utmfl'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setHost($var = null)
    {
        return $this->data['utmhn'] = $var;
    }

    //////////
    // Page //
    //////////

    /**
     * @param null $var
     * @return null
     */
    public function setScreenDepth($var = null)
    {
        return $this->data['utmsc'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setScreenResolution($var = null)
    {
        return $this->data['utmsr'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setLang($var = null)
    {
        return $this->data['utmul'] = $var;
    }

    /**
     * @param null $var
     * @return mixed|null
     */
    public function setGaVersion($var = null)
    {
        return $this->data['utmwv'] = isset($var) ? $var : $this->data['utmwv'];
    }

    /**
     * @param null $var
     * @return null
     */
    public function setPageTitle($var = null)
    {
        return $this->data['utmdt'] = $var;
    }

    ////////////
    // Events //
    ////////////

    /**
     * @param null $var
     * @return null
     */
    public function setCampaign($var = null)
    {
        return $this->data['utmcn'] = $var;
    }

    ///////////
    // Order //
    ///////////

    /**
     * @param null $var
     * @return null
     */
    public function cloneCampaign($var = null)
    {
        return $this->data['utmcr'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setReferal($var = null)
    {
        return $this->data['utmr'] = $var;
    }

    /**
     * @param $category
     * @param $action
     * @param string $label
     * @param string $value
     * @param bool $opt_noninteraction
     * @return string
     */
    public function setEvent($category, $action, $label = '', $value = '', $opt_noninteraction = false)
    {
        $event_category = (string)$category;
        $event_action = (string)$action;

        $event_string = '5(' . $event_category . '*' . $event_action;

        if (!empty($label)) {
            $event_string .= '*' . ((string)$label) . ')';
        } else {
            $event_string .= ')';
        }

        if (!empty($value)) {
            $event_string .= '(' . ((int)intval($value)) . ')';
        }

        if ($opt_noninteraction) {
            $this->data['utmni'] = '1';
        }

        $this->data['utmt'] = 'event';
        return $this->data['utme'] = $event_string;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setOrderId($var = null)
    {
        return $this->data['utmtid'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setBillingCity($var = null)
    {
        return $this->data['utmtci'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setBillingCountry($var = null)
    {
        return $this->data['utmtco'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setBillingRegion($var = null)
    {
        return $this->data['utmtrg'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setShippingCost($var = null)
    {
        return $this->data['utmtsp'] = $var;
    }

    ////////////////////////
    // Ecommerce Tracking //
    ////////////////////////

    /**
     * @param null $var
     * @return null
     */
    public function setAffiliate($var = null)
    {
        return $this->data['utmtst'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setTotal($var = null)
    {
        return $this->data['utmtto'] = $var;
    }

    /**
     * @param null $var
     * @return null
     */
    public function setTaxes($var = null)
    {
        return $this->data['utmttx'] = $var;
    }

    /**
     * Create and send a transaction object
     *
     * Parameter order from https://developers.google.com/analytics/devguides/collection/gajs/gaTrackingEcommerce
     * @param $transaction_id
     * @param $affiliation
     * @param $total
     * @param $tax
     * @param $shipping
     * @param $city
     * @param $region
     * @param $country
     * @return $this
     */
    public function sendTransaction($transaction_id, $affiliation, $total, $tax, $shipping, $city, $region, $country)
    {
        $this->data['utmvw'] = '5.6.4dc';
        $this->data['utms'] = ++self::$RequestsForThisSession;
        $this->data['utmt'] = 'tran';
        $this->data['utmtid'] = $transaction_id;
        $this->data['utmtst'] = $affiliation;
        $this->data['utmtto'] = $total;
        $this->data['utmttx'] = $tax;
        $this->data['utmtsp'] = $shipping;
        $this->data['utmtci'] = $city;
        $this->data['utmtrg'] = $region;
        $this->data['utmtco'] = $country;
        $this->data['utmcs'] = 'UTF-8';

        $this->send();
        $this->reset();

        return $this;
    }

    /**
     * Reset Defaults
     *
     * @return null
     */
    public function reset()
    {
        $data = array(
            'utmac' => null,
            'utmcc' => $this->createCookie(),
            'utmcn' => null,
            'utmcr' => null,
            'utmcs' => null,
            'utmdt' => '-',
            'utmfl' => '-',
            'utme' => null,
            'utmni' => null,
            'utmipc' => null,
            'utmipn' => null,
            'utmipr' => null,
            'utmiqt' => null,
            'utmiva' => null,
            'utmje' => '0',
            'utmn' => rand(1000000000, 9999999999),
            'utmp' => $_SERVER['PHP_SELF'],
            'utmr' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
            'utmsc' => '-',
            'utmsr' => '-',
            'utmt' => null,
            'utmtci' => null,
            'utmtco' => null,
            'utmtid' => null,
            'utmtrg' => null,
            'utmtsp' => null,
            'utmtst' => null,
            'utmtto' => null,
            'utmttx' => null,
            'utmul' => 'php',
            'utmht' => time() * 1000,
            'utmwv' => '5.6.4dc'
        );
        $this->tracking = null;
        return $this->data = $data;
    }

    /**
     * Add item to the created $transaction_id
     *
     * Parameter order from https://developers.google.com/analytics/devguides/collection/gajs/gaTrackingEcommerce
     * @param $transaction_id
     * @param $sku
     * @param $product_name
     * @param $variation
     * @param $unit_price
     * @param $quantity
     * @return $this
     */
    public function sendItem($transaction_id, $sku, $product_name, $variation, $unit_price, $quantity)
    {
        $this->data['utmvw'] = '5.6.4dc';
        $this->data['utms'] = ++self::$RequestsForThisSession;
        $this->data['utmt'] = 'item';
        $this->data['utmtid'] = $transaction_id;
        $this->data['utmipc'] = $sku;
        $this->data['utmipn'] = $product_name;
        $this->data['utmiva'] = $variation;
        $this->data['utmipr'] = $unit_price;
        $this->data['utmiqt'] = $quantity;
        $this->data['utmcs'] = 'UTF-8';

        $this->send();
        $this->reset();

        return $this;
    }

}
