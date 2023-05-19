<page>
    <page_header>
        <table class="w-100 mt-1 bc">
            <colgroup>
            <col class="tc w-15">
            <col class="w-60" >
            <col class="w-25">
            </colgroup>
            <tbody>
                <tr>
                    <td><img class='ml-5 w-130px' src='../images/logo.png'></td>
                    <td>
                    <h1 class="tc mt-100">HISTORIA CLÍNICA</h1>
                    <p class="tc">Tipo de atención: Ambulatoria</p>
                    </td>
                    <td>
                    <span class="fs-15">
                        <b>
                            <?php
                                foreach($clave as $valor){
                                    echo "<span class='fs-15'> <b>Código H.C: {$valor->nrohistoria}</b> </span>";
                                }
                            ?>
                        </b>
                    </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="w-100 mt-2 bc">
            <colgroup>
                <col class="w-16">
                <col class="w-16">
                <col class="w-16">
                <col class="w-16">
                <col class="w-17">
                <col class="w-19">
                </colgroup>
            <tbody>
                <tr>
                <td><b>Fecha:</b></td>
                <td>
                    <?php
                        foreach($clave as $valor){
                            echo "{$valor->fecha}";
                        }
                    ?>
                </td>
                <td><b>Hora Ingreso:</b></td>
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
    <h5 class="mt-3">FUNCIONES VITALES:</h5>
    <table class="mt-5 bc  mb-3">
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
                            <td>P {$valor->pulso}  X</td>
                            <td>Tº {$valor->temperatura}  Cº</td>
                            <td>F.R {$valor->frecuenciarespiratoria}  X</td>
                            <td>Peso {$valor->peso}  Kg</td>
                            <td>Talla {$valor->talla} cm</td>
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
            <td class="info mt-1">
                <?php
                    foreach($clave as $valor){
                        echo "{$valor->examenclinico}";
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
                <td class="info mt-1">
                    <?php
                        foreach($clave as $valor){
                            echo "{$valor->diagnostico}";
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

    <h5>Tratamiento:</h5>
    <table class='bc mt-1 mb-1'>
        <colgroup>
            <col class="w-100">
        </colgroup>
        <tbody>
            <tr>
                <td class="info mt-1">
                    <?php
                        foreach($clave as $valor){
                            echo "{$valor->tratamiento}";
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- <table class='bc mb-1'>
        <colgroup>
        <col style = 'width=10%;'>
        <col style = 'width=16%;'>
        <col style = 'width=19%;'>
        <col style = 'width=18%;'>
        <col style = 'width=15%;'>
        <col style = 'width=22%;'>
        </colgroup>
        <tbody>
        <tr>
            <td></td>
            <td><b>Próxima Cita</b></td>
            <td><b>Fecha:</b> 28/09/2022</td>
            <td><b>Hora: </b> 08:47:00 am</td>
            <td></td>
        </tr>
        </tbody>
    </table> -->

    <table class='bc mt-3'>
            <colgroup>
            <col class="w-40">
            <col class='w-10'>
            <col class="w-20">
            <col class="w-30">
            </colgroup>
            <tbody>
            <tr>
                <td><b> Generado por:</b></td>
                <td></td>
                <td class="bordeg"></td>
                <td class="generado"><b>MÉDICO TRATANTE</b></td>
            </tr>
            <tr>
                <td>
                    <b>
                        <?php
                            foreach($clave as $valor){
                                echo "{$valor->usuariogenerador}";
                            }
                        ?>
                    </b>
                </td>
                <td></td>
                <td class="bordeg"></td>
                <td class="generado"><b>
                    <?php
                            foreach($clave as $valor){
                                echo "{$valor->medico}";
                            }
                        ?>
                </b></td>
            </tr>
            </tbody>
        </table>
    <!--  fin del cuerpo de la página -->

    
</page>
