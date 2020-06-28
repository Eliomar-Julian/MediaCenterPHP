<?php
# -------verificando metodo de GET -----------------------------------------------------------
require_once('menu.php');
isset($_GET['valor']) ? $complemento = $_GET['valor'] : $complemento = "";
echo '<h1 style="color: blue; text-align: center; padding-top: 150px;">'.$complemento.'</h1>';

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
        closedir($subdir);
    }
}
leitura()
# ----------------- ESTILOS ----------------------------------
?>
<style>
    .series{
        float: left;
        width: 300px;
        margin-left: 20pt;
        background-color: rgba(255, 255, 255, 0.1);
    }
    video{
        width: 300px;
        height: 250px;
        padding: 20pt;
    }
    body{
        background-image: linear-gradient(to right, black 80%, red);
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
        width: 200pt;
        margin: 10px;
        transition: 1s;
    }
    button:hover{
        background-color: green;
        transition: 0.5s;
    }
    body{
        background-image: linear-gradient(to right, black 80%, red);
        margin: 0px;
        padding: 0x;
    }
    h3{
        color: ;
        text-align: center;
    }
    img{
        width: 180pt;
        height: 220pt;
        box-shadow: 2pt 2pt 5pt black;
        border-radius: 10px;
    }
</style>