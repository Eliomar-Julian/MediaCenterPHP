<?php
    require_once("menu.php");
    $dir = "./media/filmes";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            $images = array("https://cdn.pixabay.com/photo/2012/11/05/07/41/demonstration-64151_960_720.jpg", "https://cdn.pixabay.com/photo/2012/11/05/07/44/video-64153_960_720.jpg", "https://cdn.pixabay.com/photo/2012/11/04/08/23/cinema-strip-64074_960_720.jpg", "https://cdn.pixabay.com/photo/2013/07/13/11/26/film-158157_960_720.png");
            while (($file = readdir($dh)) !== false) {
                $num = rand(0, 3);
                $filtro = substr($file, -4);
                if ($filtro == ".mp4" || $filtro == ".mkv"){
                    echo '
                    <div id="player-filmes">
                        <video controls poster="'.$images[$num].'" preload="none">
                            <source src="'.$dir.'/'.$file.'" type="video/mp4">
                        </video>
                        <h5>'.$file.'</h5>
                    </div>';
                }
            }
            closedir($dh);
        }
    }
?>    
<style style="display: none;">
    #player-filmes{
        text-align: center;
        margin-top: 60pt;
    }
    video{
        width: 300px;
        height: 250px;
    }
    body{
        background-image: linear-gradient(to right, black 80%, red);
    }
    h5{
        font-family: Arial, Helvetica, sans-serif;
        color: white;
        background: black;
        margin: 0px;
    }
    div{
        float: left;
        margin-left: 25pt;
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>