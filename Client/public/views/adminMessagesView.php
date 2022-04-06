<div class="row">  
    <div class="col-auto text-center mb-2">
        <h1>
            Messages
        </h1>
    </div>          
    </div>
    <div id="messages-list">
    <?php    
    foreach($props as $key => $element){ ?>
        <div class="border border-light rounded shadow-light put-forward text-light custom-card <?= $element->done === 1 ? 'card-done' : ''?>" id="card-<?= $element->id ?>">                    
            
            <div class="row">
                <div class="col-12"><small><?= date('d-m-Y h:m', strtotime($element->date))?></small></div>
                <div class="row col-10">
                    <h2 class="mb-0 col-auto pe-0 mt-auto" id="fullname-<?= $element->id ?>">
                        <span id="lastname-<?= $element->id ?>"><?= strtoupper($element->lastname) ?></span>
                        <span id="firstname-<?= $element->id ?>"><?= ucFirst($element->firstname)?> </span>
                    </h2>                                                                              
                </div>         
            </div>
            <div class="row">
                <p class="mb-1" id="email-<?= $element->id ?>">
                    <?= $element->email ?>
                </p>                                
                <h3 class="mb-1" id="subject-<?= $element->id ?>">
                    <?= $element->subject ?>
                </h3>
                
                    <p class="mb-1">
                        <?= $element->message ?>
                    </p>
                    
                </div>
                <div class="fixed-bottom-end">
                    <button class="text-success px-0 me-2 icone" id="<?= $element->done === 1 ? 'undone' : 'done' ?>-<?= $element->id ?>"><i class="fa-solid fa-check"></i></button>
                    <button class="text-danger px-0 icone" id="delete-<?= $element->id ?>"><i class="fa-solid fa-trash-can text-danger ms-1 icone"></i></button>
                </div>
        </div>
    <?php
    };
    ?>
    </div>

<div id="validation" class="validation"></div>
<i id="check" class="fa-regular fa-circle-check check"></i>
<script type="module" src="Client/public/js/adminMessages.js"></script>