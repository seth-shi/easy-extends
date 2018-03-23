<?php

namespace DavidNineRoc\EasyExtends\Foundation;

use DavidNineRoc\EasyExtends\Application;
use DavidNineRoc\EasyExtends\Contracts\Expand as ExpandContract;
use DavidNineRoc\EasyExtends\Exception\NotExtensionDirException;

class Expand implements ExpandContract
{
    protected $mapUrl = [];
    protected $env;
    protected $app;
    protected $cachePath;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->cachePath = $this->app->getBasePath().'/bootstrap/cahe';
    }

    public function hasExtend()
    {
        return array_key_exists($this->env, $this->mapUrl);
    }

    public function downloadExtend()
    {
       return true;
    }

    public function installExtend($env)
    {
        $this->env = $env;

        if (! $this->hasExtend()) {
            // throw new NotExtensionDirException('There is no environment-compliant version');
        }

        $zip = $this->downloadExtend();


    }
}
