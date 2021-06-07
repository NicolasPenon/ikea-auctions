<?php
include("header.php");
include("nav.php");

?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <label for="prod_name">Produktnavn</label>
     <input id="prod_name" type="text" name="name">
     <label for="category-select">Kategori</label>

     <select id="category-select" name="categories">
       <option value="">Vælg venligst en kategori</option>
       <option value="stole">Stol</option>
       <option value="borde">Bord</option>
       <option value="lamper">Lampe</option>
       <option value="reoler">Reole</option>
       <option value="madrasser">Madrasse</option>
     </select>
     <label for="prod_info">Produktinfo</label>
     <input id="prod_info" type="text" name="info">
     <label for="min_price">Minimums Pris</label>
     <input id="min_price" type="number" min="1" step="0.01">
     <label for="date">Slut dato</label>
     <input id="date" type="datetime-local" name="end_date">
   </body>
 </html>
