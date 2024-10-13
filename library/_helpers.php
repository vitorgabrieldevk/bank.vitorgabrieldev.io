<?php

/**
 * Render a view file based on the calling method name or the provided view name.
 *
 * @param string|null $view The name of the view file to render. If null, the view name is derived from the calling method.
 * 
 * @return void
 */
function render($view = null)
{
    /**
     * Get the view name from the calling method.
     *
     * @return string The formatted view name.
     */
    function getViewFromCaller()
    {
        $backtrace = debug_backtrace();
        $caller = $backtrace[0]['function']; // Retrieve the name of the calling method
        return strtolower(str_replace('show', '', $caller)) . '.html'; // Format the view name
    }

    /**
     * Get the full file path of the view.
     *
     * @param string $view The name of the view file.
     * 
     * @return string The full path to the view file.
     */
    function getViewFilePath($view)
    {
        return __DIR__ . '/../views/' . $view; // Build the file path
    }

    /**
     * Check if the specified file exists.
     *
     * @param string $filePath The path to the file to check.
     * 
     * @return bool True if the file exists, otherwise false.
     */
    function fileExists($filePath)
    {
        return file_exists($filePath); // Verify file existence
    }

    /**
     * Handle the situation when a file is not found.
     *
     * @param string $filePath The path to the missing file.
     * 
     * @return void
     */
    function handleFileNotFound($filePath)
    {
        http_response_code(404); // Set HTTP response code to 404
        echo "Arquivo não encontrado: " . htmlspecialchars($filePath); // Display error message
    }

    // Main logic of the render function
    $view = $view ?? getViewFromCaller(); // Get the view name from the calling method or use the provided name
    $filePath = getViewFilePath($view);   // Get the full file path of the view

    if (fileExists($filePath)) {
        include $filePath; // Include the view file
    } else {
        handleFileNotFound($filePath); // Handle the missing file error
    }
}
