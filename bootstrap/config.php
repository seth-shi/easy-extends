<?php
/**
 * 伪造请求头，防止不允许下载扩展包的.zip
 * 会从这几个中随机选取一个放入请求头
 * 构造请求
 */
return [
    [
        'CURLOPT_USERAGENT' => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5',
    ],
    [
        'CURLOPT_USERAGENT' => 'Mozilla/5.0 (Windows; U; Windows NT 5.2) Gecko/2008070208 Firefox/3.0.1',
    ],
    [
        'CURLOPT_USERAGENT' => 'Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.2.149.27 Safari/525.13',
    ],
    [
        'CURLOPT_USERAGENT' => 'Mozilla/5.0 (Windows; U; Windows NT 5.2) AppleWebKit/525.13 (KHTML, like Gecko) Version/3.1 Safari/525.13 ',
    ],
    [
        'CURLOPT_USERAGENT' => 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/4A93 Safari/419.3',
    ],
];
