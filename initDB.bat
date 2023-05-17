create user php@localhost identified by '';

Create database Esercitazione;

use Esercitazione;

create table prodotto(
	id_prodotto int Primary Key AUTO_INCREMENT,
	nome varchar(255),
	descrizione varchar(255),
	prezzo double(5,2),
	quantita int
);

insert into prodotto (nome,descrizione,prezzo,quantita) values ("Coca Cola", "Bibita zuccherata energetica", 2.50, 40), 
("Samson Galaxu 20-nota","Telefono di ultima generazione della famosa azienda samson",400, 20), 
("Quaderno a quadri","Quaderno a quadri da 200 pagine",2,200),
("Compaq","Computer potentissimo",150,26),
("Astucccio Comics","Astuccio poco capiente",6.50,3000000),
("Matite","TANTI COLORI",0.77,200);

grant all on Esercitazione.* to php@localhost;