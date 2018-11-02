

<?php

            if(isset($tab_etape))
            {
                $i = 0;
                while( $i<$nb_etape)
                {
                    $etape = $tab_etape[$i]['etape'];
                    if($etape == 'SAISIE 1' || $etape == 'SAISIE' || $etape == 'OCR'|| $etape == 'IMAGE' || $etape == 'TRANSFORMATION')
                    {?>
                                        <script type="text/javascript">
                                            var chart1;
                                            jQuery(document).ready(function()
                                            {
                                                chart1 = new Highcharts.Chart({
                                                    chart: {
                                                        renderTo: 'graphe_tab<?php echo $i; ?>',
                                                        type: 'pie'
                                                    },
                                                    title: {
                                                        text: '<?php echo $etape; ?>'
                                                    },
                                                    exporting: { enabled: false },
                                                    subtitle: {
                                                        text: 'Toatal:<?php echo $tab_fic_nontraiteS[$i]['nb_fic_nontraiteS'] +$tab_fic_encoursS[$i]['nb_fic_encoursS']+$tab_fic_finiS[$i]['nb_fic_finiS']; ?> | Non traité:<?php if(isset($tab_fic_nontraiteS[$i]['nb_fic_nontraiteS'])) echo $tab_fic_nontraiteS[$i]['nb_fic_nontraiteS']; ?> | En cours:<?php if(isset($tab_fic_encoursS[$i]['nb_fic_encoursS'])) echo $tab_fic_encoursS[$i]['nb_fic_encoursS']; ?> | Fini:<?php if($tab_fic_finiS[$i]['nb_fic_finiS']) echo $tab_fic_finiS[$i]['nb_fic_finiS']; ?>'
                                                    },
                                                    plotOptions: {
                                                        series: {
                                                            dataLabels: {
                                                                enabled: true,
                                                                format: '{point.name}: {point.y:.1f}%'
                                                            }
                                                        }

                                                    },
                                                    tooltip: {
                                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> Par rapport au total <br/>'
                                                    },
                                                    <?php
                                                     $total = $tab_fic_nontraiteS[$i]['nb_fic_nontraiteS'] +$tab_fic_encoursS[$i]['nb_fic_encoursS']+$tab_fic_finiS[$i]['nb_fic_finiS'];
                                                     $p_nontraite_S = ($tab_fic_nontraiteS[$i]['nb_fic_nontraiteS']/$total)*100;
                                                     $p_encours_S = ($tab_fic_encoursS[$i]['nb_fic_encoursS']/$total)*100;
                                                     $p_fini_S = ($tab_fic_finiS[$i]['nb_fic_finiS']/$total)*100;
                                                     ?>
                                                    series: [{"name":"Informations","colorByPoint":"true","data":[{"name":"En cours","y":<?php echo $p_encours_S; ?>,"drilldown":"En cours"},{"name":"Fini","y":<?php echo $p_fini_S; ?>,"drilldown":"Fini"},{"name":"Non trait\u00e9","y":<?php echo $p_nontraite_S; ?>,"drilldown":"Non trait\u00e9"}]}]
                                                });
                                            });
                                        </script>


                    <?php
                    }
                    if($etape == 'CONTROLE ECH' || $etape == 'CONTROLE' || $etape == 'CONTROLE WEB' )
                    {  ?>
                        <script type="text/javascript">
                            var chart1;
                            jQuery(document).ready(function()
                            {
                                chart1 = new Highcharts.Chart({
                                    chart: {
                                        renderTo: 'graphe_tab<?php echo $i; ?>',
                                        type: 'pie'
                                    },
                                    title: {
                                        text: '<?php echo $etape; ?>'
                                    },
                                    exporting: { enabled: false },
                                    subtitle: {
                                        text: 'Toatal:<?php echo $tab_fic_nontraiteC[$i]['nb_fic_nontraiteC'] +$tab_fic_encoursC[$i]['nb_fic_encoursC']+$tab_fic_finiC[$i]['nb_fic_finiC']; ?> | Non traité:<?php if(isset($tab_fic_nontraiteC[$i]['nb_fic_nontraiteC'])) echo $tab_fic_nontraiteC[$i]['nb_fic_nontraiteC']; ?> | En cours:<?php if(isset($tab_fic_encoursC[$i]['nb_fic_encoursC'])) echo $tab_fic_encoursC[$i]['nb_fic_encoursC']; ?> | Fini:<?php if($tab_fic_finiC[$i]['nb_fic_finiC']) echo $tab_fic_finiC[$i]['nb_fic_finiC']; ?>'
                                    },
                                    plotOptions: {
                                        series: {
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}: {point.y:.1f}%'
                                            }
                                        }

                                    },
                                    tooltip: {
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> Par rapport au total <br/>'
                                    },
                                    <?php
                                                                       $total = $tab_fic_nontraiteC[$i]['nb_fic_nontraiteC'] +$tab_fic_encoursC[$i]['nb_fic_encoursC']+$tab_fic_finiC[$i]['nb_fic_finiC'];
                                                                       $p_nontraite_C = ($tab_fic_nontraiteC[$i]['nb_fic_nontraiteC']/$total)*100;
                                                                       $p_encours_C = ($tab_fic_encoursC[$i]['nb_fic_encoursC']/$total)*100;
                                                                       $p_fini_C = ($tab_fic_finiC[$i]['nb_fic_finiC']/$total)*100;
                                                                       ?>
                                    series: [{"name":"Informations","colorByPoint":"true","data":[{"name":"En cours","y":<?php echo $p_encours_C; ?>,"drilldown":"En cours"},{"name":"Fini","y":<?php echo $p_fini_C; ?>,"drilldown":"Fini"},{"name":"Non trait\u00e9","y":<?php echo $p_nontraite_C; ?>,"drilldown":"Non trait\u00e9"}]}]                                });
                            });
                        </script>
                    <?php
                    }
                    if($etape == 'FORMATAGE' )
                    {  ?>
                        <script type="text/javascript">
                            var chart1;
                            jQuery(document).ready(function()
                            {
                                chart1 = new Highcharts.Chart({
                                    chart: {
                                        renderTo: 'graphe_tab<?php echo $i; ?>',
                                        type: 'pie'
                                    },
                                    title: {
                                        text: '<?php echo $etape; ?>'
                                    },
                                    exporting: { enabled: false },
                                    subtitle: {
                                        text: 'Toatal:<?php echo $tab_fic_nontraiteF[$i]['nb_fic_nontraiteF'] +$tab_fic_encoursF[$i]['nb_fic_encoursF']+$tab_fic_finiF[$i]['nb_fic_finiF']; ?> | Non traité:<?php if(isset($tab_fic_nontraiteF[$i]['nb_fic_nontraiteF'])) echo $tab_fic_nontraiteF[$i]['nb_fic_nontraiteF']; ?> | En cours:<?php if(isset($tab_fic_encoursF[$i]['nb_fic_encoursF'])) echo $tab_fic_encoursF[$i]['nb_fic_encoursF']; ?> | Fini:<?php if($tab_fic_finiF[$i]['nb_fic_finiF']) echo $tab_fic_finiF[$i]['nb_fic_finiF']; ?>'
                                    },
                                    plotOptions: {
                                        series: {
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}: {point.y:.1f}%'
                                            }
                                        }

                                    },
                                    tooltip: {
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> Par rapport au total <br/>'
                                    },
                                    <?php
                                                                       $total = $tab_fic_nontraiteF[$i]['nb_fic_nontraiteF'] +$tab_fic_encoursF[$i]['nb_fic_encoursF']+$tab_fic_finiF[$i]['nb_fic_finiF'];
                                                                       $p_nontraite_F = ($tab_fic_nontraiteF[$i]['nb_fic_nontraiteF']/$total)*100;
                                                                       $p_encours_F = ($tab_fic_encoursF[$i]['nb_fic_encoursF']/$total)*100;
                                                                       $p_fini_F = ($tab_fic_finiF[$i]['nb_fic_finiF']/$total)*100;
                                                                       ?>
                                    series: [{"name":"Informations","colorByPoint":"true","data":[{"name":"En cours","y":<?php echo $p_encours_F; ?>,"drilldown":"En cours"},{"name":"Fini","y":<?php echo $p_fini_F; ?>,"drilldown":"Fini"},{"name":"Non trait\u00e9","y":<?php echo $p_nontraite_F; ?>,"drilldown":"Non trait\u00e9"}]}]                                });
                            });
                        </script>
                    <?php
                    }
                    if($etape == 'LIVRAISON' )
                    {  ?>
                        <script type="text/javascript">
                            var chart1;
                            jQuery(document).ready(function()
                            {
                                chart1 = new Highcharts.Chart({
                                    chart: {
                                        renderTo: 'graphe_tab<?php echo $i; ?>',
                                        type: 'pie'
                                    },
                                    title: {
                                        text: '<?php echo $etape; ?>'
                                    },
                                    exporting: { enabled: false },
                                    subtitle: {
                                        text: 'Toatal:<?php echo $tab_fic_nontraiteLi[$i]['nb_fic_nontraiteLi'] +$tab_fic_encoursLi[$i]['nb_fic_encoursLi']+$tab_fic_finiLi[$i]['nb_fic_finiLi']; ?> | Non traité:<?php if(isset($tab_fic_nontraiteLi[$i]['nb_fic_nontraiteLi'])) echo $tab_fic_nontraiteLi[$i]['nb_fic_nontraiteLi']; ?> | En cours:<?php if(isset($tab_fic_encoursLi[$i]['nb_fic_encoursLi'])) echo $tab_fic_encoursLi[$i]['nb_fic_encoursLi']; ?> | Fini:<?php if($tab_fic_finiLi[$i]['nb_fic_finiLi']) echo $tab_fic_finiLi[$i]['nb_fic_finiLi']; ?>'
                                    },
                                    plotOptions: {
                                        series: {
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}: {point.y:.1f}%'
                                            }
                                        }

                                    },
                                    tooltip: {
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> Par rapport au total <br/>'
                                    },
                                    <?php
                                   $total = $tab_fic_nontraiteLi[$i]['nb_fic_nontraiteLi'] +$tab_fic_encoursLi[$i]['nb_fic_encoursLi']+$tab_fic_finiLi[$i]['nb_fic_finiLi'];
                                   $p_nontraite_Li = ($tab_fic_nontraiteLi[$i]['nb_fic_nontraiteLi']/$total)*100;
                                   $p_encours_Li = ($tab_fic_encoursLi[$i]['nb_fic_encoursLi']/$total)*100;
                                   $p_fini_Li = ($tab_fic_finiLi[$i]['nb_fic_finiLi']/$total)*100;
                                   ?>
                                    series: [{"name":"Informations","colorByPoint":"true","data":[{"name":"En cours","y":<?php echo $p_encours_Li; ?>,"drilldown":"En cours"},{"name":"Fini","y":<?php echo $p_fini_Li; ?>,"drilldown":"Fini"},{"name":"Non trait\u00e9","y":<?php echo $p_nontraite_Li; ?>,"drilldown":"Non trait\u00e9"}]}]
                                });
                            });
                        </script>
                    <?php
                    }
                    if($etape == 'LECTURE' || $etape == 'RECHERCHE')
                    {  ?>
                        <script type="text/javascript">
                            var chart1;
                            jQuery(document).ready(function()
                            {
                                chart1 = new Highcharts.Chart({
                                    chart: {
                                        renderTo: 'graphe_tab<?php echo $i; ?>',
                                        type: 'pie'
                                    },
                                    title: {
                                        text: '<?php echo $etape; ?>'
                                    },
                                    exporting: { enabled: false },
                                    subtitle: {
                                        text: 'Toatal:<?php echo $tab_fic_nontraiteLec[$i]['nb_fic_nontraiteLec'] +$tab_fic_encoursLec[$i]['nb_fic_encoursLec']+$tab_fic_finiLec[$i]['nb_fic_finiLec']; ?> | Non traité:<?php if(isset($tab_fic_nontraiteLec[$i]['nb_fic_nontraiteLec'])) echo $tab_fic_nontraiteLec[$i]['nb_fic_nontraiteLec']; ?> | En cours:<?php if(isset($tab_fic_encoursLec[$i]['nb_fic_encoursLec'])) echo $tab_fic_encoursLec[$i]['nb_fic_encoursLec']; ?> | Fini:<?php if($tab_fic_finiLec[$i]['nb_fic_finiLec']) echo $tab_fic_finiLec[$i]['nb_fic_finiLec']; ?>'
                                    },
                                    plotOptions: {
                                        series: {
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}: {point.y:.1f}%'
                                            }
                                        }

                                    },
                                    tooltip: {
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> Par rapport au total <br/>'
                                    },
                                    <?php
                                                             $total = $tab_fic_nontraiteLec[$i]['nb_fic_nontraiteLec'] +$tab_fic_encoursLec[$i]['nb_fic_encoursLec']+$tab_fic_finiLec[$i]['nb_fic_finiLec'];
                                                             $p_nontraite_Lec = ($tab_fic_nontraiteLec[$i]['nb_fic_nontraiteLec']/$total)*100;
                                                             $p_encours_Lec = ($tab_fic_encoursLec[$i]['nb_fic_encoursLec']/$total)*100;
                                                             $p_fini_Lec = ($tab_fic_finiLec[$i]['nb_fic_finiLec']/$total)*100;
                                                             ?>
                                    series: [{"name":"Informations","colorByPoint":"true","data":[{"name":"En cours","y":<?php echo $p_encours_Lec; ?>,"drilldown":"En cours"},{"name":"Fini","y":<?php echo $p_fini_Lec; ?>,"drilldown":"Fini"},{"name":"Non trait\u00e9","y":<?php echo $p_nontraite_Lec; ?>,"drilldown":"Non trait\u00e9"}]}]

                                });
                            });
                        </script>
                   <?php
                    }
                    ?>
                    <div id="graphe_tab<?php echo $i; ?>"> </div>
                    <?php
                $i++;
                }
            }?>
<style>
    #graphe_tab0
    {
        float: left;
        width: 48%;
        bottom : 20px
    }
    #graphe_tab1
    {
        float: right;
        width: 48%;
    }
    #graphe_tab2
    {
        float: left;
        width: 48%;
    }
    #graphe_tab3
    {
        float: right;
        width: 48%;
    }
    #graphe_tab4
    {
        float: left;
        width: 48%;
    }
    #graphe_tab5
    {
        float: right;
        width: 48%;
    }
    #graphe_tab6
    {
        float: left;
        width: 48%;
    }
</style>

