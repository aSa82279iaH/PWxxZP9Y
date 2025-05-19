﻿#########################################################
#                                                       #
# Install Microsoft Integration & Azure Stencils Pack   #
# Author: Sandro Pereira                                #
#                                                       #
#########################################################

[String]$location = Split-Path -Parent $PSCommandPath
$files = Get-ChildItem $location -recurse -force -Filter *.vssx
foreach($file in $files)
{
    if($file.PSPath.Contains("Previous Versions") -eq $false)
    {
        Copy-Item -Path $file.PSPath -Destination $destination -force
    }
}
