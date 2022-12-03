<!DOCTYPE html>
<!-- Ejercio 3 -->
<!-- Haz una página web que muestre la fecha actual en castellano, 
incluyendo el día de la semana, con un formato similar al siguiente: 
"Miércoles, 13 de Abril de 2011". 
Utiliza la función predefinida date()-->
<html>
  
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /** 
         * formatear fecha
         */
        // inicializar variables de fecha
        $dayOfWeek = date("w"); // 0-6 dom-sab
        $dayOfMonth = date("d"); // 1 -12 
        $month = date("m");
        $year = date("Y");
        
        //// dia de la semana en letra
        $diasemana = date('N');
        
        $arrayDayOfWeek = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
        $arraydiasemana = ['Monday' => 'Lunes',
                        'Tuesday' => 'Martes',
                        'Wednesday' => 'Miércoles',
                        'Thursday' => 'Jueves',
                        'Friday' => 'Viernes',
                        'Saturday' => 'Sábado',
                        'Sunday' => 'Domingo'];
        
        
        // dar formato en castellano al mes
        switch ($month) {
            case 1:
                $month = 'Enero';
                break;
            case 2:
                $month = 'Febrero';
                break;
            case 3:
                $month = 'Marzo';
                break;
            case 4:
                $month = 'Abril';
                break;
            case 5:
                $month = 'Mayo';
                break;
            case 6:
                $month = 'Junio';
                break;
            case 7:
                $month = 'Julio';
                break;
            case 8:
                $month = 'Agosto';
                break;
            case 9:
                $month = 'Septiembre';
                break;
            case 10:
                $month = 'Octubre';
                break;
            case 11:
                $month = 'Noviembre';
                break;
            case 12:
                $month = 'Diciembre';
                break;
            default:
                $month = 'Mes no definido';
                break; 
        }
        
        // dar formato en castellano al día de la semana
        switch ($dayOfWeek){
            case 1:
                $dayOfWeek = 'Lunes';
                break;
            case 2:
                $dayOfWeek = 'Martes';
                break;
            case 3:
                $dayOfWeek = 'Miércoles';
                break;
            case 4:
                $dayOfWeek = 'Jueves';
                break;
            case 5:
                $dayOfWeek = 'Viernes';
                break;
            case 6:
                $dayOfWeek = 'Sábado';
                break;
            case 0:
                $dayOfWeek = 'Domingo';
                break;
            default:
                $dayOfWeek = 'Día no definido';
                break; 
        }
        
        $msg.=$arrayDayOfWeek[$diasemana].", ";
        $msg.=$dayOfMonth." de ";
        $msg.=$month." de ";
        $msg.=$year;
        ?>
        <p>$msg</p>
        <p>Hoy es <?=$dayOfWeek?>, <?=$dayOfMonth?> de <?=$month?> de <?= $year ?></p>
    </body>
</html>
