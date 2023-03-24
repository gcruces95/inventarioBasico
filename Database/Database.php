<?php

    $consulta_addproduct = "SELECT procesador.id, marca.nombre as marca, modelo.nombre as modelo, procesador.nombre as procesador
                    FROM procesador
                    INNER JOIN marca ON marca.id = procesador.marca_id
                    INNER JOIN modelo ON modelo.id = procesador.modelo_id
                    ORDER BY marca.nombre ASC, modelo.nombre ASC, procesador.nombre ASC";

    $consulta_addregistro = "SELECT product.id, product.nombre, marca.nombre as marca, modelo.nombre as modelo, procesador.nombre as procesador,
                    direccion.nombre as direccion, departamento.nombre as departamento, product.usuario, product.ubicacion
                    FROM product
                    INNER JOIN marca ON marca.id = product.marca
                    INNER JOIN modelo ON modelo.id = product.modelo
                    INNER JOIN procesador ON procesador.id = product.procesador
                    INNER JOIN direccion ON direccion.id = product.direccion
                    INNER JOIN departamento ON departamento.id = product.departamento"
    
?>