<?php
// 代码生成时间: 2025-09-19 22:36:02
class MemoryUsageAnalyzer {

    /**
     * Get the current memory usage in bytes.
     *
     * @return int
     */
    public function getCurrentMemoryUsage() {
        return memory_get_usage();
    }

    /**
     * Get the peak memory usage in bytes.
     *
     * @return int
     */
    public function getPeakMemoryUsage() {
        return memory_get_peak_usage();
    }

    /**
     * Analyze the memory usage and return a formatted string.
     *
     * @return string
     */
    public function analyzeMemoryUsage() {
        $currentUsage = $this->getCurrentMemoryUsage();
        $peakUsage = $this->getPeakMemoryUsage();

        // Format the memory usage in kilobytes
        $currentUsageKB = round($currentUsage / 1024, 2);
        $peakUsageKB = round($peakUsage / 1024, 2);

        return "Current memory usage: {$currentUsageKB} KB
Peak memory usage: {$peakUsageKB} KB";
    }
}

// Usage example
try {
    $memoryAnalyzer = new MemoryUsageAnalyzer();
    $memoryReport = $memoryAnalyzer->analyzeMemoryUsage();
    echo $memoryReport;
} catch (Exception $e) {
    // Handle any exceptions that may occur
    echo "Error: " . $e->getMessage();
}