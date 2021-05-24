<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Liste des pays pris en compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <?php

        $lieuActuel = "";

        foreach($array as $value){

            if($lieuActuel != $value['nom']) {

                foreach($listePays as $pays) {

                    if($value['nom'] == $pays) {

                        $lieuActuel = $value['nom'];

                        

                        echo $value['nom'] ."<br>";

                        

                    }

                }
                
            }

        }


        ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Revenir</button>
      </div>
    </div>
  </div>
</div>