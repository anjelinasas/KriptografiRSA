<!DOCTYPE html>
<html>
    <head>
        <title>Kriptografi RSA</title>

        <!-- Css -->
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    </head>
    <body>

        <?php
                error_reporting(0);
                function ordutf8($string, &$offset) {
                $code = ord(substr($string, $offset,1)); 
                if ($code >= 128) {        //otherwise 0xxxxxxx
                    if ($code < 224) $bytesnumber = 2;                //110xxxxx
                    else if ($code < 240) $bytesnumber = 3;        //1110xxxx
                    else if ($code < 248) $bytesnumber = 4;    //11110xxx
                    $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
                    for ($i = 2; $i <= $bytesnumber; $i++) {
                        $offset ++;
                        $code2 = ord(substr($string, $offset, 1)) - 128;        //10xxxxxx
                        $codetemp = $codetemp*64 + $code2;
                    }
                    $code = $codetemp;
                }
                $offset += 1;
                if ($offset >= strlen($string)) $offset = -1;
                return $code;

            }
        ?>

        <div class="container">
            <div class="row form">
                <div class="col s12">
                    <div class="row">
                        <div class="col s5">
                            <div class="card white grey-text text-lighten-1 z-depth-0">
                                <div class="card-content">
                                    <div class="row">
                                        <form class="col s12" action="" method="post">
                                            <span class="teal-text text-accent-4">Lengkapi form dibawah ini</span>
                                            <div class="row forms">
                                                <div class="input-field col s6">
                                                    <input id="prima-1" name="prima-1" type="number" class="validate" required="">
                                                    <label for="prima-1">Bilangan Prima Pertama</label>
                                                </div>
                                                <div class="input-field col s6">
                                                      <input id="prima-2" name="prima-2" type="number" class="validate" required="">
                                                      <label for="prima-2">Bilangan Prima Kedua</label>
                                                </div>
                                            </div>
                                            <div class="row forms">
                                                <div class="input-field col s6">
                                                    <input id="prima-1" name="public" type="number" class="validate" required="">
                                                    <label for="prima-1">Public Key</label>
                                                </div>
                                                <div class="input-field col s6">
                                                      <input id="prima-2" name="private" type="number" class="validate" required="">
                                                      <label for="prima-2">Private</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="plainteks" name="plainteks" class="materialize-textarea" length="120" required=""></textarea>
                                                    <label for="plainteks">Plainteks</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="waves-light btn" value="Enkripsi">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col s7">
                            <h5 class="teal-text text-accent-4">Kriptografi RSA</h5>
                            
                            <?php
                                $p          = $_POST['prima-1'];
                                $q          = $_POST['prima-2'];
                                $plainteks  = $_POST['plainteks'];
                                $teks = $_POST['plainteks'];

                                // mencari nilai N
                                $n = $p * $q;

                                // mencari nilai M
                                $m = ($p-1) * ($q-1);

                                $public_key = $_POST['public'];
                                $chiper = pow($teks, $public_key);
                            ?>
                            <table class="responsive-table">
                                <tbody>
                                    <tr>
                                        <td width="70px">Prima 1</td>
                                        <td width="5px">:</td>
                                        <td>
                                            <?php
                                                echo $p;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prima 2</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                echo $q;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ASCII</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                $plainteks;
                                                while ($offset >= 0) {
                                                    echo ordutf8($plainteks, $offset)."  ";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>n</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                echo $n;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>m</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                echo $m;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>m</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                echo $chiper."<br>".$teks."<br>".$public_key;
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>