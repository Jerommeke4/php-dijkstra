# php-dijkstra
This is a simple test code base where I tried out the dijkstra algorythm in PHP.

Dijkstra Algorithm is used for determining the shortest path between two nodes weighted network. For more information on the Dykstra algorithm see: [https://en.wikipedia.org/wiki/Dijkstra's_algorithm](https://en.wikipedia.org/wiki/Dijkstra's_algorithm)

Installation
------------
There are no depedencies on this project except for PHPUnit in require-dev section of composer.

Running
-------
After the code is hosted somewhere navigate to `http://your.host:your_port/`. Using GET parameters in the url for start and end you can let the library calculate the path between nodes.

Docker compose
--------------
Using this simple tool can be done locally or using Docker. Starting the container to test this functionality should be as simple as entering `docker-compose up`.
