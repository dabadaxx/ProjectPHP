<?php

class Page {

    private static $_title = "Flight Project ";

    static function setTitle(string $title) {
        self::$_title = $title;
    }

    static function header()    { ?>

        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title><?php echo self::$_title; ?></title>
                <link rel="stylesheet" href="css/style.css">
               
            </head>
        <body>

        
        <div class="container">
      
            <div class="title" style="text-align:center">
                <h1><?php echo self::$_title; ?></h1>
                <img class="img" src="ClipartKey_907285.png" alt="Aire plane" style="width:200px;height:200px;" >   
            </div>
            <div class="content"> 
    <?php }

    static function footer()    { ?>

            </div>
        </div>

        <!-- End Document
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        </body>
        </html>

    <?php }

    static function importForm() { ?>
    <div class="featurebox">
        <div class="feature">
         <form method="post" enctype="multipart/form-data">
			Import Json file form the Ministry of Transport <input type="file" name="jsonFile">
			<br>
			<input type="submit" value="Import" name="buttonImport">
		</form>
        </div>
    <?php }

    static function exportForm($flights=array())    { ?>
    <div class="feature">
        <h4>Export Flights</h4>
        <p>Select the flights you would like to export to XMl</p>
        
        <form method="post" enctype="multipart/form-data" action="XMLExport.php">
            <fieldset> 
                <table>
                <?php 

                $stats = array();
                foreach ($flights as $flight) {
                    $dest = $flight->getDestination(); 
                    if(key_exists($dest, $stats)) {
                        $stats[$dest] += $flight->getPassengers();
                    } else {
                        $stats[$dest] = $flight->getPassengers();
                    }
                }
                // Sort by passenger value
                arsort($stats);

                foreach($stats as $dest => $pass) {
                ?>

                <tr>
                    <td><?php echo $dest; ?></td>
                    <td><input type="checkbox" name="flightno[]" value="<?php echo $dest; ?>"></td>
                </tr>
                <?php 
                } // foreach stats
                ?>
                </table>
            </fieldset>      
            <br>  
        <input type="submit" value="Export" name="buttonExport">  
        
        </form>  
            </div>
    </div>

    <?php }   
  

    static function displayStats($flights = array()) { ?>
    <div class="flightStats">
     <table>

            <thead>
                <tr>
                <?php
                if(count($flights) == 0) {
                ?>
                    <th><h2>Sorry there is currently no flight data in the database</h2></th>
                <?php
                } else {
                ?>
                
                    <th>Destination</th>
                    <th>Incomming</th>                    
                <?php 
                }
                ?>
                </tr>
            </thead>
    
            <?php
            $stats = array();
            foreach ($flights as $flight) {
                $dest = $flight->getDestination(); 
                if(key_exists($dest, $stats)) {
                    $stats[$dest] += $flight->getPassengers();
                } else {
                    $stats[$dest] = $flight->getPassengers();
                }
            }
            // Sort by passenger value
            arsort($stats);
            foreach($stats as $dest => $pass) {
                echo '<tr>
                        <td>'.$dest.'</td>
                        <td>'.$pass.'</td>
                      
                    </tr>';
    
            }  ?>
    
            </table>
    </div>
   <?php 
    }
}

?>