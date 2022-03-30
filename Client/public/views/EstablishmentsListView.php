    <div class="row">  
        <div class="col text-center">
            <h1>
                Nos établissements
            </h1>
        </div>        
    </div>
    <?php
    foreach($props as $key => $element){ ?>
        <div class="mt-2 mb-3 p-2 border border-light rounded shadow-light put-forward">        
            <div class="row">
                <div class="col-auto">
                    <h2 class="curve">
                        <?= $element->name ?>
                    </h2>
                    <p class="font-light adress">
                        <?= $element->adress ?>
                    </p>
                    <hr>
                </div>        
                <div class="col-auto ms-auto">
                    <h3>
                        <?= $element->city ?>
                    </h3>            
                </div>
                <div class="col-12">
                    <p>
                        <?= $element->description ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-auto ms-auto">
                    <a class="btn btn-info" href="/establishments/suites?id=<?= $element->id ?>">Je découvre</a>                    
                </div>        
            </div>          
        </div>
    <?php
    };
    ?>