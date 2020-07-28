<?php
# -------verificando metodo de GET -----------------------------------------------------------
require_once('menu.php');
isset($_GET['valor']) ? $complemento = $_GET['valor'] : $complemento = "";
echo '<h1 style="color: blue; text-align: center; padding-top: 150px; padding-bottom: 50px; text-shadow: 1px 0px 40px white;">'.$complemento.'</h1>';

# ---- definindo função de leitura e manipulação de arquivos -------------------------------------
function leitura(){
    global $complemento;
    $dir = "media/series/".$complemento;
    # --------- leitura das imagens pra posters-----------------------------------------------------------------
    $poster_dir = "media/poster/";
    if (is_dir($poster_dir)){
        if ($arquivos = opendir($poster_dir)){
            $list_image = array();
            while (($imagens = readdir($arquivos)) !== false){
                if (substr($imagens, -4) == ".jpg"){
                    $list_image[] = $imagens;
                }
            }
            closedir($arquivos);
        }
    }
   # -------- varrendo diretorios de midia--------------------
    if (is_dir($dir)){
        if ($subdir = opendir($dir)){
            $cont = 0;
            $imagens = array();
        # ---------filtrando tipos de arquivos ----------------
            while (($pastas = readdir($subdir)) !== false){
                if (substr($pastas, 0) !== "." && substr($pastas, 0) !== ".."){
                    if (substr($pastas, -4) == ".mp4" or substr($pastas, -4) == ".mkv"){
                        $caminho = $complemento;
                        $cont = $cont + 1;
                        echo '
                        <body>
                            <div class="series">
                                <video controls poster="./media/poster/'.$caminho.'.jpg" preload="none">
                                    <source src="media/series/'.$caminho.'/'.$pastas.'" type="video/mp4">
                                </video>
                                <h3 class="titulo-series">Episodio: '.$cont.'</h3>
                                <hr>
                            </div>
                        </body>';
                    continue;
                    }
                # --------- buscando o poster ----------------
                $poster = "";
                foreach ($list_image as $i){
                    $img = substr_replace($i, "", -4, strlen($i));
                    if ($img == $pastas){
                        $poster = $img;
                    }
                }
                # ---------- montando seletor de series ---------
                if (strlen($pastas) < 12){
                    echo '
                        <div>
                            <form method="GET">
                                <button type="submit" name="valor" class="btn btn-secondary" value="'.$pastas.'">
                                <h3 style="font-size: 25pt;">'.$pastas.'</h3><br/>
                                <img src="./media/poster/'.$poster.'.jpg" >
                                </button>
                            </form>
                        </div>';
                }else {
                    echo '
                        <div>
                            <form method="GET">
                                <button type="submit" name="valor" class="btn btn-secondary" value="'.$pastas.'">
                                <h3>'.$pastas.'</h3>
                                <img src="./media/poster/'.$poster.'.jpg" >
                                </button>
                            </form>
                        </div>';
                    }
                }
            }
        }
        closedir($subdir);
    }
}
leitura()
# ----------------- ESTILOS ----------------------------------
?>
<style>
    body{
        padding: 0px;
        margin: 0px;
        align-items: center;
    }
    .series{
        float: left;
        width: 200px;
        margin-left: 25pt;
        background-color: rgba(255, 255, 255, 0.1);
    }
    video{
        width: 200px;
        height: 200px;
        padding: 20pt;
    }
    .titulo-series{
        color: white;
        text-align: center;
    }
    div{
        width: 90%;
        text-align: center;
        margin: auto;
    }
    button{
        position: relative;
        font-size: 14pt;
        color: red;
        float: left;
        width: 150pt;
        margin: 10px;
        transition: 1s;
    }
    button:hover{
        background-color: green;
        transition: 0.5s;
    }
    body{
        background-image: linear-gradient(to right, #363E4D 50%, #0D0F12);
        margin: 0px;
        padding: 0x;
    }
    h3{
        color: white;
        text-align: center;
    }
    img{
        width: 100pt;
        height: 150pt;
        box-shadow: 2pt 2pt 5pt black;
        border-radius: 10px;
    }
</style>