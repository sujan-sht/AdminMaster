<?php

namespace SujanSht\LaraAdmin\Services\Helper;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CommandHelper
{
    public static function getStub($type)
    {
        return file_get_contents(app_path("Console/Commands/Stubs/$type.stub"));
    }

    public static function createFolderIfNotExists($folderPath)
    {
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true, true);
        }
    }

    public static function generateContent($stubName,$name)
    {
        $content = str_replace(
            [
            'modelName',
            'lowercaseModelName',
            'pluralModelName'
        ],
        [
            $name,
            strtolower($name),
            strtolower(Str::plural($name))
        ],Self::getStub($stubName));
        return $content;
    }

    public static function putContentToClassFunction($file, $function_name, $data, $closing_token = '}')
    {
        $data = $data . "\n";
        // Read the contents of the file into a string
        $contents = file_get_contents($file);

        // Find the position of the function definition within the class
        $start_pos = strpos($contents, "$function_name");
        if ($start_pos === false) {
            exit('Function not found');
        }

        // Find the position of the closing brace of the function
        $end_pos = strpos($contents, $closing_token, $start_pos);
        if ($end_pos === false) {
            exit('Function not properly defined');
        }

        // Extract the function definition from the class
        $function_definition = substr($contents, $start_pos, $end_pos - $start_pos + 1);

        // Append the new content to the function definition
        $modified_function_definition = rtrim($function_definition, $closing_token) . $data . $closing_token;

        // Replace the original function definition with the modified one in the class definition
        $modified_contents = substr_replace($contents, $modified_function_definition, $start_pos, $end_pos - $start_pos + 1);

        // Write the modified string back to the file
        file_put_contents($file, $modified_contents);

        return true;
    }
}
