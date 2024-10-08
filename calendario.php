<?php
// Definindo os feriados de 2024
$feriados = [
    "01-01" => "Confraternização Universal",
    "12-02" => "Carnaval",
    "13-02" => "Carnaval",
    "29-03" => "Sexta-feira Santa",
    "21-04" => "Tiradentes",
    "01-05" => "Dia do Trabalho",
    "08-06" => "Corpus Christi",
    "07-09" => "Independência do Brasil",
    "12-10" => "Nossa Senhora Aparecida",
    "02-11" => "Finados",
    "15-11" => "Proclamação da República",
    "25-12" => "Natal"
];

// Função para gerar o calendário
function gerarCalendario($ano) {
    global $feriados;
    
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th colspan='7'>$ano</th></tr>";
    echo "<tr>
            <th>Dom</th>
            <th>Seg</th>
            <th>Ter</th>
            <th>Qua</th>
            <th>Qui</th>
            <th>Sex</th>
            <th>Sab</th>
          </tr>";
    
    // Primeiro dia do ano e dia da semana
    $primeiroDia = strtotime("$ano-01-01");
    $diaDaSemana = date('w', $primeiroDia);
    
    // Preenchendo os espaços vazios antes do primeiro dia
    echo "<tr>";
    for ($i = 0; $i < $diaDaSemana; $i++) {
        echo "<td></td>";
    }

    // Loop para cada dia do ano
    for ($dia = 1; $dia <= 366; $dia++) {
        $data = strtotime("$ano-$dia");
        if (date('Y', $data) != $ano) continue; // Ignora dias do próximo ano
        
        $dataFormatada = date('d-m', $data);
        $feriado = isset($feriados[$dataFormatada]) ? $feriados[$dataFormatada] : "";

        echo "<td" . ($feriado ? " style='background-color: yellow;'" : "") . ">";
        echo $dia . ($feriado ? "<br><small>$feriado</small>" : "") . "</td>";
        
        // Quebra de linha após sábado
        if (date('w', $data) == 6) {
            echo "</tr><tr>";
        }
    }

    // Preenchendo os espaços vazios após o último dia
    while (date('w', strtotime("$ano-$dia")) != 0) {
        echo "<td></td>";
        $dia++;
    }
    
    echo "</tr></table>";
}

// Chama a função para gerar o calendário de 2024
gerarCalendario(2024);
?>
