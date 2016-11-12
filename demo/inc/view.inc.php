<div class="row">
    <form class="col s12" method="post" action="" enctype="multipart/form-data">
        <div class="row">
            <div class="file-field input-field col s12 file-1">
                <div class="btn">
                    <span>Fichier *</span>
                    <input type="file" class="input-file" name="file-name-1">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">label</i>
                <input id="icon_prefix" name="file-nomenclature[]" type="text" class="validate">
                <label for="icon_prefix">Nom du fichier 1</label>
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">swap_vert</i>
                <input id="icon_prefix" name="resize-height[]" type="text" class="validate">
                <label for="icon_prefix">Hauteur du fichier 1</label>
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">swap_horiz</i>
                <input id="icon_prefix" name="resize-width[]" type="text" class="validate">
                <label for="icon_prefix">Largeur du fichier 1</label>
            </div>

            <div class="input-field col s12 add-upload">
                <i class="material-icons prefix">note_add</i>
                <label>Ajouter un fichier</label>
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">info</i>
                <input id="icon_prefix" name="max-size" type="text" class="validate">
                <label for="icon_prefix">Taille du/des fichier(s) maximum (en Octets) [Par défaut : 1000000000 Octets]</label>
            </div>

            <div class="input-field col s12 checkbox-form">
                <p>Extensions autorisées [Par défaut : Toutes] : </p>
                <p>
                    <input type="checkbox" id="png" value="png" name="extension[]" />
                    <label for="png">PNG</label>

                    <input type="checkbox" id="jpg" value="jpg" name="extension[]" />
                    <label for="jpg">JPG/JPEG</label>

                    <input type="checkbox" id="gif" value="gof" name="extension[]" />
                    <label for="gif">GIF</label>

                    <input type="checkbox" id="pdf" value="pdf" name="extension[]" />
                    <label for="pdf">PDF</label>

                    <input type="checkbox" id="doc" value="doc" name="extension[]" />
                    <label for="doc">DOC</label>

                    <input type="checkbox" id="docx" value="docx" name="extension[]" />
                    <label for="docx">DOCX</label>

                    <input type="checkbox" id="ppt" value="ppt" name="extension[]" />
                    <label for="ppt">PPT</label>

                    <input type="checkbox" id="pptx" value="pptx" name="extension[]" />
                    <label for="pptx">PPTX</label>

                    <input type="checkbox" id="xls" value="xls" name="extension[]" />
                    <label for="xls">XLS</label>

                    <input type="checkbox" id="xlsx" value="xlsx" name="extension[]" />
                    <label for="xlsx">XLS</label>
                </p>
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">work</i>
                <input id="icon_prefix" name="path-upload" type="text" class="validate">
                <label for="icon_prefix">Chemin [Par défaut : fu_uploads/]</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light send-form" type="submit">Tester
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>
