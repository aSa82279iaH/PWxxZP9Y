<?php
// 代码生成时间: 2025-09-18 12:34:48
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// 文件命名规范，易于理解
class ExcelGenerator {

    private $spreadsheet;
    private $sheet;

    // 构造函数，初始化Spreadsheet对象
    public function __construct() {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
    }

    // 添加标题行
    public function addTitleRow($titles) {
        foreach ($titles as $index => $title) {
            $this->sheet->setCellValueByColumnAndRow($index + 1, 1, $title);
        }
    }

    // 添加数据行
    public function addDataRow($data) {
        $rowIndex = $this->sheet->getHighestRow() + 1;
        foreach ($data as $index => $value) {
            $this->sheet->setCellValueByColumnAndRow($index + 1, $rowIndex, $value);
        }
    }

    // 保存Excel文件
    public function save($filename) {
        try {
            $writer = new Xlsx($this->spreadsheet);
            $writer->save($filename);
            return "Excel file created successfully: {$filename}";
        } catch (Exception $e) {
            // 错误处理
            return "Error creating Excel file: " . $e->getMessage();
        }
    }

}

// 以下是使用示例和测试代码
// 创建Excel生成器实例
$excelGenerator = new ExcelGenerator();

// 添加标题行
$titles = ['ID', 'Name', 'Email'];
$excelGenerator->addTitleRow($titles);

// 添加数据行
$dataRows = [
    [1, 'John Doe', 'john@example.com'],
    [2, 'Jane Doe', 'jane@example.com'],
    [3, 'Jim Beam', 'jim@whiskey.com'],
];
foreach ($dataRows as $data) {
    $excelGenerator->addDataRow($data);
}

// 保存Excel文件
$filename = 'example.xlsx';
echo $excelGenerator->save($filename);
