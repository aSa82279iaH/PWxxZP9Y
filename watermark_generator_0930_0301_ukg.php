<?php
// 代码生成时间: 2025-09-30 03:01:22
class WatermarkGenerator
{
    /**
     * 生成水印图片
     *
     * @param string $imagePath 图片路径
     * @param string $text 水印文本
     * @param string $outputPath 输出路径
     * @return bool
     */
    public function generateWatermark($imagePath, $text, $outputPath)
    {
        // 检查文件是否存在
        if (!file_exists($imagePath)) {
            // 文件不存在的错误处理
            return false;
        }

        // 获取图片信息
        list($width, $height) = getimagesize($imagePath);

        // 创建图像资源
        $image = imagecreatefromjpeg($imagePath);

        // 设置水印文本颜色
        $color = imagecolorallocate($image, 255, 255, 255); // 白色

        // 设置水印文本位置
        $fontSize = 20;
        $x = $width - 100;
        $y = $height - 50;

        // 添加水印文本
        imagettftext($image, $fontSize, 0, $x, $y, $color, public_path('fonts/OpenSans-Bold.ttf'), $text);

        // 输出图像
        header('Content-Type: image/jpeg');
        imagejpeg($image, $outputPath);

        // 释放资源
        imagedestroy($image);

        return true;
    }
}

// 使用示例
$watermarkGenerator = new WatermarkGenerator();
$imagePath = 'path/to/your/image.jpg';
$text = '你的水印文本';
$outputPath = 'path/to/output/watermarked_image.jpg';

if ($watermarkGenerator->generateWatermark($imagePath, $text, $outputPath)) {
    echo '水印添加成功';
} else {
    echo '水印添加失败';
}
