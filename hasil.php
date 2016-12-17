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
        
                        <h5 class="teal-text text-accent-4">Kriptografi RSA</h5>
                            
                            <table class="responsive-table">
                                <tbody>
                                    <tr>
                                        <td width="70px">Prima 1</td>
                                        <td width="5px">:</td>
                                        <td>
                                            <?php
                                                echo $_POST['prima-1'];
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prima 2</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                echo $_POST['prima-2'];
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ASCII</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                                $text = $_POST['plainteks'];
                                                while ($offset >= 0) {
                                                    echo ordutf8($text, $offset)."  ";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>