<?php
function n_pivots($pivots)
{
	$actualNumber = 2; # Empezamos desde el 2
	$scalingParameter = 5.828427; # Parametro de escalado. Cada numero pivote es
	# aproximadamente 5.8 veces mayor al anterior.
	$sumPrevious = 1; # Suma de numeros previos
	$sumPosterior = 0; # Suma de numeros posteriores
	$factor = 3; # Parametro correspondiente a la cantidad de sucesores a sumar.

	while ($pivots > 0){
		# Se calcula una suma estimada inicial de los sucesores del numero actual.
		$aux = (int)($actualNumber / $factor);
		$sumPosterior = ($actualNumber) * $aux + $aux * ($aux + 1) / 2;
		# Se siguen sumando sucesores hasta que la suma posterior sea mayor a la suma anterior.
		while ($sumPosterior < $sumPrevious){
			$aux += 1;
			$sumPosterior += $actualNumber + $aux;
		}
		# Se verifica si la suma posterior es igual a la suma anterior.
		if ($sumPosterior == $sumPrevious) {
			echo $actualNumber;
			$pivots -= 1;
			$factor = $actualNumber / $aux;
			$actualNumber = (int)($actualNumber * $scalingParameter);
			$sumPrevious = ($actualNumber - 1) * ($actualNumber)/2;
			echo "\n";
		}
		$sumPrevious += $actualNumber;
		$actualNumber += 1;
	}
}

n_pivots(100); # Se llama a la funcion para encontrar los primeros X numeros pivote.
?>