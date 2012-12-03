<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_controller
 *
 * @author wilmerarteaga
 */
Load::models('proveedores', 'contratos', 'Actividad_Has_Proveedores', 'contra');
View::template('admin/admin');

class AdminController extends ApplicationController {

    public function index() {
        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }
    }

    //*** Contratos ***//

    public function contratos() {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        $obj = new Contratos();
        $this->contratos = array();
        $this->contratos = $obj->find();
    }

    public function nuevocontrato($idpro) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idpro);
        if (Input::hasPost('contratos')) {
            $contrato = new Contratos(Input::post("contratos"));
            if ($contrato->save()) {
                Flash::success("Creado correctamente");
                Router::redirect("admin/ponderacion/" . $this->proveedor->id);
            }
        }
    }

    public function editarcontrato($idcontrato) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        $this->objContrato = new Contratos();
        $this->objContrato->find_first($idcontrato);

        if (Input::hasPost("contratos")) {
            $contrato = new Contratos(Input::post("contratos"));
            $contrato->id = Input::post("idcontrato");
            if ($contrato->update()) {
                $this->objContrato = new Contratos();
                $this->objContrato->find_first($idcontrato);
                Flash::success("Modificación exitosa");
            } else {
                Flash::error("No se puede actualizar..");
            }
        }
    }

    public function eliminarcontrato($idcontrato) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        $this->objContrato = new Contratos();
        $this->objContrato->find_first($idcontrato);

        if (Input::hasPost("contratos")) {
            $contrato = new Contratos();
            $contrato->find_first($idcontrato);
            if ($contrato->delete()) {
                $this->redirect("admin/contratos");
            } else {
                Flash::error("No se pudo eliminar.");
            }
        }
    }

    //*** Proveedores ***//

    function proveedores($pagina = 1) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        try {
            $pro = new Proveedores();
            $this->proveedores = $pro->paginar($pagina);

            if (Input::hasPost("actividad")) {
                $in = Input::post("actividad");
                $idactividad = $in["actividad_id"];

                $ac = new ActividadHasProveedores();
                $arr = array();
                $arr = $ac->find("actividad_id=$idactividad");

                $this->proveedores = array();
                $i = 0;
                foreach ($arr as $obj) {
                    $prov = new Proveedores();
                    $x = $prov->find_first($obj->proveedores_id);
                    $this->proveedores[$i] = $x;
                    $i++;
                }
            }

            if (Input::hasPost("textoBusqueda")) {
                $comboBusqueda = Input::post("comboBusqueda");
                $textoBusqueda = Input::post("textoBusqueda");

                $obj = new Proveedores();
                $this->proveedores = array();

                if ($textoBusqueda != "") {

                    //IDENTIFICACION
                    if ($comboBusqueda == 0 && $textoBusqueda > 0) {
                        $this->proveedores = $obj->find("identificacion=$textoBusqueda");
                    }//APELLIDO
                    else if ($comboBusqueda == 1) {
                        $this->proveedores = $obj->find("apellidos like'%$textoBusqueda%'");
                    } else if ($comboBusqueda == 2) {
                        $this->proveedores = $obj->find("razonsocial like'%$textoBusqueda%'");
                    }
                } else {
                    Flash::success("Escriba texto de búsqueda");
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function nuevoproveedor() {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        Load::model('proveedores');
        View::template("admin/admin");


        Load::model("proveedores");
        if (Input::hasPost("proveedores")) {


            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");

            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->tipo_identificacion_id = $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id = $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = $tpr["tipo_proveedor_id"];
            $proveedor->tipousuario_id = "2";

            if ($proveedor->save()) {
                Flash::success("Creando correctamente");
                Router::redirect("admin/proveedores");
            }
        }
    }

    public function editarproveedor($idproveedor) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        Load::model("proveedores");

        View::template('admin/admin');

        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idproveedor);

        if (Input::hasPost("proveedores")) {

            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");

            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->id = Input::post("idproveedor");
            $proveedor->tipo_identificacion_id = $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id = $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = $tpr["tipo_proveedor_id"];


            if ($proveedor->update()) {
                Flash::success("Actualizado correctamente");
                Router::redirect("admin/proveedores/");
            }
        }
    }

    public function eliminarproveedor($idproveedor) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        $prov = new Proveedores();
        $ap = new ActividadHasProveedores();
        $cont = new Contratos();

        if ($cont->count("proveedores_id=$idproveedor") == 0) {
            if ($ap->delete("proveedores_id=$idproveedor")) {

                if ($prov->delete($idproveedor)) {
                    Flash::success("Eliminado correctamente");
                    Router::redirect("admin/proveedores/");
                } else {
                    Flash::success("No se pudo eliminar");
                }
            }
        } else {
            Flash::notice("Tiene contratos relacionados imposible eliminar");
            Router::redirect("admin/proveedores");
        }
    }

    function actividades($idproveedor) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        View::template("admin/admin");
        Load::model("actividad_has_proveedores");

        $ap = new ActividadHasProveedores();
        $this->actividades = array();
        $this->actividades = $ap->find("proveedores_id=$idproveedor");
        $this->idproveedor = $idproveedor;

        if (Input::hasPost("actividad")) {
            $in = Input::post("actividad");
            $idactividad = $in["actividad_id"];
            $idproveedor = Input::post("idproveedor");

            $ap = new ActividadHasProveedores();

            if ($ap->count("actividad_id=$idactividad and proveedores_id=$idproveedor") == 0) {
                $ap->actividad_id = $idactividad;
                $ap->proveedores_id = $idproveedor;
                if ($ap->save()) {
                    Flash::success("Actividad agregada correctamente");
                    Router::redirect("admin/actividades/$idproveedor");
                } else {
                    Flash::error("Error agregando actividad");
                }
            } else {
                Flash::error("La actividad seleccionada ya existe");
            }
        }
    }

    function eliminaractividad($idactividad, $idproveedor) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        View::template("admin/admin");

        $ap = new ActividadHasProveedores();
        $ap->find_first($idactividad);

        if ($ap->delete()) {
            Flash::success("Se eliminó la actividad correctamente");
            Router::redirect("admin/actividades/$idproveedor");
        } else {
            Flash::error("Se eliminó la actividad correctamente");
            Router::redirect("asistente/actividade/$idproveedor");
        }
    }

    public function ponderacion($idproveedor, $pagina = 1) {

        if (!Auth::is_valid()) {
            $this->redirect("sesion/index");
        }

        //campos del proveedor
        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idproveedor);

        //listamos los contratos del proveedor
        $idpro = $this->proveedor->id;
        $obj = new Contra();
        $this->contratos = array();
        $this->contratos2 = $obj->find("proveedores_id=$idpro");
        $this->contratos = $obj->paginar($pagina, $idpro);
    }

    function reportepdf1() {

        View::response("view");
        Load::lib("fpdf/fpdf");


        if (Input::hasPost("id")) {

            $this->matriz = Input::post("id");

            foreach (Input::post("id") as $puesto => $val) {
                
            }
        } else {
            Flash::error("No seleccionó ningún proveedor");
            Router::redirect("admin/proveedores");
        }
    }

    function borrar() {
        Load::models("Antiguoactividad", "Actividad");
        $array = array();
        $act = new Antiguoactividad();
        $array = $act->find();


        foreach ($array as $obj) {
            $prov = new Proveedores();

            if ($prov->count("identificacion=$obj->identificacion") > 0) {
                $prov->find_first("identificacion=$obj->identificacion");
                $ac = new Actividad();

                if ($ac->count("codigo = $obj->codigo") > 0) {

                    $ac->find_first("codigo = $obj->codigo");
                    $ap = new ActividadHasProveedores();

                    Flash::notice($ac->id . "-" . $prov->id);

                    $ap->actividad_id = $ac->id;
                    $ap->proveedores_id = $prov->id;
                    $ap->save();
                } else {
                    Flash::notice("codigono encontrado" . $obj->codigo);
                }
            } else {
                Flash::notice("prveedor no encontrado" . $obj->identificacion);
            }
        }
    }

    //SUBIDA DE PLANOS
    public function subirplano() {
        Load::lib('Excel/reader');
        View::select('subirplano');  //para mostrar siempre la vista con los formularios
        if (Input::hasPost('oculto')) {  //para saber si se envió el form
            $archivo = Upload::factory('archivo'); //llamamos a la libreria y le pasamos el nombre del campo file del formulario

            $archivo->setExtensions(array('xls')); //le asignamos las extensiones a permitir
            if ($archivo->isUploaded()) {
                $archivo->overwrite(true);
                if ($archivo->save('prueba')) {
                    $new_name = "prueba.xls";
                    $dir = KILLER_PATH . "files/upload";
                    $reader = new Spreadsheet_Excel_Reader();
                    $reader->setUTFEncoder('UTF-8');
                    $reader->setOutputEncoding('UTF-8');
                    $reader->read("$dir/$new_name");
                    $i = 1;
                    foreach ($reader->sheets as $k => $data) {

                        foreach ($data['cells'] as $row) {
                            foreach ($row as $cell) {
                                //echo "$cell\t";
                            }
                            //echo "\n";
                            $originalDate = $reader->sheets[0]['cells'][$i][7];
                            $newDate = date("Y-m-d", strtotime($originalDate));
                            $originalDate2 = $reader->sheets[0]['cells'][$i][8];
                            $newDate2 = date("Y-m-d", strtotime($originalDate2));
                            $array_usuarios[] = array(
                                'numero' => $reader->sheets[0]['cells'][$i][1],
                                'objeto' => $reader->sheets[0]['cells'][$i][2],
                                'valorini' => $reader->sheets[0]['cells'][$i][3],
                                'fechaini' => $newDate,
                                'fechafinal' => $newDate2,
                                'puntaje' => $reader->sheets[0]['cells'][$i][9],
                                'proveedores_id' => $reader->sheets[0]['cells'][$i][4],
                                'vigencia' => $reader->sheets[0]['cells'][$i][6]
                            );
                            $i++;
                        }
                    }

                    $tamano = count($array_usuarios);
                    //$this->sql('BEGIN');
                    ?>
                    <table>
                        <tr>
                            <th>NUMERO</th>
                            <th>OBJETO</th>
                            <th>VALOR INI</th>
                            <th>FECHA  INI</th>
                            <th>FECHA FINAL</th>
                            <th>PUNTAJE</th>
                            <th>ID PRO</th>
                            <th>VIGENCIA</th>
                        </tr><?
                    for ($i = 0; $i < $tamano; $i++) {
                        $miContrato = new Contratos();
                        $miProveedor = new Proveedores();
                        $miContrato->numero = $array_usuarios[$i]['numero'];
                        $miContrato->objeto = $array_usuarios[$i]['objeto'];
                        $miContrato->valorini = $array_usuarios[$i]['valorini'];
                        $miContrato->fechaini = $array_usuarios[$i]['fechaini'];
                        $miContrato->fechafinal = $array_usuarios[$i]['fechafinal'];
                        $miContrato->puntaje = $array_usuarios[$i]['puntaje'];
                        $miContrato->proveedores_id = $array_usuarios[$i]['proveedores_id'];
                        $miContrato->vigencia = $array_usuarios[$i]['vigencia'];

                        if ($miProveedor->count("identificacion=$miContrato->proveedores_id")) {//si exixte el proveedor
                            $miContrato->proveedores_id = $miProveedor->find_first("identificacion=$miContrato->proveedores_id")->id;
                            $array_usuarios[$i]['proveedores_id'] = $miContrato->proveedores_id;
                            if ($miContrato->count("numero=$miContrato->numero") == 0) {//si el contrato aun no existe
                                if ($miContrato->save()) {
                                    Flash::success("Exito. ". $miContrato->numero . "  " . $miContrato->proveedores_id);
                                } else {
                                    Flash::error("Error. ". $miContrato->numero . "  " . $miContrato->proveedores_id);
                                }
                            } else {
                                Flash::info("No agregar " . $miContrato->numero . "  " . $miContrato->proveedores_id);
                            }
                        }
                        ?>
                            <tr>
                                <td><?php echo $array_usuarios[$i]['numero'] ?></td>
                                <td><?php echo $array_usuarios[$i]['objeto'] ?></td>
                                <td><?php echo $array_usuarios[$i]['valorini'] ?></td>
                                <td><?php echo $array_usuarios[$i]['fechaini'] ?></td>
                                <td><?php echo $array_usuarios[$i]['fechafinal'] ?></td>
                                <td><?php echo $array_usuarios[$i]['puntaje'] ?></td>
                                <td><?php echo $array_usuarios[$i]['proveedores_id'] ?></td>
                                <td><?php echo $array_usuarios[$i]['vigencia'] ?></td>
                            </tr><? }
                    ?>
                    </table>
                    <?php
                    //$this->sql('COMMIT');

                    Flash::valid('Archivo subido correctamente...!!!');
                }
            } else {
                Flash::warning('No se ha Podido Subir el Archivo...!!!');
            }
        }
    }
}
?>
