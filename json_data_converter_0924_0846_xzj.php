<?php
// 代码生成时间: 2025-09-24 08:46:00
class JsonDataConverter {

    /**
     * Converts JSON data into an associative array.
     *
     * @param string $jsonData The JSON string to convert.
     * @return array The associative array resulting from the JSON conversion.
     * @throws InvalidArgumentException If the JSON data is not valid.
     */
    public function convertJsonToAssocArray(string $jsonData): array {
        try {
            // Decode the JSON data into an associative array.
            $assocArray = json_decode($jsonData, true);

            // Check if the decoding was successful.
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Invalid JSON data provided.');
            }

            return $assocArray;
        } catch (InvalidArgumentException $e) {
            // Handle the exception by logging and re-throwing.
            Log::error('JSON Data Conversion Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Converts an associative array into JSON data.
     *
     * @param array $assocArray The associative array to convert.
     * @param int $options JSON encoding options.
     * @return string The JSON string resulting from the conversion.
     * @throws InvalidArgumentException If the array is not valid.
     */
    public function convertAssocArrayToJson(array $assocArray, int $options = 0): string {
        try {
            // Encode the associative array into a JSON string.
            $jsonData = json_encode($assocArray, $options);

            // Check if the encoding was successful.
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Invalid associative array provided.');
            }

            return $jsonData;
        } catch (InvalidArgumentException $e) {
            // Handle the exception by logging and re-throwing.
            Log::error('JSON Data Conversion Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
