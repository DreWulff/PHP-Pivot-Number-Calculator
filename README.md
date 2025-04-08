# PHP Pivot Number Calculator

Small PHP script that defines a function for finding the first `n` numbers that fulfill the next condition:
* The sum of the consecutive numbers that follow any `x` number equals `y` = $\sum_{i=1}^{x-1} i$
    * `y` is the sum of all the numbers that precede `x`.

## Observations
By calculating the first few numbers, multiple patterns can be observed:
* Each number in the sequence is approximately `5.8` times the previous number, converging as seen in the next table:

    | n  | n-Pivot |   | Ratio (n/n-1)       |
    |----|--------------|---|-------------|
    | 1  |            6 |   |             |
    | 2  |           35 |   | 5.833333333 |
    | 3  |          204 |   | 5.828571429 |
    | 4  |         1189 |   | 5.828431373 |
    | 5  |         6930 |   |  5.82842725 |
    | 6  |        40391 |   | 5.828427128 |
    | 7  |       235416 |   | **5.828427125** |
    | 8  |      1372105 |   | **5.828427125** |
    | 9  |      7997214 |   | **5.828427125** |

* The amount of numbers that follow any `x` number in the sequence is approximately `2.41`, converging as seen in the next table:

    | n  | n-Pivot  | Following    | Ratio       |
    |----|---------------|--------------|-------------|
    | 1  |             6 |            2 |           3 |
    | 2  |            35 |           14 |         2.5 |
    | 3  |           204 |           84 | 2.428571429 |
    | 4  |          1189 |          492 | 2.416666667 |
    | 5  |          6930 |         2870 | 2.414634146 |
    | 6  |         40391 |        16730 | 2.414285714 |
    | 7  |        235416 |        97512 | 2.414225941 |
    | 8  |       1372105 |       568344 | 2.414215686 |
    | 9  |       7997214 |      3312554 | 2.414213927 |
    | 10 |      46611179 |     19306982 | 2.414213625 |
    | 11 |     271669860 |    112529340 | 2.414213573 |
    | 12 |    1583407981 |    655869060 | 2.414213564 |
    | 13 |    9229713949 |   3823072694 | 2.414213563 |
    | 14 |   53794827682 |  22282547211 | **2.414213562** |
    | 15 |  313539244100 | 129872207242 | **2.414213562** |
    | 16 | 1827440608860 | 756950684621 | **2.414213562** |

## Algorithm
Considering the previous observations, the search algorithm has been adjusted to use the discovered ratios as parameters.

The process goes through the following steps:
* Initial number being checked (from now on `x`) is set to `2`.
* Sum of previous numbers is set to `1`.
* Scaling parameter (from now on `scaling_parameter`) is set to `5.8`.
* Ratio of following numbers (from now on `ratio`) is set to `3`.
* Up until de required amount of pivots is found, the next process is repeated:
    * An auxiliar number (`aux`) is defined as the division of `x / ratio`.
    * An initial estimation of the sum of the following numbers is calculated as `(x * aux) + (aux * (aux + 1) / 2)`.
    * The numbers that follow `x + aux` are added until the sum is larger or equal than the sum of the previous numbers.
    * If it is equal:
        * Print `x`.
        * Reduce the amount of required pivots by 1.
        * Update `ratio` to `x / aux`.
        * `x = x * scaling_parameter`
        * The sum of previous numbers is adjusted as `(x - 1) * x / 2`.
    * Add `x` to the sum of previous numbers.
    * `x = x + 1`

## Results
It is to be noted that due to the use of division in the calculations, it is quite likely false positives are found, due to problems with precision in floating point numbers.

| n  | n-Pivot     |
|----|-------------------|
| 1  | 6                 |
| 2  | 35                |
| 3  | 204               |
| 4  | 1189              |
| 5  | 6930              |
| 6  | 40391             |
| 7  | 235416            |
| 8  | 1372105           |
| 9  | 7997214           |
| 10 | 46611179          |
| 11 | 271669860         |
| 12 | 1583407981        |
| 13 | 9229713949        |
| 14 | 53794827682       |
| 15 | 313539244100      |
| 16 | 1827440608860     |
| 17 | 10651104186298    |
| 18 | 62079183219990    |
| 19 | 361823987617380   |
| 20 | 2108864698676804  |
| 21 | 12291363949114749 |
| 22 | 71639317507847017 |

It is also because of floating point precision that it is hard to find new numbers, as the parameters keep converging with longer decimals, and by rounding/truncating these ratios an exponentially larger amount of calculations has to be made.
## Possible improvements
* Avoiding the use of divisions.
* Using a more precise numeric format.
* Increasing computing power (as this is running in a container with very limited resources).