<?php
  include("config.php");
  $query1="
          insert into livello values
            (1,'Admin'),
            (2,'Dirigente'),
            (3,'Utente'),
            (4,'Guest');
          ";
  mysqli_query($conn,$query1)or die ("Errore negli inserimenti".mysqli_error());
  $query2="
          insert into utente values
            ('LucaBabbo',md5('luca'),'1','admin.jpg'),
            ('Stefano Magalli',md5('stefano'),'3','utente.png'),
            ('Andrea Ciro',md5('andrea'),'2','dirigente.jpg'),
            ('Marco Savastano',md5('marco'),'3','utente.png'),
            ('Giulio di Marzio',md5('giulio'),'4','guest.jpg');
          ";
  mysqli_query($conn,$query2)or die ("Errore negli inserimenti".mysqli_error());
  $query3="
    insert into operazione values
       ('AA1','Visualizzazione','3','SI'),
       ('AA2','modifica_accesso','1','SI'),
       ('AA3','Visualizzazione','2','SI'),
       ('AA4','Inserimento','2','SI'),
       ('AA5','modifica_regole','3','NO'),
       ('AA6','Cancellazione','3','NO'),
       ('AA7','Inserimento','4','NO');
  ";
  mysqli_query($conn,$query3)or die ("Errore negli inserimenti".mysqli_error());
  $query4="
    insert into sessione values
       ('A123','Andrea Ciro','2016/10/01 12:09:00','2018/11/13 14:43:45'),
       ('B123','LucaBabbo','2015/09/04 13:48:12','2016/08/24 15:01:32'),
       ('C123','Stefano Magalli','2017/04/09 14:23:19','2019/07/31 08:21:41'),
       ('D123','Marco Savastano','2019/01/15 15:44:45','2019/06/29 01:44:39'),
       ('E123','Giulio di Marzio','2018/12/05 16:14:55','2019/05/07 12:25:08');
  ";
  mysqli_query($conn,$query4)or die ("Errore negli inserimenti".mysqli_error());
  
?>