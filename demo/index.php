<?php

if(!empty($_FILES)){
    if(isset($_FILES["file-name-1"]) && $_FILES["file-name-1"]["error"] != 4) {

        require_once "../class/FileUploader.php";

        function define_args($post) {

            $args = [];

            if (isset($post["max-size"]) && !empty($post["max-size"])) {
                $args["maxSize"] = $post["max-size"];
            }

            if (isset($post["path-upload"]) && !empty($post["path-upload"])) {
                $args["contentDir"] = "fu_uploads/". $post["path-upload"];
            }
            else if (!isset($post["path-upload"]) || empty($post["path-upload"])) {
                $args["contentDir"] = "fu_uploads/";
            }

            if (isset($post["extension"]) && !empty($post["extension"])) {
                $args["allowedExts"] = $post["extension"];
            }

            if (isset($post["resize-width"]) && !empty($post["resize-width"])) {
                $args["width"] = $post["resize-width"];
            }

            if (isset($post["resize-height"]) && !empty($post["resize-height"])) {
                $args["height"] = $post["resize-height"];
            }

            if (isset($post["file-nomenclature"]) && !empty($post["file-nomenclature"])) {
                $args["fileName"] = $post["file-nomenclature"];
            }
            return $args;
        }

        $error = "";
        $path = "";

        foreach ($_FILES as $key => $value) {

            if ($value["name"] == 0) {

                $args = define_args($_POST);
                $explode = explode("-", $key);
                $id = $explode[2];

                foreach ($args["fileName"] as $keyName => $valName) {

                    if ($keyName == $id - 1) {

                        $args["fileName"] = $valName;
                    }
                }

                foreach ($args["height"] as $keyHeight => $valHeight) {

                    if ($keyHeight == $id - 1) {

                        $args["height"] = $valHeight;
                    }
                }
                foreach ($args["width"] as $keyWidth => $valWidth) {

                    if ($keyWidth == $id - 1) {

                        $args["width"] = $valWidth;
                    }
                }
        
                try{
                    $fu = new FileUploader($value, $args);
                    $fu->upload();
                    $path .= $fu->getPath() . "-sepeartion-";
                }catch(Exception $e){
                    $error.= " " . $e->getMessage(). " <br/> ";
                }
            }
        }

        if(!empty($error)){
            header("Location: ./?upload=error&message=".$error);
            exit();
        }else{
            header("Location: ./?upload=success&urls=".$path);
            exit();
        }

    }else{
        header("Location: ./?upload=error");
        exit();
    }
}else{

    require_once "inc/header.inc.php";
    require_once "inc/view.inc.php";
    require_once "inc/footer.inc.php";
}