<?php
function n_pivots($pivots)
{
	$actualNumber = 2; # First number to try
	$scalingParameter = 5.828427; # Scaling parameter. Each pivot number is
	# approximately 5.8 times larger than the previous one.
	$sumPrevious = 1; # Sum of all previous numbers.
	$sumPosterior = 0; # Sum of successors.
	$factor = 3; # Parameter to calculate the number of successors.

	while ($pivots > 0){
		# An initial estimate of the sum of the successors of the current number is calculated.
		$aux = (int)($actualNumber / $factor);
		$sumPosterior = ($actualNumber) * $aux + $aux * ($aux + 1) / 2;
		# More successors are added until the sum is greater than the sum of the previous numbers.
		while ($sumPosterior < $sumPrevious){
			$aux += 1;
			$sumPosterior += $actualNumber + $aux;
		}
		# Verification of the pivot number condition.
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
# Example of use:
n_pivots(100);
?>