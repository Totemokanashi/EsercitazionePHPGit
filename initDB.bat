create user php@localhost identified by '';

Create database Esercitazione;

use Esercitazione;

create table prodotto(
	id_prodotto int Primary Key AUTO_INCREMENT,
	nome varchar(255),
	descrizione varchar(255),
	prezzo double(5,2),
	quantita int,
	image varchar(255)
);

insert into prodotto (nome,descrizione,prezzo,quantita,image) values 
("Coca Cola", "Bibita zuccherata energetica", 2.50, 40,"Coca Cola.png"), 
("Samson Galaxu 20-nota","Telefono di ultima generazione della famosa azienda samson",400, 20,"Samson Galaxu 20-nota.png"), 
("Quaderno a quadri","Quaderno a quadri da 200 pagine",2,200,"Quaderno a quadri.png"),
("Compaq","Computer potentissimo",150,26,"Compaq.png"),
("Astucccio Comics","Astuccio poco capiente",6.50,3000000,"Astucccio Comics.png"),
("Matita","TANTI COLORI",0.77,200,"Matita.png");

grant all on Esercitazione.* to php@localhost;