<script>
    $(document).ready(function() {
        $('#actualiser').click(function()
            {
                $.ajax({
                type: "GET",
                url: "http://localhost/mikiry/index.php/tab_bord_recap",
               // url: "http://localhost/mikiry/index.php/tab_bord_recap",
                dataType : "html",
                error:function(msg, string)
                {
                    alert( "Error !: " + string );
                },
                success:function(data)
                {
                    $("#accueil").empty().hide();
                    $("#accueil").append(data);
                    $('#accueil').fadeIn(500);
                }
            });

            });
    });
</script>

<legend>Tableau de bord recapitulatif</legend>

<button type="button" id="actualiser" class="btn btn-info btn-mini">Actualiser Tout</button>

<table  cellpadding="5" cellspacing="5">
    <thead>
        <tr>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total personnel actif   </td><td><?php
                if(isset($pers_actif))
                {
                if($pers_actif !=0)
                {
                    ?><span class="badge badge-success"><?php echo $total_actif;?> </span> <?php
                }
                else if($pers_actif ==0)
                {
                ?><span class="badge badge-warning"><?php echo '0';
                    }
                    } ?></span>
            </td>
            <td>Pers Actif  </td><td><?php
                if(isset($pers_actif))
                {
                    if($pers_actif !=0)
                        {
                            ?><span class="badge badge-success"><?php echo $pers_actif;?> </span> <?php
                        }
                    else if($pers_actif ==0)
                    {
                        ?><span class="badge badge-warning"><?php echo '0';
                    }
                } ?></span>
            </td>

            <td>Controlleur Actif  </td><td><?php
                if(isset($ctl_actif))
                {
                if($ctl_actif !=0)
                {
                    ?><span class="badge badge-success"><?php echo $ctl_actif;?> </span> <?php
                }
                else if($ctl_actif ==0)
                {
                ?><span class="badge badge-warning"><?php echo '0';
                    }
                    } ?></span>
            </td>
            <td>Os Actif  </td><td><?php
                if(isset($os_actif))
                {
                if($os_actif !=0)
                {
                    ?><span class="badge badge-success"><?php echo $os_actif;?> </span> <?php
                }
                else if($os_actif ==0)
                {
                ?><span class="badge badge-warning"><?php echo '0';
                    }
                    } ?></span>
            </td>        </tr>

    </tbody>

</table>
<hr>
Graphe et information pour chaque commande qui n'est pas encore fermeé

<hr>

