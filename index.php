<?php
include("db.php");
$basePathImg = "/WordGame/assets/Image/";
$basePathWord = "/WordGame/assets/Word/";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Word Game</title>
        <link rel="stylesheet" href="style.css">
<!--        <script src="js.js"></script>-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
    </head>
    <body>
        <div class="container">
            <div id="img" class="box">
                <!--
                This div is where the picture will go.
                -->
                <ul>
                    <?php
                    $imgQ = "SELECT * FROM pic_t ORDER BY RAND() LIMIT 1";
                    $imgR = mysqli_query($conn, $imgQ);

//                    /* Debug */
//                    if ($imgR != NULL) {
//                        echo $imgR;
//                    } else {
//                        echo"NO RECORDS";
//                    }
                    while ($rowImg = mysqli_fetch_array($imgR, MYSQLI_ASSOC)) {
                        $currentPic = $rowImg['Pic'];
                        ?>
                        <li id="picID_<?php echo $rowImg['Pic_Id']; ?>">
                            <img src="<?php echo $basePathImg . $rowImg['Pic']; ?>" />
                        </li>
                    <?php } ?>
                </ul>        
            </div>

            <div id="comp" class="box">
                <!--
                This div is where the image will be dragged to.
                -->
                <script type="text/javascript">
                    var currentPic = "<?php echo $currentPic ?>";
                    var basePathWord = "<?php echo $basePathWord?>";
                </script>
                <ul  id="sortable2" class="sortBox" style="min-height: 250px; background-color: yellow;">
                    <li></li>
                </ul>
            </div>

            <div id="words" class="box">
                <!--
                This div is where the images will be appear initially.
                -->
                <ul id="sortable1" class="sortBox">
                    <!--<li><img src="assets/Word/bunny.jpg"</li>-->
                    <?php
                    $wordQ = "SELECT * FROM word_t WHERE Word_Id IN(SELECT Word_Id FROM Word_T WHERE Pic != '$currentPic') LIMIT 2";
                    $wordR = mysqli_query($conn, $wordQ);

//                    /* Debug */
//                    if ($wordR) {
//                        echo "There are records";
//                    } else {
//                        echo"NO RECORDS";
//                    }

                    while ($rowWord = mysqli_fetch_array($wordR, MYSQLI_ASSOC)) {
                        ?>
                        <li id="wordID_<?php echo $rowWord['Word_Id']; ?>">
                            <img src="<?php echo $basePathWord . $rowWord['Pic']; ?>" />
                        </li>                        
                    <?php } ?>
                    <li>
                        <img src="<?php echo $basePathWord . $currentPic; ?>" />
                    </li>
                </ul>
            </div>
        </div>  
        <script type="text/javascript">
            $(document).ready(function () {

                $(function () {
                    $("#comp ul").sortable({
                        opacity: 0.6,
                        cursor: 'move',
                        update: function () {                            
                            var filePath = $( "ul#sortable2 li:nth-child(2) img").attr("src");
                            var choice = filePath.replace('/WordGame/assets/Word/', '');
                            chosenWord(currentPic, choice);
                        }});
                });

                $(function () {
                    $("#word ul").sortable({
                        opacity: 0.6,
                        cursor: 'move'
                    });
                });
                //Make second and third box sortable
                $(function () {
                    $("#sortable1, #sortable2").sortable(
                            {connectWith: ".sortBox"})
                            .disableSelection();
                });

//Compare chosen word and image
                function chosenWord(currentPic, choice) {
                    if(currentPic === choice){
                        alert('Congrats!!!');
                    }
                    else {
                        alert('Oh man...');
                    }
                }
            });
        </script>
    </body>
</html>


