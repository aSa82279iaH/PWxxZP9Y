<?php
// 代码生成时间: 2025-09-24 00:33:38
// 引入Laravel框架的Facade和Exception类
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * ErrorLogCollector.php
 *
 * 错误日志收集器，用于统一管理Laravel应用中的错误日志记录。
 */
class ErrorLogCollector {

    /**
     * 记录错误日志
     *
     * @param Exception $exception 捕获的异常对象
     * @param string $level 日志记录级别
     */
    public function logError(Exception $exception, string $level = 'error'): void {
        // 获取异常的基本信息
        $message = $exception->getMessage();
        $code = $exception->getCode();
        $file = $exception->getFile();
        $line = $exception->getLine();

        // 构建日志记录信息
        $logInfo = "Error: {$message} (Code: {$code})\
" .
                   "File: {$file}, Line: {$line}";

        // 根据级别记录日志
        Log::channel('stack')->{$level}($logInfo);
    }

    /**
     * 初始化错误日志收集器
     *
     * @param string $channel 日志通道名称
     */
    public function __construct(string $channel = 'stack') {
        // 设置默认日志通道
        Log::useFiles($channel);
    }
}

// 使用示例：
try {
    // 模拟代码执行中出现的异常
    throw new Exception('Test exception', 500);
} catch(Exception $e) {
    $errorLogger = new ErrorLogCollector();
    $errorLogger->logError($e);
}
