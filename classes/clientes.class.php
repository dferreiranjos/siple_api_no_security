<?php

if($api == 'clientes'){
    // GET
    if($method == 'GET'){
        if($acao == ''){ echo json_encode(['ERRO' => 'Caminho não encontrado!']); exit;}
        if($acao == 'lista' && $param == ''){
            $db = DB::connect();
            $rs = $db->prepare("SELECT * FROM clientes ORDER BY nome");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);
        
            if ($obj) {
                echo json_encode(["dados" => $obj]);
            } else {
                echo json_encode(["dados" => 'Não existem dados para retornar']);
            }
        }

        if($acao == 'lista' && $param != ''){
            $db = DB::connect();
            $rs = $db->prepare("SELECT * FROM clientes WHERE id = {$param} ORDER BY nome");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);
        
            if ($obj) {
                echo json_encode(["dados" => $obj]);
            } else {
                echo json_encode(["dados" => 'Não existem dados para retornar']);
            }
        }
    }


    // POST
    if($method == 'POST'){
        if($acao == ''){ echo json_encode(['ERRO' => 'Caminho não encontrado!']); exit;}
        if($acao == 'adiciona' && $param == ''){
            
            $sql = 'INSERT INTO clientes(';

            foreach(array_keys($_POST) as $key){
                $sql .= "{$key},";
            }
            $sql = substr($sql, 0, -1);
            $sql .= ') VALUES(';

            foreach(array_values($_POST) as $values){
                $sql .= "'$values',";
            }
            $sql = substr($sql, 0, -1);
            $sql .= ');';

            $db = DB::connect();
            $rs = $db->prepare($sql);
            $exec = $rs->execute();
           
            if ($exec) {
                echo json_encode(["dados" => 'Os dados foram inseridos com sucesso!']);
            } else {
                echo json_encode(["dados" => 'Erro ao inserir os dados.']);
            }
        }
    }

    // PUT
    if($method == 'POST' && $_POST['_method'] == 'PUT'){
        if($acao == ''){ echo json_encode(['ERRO' => 'Caminho não encontrado!']); exit;}
        if($acao == 'update' && $param == ''){
            echo json_encode(['ERRO' => 'Informe o cliente que você deseja atualizar']);
            exit;
        }

        if($acao == 'update' && $param != ''){
            
            array_shift($_POST);

            $sql = 'UPDATE clientes SET ';
            
            foreach(array_keys($_POST) as $keys){
                $sql .= "$keys = '$_POST[$keys]', ";
            }

            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id = {$param}";

            // var_dump($sql);

            $db = DB::connect();
            $rs = $db->prepare($sql);
            $exec = $rs->execute();
           
            if ($exec) {
                echo json_encode(["dados" => 'O Registro foi atualizado com sucesso!']);
            } else {
                echo json_encode(["dados" => 'Erro ao tentar atualizar os dados.']);
            }
        }
    }

    // DELETE
    if($method == 'POST' && $_POST['_method'] == 'DELETE'){
        if($acao == ''){ echo json_encode(['ERRO' => 'Caminho não encontrado!']); exit;}
        if($acao == 'delete' && $param == ''){
            echo json_encode(['ERRO' => 'Informe o cliente que você deseja atualizar']);
            exit;
        }

        if($acao == 'delete' && $param != ''){
            

            $db = DB::connect();
            $rs = $db->prepare("DELETE FROM clientes WHERE id = {$param}");
            $exec = $rs->execute();
           
            if ($exec) {
                echo json_encode(["dados" => 'O Registro foi excluído com sucesso!']);
            } else {
                echo json_encode(["dados" => 'Erro ao tentar excluir os dados.']);
            }

            
        }
    }
}

