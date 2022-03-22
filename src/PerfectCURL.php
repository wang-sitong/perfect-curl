<?php

namespace PerfectCURL;
class PerfectCURL
{
    /**
     * Type get,post,put,delete for the request.
     * @var string
     */
    protected $type;

    /**
     * Headers for the request.
     * @var array
     */
    protected $headers;

    /**
     * Address for the request.
     * @var array
     */
    protected $url;

    /**
     * Params for the request.
     * @var array
     */
    protected $params;

    /**
     * Content type (json,x-www-form-urlencoded) for the request.
     * @var string
     */
    protected $contentType;

    /**
     * Proxy (127.0.0.1:9999) for the request.
     * @var string
     */
    protected $proxy;

    /**
     * error for the request.
     * @var string
     */
    protected $error;

    /**
     * Http info for the request.
     * @var string
     */
    protected $httpInfo;

    /**
     * Http code for the request.
     * @var string
     */
    protected $httpCode;

    /**
     * @param string $url www.baidu.com
     * @param string $contentType json,x-www-form-urlencoded
     * @param string $type get,post,put,delete
     * @param array $params []
     * @param array $headers []
     * @param string $error error
     * @param string $httpInfo info message
     * @param string $httpCode code status
     */
    public function __construct(string $url = '', string $contentType = 'json', string $type = 'get', array $params = [], array $headers = [], string $error = '', string $httpInfo = '', string $httpCode = '', string $proxy = '')
    {
        $this->setType($type);
        $this->setUrl($url);
        $this->setContentType($contentType);
        $this->setParams($params);
        $this->setHeaders($headers);
        $this->setError($error);
        $this->setHttpInfo($httpInfo);
        $this->setHttpCode($httpCode);
        $this->setProxy($proxy);
    }

    public function start()
    {
        $headers = [
            "Content-type:application/json;",
            "Accept:application/json",
        ];
        if ($this->contentType == 'x-www-form-urlencoded') {
            $headers[0] = "array('Content-Type: application/x-www-form-urlencoded')";
        }
        if ($this->header) {
            $headers = $this->header;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在'
        curl_setopt($ch, CURLINFO_HEADER_OUT, true); //TRUE 时追踪句柄的请求字符串，从 PHP 5.1.3 开始可用。这个很关键，就是允许你查看请求header


        if ($this->proxy) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
        }

        switch ($this->type) {
            case 'get':
                if (is_array($this->params)) {
                    $this->params = http_build_query($this->params);
                }
                curl_setopt($ch, CURLOPT_URL, $this->url . '?' . $this->params);
                break;
            case 'post':
                curl_setopt($ch, CURLOPT_POST, true);
                switch ($this->contentType) {
                    case 'json':
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->params));
                        break;
                    case 'x-www-form-urlencoded':
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));
                        break;
                }
                curl_setopt($ch, CURLOPT_URL, $this->url);
                break;
            case 'put':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->params);
                curl_setopt($ch, CURLOPT_URL, $this->url);
                break;
            case 'delete':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->params);
                curl_setopt($ch, CURLOPT_URL, $this->url);
                break;
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            $this->error = json_encode(curl_error($ch));
            curl_close($ch);
            return false;
        }

        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->httpInfo = curl_getinfo($ch);
        curl_close($ch);
        return $response;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setHeaders($headers)
    {
        $this->header = $headers;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function setProxy($proxy)
    {
        $this->proxy = $proxy;
        return $this;
    }

    public function getProxy()
    {
        return $this->proxy;
    }

    public function setHttpInfo($httpInfo)
    {
        $this->httpinfo = $httpInfo;
        return $this;
    }

    public function getHttpInfo()
    {
        return $this->httpInfo;
    }


    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    public function getError()
    {
        return $this->error;
    }


}
