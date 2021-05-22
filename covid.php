<?php

$casPHP = [];
$decesPHP = [];
$moisPHP = [];

for($i=1;$i<=12;$i++){

  if(isset($totalCas[$i])) {

    array_push($casPHP,$totalCas[$i]);

  }
  else {
    array_push($casPHP,0);
  }

  if(isset($totalDeces[$i])) {

    array_push($decesPHP,$totalDeces[$i]);

  }
  else {
    array_push($decesPHP,0);
  }

  switch($i) {
    case 1:
      array_push($moisPHP,"Janvier");
      break;
    case 2:
      array_push($moisPHP,"Fevrier");
      break;
    case 3:
      array_push($moisPHP,"Mars");
      break;
    case 4:
      array_push($moisPHP,"Avril");
      break;
    case 5:
      array_push($moisPHP,"Mai");
      break;
    case 6:
      array_push($moisPHP,"Juin");
      break;
    case 7:
      array_push($moisPHP,"Juillet");
      break;
    case 8:
      array_push($moisPHP,"Aout");
      break;
    case 9:
      array_push($moisPHP,"Septembre");
      break;
    case 10:
      array_push($moisPHP,"Octobre");
      break;
    case 11:
      array_push($moisPHP,"Novembre");
      break;
    case 12:
      array_push($moisPHP,"Decembre");
      break;
  }

}

?>

<script>

var mois = <?php echo json_encode($moisPHP) ?>;

var cas = <?php echo json_encode($casPHP) ?>;

var deces = <?php echo json_encode($decesPHP) ?>;

const labels = mois;

const data = {
  labels: labels,
  datasets: [
  {
    label: 'nombre de cas',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: cas,
  },
  {
    label: 'nombre de décès',
    backgroundColor: 'rgb(149, 224, 108)',
    borderColor: 'rgb(149, 224, 108)',
    data: deces,
  },
  ]
};

const config = {
  type: 'line',
  data,
  options: {}
};

// module.exports = {
//   actions: [],
//   config: config,
// };

</script>