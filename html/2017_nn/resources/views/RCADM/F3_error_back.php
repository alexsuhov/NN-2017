<?php

$data = $_POST['data'];
$cutia = $_POST['cutie'];
$nume_output = "erori";
if ($data) {
	$nume_output .= "_data_{$data}";
}
if ($cutia) {
	$nume_output .= "_cutia_{$cutia}";
}
header('Content-type: text/plain');
/**/
header('Content-Disposition: attachment; filename="' . $nume_output . '.txt"');
/**/
$batch = '';
$erori = array();
$cutii = array();
$output = "";
if ($_FILES['file']['tmp_name']) {
	$fd = fopen($_FILES['file']['tmp_name'], "r");
	while ($linie = fgets($fd)) {
		if (!$data || strpos($linie,"[{$data}") === 0) {
			preg_match("/^\[[^\]]+\]: (.*)\r?$/", $linie, $matches);
			$mesaj = $matches[1];
			if (strpos($mesaj, "Incepe procesarea fisierului ") === 0) {
				$erori = array();
				$batch = trim(str_replace("Incepe procesarea fisierului ","",$mesaj), ".");
			} elseif (strpos($mesaj, "S-a incheiat procesarea fisierului ") === 0) {
				if (count($erori) === 0) {
					if (!$cutia)
						$output .= "{$batch} nu contine erori\r\n\r\n";
				} else {
					$output .= "{$batch} are urmatoarele erori\r\n";
					foreach ($erori as $tip => $es) {
						$output .= "  Tip {$tip}:\r\n";
						foreach ($es as $eroare) {
							$output .= "    {$eroare}\r\n";
						}
					}
					$output .= "\r\n";
				}
			} elseif (strpos($mesaj, "Eroare de tip 1") === 0) {
				preg_match('/^.*"([^"]*)"\)\r?$/', $mesaj, $matches);
				$cutie = $matches[1];
				if (!$cutia || $cutie == $cutia) {
					$cutii[$cutie] = $cutie;
					if (!isset($erori[1]))
						$erori[1] = array();
					$erori[1][] = preg_replace(array(
						"/^Eroare de tip 1: /", 
						"/ din fisierul '[^']*' nu se regaseste scanata in Documentum in nici unul din subfolderele lui '[^']*'\. /"
					), array('', ' - '), $mesaj);
				}
			} elseif (strpos($mesaj, "Eroare de tip 2") === 0) {
				preg_match('/^.*Numar cutie din CSV:(.*)\)\r?$/', $mesaj, $matches);
				$cutie = $matches[1];
				if (! $cutia || $cutie == $cutia) {
					$cutii[$cutie] = $cutie;
					if (!isset($erori[2]))
						$erori[2] = array();
					$erori[2][] = str_replace(array("Eroare de tip 2: "," in fisierul {$batch}"), array('',''), $mesaj);
				}
			} elseif (strpos($mesaj, "Eroare de tip 6") === 0) {
				preg_match('/^.*"([^"]*)"\)\r?$/', $mesaj, $matches);
				$cutie = $matches[1];
				if (!$cutia || $cutie == $cutia) {
					$cutii[$cutie] = $cutie;
					if (!isset($erori[6]))
						$erori[6] = array();
					$erori[6][] = preg_replace(array(
						"/^Eroare de tip 6: /", 
						"/ din fisierul '[^']*' nu se '[^']*'\. /"
					), array('', ' - '), $mesaj);
				}
}




		}
	}
	fclose($fd);
}
if (!$cutia)
	if (count($cutii))
		$titlu = "Raport erori din {$data} � Cutiile: " . implode(", ", $cutii);
	else
		$titlu = "Raport erori din {$data} � Nicio eroare";
else
	if (count($cutii))
		$titlu = "Raport erori din {$data} � Cutia: " . implode(", ", $cutii);
	else
		$titlu = "Raport erori din {$data} � Nu s-a gasit cutia";
$output = $titlu . "\r\n" . $output;
echo $output;
die();