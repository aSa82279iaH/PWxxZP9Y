#########################################################
#                                                       #
# Install Microsoft Integration & Azure Stencils Pack   #
# Author: Sandro Pereira                                #
#                                                       #
#########################################################

[String]$location = Split-Path -Parent $PSCommandPath
foreach($file in $files)
{
    if($file.PSPath.Contains("Previous Versions") -eq $false)
    {
        Copy-Item -Path $file.PSPath -Destination $destination -force
    }
}
