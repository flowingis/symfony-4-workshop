# Workshop Symfony 4

Questo repository contiene il codice che verrà utilizzato nel workshop Symfony 4.

E' possibile creare un ambiente per far girare l'applicativo utilizzando il comando `docker-compose -d`, lanciandolo nella directory root del progetto. 

Se non ci sono stati errori, aprendo il browser all'indirizzo `http://localhost:8080/` verrà visualizzata la pagina di default di symfony `Welcome to Symfony 4.3.4` 

In alternativa, se non si dispone di docker e docker-compose, è possibile configurare un ambiente adatto a far girare l'applicazione, che necessita di:
- php > 7.1 (con le estensioni necessarie a symfony https://symfony.com/doc/4.2/reference/requirements.html)
- mysql 5.7
- nodejs 8 o 10