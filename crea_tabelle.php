<?php
  include("config.php");
  $query1="
       create table if not exists livello(
         ID_livello int(5) primary key,
         nome varchar(20)
       );
  ";
  $query2="
       create table if not exists utente(
         username varchar(30) primary key,
         password varchar(50),
         livello int(5),
         avatar varchar(50),
         foreign key (livello) references livello(ID_livello) on update cascade on delete cascade
       );
  ";
  $query3="
     create table if not exists operazione(
       ID_operazione varchar(5) primary key,
       tipo varchar(20),
       livello int(5),
       consentito enum('SI','NO'),
       foreign key (livello) references livello(ID_livello) on update cascade on delete cascade
      );
  ";
  $query4="
     create table if not exists sessione(
       ID_sessione varchar(5) primary key,
       utente varchar(20),
       dataOra_login datetime,
       dataOra_logout datetime,
       foreign key (utente) references utente(username) on update cascade on delete cascade
     );
  ";
  
  mysqli_query($conn,$query1) or die("Errore nella creazione della tabella LIVELLO <br>".mysqli_error($conn));  
  echo"tabella LIVELLO creata correttamente!!<br>";
   mysqli_query($conn,$query2) or die("Errore nella creazione della tabella UTENTE <br>".mysqli_error($conn));  
  echo"tabella UTENTE creata correttamente!!<br>";
  mysqli_query($conn,$query3) or die("Errore nella creazione della tabella OPERAZIONE <br>".mysqli_error($conn));  
  echo"tabella OPERAZIONE creata correttamente!! <br>";
  mysqli_query($conn,$query4) or die("Errore nella creazione della tabella SESSIONE <br>".mysqli_error($conn));  
  echo"tabella SESSIONE creata correttamente!! <br>";
  mysqli_close($conn);
?>