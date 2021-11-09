<?php
error_reporting(E_ALL);  // Turn on all errors, warnings and notices for easier debugging

// API request variables
$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
$version = '1.0.0';  // API version supported by your application
$appid = 'RobertMa-Shakopee-PRD-169ec6b8e-bb30ba02';  // Replace with your own AppID
$globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
$query = 'nike shoes';  // You may want to supply your own query
$safequery = urlencode($query);  // Make the query URL-friendly
$i = '0';  // Initialize the item filter index to 0
// Create a PHP array of the item filters you want to use in your request
$filterarray =
    array(
        array(
            'name' => 'MaxPrice',
            'value' => '25',
            'paramName' => 'Currency',
            'paramValue' => 'USD'
        ),
        array(
            'name' => '',
            'value' => 'true',
            'paramName' => '',
            'paramValue' => ''
        ),
        array(
            'name' => 'ListingType',
            'value' => array('AuctionWithBIN', 'FixedPrice'),
            'paramName' => '',
            'paramValue' => ''
        ),
    );

// Generates an indexed URL snippet from the array of item filters
function buildURLArray($filterarray)
{
    global $urlfilter;
    global $i;
    // Iterate through each filter in the array
    foreach ($filterarray as $itemfilter) {
        // Iterate through each key in the filter
        foreach ($itemfilter as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $j => $content) { // Index the key for each value
                    $urlfilter .= "&itemFilter($i).$key($j)=$content";
                }
            } else {
                if ($value != "") {
                    $urlfilter .= "&itemFilter($i).$key=$value";
                }
            }
        }
        $i++;
    }
    return "$urlfilter";
} // End of buildURLArray function

// Build the indexed item filter URL snippet
buildURLArray($filterarray);


// Construct the findItemsByKeywords HTTP GET call
$apicall = "$endpoint?";
$apicall .= "OPERATION-NAME=findItemsByKeywords";
$apicall .= "&SERVICE-VERSION=$version";
$apicall .= "&SECURITY-APPNAME=$appid";
$apicall .= "&GLOBAL-ID=$globalid";
$apicall .= "&keywords=$safequery";
$apicall .= "&paginationInput.entriesPerPage=50";
$apicall .= "$urlfilter";
// Load the call and capture the document returned by eBay API
$resp = simplexml_load_file($apicall);

// Check to see if the request was successful, else print an error
if ($resp->ack == "Success") {
    $results = '';
    // If the response was loaded, parse it and build links
    foreach ($resp->searchResult->item as $item) {
        $pic   = $item->galleryURL;
        $link  = $item->viewItemURL;
        $title = $item->title;
        /////////////////////////EDIT THIS LINE/////////////////////////////////////////////////////
        // For each SearchResultItem node, build a link and append it to $results
        $results .= "<tr><td><img src=\"$pic\"></td><td><a href=\"$link\">$title</a></td></tr>";
        ////////////////////////EDIT THIS LINE//////////////////////////////////////////////////////      
    }
}
// If the response does not indicate 'Success,' print an error
else {
    $results  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
    $results .= "AppID for the Production environment.</h3>";
}
?>

<html>
<!DOCTYPE html>
<html lang="en">
<!--Version 6.0 
	Name: Evan You
	Date Completed:
    -->

<head>
    <!-- Bootstrap meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SHS WebDev Bootstrap sample">

    <!-- CSS -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="../CSS/style.css">


    <!--------------JS----------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="icon" href="../images/Shoe.ico" type="ico" sizes="32x32">
    <title>Sneaker Kicks</title>
    <style>

    </style>
</head>

<body class="text-center text-white drk">
    <main>
        <!-- Insert php here-->




    </main>
    <!-------------- Footer -------------->
    <footer class="bg-black text-center text-white">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light btn-floating m-lg-auto" href="#!" role="button"><i class="fa fa-facebook-f lg"></i></a>

                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-twitter"></i></a>

                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-youtube-play"></i></a>

                <!-- Github -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-2 ">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../../../Version1.0/webDevUser26.html" target="_blank" class="text-white">Version
                                1</a>
                        </li>
                        <li>
                            <a href="../../../Version2.0/webDevUser26.html" target="_blank" class="text-white">Version
                                2</a>
                        </li>
                        <li>
                            <a href="../../../Version3.0/user26/index.html" target="_blank" class="text-white">Version
                                3</a>
                        </li>
                        <li>
                            <a href="../../../Version4.0/user26/index.html" target="_blank" class="text-white">Version
                                4</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 ">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="../../../Version5.0/user26/index.html" target="_blank" class="text-white">Version
                                5</a>
                        </li>
                        <li>
                            <a href="#" target="_blank" class="text-white">Version 6</a>
                        </li>
                        <li>
                            <a href="../../../Version7.0/user26/index.html" target="_blank" class="text-white">Version 7</a>
                        </li>
                        <li>
                            <a href="../../../Version7.0/user26/weather/app.js" target="_blank" class="text-white">Version 8</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0 ">
                    <p class="pt-2">
                        <strong>Sign up for our newsletter</strong>
                    </p>
                </div>
                <div class="col-md-3 mb-4 mb-md-o">
                    <div class="form-outline mb-4">
                        <input type="email" id="form5Example25" class="form-control" />
                        <label class="form-label" for="form5Example25">Email address</label>
                    </div>
                </div>
                <div class="col-auto mb-4 mb-md-0">
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary mb-4">
                        Subscribe
                    </button>
                </div>

            </div>

            </div>
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                Website made by
                <a class="text-white" href="#">Evan You</a>
            </div>
            <!-- Copyright -->
    </footer>
</body>

</html>