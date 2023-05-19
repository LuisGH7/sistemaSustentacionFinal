<page>
    <page_header>
        <table class="mt-1 bc">
            <colgroup>
            <col class="tc w-15">
            <col class="w-60" >
            <col class="w-25">
            </colgroup>
            <tbody>
                <tr>
                    <td><img class='ml-5 w-130px' src='../images/descarga.jpeg'></td>
                    <td>
                    <h1 class="tc mt-100">HISTORIA CLÍNICA</h1>
                    <p class="tc">Tipo de atención: Ambulatoria</p>
                    </td>
                    <td>
                        <?php
                            foreach($clave as $valor){
                                echo "<span class='fs-15'> <b>Código H.C: {$valor->nrohistoria}</b> </span>";
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="mt-2 bc">
            <colgroup>
                <col class="w-20">
                <col class="w-25">
                <col class="w-20">
                <col class="w-25">
                <col class="w-10">
            </colgroup>
            <tbody>
                <tr>
                <td><b>Fecha de ingreso:</b></td>
                <td>                        
                    <?php
                        foreach($clave as $valor){
                            echo "{$valor->fecha}";
                        }
                    ?>
                </td>
                <td><b>Hora de ingreso:</b></td>
                <td>
                    <?php
                        foreach($clave as $valor){
                            echo "{$valor->hora}";
                        }
                    ?>                  
                </td>
                </tr>
            </tbody>
        </table>
    </page_header>
    
    <!-- cuerpo de la página -->
    <div class="mb-180"></div>
    <table class='historia bc mt-2'>
        
        <colgroup>
            <col style = 'width=11%;'>
            <col style = 'width=11%;'>
            <col style = 'width=11%;'>
            <col style = 'width=11%;'>
            <col style = 'width=11%;'>
            <col style = 'width=11%;'>
            <col style = 'width=11%;'>
            <col style = 'width=11%;'>
            <col style = 'width=12%;'>
        </colgroup>

        <tr class="tc">
            <?php
                foreach($clave as $valor){
                    echo "
                        <td colspan='3' class='historia'> {$valor->primerapellido} </td>
                        <td colspan='3' class='historia'> {$valor->segundoapellido}</td>
                        <td colspan='3' class='historia'> {$valor->nombres}</td> 
                    ";
                }
            ?>
        </tr>
        <tr class="tc">
            <td colspan='3' class='historia'><b>Apellido Paterno</b></td>
            <td colspan='3' class='historia'><b>Apellido Materno</b></td>
            <td colspan='3' class='historia'><b>Nombres</b></td>
        </tr>
        <tr>
            <td colspan='3' class='historia'><b>Dirección</b></td>
            <td colspan='2' class='historia'><b>Distrito</b></td>
            <td colspan='2' class='historia'><b>Provincia</b></td>
            <td colspan='2' class='historia'><b>Departamento</b></td>
        </tr>
        <tr>
            <?php
                foreach($clave as $valor){
                    echo "
                        <td colspan='3' class='historia'>{$valor->direccion}</td>
                        <td colspan='2' class='historia'>{$valor->distrito}</td>
                        <td colspan='2' class='historia'>{$valor->prov}</td>
                        <td colspan='2' class='historia'>{$valor->dpto}</td>
                    ";
                }
            ?>
        </tr>
        <tr class="tc">
            <td colspan='2' class='historia'><b>Edad</b></td>
            <td colspan='2'  class='historia'><b>Sexo</b></td>
            <td colspan='3'  class='historia'><b>Estado Civil</b></td>
            <td colspan='2' class='historia'><b>Nº DNI</b></td>
        </tr>
        <tr class="tc">
            <?php
                foreach($clave as $valor){
                    echo "
                        <td colspan='2' class='historia'>{$valor->edad}</td>
                        <td colspan='2' class='historia'>{$valor->sexo}</td>
                        <td colspan='3' class='historia'>{$valor->estadocivil}</td>
                        <td colspan='2' class='historia'>{$valor->nrodocumento}</td>
                    ";
                }
            ?>
        </tr>
        <tr>
            <td colspan='3' class='historia'><b>Seguro</b></td>
            <td colspan='3' class='historia'><b>Alergico a:</b></td>
            <td colspan='3' class='historia'><b>Teléfono/Celular:</b></td>
        </tr>
        <tr>
            <?php
                foreach($clave as $valor){
                    echo "
                        <td colspan='3' class='historia'>{$valor->motivo}</td>
                        <td colspan='3' class='historia'>{$valor->alergias}</td>
                        <td colspan='3' class='historia'>{$valor->telefono}</td>
                    ";
                }
            ?>
        </tr>
    </table>

    <h5 class="mt-3">FUNCIONES VITALES:</h5>
    <table class="mt-5 mb-4 bc">
    <colgroup>
        <col class="w-18">
        <col class="w-15">
        <col class="w-15">
        <col class="w-16">
        <col class="w-17">
        <col class="w-19">
    </colgroup>
    <tbody>
        <tr>
            <?php
                foreach($clave as $valor){
                    echo "
                        <td>P.A {$valor->presionarterial} mnhg</td>
                        <td>P {$valor->pulso}X</td>
                        <td>Tº {$valor->temperatura}Cº</td>
                        <td>F.R {$valor->frecuenciarespiratoria}X</td>
                        <td>Peso {$valor->peso}Kg</td>
                        <td>Talla {$valor->talla}cm</td>
                    ";
                }
            ?>
        </tr>
    </tbody>
    </table>

    <h5>Exámen Clínico:</h5>
    <table class=' bc mt-1 mb-2'>
        <colgroup>
            <col class="w-100">
        </colgroup>
        <tbody>
            <tr>
                <td class="info">
                    <?php
                        foreach($clave as $valor){
                            echo "
                                <p>$valor->examenclinico</p>
                            ";
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    
    <h5>Diagnóstico:</h5>
    <table class=' bc mt-1 mb-2'>
        <colgroup>
            <col class="w-100">
        </colgroup>
        <tbody>
            <tr>
                <td class="info">
                    <?php
                        foreach($clave as $valor){
                            echo "
                                <p>$valor->diagnostico</p>
                            ";
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h5>Tratamiento:</h5>
    <table class='bc mt-1 mb-2'>
        <colgroup>
            <col class="w-100">
        </colgroup>
        <tbody>
            <tr>
                <td class="info">
                    <?php
                        foreach($clave as $valor){
                            echo "
                                <p>$valor->tratamiento</p>
                            ";
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

</page>