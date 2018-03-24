<?php

namespace DavidNineRoc\EasyExtends\Foundation;

class NotDownloadExpand extends Expand
{
    protected function hasExtend($env)
    {
        return true;
    }

    protected function downloadExtend($env)
    {
        return true;
    }

    protected function unZipFile($zipFile)
    {
        return true;
    }

    protected function copyDllToExtPath()
    {
        return true;
    }
}
