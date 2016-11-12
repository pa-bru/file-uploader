var count = 2;
$('.add-upload').click(function() {
    if (count < 20) {// 0 <= count < 20
        box = '<div class="file-field input-field col s12 file-'+count+'">';

        box = box + '<div class="btn">';

        box = box + '<span>Fichier *</span>';

        box = box + '<input class="input-file" name="file-name-'+count+'" type="file"/>';

        box = box + '</div>';

        box = box + '<div class="file-path-wrapper">';

        box = box + '<input class="file-path validate" type="text">';

        box = box + '</div>';

        box = box + '</div>';

        box = box + '<div class="input-field col s12">';

        box = box + '<i class="material-icons prefix">label</i>';

        box = box + '<input name="file-nomenclature[]" class="validate" type="text"/>';

        box = box + '<label for="icon_prefix">Nom du fichier '+count+'</label>';

        box = box + '</div>';

        box = box + '<div class="input-field col s12">';

        box = box + '<i class="material-icons prefix">swap_vert</i>';

        box = box + '<input id="icon_prefix" name="resize-height[]" type="text" class="validate">';

        box = box + '<label for="icon_prefix">Hauteur du fichier '+count+'</label>';

        box = box + '</div>';

        box = box + '<div class="input-field col s12">';

        box = box + '<i class="material-icons prefix">swap_horiz</i>';

        box = box + '<input id="icon_prefix" name="resize-width[]" type="text" class="validate">';

        box = box + '<label for="icon_prefix">Largeur du fichier '+count+'</label>';

        box = box + '</div>';

        $('.add-upload').before(box);
        count++;
    }
});