<div style="width:100%; max-height:800px; background-color: rgba(197, 219, 255, 0); height:auto; border:solid 1px rgba(0, 0, 0, 0.08); overflow:auto; ">
<?php
if(isset($j))
{
        $i=0;
        while($i<$j)
        {
            ?>
            <script type="text/javascript">
            var chart1;
            jQuery(document).ready(function()
            {
                chart1 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'graphe<?php echo $i;?>',
                        type: 'column'
                    },
                    title: {
                        text: 'Pourcentage des etapes finis pour <?php if(isset($data_commande)){ echo $data_commande[$i]['commande'];}
                            if(isset($data_dossier)) {
                            if($data_dossier[$i]['dossier'] !=null )
                            {
                                 echo '/'.$data_dossier[$i]['dossier'] ;

                            }}?> '
                    },
                    exporting: { enabled: false },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Total des fichiers = <?php if(isset($data_nb_fic)){ echo $data_nb_fic[$i]['nb_fichier']; } ?> '
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true,
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.1f}%'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> par rapport au <?php if(isset($data_nb_fic)){ echo $data_nb_fic[$i]['nb_fichier']; } ?><br/>'
                    },

                    series: [{
                        name: "Informations",
                        data:
                            [{
                                <?php
               if(isset($data_etape[$i]['data_etape']))
               {
                        foreach($data_etape[$i]['data_etape'] as $etape)
                       {
                           if($etape->ETAPE == 'SAISIE 1' || $etape->ETAPE == 'SAISIE' || $etape->ETAPE == 'OCR'|| $etape->ETAPE == 'IMAGE' || $etape->ETAPE == 'TRANSFORMATION' )
                           {  ?>


                                name: "Saisie fini",
                                color:'#d9482a',
                                y: <?php if(isset($data_fic_s)){ echo $data_fic_s[$i]['saisie_fini']; } ?>,
                                drilldown: "Saisie fini"

                                },{

                                <?php
                            }



                             if($etape->ETAPE == 'CONTROLE ECH' || $etape->ETAPE == 'CONTROLE' || $etape->ETAPE == 'CONTROLE WEB' )
                           {  ?>


                                name: "Controle fini",
                                color:'#b8b717',
                                y: <?php if(isset($data_fic_c)){ echo $data_fic_c[$i]['controle_fini']; } ?>,
                                drilldown: "Controle fini"

                            },{

                                <?php
                            }



                             if($etape->ETAPE == 'FORMATAGE' )
                           {  ?>


                                name: "Formatage fini",
                                color:'#448fea',
                                y: <?php if(isset($data_fic_fo)){ echo $data_fic_fo[$i]['formatage_fini']; } ?>,
                                drilldown: "Formatage fini"

                            },{

                                <?php
                            }


                             if($etape->ETAPE == 'LIVRAISON'  )
                           {  ?>


                                name: "Livraison fini",
                                color:'#28ba41',
                                y: <?php if(isset($data_fic_li)){ echo $data_fic_li[$i]['livraison_fini']; } ?>,
                                drilldown: "Livraison fini"

                            },{

                                <?php
                            }

                             if($etape->ETAPE == 'LECTURE' || $etape->ETAPE == 'RECHERCHE' )
                           {  ?>


                                name: "Lecture fini",
                                color:'#46bfa3',
                                y: <?php if(isset($data_fic_lec)){ echo $data_fic_lec[$i]['lecture_fini']; } ?>,
                                drilldown: "Lecture fini"

                            },{

                                <?php
                            }
                            ?>


                                <?php
         /*foreach */}

/*if (isset */ }?>
                            }]

                    }]

                });
            });
            </script>


            <?php
            $i++;
            ?>

            <div style='display:;'>
                <div style='display:table-row;'>
                    <div style='display;float: left;  padding:5px;'>
                        <div style="height: 34%;" id="graphe<?php echo ($i-1); ?>"></div>
                    </div>
                    <div style='display:;float:right;'>



                <?php  if(isset($data_etape[$i-1]['data_etape']))
                {
                    ?>
                <table style="font-size: smaller;float: right;">
                    <tr>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'os traiteur:
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($nb_os)){ echo $nb_os[$i-1]['os']; } ?>
                    </td>
                        </tr>
                    <tr>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre de controleur traiteur:
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($nb_ctl)){ echo $nb_ctl[$i-1]['ctl']; } ?>
                    </td>
                    </tr>

                </table>

                <table style="font-size: smaller;float:left;">

                            <tbody>
                    <?php
                    foreach($data_etape[$i-1]['data_etape'] as $etape)
                    {

                        if($etape->ETAPE == 'SAISIE 1' || $etape->ETAPE == 'SAISIE' || $etape->ETAPE == 'OCR'|| $etape->ETAPE == 'IMAGE' || $etape->ETAPE == 'TRANSFORMATION')
                        {?>

                            <tr>
                                <td style=" color: #d9482a;">
                                    Saisie non traité:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_notraite_s)){ echo $data_nb_notraite_s[$i-1]['nb_notraite_s']; } ?>
                                </td>

                            </tr>
                            <tr>
                                <td  style=" color: #d9482a;">
                                    Saisie En cours:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_encours_s)){ echo $data_nb_encours_s[$i-1]['nb_encours_s']; } ?>
                                </td>

                            </tr>
                            <tr>
                                <td style=" color: #d9482a;">
                                    Saisie fini:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_fini_s)){ echo $data_nb_fini_s[$i-1]['nb_fini_s']; } ?>
                                </td>

                            </tr>


                        <?php  }
                        if($etape->ETAPE == 'REJET')
                        {?>

                            <tr>
                                <td style=" color: red;">
                                    Saisie Rejeté:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_rejete_s)){ echo $data_nb_rejete_s[$i-1]['nb_rejete_s']; } ?>
                                </td>
                            </tr>


                        <?php  }
                        if($etape->ETAPE == 'CONTROLE' || $etape->ETAPE == 'CONTROLE ECH'|| $etape->ETAPE == 'CONTROLE WEB')
                        {?>
                            <tr>
                                <td style=" color: #b8b717;">
                                    Controle non traité:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_notraite_c)){ echo $data_nb_notraite_c[$i-1]['nb_notraite_c']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color:  #b8b717;">
                                    Controle En cours:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_encours_c)){ echo $data_nb_encours_c[$i-1]['nb_encours_c']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color:  #b8b717;">
                                    Controle fini:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_fini_c)){ echo $data_nb_fini_c[$i-1]['nb_fini_c']; } ?>
                                </td>
                            </tr>
                       <?php }
                        if($etape->ETAPE =='FORMATAGE')
                        {?>
                            <tr>
                                <td style=" color: #448fea;">
                                    Formatage non traité:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_notraite_fo)){ echo $data_nb_notraite_fo[$i-1]['nb_notraite_fo']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color: #448fea;">
                                    Formatage En cours:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_encours_fo)){ echo $data_nb_encours_fo[$i-1]['nb_encours_fo']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color: #448fea;">
                                    Formatage fini:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_fini_fo)){ echo $data_nb_fini_fo[$i-1]['nb_fini_fo']; } ?>
                                </td>
                            </tr>
                        <?php }
                        if($etape->ETAPE =='LECTURE' || $etape->ETAPE =='RECHERCHE' )
                        {?>
                            <tr>
                                <td style=" color: #46bfa3;">
                                    Lecture non traité:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_notraite_lec)){ echo $data_nb_notraite_lec[$i-1]['nb_notraite_lec']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color: #46bfa3;">
                                    Lecture En cours:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_encours_lec)){ echo $data_nb_encours_lec[$i-1]['nb_encours_lec']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color: #46bfa3;">
                                    Lecture fini:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_fini_lec)){ echo $data_nb_fini_lec[$i-1]['nb_fini_lec']; } ?>
                                </td>
                            </tr>
                        <?php }
                        if($etape->ETAPE =='LIVRAISON')
                        {?>
                            <tr>
                                <td style=" color: #28ba41;">
                                    Livraison non traité:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_notraite_li)){ echo $data_nb_notraite_li[$i-1]['nb_notraite_li']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color: #28ba41;">
                                    Livraison En cours:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_encours_li)){ echo $data_nb_encours_li[$i-1]['nb_encours_li']; } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color: #28ba41;">
                                    Livraison fini:
                                </td>
                                <td>
                                    <?php if(isset($data_nb_fini_li)){ echo $data_nb_fini_li[$i-1]['nb_fini_li']; } ?>
                                </td>
                            </tr>
                        <?php }




                    }
                }?>


                            </tbody>
                        </table>
                    </div>

                </div>

            </div><hr>

        <?php }

    }
 ?>
</div>




