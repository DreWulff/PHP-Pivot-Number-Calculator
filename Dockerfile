FROM php:8.2-cli
COPY . /usr/src/pivot_calculator
WORKDIR /usr/src/pivot_calculator
CMD [ "php", "./n_pivots.php" ]
