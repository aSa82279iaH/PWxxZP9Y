<?php
// 代码生成时间: 2025-09-16 20:50:57
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * SystemPerformanceMonitor.php
 *
 * This class is responsible for monitoring system performance metrics.
 */
class SystemPerformanceMonitor
{
    /**
     * Get system memory usage.
     *
     * @return array
     */
    public function getMemoryUsage()
    {
        try {
            // Use the `free()` function to get memory information.
            $memory = shell_exec('free');
            $memory = (float)preg_replace('/.*?(\d+)k used,.*?(\d+)k free,.*?(\d+)k total.*/', '$1', $memory) / 1024;

            return ['used' => $memory, 'free' => (float)preg_replace('/.*?(\d+)k used,.*?(\d+)k free,.*?(\d+)k total.*/', '$2', $memory) / 1024, 'total' => (float)preg_replace('/.*?(\d+)k used,.*?(\d+)k free,.*?(\d+)k total.*/', '$3', $memory) / 1024];
        } catch (\Exception $e) {
            Log::error('Failed to get memory usage: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get system CPU usage.
     *
     * @return array
     */
    public function getCpuUsage()
    {
        try {
            // Use the `top()` function to get CPU information.
            $cpu = shell_exec('top -bn2 | grep "Cpu(s)" | sed "s/.*, *\([0-9.]*\)%* id.*/\1/;s/.*, *\([0-9.]*\)%*% i.*/\1/"');
            $cpu = explode(',', $cpu);
            $cpu = array_map('trim', $cpu);

            return ['user' => $cpu[0], 'system' => $cpu[1], 'idle' => $cpu[2]];
        } catch (\Exception $e) {
            Log::error('Failed to get CPU usage: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get system disk usage.
     *
     * @return array
     */
    public function getDiskUsage()
    {
        try {
            // Use the `df()` function to get disk information.
            $disk = shell_exec('df -h');
            $lines = explode("\
", $disk);
            $lines = array_filter($lines);
            $lines = array_values($lines);

            $diskUsage = [];
            foreach ($lines as $line) {
                $parts = preg_split('/\x20+/', $line, -1, PREG_SPLIT_NO_EMPTY);
                if (count($parts) < 6) continue;

                $diskUsage[] = [
                    'filesystem' => $parts[0],
                    'size' => $parts[1],
                    'used' => $parts[2],
                    'available' => $parts[3],
                    'percent' => $parts[4],
                    'mount' => $parts[5],
                ];
            }

            return $diskUsage;
        } catch (\Exception $e) {
            Log::error('Failed to get disk usage: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get system network usage.
     *
     * @return array
     */
    public function getNetworkUsage()
    {
        try {
            // Use the `ifconfig()` or `ip addr` function to get network information.
            $interfaces = shell_exec('ifconfig');
            $interfaceLines = explode("\
", $interfaces);
            $interfaceLines = array_filter($interfaceLines);
            $interfaceLines = array_values($interfaceLines);

            $networkUsage = [];
            foreach ($interfaceLines as $line) {
                if (preg_match('/^[a-z]+[0-9]+:/i', $line)) {
                    $interface = preg_replace('/:$/', '', $line);
                    $stats = shell_exec("ifconfig $interface | grep 'inet addr:' | awk -F: '{print \$2}' | awk '{print \$1}'");
                    $networkUsage[$interface] = $stats;
                }
            }

            return $networkUsage;
        } catch (\Exception $e) {
            Log::error('Failed to get network usage: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get system load averages.
     *
     * @return array
     */
    public function getLoadAverages()
    {
        try {
            // Use the `uptime()` function to get load averages.
            $loadAverages = shell_exec('uptime');            $loadAverages = preg_replace('/.*load average: (.*)/', '$1', $loadAverages);
            $loadAverages = explode(',', $loadAverages);
            $loadAverages = array_map('trim', $loadAverages);

            return ['1min' => $loadAverages[0], '5min' => $loadAverages[1], '15min' => $loadAverages[2]];
        } catch (\Exception $e) {
            Log::error('Failed to get load averages: ' . $e->getMessage());
            return [];
        }
    }
}
