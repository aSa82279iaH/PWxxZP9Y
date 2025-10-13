<?php
// 代码生成时间: 2025-10-14 03:13:21
class CodeHighlighter {

    /**
     * Holds the list of languages and their corresponding regex patterns.
     * @var array
     */
    private $patterns = [
        'php' => '/<\?php.*?<\?php|<\?=.*?<\?php|<\?.*?<\?php/s',
        // Add more patterns for different languages as needed.
    ];

    /**
     * Highlights the code based on the given language.
     * @param string $code The code to be highlighted.
     * @param string $language The language of the code.
     * @return string The highlighted code.
     * @throws Exception If the language is not supported.
     */
    public function highlight($code, $language) {
        // Check if the language is supported
        if (!isset($this->patterns[$language])) {
            throw new Exception("Language not supported: {$language}");
        }

        // Apply the regex pattern for the given language
        $highlightedCode = preg_replace(
            $this->patterns[$language],
            "<span style='color: blue;'>$0</span>",
            $code
        );

        return $highlightedCode;
    }

}

/**
 * Example usage of the CodeHighlighter class.
 */
try {
    $code = "<?php echo 'Hello, world!'; ?>";
    $highlighter = new CodeHighlighter();
    $highlightedCode = $highlighter->highlight($code, 'php');
    echo $highlightedCode;
} catch (Exception $e) {
    // Handle the error
    echo "Error: " . $e->getMessage();
}
