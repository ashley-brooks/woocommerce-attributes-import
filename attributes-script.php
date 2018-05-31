<?php

// Function for testing outputs in formatted mode
function formatOutput($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";

    return $data;
}

echo "<h1>Project Data - Variable Product Attributes</h1>";

// get JSON file
$attributeJsonData = file_get_contents('attribute-data.json');

// Decode into multidimensional JSON array
$attributeData = json_decode($attributeJsonData, true);

// Counters - for test purposes - otherwise too many product attribute data sets load
$c = 1;
$i = 1;

// Max limit
$countLimit = 400;

// Empty array to store our attribute key - values by SKU
$SKUAttributes = array();
$refinedArray = array();

// Loop through data
foreach ($attributeData as $attribute):

    // Testing check, see $c assignment above for reason
    if ($c < $countLimit):

        $attributeSKU = $attribute['Variant SKU']; // Variant SKU
        $attributeName = $attribute['Title']; // Attrbiute Name
        $attributeValue = $attribute['Value']; // Attrbibute Value
        $SKUAttributes[$attributeSKU][$attributeName] = $attributeValue; // Create multidimensional array

    endif;

    $c++;
endforeach;

// Restructuring data format for Woocommerce import
foreach ($SKUAttributes as $SKUValues => $SKUAttribute):

    if ($i < $countLimit):

        // Append product SKU to start of array
        array_push($refinedArray, $SKUValues);
        $refinedArray[$SKUValues] = array();

        // Add attribute name and values to array alongside product SKU
        foreach ($SKUAttribute as $attributeName => $attributeValue):
            array_push($refinedArray[$SKUValues], $attributeName, $attributeValue, '', '');
        endforeach;

    endif;

    $i++;
endforeach;

// Testing - output final array
formatOutput($refinedArray);

// Convert back to JSON format
$updatedJson = json_encode($refinedArray);

// Write to updated JSON file
file_put_contents('attribute-data-updated.json', $updatedJson);
