<?php

ob_start();

    include 'head_pg.php';
    include 'publicacao.class.php';
        $publicacao = new Publicacao();
        $lastid = $publicacao->lastJournal(); 
        $id = $lastid['id'];
        $edic = $lastid['edicao'];
        $data_end = $lastid['data'];

    include 'configuracoes.class.php';
        $configuracao = new Configuracao();
        $dadosfixos = $configuracao->getDadosDiagr();
        $lastsecr = $configuracao->lastSecr();
        $idsec = $lastsecr ['id'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="DSJ Soluções Digitais">
    <title>Diário Oficial de Cubatão</title>

        <!-- JAVASCRIPT E JQUERY -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css">                

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="icon" type="image/png" href="assets/img/fav.png" />
    <script src="https://kit.fontawesome.com/35f244f0d3.js" crossorigin="anonymous"></script>



</head>

<body>

    <div id="cabecalho">    
        <div class="container">

            <div class="row align-middle justify-content-center">
                <div class="logo">
                    <img src="assets/img/logo_cab_PMC.png" class="figure-img img-fluid">
                </div>
                <div class="title">
                    <h1>Diário Oficial Eletrônico</h1>
                </div>
            </div>
            <div id="barra_t">
                
            </div>
            <div class="row align-middle justify-content-around">
                <div>
                    <span class="d_hoje">Nº <?php echo $edic; ?></span>
                </div>
                <div>
                    <span class="d_hoje">Cubatão, <?php setlocale(LC_ALL, 'pt_BR.utf8');
                                                        date_default_timezone_set('America/Sao_Paulo');
                                                        echo strftime('%A-feira, %d de %B de %Y', strtotime($data_end)); ?>
                    </span>
                </div>
                <div>
                    <span class="d_hoje">Poder Executivo</span>
                </div>

            </div>
            <div id="barra_b">
            </div>

            <div id="resp" class="row align-middle justify-content-start justify-content-around">
                 <div>
                    <span class="info">www.cubatao.sp.gov.br/diariooficial</span>
                </div>
                <div>
                    <span class="info">Lei ordinária nº 3893, de 20 de abril de 2018</span>
                </div>
                <div>
                    <span class="info"> Responsável pelo executivo: <?php echo $dadosfixos['executivo']; ?></span>
                </div>                    
            </div>
        </div>
  
    </div>   
   

    
 
    <div id="diariodia">
        <div class="container">
            <?php

            $noplubexec = $publicacao->vazioExecutivo(); 
            if (empty($noplubexec)) {
                
                echo '<br />';
                echo '  <div class="row align-middle justify-content-around">
                            <div>
                                 <h6 class="titulo_dg"> NÃO HÁ PUBLICAÇÕES OFICIAIS NESTA DATA </h6>
                            </div>                       
                         </div>';
                echo '<br /><br />';

            } else {

                $id = 1;

                while ($id <= $idsec) {

                    $inf_secr = $configuracao->getInfoSecretaria($id);
                    $divis = $inf_secr['divis'];

                    $publicado = $publicacao->getPubOne($divis, $edic);

                        if ((!empty($publicado))&&($divis != "Legislativo")) {
                      
                            echo '<br /><h4 id="secret_dg">'.$divis.'</h4><br />';        
                            foreach ($publicado as $item_pb):
                            ?>

                            <div class="titulo_dg">
                                <h6 ><?php echo $item_pb['titulo']; ?> </h6>    
                            </div>
                            <br /> 
                            <div class="conteudo_dg">
                                <div style="overflow-x:auto;padding:5px">
                                    <?php echo $item_pb['conteudo']; ?>
                                </div>
                            </div>
                            <br /> 
                            <div class="datapublic_dg"><?php echo $item_pb['datapublic']; ?> </div> 
                            <br /> <br />
                            <div class="assinatura_dg"><?php echo $item_pb['assinatura']; ?> </div>
                            <br />

                            <div class="container">
                                <div class="row align-middle justify-content-center">
                                    <hr class="separacao_dg" align="right" />
                                </div>
                            </div>
                            <br />

                            <?php endforeach;                        
                        } 

                    ++$id;
                }
            }
            ?>
        </div>

        <div id="cabecalho">    
                    <div class="container">

                        <div class="row align-middle justify-content-center">
                            <div class="logo">
                                <img src="assets/img/logo_cab_PMC.png" class="figure-img img-fluid">
                            </div>
                            <div class="title">
                                <h1>Diário Oficial Eletrônico</h1>
                            </div>
                        </div>
                        <div id="barra_t">
                            
                        </div>
                        <div class="row align-middle justify-content-around">
                            <div>
                                <span class="d_hoje">Nº <?php echo $edic; ?> </span>
                            </div>
                            <div>
                                <span class="d_hoje">Cubatão <?php setlocale(LC_ALL, 'pt_BR.utf8');
                                                            date_default_timezone_set('America/Sao_Paulo');
                                                            echo strftime('%A-feira, %d de %B de %Y', strtotime($data_end)); ?>
                                </span>
                            </div>
                            <div>
                                <span class="d_hoje">Poder Legislativo</span>
                            </div>

                        </div>
                        <div id="barra_b">
                        </div>

                        <div id="resp" class="row align-middle justify-content-start justify-content-around">
                             <div>
                                <span class="info">www.cubatao.sp.leg.br/diariooficial</span>
                            </div>
                            <div>
                                <span class="info">Lei ordinária nº 3893, de 20 de abril de 2018</span>
                            </div>
                            <div>
                                <span class="info"> Responsável pelo legislativo: <?php echo $dadosfixos['legislativo']; ?></span>
                            </div>                    
                        </div>
                    </div>
              
                    <div class="container">
                                <?php

                                    $noplubleg = $publicacao->vazioLegislativo(); 
                                    if (empty($noplubleg)) {
                                        echo '<br />';
                                        echo '  <div class="row align-middle justify-content-around">
                                                    <div>
                                                        <h6 class="titulo_dg"> NÃO HÁ PUBLICAÇÕES OFICIAIS NESTA DATA </h6>
                                                    </div>                       
                                                 </div>';
                                        echo '<br /><br />';
                                    } else {

                                    $id = $idsec;

                                    while ($id <= $idsec) {

                                        $inf_secr = $configuracao->getInfoSecretaria($id);
                                        $divis = $inf_secr['divis'];
                                                            
                                        $publicado = $publicacao->getPubOne($divis, $edic);

                                            if ((!empty($publicado))) {
                                                  
                                                foreach ($publicado as $item_pb):
                                                ?>
                                                <br /> 
                                                <h6 class="titulo_dg"><?php echo $item_pb['titulo']; ?> </h6>
                                                <br /> 
                                                <span class="conteudo_dg"><?php echo $item_pb['conteudo']; ?> </span>
                                                <br /> 
                                                <span class="datapublic_dg"><?php echo $item_pb['datapublic']; ?> </span> 
                                                <br /> <br />
                                                <span class="assinatura_dg"><?php echo $item_pb['assinatura']; ?> </span>
                                                <br /> 
                                                <div class="container">
                                                    <div class="row align-middle justify-content-center">
                                                        <hr class="separacao_dg" align="right" />
                                                    </div>
                                                </div>
                                                
                                                <?php endforeach;
                                            
                                            } else {

                                            }
                                        ++$id;
                                    }
                                }
                                ?>
                            </div>

    </div>
  
   
</html>
 
  
<?php

$html = ob_get_contents();
ob_end_clean();

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>