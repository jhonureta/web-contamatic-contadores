<?php


class EnvioMensaje{
    
    static public function env_renv_documento($data, $parametro, $url)
    {

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        $response = json_decode($response);

        curl_close($curl); //print_r($response);

        if ($response->status == 1) {
            $response->status = "true";
            return $response;
        } else {
            //retornar la respuesta una vez que ya supero los intentos 
            $response->status = "false";
            return $response;
        }

    }


    static public function enviarTextoUltraMSG($token, $telefono, $texto, $sender)
    {
        $telefono = substr($telefono, 3);
        error_log($telefono);
        $data = [
            'api_key' => $token,
            'sender' => $sender,
            'number' => '593' . $telefono,
            'message' => $texto,

        ];

        $url = "https://chat.contamatic.ec/send-message";
        $response = EnvioMensaje::env_renv_documento($data, 1, $url);

        return $response;
    }
    
    static public function enviodeMensajes($datos)
    {
        $telefono = $datos["telefono"];
        if (strlen($datos["telefono"]) == 10) {
            $telefono = substr($datos["telefono"], 1);
            $telefono = "593" . $telefono;
        }
        
        $token = "JcxECVt0CqxACEqrs0E4m4Rvz2jlkm";
        $sender = "593986785769";
        
        $texto = $datos["texto"];
        $response = EnvioMensaje::enviarTextoUltraMSG($token, $telefono, $texto, $sender);
        return $response;
    }
    
    
}