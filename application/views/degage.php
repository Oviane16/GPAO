<?php

  name: "Informations",
  colorByPoint: true,
  data: [{
  name: "Saisie fini",
  y: <?php if(isset($data_fic_s)){ echo $data_fic_s[$i]['saisie_fini']; } ?>,
  drilldown: "Saisie fini"
  }, {
  name: "Controle fini",
  y:  <?php if(isset($data_fic_c)){ echo $data_fic_c[$i]['controle_fini']; } ?>,
  drilldown: "Controle fini"
  }, {
  name: "Formatage fini",
  y:  <?php if(isset($data_fic_fo)){ echo $data_fic_fo[$i]['formatage_fini']; } ?>,
  drilldown: "Formatage fini"
  }, {
  name: "Lecture fini",
  y: <?php if(isset($data_fic_lec)){ echo $data_fic_lec[$i]['lecture_fini']; } ?>,
  drilldown: "lecture"
  },  {
  name: "Livraison fini",
  y: <?php if(isset($data_fic_li)){ echo $data_fic_li[$i]['livraison_fini']; } ?>,
  drilldown: "Livraison fini"
  }]

?>