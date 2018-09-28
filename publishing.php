<!DOCTYPE html>
<html>
<body>
        <title>PokeFix - V 1.0</title>
    <link rel="shortcut icon" type="image/png" href="img/PokeIco.png"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/animation.css">
    <link rel="stylesheet" href="assets/font-awesome/font-awesome-4.7.0/css/font-awesome.min.css">
    
<?php
function file_get_contents_curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$url=$_POST['url'];


$html = file_get_contents_curl("$url");

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

$metas = $doc->getElementsByTagName('meta');

for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'updated_at')
        $lastUpdate = $meta->getAttribute('content');
}
?>

<div class = "main">    <div class = "wrapper">
    <div class="pokefix-container">
        <div class="pokefix-camera"></div>
        <div class="pokefix-statuscolor">
            <div class="pokefix-status"></div>
            <div class="pokefix-status"></div>
            <div class="pokefix-status"></div>
        </div>
        <div class="input-container">

        <form action="publishing.php" method="POST">
            <p>URL(Single):</p>
            <input id="input-url" name="url" value="<?php echo htmlspecialchars($url); ?>">
            
            <p>Publishing Date:</p>
            <input id="input-lang" type="text" disabled value="<?php echo htmlspecialchars($lastUpdate); ?>">          
            
            <button class="button-openURL selected tool-button"><a href="index.html">Go Back</a></button>            
            <button type="submit" class="button-openURL tool-button">Get Dates</button>
        </form>

            <a href="#"><div id="tools-shower" class="fa fa-hand-o-up rotate fa-3x fa-more"></div></a>

        </div>
        <div>


        <div id="tools-container" class="tools-container" style="display: none">
            <button class="tool-button"><a href="https://goo.gl/r4zRq8" target="_blank"><i class="fa fa-windows" aria-hidden="true"></i>TFS</a></button>
            <button class="tool-button"><a href="https://goo.gl/MTKLRg" target="_blank"><i class="fa fa-windows" aria-hidden="true"></i>VSTS</a></button>
            <button class="tool-button"><a href="https://goo.gl/7fZsMP" target="_blank"><i class="fa fa-line-chart" aria-hidden="true"></i>BPI</a></button>
            <button class="tool-button"><a href="https://goo.gl/vh3H6m" target="_blank"><i class="fa fa-space-shuttle" aria-hidden="true"></i>OPS</a></button>
            <button class="tool-button"><a href="https://goo.gl/QM44qw" target="_blank"><i class="fa fa-wrench" aria-hidden="true"></i>iCMS</a></button>
            <button class="tool-button"><a href="https://goo.gl/CzKxjJ" target="_blank"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>AirLoc</a></button>
            <button class="tool-button" id="info-shower"><i class="fa fa-copy" aria-hidden="true"></i>+INFO</button>
        </div>

            <div id="info-container" class="nav-container" style="display: none">
                <input id="filter" type="text" class="form-control" placeholder="Search...">
                <table class="table table-striped">

                <thead>
                    <tr>
                        <td>Product Name</td>
                        <td>Nav ID</td>  
                        <td>IPM</td>
                        <td>Publish</td>
                        <td>ENU</td>
                        <td>HO</td>
                        <td>HB</td>
                        <td>Loc</td>
                    </tr>
                </thead>
                <tbody class="searchable">
                    <tr>
                        <td>FLOW</td>
                        <td>20170850</td>
                        <td>Maya</td>
                        <td>DPS</td>
                        <td><a href="https://github.com/Azure/flow-content-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                        <td><a href="https://github.com/Azure/flow-content-handoff-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                        <td><a href="https://github.com/Azure/flow-content-handback-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                        <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="flow();"></i></td>                                   
                    </tr>
                <tr>
                    <td>PowerApps</td>
                    <td>20170850</td>               
                    <td>Maya</td>
                    <td>DPS</td>
                    <td><a href="https://github.com/Azure/powerapps-content-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Azure/powerapps-content-handoff-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Azure/powerapps-content-handback-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="powerApps();"></i></td>                                           
                </tr>
                <tr>
                    <td>PowerBI</td>
                    <td>20170850</td>               
                    <td>Maya</td>
                    <td>DPS</td>
                    <td><a href="https://github.com/Azure/powerbi-content-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Azure/powerbi-content-handoff-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Azure/powerbi-content-handback-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="powerBi();"></i></td>                                           
                </tr>
                <tr>
                    <td>ATADocs</td>
                    <td>20170860</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/ATADocs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/ATADocs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/ATADocs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="ataDocs();"></i></td>                                           
                </tr>   
                <tr class="hidden">
                    <td>Intune Docs</td>
                    <td>20170860</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/InTuneDocs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/IntuneDocs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/IntuneDocs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="intuneDocs();"></i></td>
                </tr>                     
                <tr class="hidden">
                    <td>AzureRMS</td>
                    <td>20170860</td>
                    <td>Isha</td>                          
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/Azure-RMSDocs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/Azure-RMSDocs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/Azure-RMSDocs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="rmsDocs();"></i></td>

                </tr>           
                <tr class="hidden">
                    <td>MIM Docs</td>
                    <td>20170860</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/MIMDocs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/MIMDocs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/mimDocs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="mimDocs();"></i></td>                                           
                </tr>           
                <tr class="hidden">
                    <td>Cloud Apps</td>
                    <td>20170860</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/CloudAppSecurityDocs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/CloudAppSecurityDocs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/CloudAppSecurityDocs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="cloudApps();"></i></td>                                           

                </tr>           
                <tr class="hidden">
                    <td>SQL2016</td>
                    <td>20170854</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/MicrosoftDocs/sql-docs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/MicrosoftDocs/sql-docs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/MicrosoftDocs/sql-docs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="sql();"></i></td>                                                            
                </tr>           
                <tr class="hidden">
                    <td>SQL2017</td>
                    <td>20170854</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/MicrosoftDocs/sql-docs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/MicrosoftDocs/sql-docs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/MicrosoftDocs/sql-docs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="sql();"></i></td>                                                            
                </tr>                     
                <tr class="hidden">
                    <td>S.Center 2016</td>
                    <td>20170855</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/microsoft/systemcenterdocs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/microsoft/systemcenterdocs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/microsoft/systemcenterdocs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="scDocs();"></i></td>                                                                                                                        
                </tr>                                                                                                                           
                <tr class="hidden">
                    <td>.NET Core</td>
                    <td>20170856</td>
                    <td>Nobuko</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/dotnet/docs/" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/dotnet/docs.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/dotnet/docs.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="dotnetOrg();"></i></td>
                </tr>                                                                                                                           
                <tr class="hidden">
                    <td>.NET Fwk</td>
                    <td>20170856</td>
                    <td>Nobuko</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/dotnet/docs/" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/dotnet/docs.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/dotnet/docs.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="dotnetOrg();"></i></td>                                                            
                </tr>                                                                                                                           
                <tr class="hidden">
                    <td>VSDOCS</td>
                    <td>20170856</td>
                    <td>Nobuko</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/vsdocs" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/dotnet/docs.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/dotnet/docs.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="dotnetOrg();"></i></td>                                                                         
                </tr>                                                                                                                           
                <tr class="hidden">
                    <td>VCPPDOCS</td>
                    <td>20170856</td>
                    <td>Nobuko</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/vcppdocs" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/vcppdocs.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/vcppdocs.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="vcppDocs();"></i></td>                                     
                </tr>                                                                                                                           
                <tr class="hidden">
                    <td>VSRelease</td>
                    <td>20170856</td>
                    <td>Nobuko</td>
                    <td>OPS</td>
                    <td><a href="hhttps://devdiv.visualstudio.com/defaultcollection/DevDiv/_git/RECON" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://devdiv.visualstudio.com/DefaultCollection/DevDiv/_git/RECON.Handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://devdiv.visualstudio.com/DefaultCollection/DevDiv/_git/RECON.Handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="vsRelease();"></i></td>              
                </tr>                                                                                                                           
                <!---<tr class="hidden">
                    <td>cSharp</td>
                    <td>20170856</td>
                    <td>Nobuko</td>
                    <td>OPS</td>                                                          
                </tr>-->                                                                                                                           
                <!--<tr class="hidden">
                    <td>Visual Basic</td>
                    <td>20170856</td>
                    <td>Nobuko</td>
                    <td>OPS</td>                                                          
                </tr>-->                                                                                                                           
                <tr class="hidden">
                    <td>AAD</td>
                    <td>20170860</td>
                    <td>Isha</td>
                    <td>OPS</td>
                    <td><a href="https://github.com/Microsoft/aad-graph-api-docs-pr" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/aad-graph-api-docs-pr.handoff" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><a href="https://github.com/Microsoft/aad-graph-api-docs-pr.handback" target="_blank"><i class="fa fa-location-arrow" aria-hidden="true"></i></a></td>
                    <td><i class="fa fa-location-arrow" aria-hidden="true" onclick="aadDocs();"></i></td>                                                                             
                </tr>                                                                                                                           

                </table>

            </div>

    </div>
</div>
</div>
<div class="footer">
  <p>By: <a class="footer-a">Alan Mac Cormack</a></p>
  <p>E-Mail: <a class="footer-a">alandmc@moravia.com</a>.</p>
  <p>Skype: <a class="footer-a">mcormack5</a></p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/app.js"></script>

</body>
</html>
